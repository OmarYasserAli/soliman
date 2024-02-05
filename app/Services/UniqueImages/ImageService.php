<?php

namespace App\Services\UniqueImages;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Enhance\ImageDetails;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use App\Services\UniqueImages\ImageJsonHandler;
use App\Traits\UniqueImages\ImageServiceHelper;
use App\Interfaces\UniqueImages\ImageJsonHandlerInterface;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class ImageService
{
    use ImageServiceHelper;

    /**
     * The request
     */
    private Request $request;

    /**
     * Handled Request Data
     */
    private array $requestData;

    /**
     * The needed model to handle its images
     */
    private Model $model;

    /**
     * Image json handler object
     */
    private ImageJsonHandlerInterface $imageJsonHandler;

    /**
     * A flag to determine whether the request contains an image details needed to be handled or not
     */
    private bool $handleImageDetailsRecordFlag = false;

    /**
     * The full current handled image name with extension e.g (foo.png)
     */
    private string $imageName;

    /**
     * The language image key e.g (logo_ar)
     */
    private string $imageLangKey;

    /**
     * Class constructor
     *
     * @param Request $request
     * @param Model $model
     */
    public function __construct()
    {
        // Initialize the json handler
        $this->imageJsonHandler = new ImageJsonHandler;

        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        $constructor = method_exists( $this, $fn = "__construct" . $numberOfArguments );

        if ($constructor) {
            call_user_func_array([$this, $fn], $arguments);
        } else {
            throw new Exception("No matching constructor found" . PHP_EOL);
        }
    }

    /**
     * Class constructor 1
     *
     * @param Model $model
     */
    private function __construct1(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Class constructor 2
     *
     * @param Request $request
     * @param Model $model
     */
    private function __construct2(Request $request, Model $model)
    {
        $this->request = $request;
        $this->requestData = $request->all();
        $this->model = $model;
    }

    /**
     * The entry point for storing process to handle the images
     *
     * @return void
     */
    public function store()
    {
        /**
         * Check if any image is uploaded then set a flag and initialize image I'm gonna work on.
         */
        foreach(LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
            foreach($this->model->uniqueFiles as $imageKey => $value) {

                if($this->request->hasFile($value['formInputKey'] . '_' . $lang)) {

                    $this->initializeImageData($imageKey, $lang);

                    $this->requestData[$this->imageLangKey] = $this->storeImageOnDisk();

                    $this->imageJsonHandler->setImageJsonDataForImage($this->requestData, $this->imageName, $imageKey, $lang);

                    $this->handleImageDetailsRecordFlag = true;

                }
            }
        }
    }

    /**
     * The entry point for updating process to handle the images
     */
    public function update()
    {
        $this->imageJsonHandler->initializeJsonDataByTheOldModel($this->model);

        foreach(LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
            foreach($this->model->uniqueFiles as $imageKey => $value) {

                $this->initializeImageData($imageKey, $lang);

                if($this->request->hasFile($this->imageLangKey)) {

                    $this->requestData[$this->imageLangKey] = isset($this->model->imageDetails) ? $this->updateImageOnDisk($imageKey, $lang) : $this->storeImageOnDisk();

                    $this->imageJsonHandler->setImageJsonDataForImage($this->requestData, $this->imageName, $imageKey, $lang);

                    $this->handleImageDetailsRecordFlag = true;

                }
                else {
                    $this->handleImageDetailsOnUpdate($imageKey, $lang);
                }
            }
        }
    }

    /**
     * The entry point for the deleting process
     *
     * @return void
     */
    public function destroy()
    {
        DB::transaction(function() {

            if($this->model->imageDetails) {
                foreach($this->model->imageDetails->image_details as $key => $value) {
                    foreach(LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
                        @File::delete(public_path('uploads/' . $value['path'][$lang]));
                    }
                }
            }

            ImageDetails::where('imageable_details_id', $this->model->id)->delete();

            if(File::exists('uploads/' . $this->model->filesPath . '/' . $this->model->id)) File::deleteDirectory(public_path('uploads/' . $this->model->filesPath . '/' . $this->model->id));

        });
    }

    /**
     * Store the uploaded image with different name depending on the sent image name
     *
     * @return string Full path of the image
     */
    private function storeImageOnDisk() : string
    {
        $path = $this->model->filesPath;

        /**
         * Store the image in a unique folder
         */
        $uniqueFolder = $this->generateUniqueDirectoryName();
        $this->request->file($this->imageLangKey)->move(public_path("uploads/$path/" . $this->model->id . '/' . $uniqueFolder), $this->imageName);
        $fullImagePath = $path . '/'. $this->model->id . '/' . $uniqueFolder . '/' . $this->imageName;

        return $fullImagePath;
    }

    /**
     * Update the uploaded image with different name depending on the sent image name
     *
     * @param string $imageKey e.g logo
     * @param string $lang e.g en
     * @return string Full path of the image
     */
    private function updateImageOnDisk(string $imageKey, string $lang) : string
    {
        $oldImagePath       = $this->model->imageDetails->image_details[$imageKey]['path'][$lang];
        $pathToOldImageDir  = dirname($oldImagePath);

        // Delete the old image file
        @File::delete(public_path('uploads/' . $oldImagePath));

        // Store the new uploaded image but keep it in the same unique directory of the old image
        $this->request->file($this->imageLangKey)->move(public_path('uploads/' . $pathToOldImageDir . '/'), $this->imageName);
        $fullImagePath = $pathToOldImageDir . '/' . $this->imageName;

        return $fullImagePath;
    }

    /**
     * Update a specific element in image details
     *
     * @param string $imageKey
     * @param string $lang
     * @return void
     */
    private function handleImageDetailsOnUpdate(string $imageKey, string $lang)
    {
        if(@isset($this->request->input($imageKey . '_title')[$lang])) {
            $this->handleImageDetailsRecordFlag = true;
            $this->imageJsonHandler->editSpecificFieldInImageDetails($this->requestData, $this->model, 'title', $imageKey, $lang);
        }
        if(@isset($this->request->input($imageKey . '_alt')[$lang])) {
            $this->handleImageDetailsRecordFlag = true;
            $this->imageJsonHandler->editSpecificFieldInImageDetails($this->requestData, $this->model, 'alt', $imageKey, $lang);
        }
        if(@isset($this->request->input($imageKey . '_name')[$lang])) {
            $this->handleImageDetailsRecordFlag = true;
            $this->imageJsonHandler->editSpecificFieldInImageDetails($this->requestData, $this->model, 'name', $imageKey, $lang);
        }
    }

    /**
     * Initialize the needed data along the image life cycle
     *
     * @param string $imageKey
     * @param string $lang
     * @return void
     */
    private function initializeImageData(string $imageKey, string $lang)
    {
        $this->imageLangKey = $imageKey . '_' . $lang;
        $this->imageName = isset($this->requestData[$imageKey . '_name'][$lang]) ? $this->requestData[$imageKey . '_name'][$lang] : $this->addHyphens($this->request->file($this->imageLangKey)->getClientOriginalName());
    }

    /**
     * Create new record for image details
     *
     * @return void
     */
    private function handleImageDetailsRecord()
    {
        $imageDetailsRecord = ImageDetails::updateOrCreate(
            ['imageable_details_id' => $this->model->id, 'imageable_details_type' => get_class($this->model)],
            ['image_details' => $this->imageJsonHandler->getImageDetailsJsonStorageData()]
        );
        $this->model->imageDetails()->save($imageDetailsRecord);
    }

    /**
     * Get all needed validation rules for image details
     *
     * @return array
     */
    public function getImageValidationRules() : array
    {
        $rules = [];

        foreach(LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
            foreach($this->model->uniqueFiles as $key => $value) {
                $rules[$key . "_$lang"] = $value['validation'];
            }
        }

        return $rules;
    }

    /**
     *  Validation for image details
     *
     * @param string $action determine whether the action is store is update
     *
     * @return array
     */
    public function getImageDetailsValidationRules(string $action = 'update') : array
    {
        $rules = [];

        foreach(LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
            foreach($this->model->uniqueFiles as $key => $value) {
                $rules[$key . '_name' .  ".$lang"] = $action == 'update' ? 'required|string|max:255' : 'nullable|string|max:255' ;
                $rules[$key . '_title' .  ".$lang"] = 'nullable|string|max:255';
                $rules[$key . '_alt' .  ".$lang"] = 'nullable|string|max:255';
            }
        }

        return $rules;
    }

    /**
     * Class destructor
     */
    public function __destruct()
    {
        // Convert the request data into the json data then save it to the model
        if($this->handleImageDetailsRecordFlag) $this->handleImageDetailsRecord();
    }
}
