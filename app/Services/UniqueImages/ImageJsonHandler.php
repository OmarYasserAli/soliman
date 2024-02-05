<?php

namespace App\Services\UniqueImages;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UniqueImages\ImageServiceHelper;
use App\Interfaces\UniqueImages\ImageJsonHandlerInterface;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class ImageJsonHandler implements ImageJsonHandlerInterface
{
    use ImageServiceHelper;

    /**
     * The final image details to be stored as a json format in the polymorphic table (for only one image)
     */
    private array $imageDetailsJsonStorageData;

    /**
     * Save the image details in an array that matches the json format which it's going to be saved into the db
     */
    public function setImageJsonDataForImage(array $requestData, string $imageName, string $imageKey, string $lang)
    {

        /**
         * Just image name separated by hyphens without the image extension
         */
        $separatedImageNameWithHyphens = $this->separateImageNameWithHyphens($imageName);

        /**
         * If user submits the image title input
         */
        isset($requestData[$imageKey . '_title'][$lang])
        ? $this->imageDetailsJsonStorageData[$imageKey]['title'][$lang] = $requestData[$imageKey . '_title'][$lang]
        : $this->imageDetailsJsonStorageData[$imageKey]['title'][$lang] = $separatedImageNameWithHyphens;

        /**
         * If user submits the image alt input
         */
        isset($requestData[$imageKey . '_alt'][$lang])
        ? $this->imageDetailsJsonStorageData[$imageKey]['alt'][$lang] = $requestData[$imageKey . '_alt'][$lang]
        : $this->imageDetailsJsonStorageData[$imageKey]['alt'][$lang] = $separatedImageNameWithHyphens;

        $this->imageDetailsJsonStorageData[$imageKey]['name'][$lang] = $this->addHyphens($imageName);

        $this->imageDetailsJsonStorageData[$imageKey]['path'][$lang] = $requestData[$imageKey . '_' . $lang];
    }

    /**
     * Gettter for imageDetailsJsonStorageData property
     *
     * @return array
     */
    public function getImageDetailsJsonStorageData() : array
    {
        return $this->imageDetailsJsonStorageData;
    }

    /**
     * Load the updating model data from the model to the jsonStorage array
     *
     * @param Model $model
     * @param string $imageKey
     * @return void
     */
    public function initializeJsonDataByTheOldModel(Model $model)
    {
        if(@$oldModelImageDetails = $model->imageDetails->image_details) {
            foreach(LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
                foreach($model->uniqueFiles as $imageKey => $value) {
                    @$this->imageDetailsJsonStorageData[$imageKey]['title'][$lang]    = $oldModelImageDetails[$imageKey]['title'][$lang];
                    @$this->imageDetailsJsonStorageData[$imageKey]['alt'][$lang]      = $oldModelImageDetails[$imageKey]['alt'][$lang];
                    @$this->imageDetailsJsonStorageData[$imageKey]['name'][$lang]     = $oldModelImageDetails[$imageKey]['name'][$lang];
                    @$this->imageDetailsJsonStorageData[$imageKey]['path'][$lang]     = $oldModelImageDetails[$imageKey]['path'][$lang];
                }
            }
        }
    }

    /**
     * Edit the given field in the image details
     *
     * @param string $imageColumnName
     * @param string $field
     * @param string $lang
     * @return void
     */
    public function editSpecificFieldInImageDetails(array $requestData, Model $model, string $field, string $imageKey, string $lang)
    {
        switch($field) {
            case 'title':
                $this->imageDetailsJsonStorageData[$imageKey]['title'][$lang] = $requestData[$imageKey . '_title'][$lang];
                break;

            case 'alt':
                $this->imageDetailsJsonStorageData[$imageKey]['alt'][$lang] = $requestData[$imageKey . '_alt'][$lang];
                break;

            case 'name':

                try {
                    $newName = $this->addHyphens($requestData[$imageKey . '_name'][$lang]);
                    $parentDir = dirname($model->imageDetails->image_details[$imageKey]['path'][$lang]);
                    $newPath = $parentDir . '/' . $newName;

                    File::move(public_path('uploads/' . $model->imageDetails->image_details[$imageKey]['path'][$lang]), public_path('uploads/' . $newPath));
                    $this->imageDetailsJsonStorageData[$imageKey]['name'][$lang] = $newName;
                    $this->imageDetailsJsonStorageData[$imageKey]['path'][$lang] = $newPath;

                } catch(Exception $e) {
                    Log::info('Error in editSpecificFieldInImageDetails() method: ' . $e->getMessage() . PHP_EOL);
                }

                break;
        }
    }
}

