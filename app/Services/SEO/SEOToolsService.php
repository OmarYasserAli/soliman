<?php

namespace App\Services\SEO;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Enhance\SEOTool;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SEOToolsService
{
    /**
     * List of SEO tools form input names and validations
     */
    protected $seoInputs = [

        // Meta title and description
        'meta_title'            => 'nullable|string|max:60',
        'meta_description'      => 'nullable|string|max:160',

        // Open Graph Validations
        'og_type'               => 'nullable|string',
        'og_title'              => 'nullable|string|max:65',
        'og_url'                => 'nullable|string',
        'og_image'              => 'image|mimes:jpeg,png,jpg,gif,webp,svg',
        'og_description'        => 'nullable|string|max:155',

        // Twitter Card Validations
        'twitter_card'          => 'nullable|string',
        'twitter_title'         => 'nullable|string|max:65',
        'twitter_site'          => 'nullable|string',
        'twitter_description'   => 'nullable|string|max:155',
        'twitter_image'         => 'image|mimes:jpeg,png,jpg,gif,webp,svg',
        'twitter_image_alt'     => 'nullable|string',
    ];

    /**
     * List of SEO tools inputs of files type
     */
    private $inputFiles = [
        'og_image',
        'twitter_image'
    ];

    /**
     * Request data for the sent validated request data
     */
    private $requestData;

    /**
     * A model to attach the record of SEO Tools to it
     */
    private $model;

    /**
     * Name of directory to store all of uploaded seo tools files
     */
    private $seoToolsDirName;

    /**
     * Class constructor
     */
    public function __construct()
    {
        // Inject seoToolsDirName
        $this->seoToolsDirName = (new SEOTool)->filesPath;

        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        $constructor = method_exists( $this, $fn = "__construct" . $numberOfArguments );

        if ($numberOfArguments == 0) {
            call_user_func_array([$this, '__emptyConstruct'], $arguments);
        } elseif($constructor) {
            call_user_func_array([$this, $fn], $arguments);
        } else {
            throw new Exception("No matching constructor found" . PHP_EOL);
        }
    }

    /**
     * Class empty constructor
     */
    private function __emptyConstruct() { }

    /**
     * Class constructor 1
     * Multiple constructor with only request restriction
     *
     * @param Illuminate\Database\Eloquent\Model $model
     */
    private function __construct1(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Class constructor 2
     * Multiple constructor with request and model restriction
     *
     * @param Illuminate\Http\Request $request
     * @param Illuminate\Database\Eloquent\Model $model
     */
    private function __construct2(Request $request, Model $model)
    {
        $this->requestData = $request->all();
        $this->model = $model;
    }


    /**
     * Handle the entire process for storing SEO Tools details
     *
     * @return void
     */
    public function store()
    {
        $this->handleSEO();
    }

    /**
     * Update the related SEO Tool record of the sent model
     *
     * @return void
     */
    public function update()
    {
        $this->handleSEO();
    }

    /**
     * Delete related SEO tool from the SEOTool model itself to make the boot deleted method be triggered
     *
     * @return void
     */
    public function destroy() : void
    {
        DB::transaction(function() {

            if($this->model->seotool) {

                foreach($this->model->seotool->filesFields as $fileField) {
                    @File::delete(public_path('uploads/' . $this->model->seotool->$fileField));
                }

                SEOTool::destroy($this->model->seotool->id);

                @File::deleteDirectory(public_path('uploads/' . $this->seoToolsDirName . '/' . $this->model->filesPath . '/' . $this->model->id));
            }

        });
    }

    /**
     * A getter for SEO tools validation rules
     *
     * @return array
     */
    public function getSEOToolsValidationRules() : array
    {
        $rules = [];

        foreach(LaravelLocalization::getSupportedLanguagesKeys() as $lang) {
            foreach($this->seoInputs as $key => $value) {
                $rules[$key . ".$lang"] = $value;
            }
        }

        return $rules;
    }

    /**
     * Handle seo for single pages
     */
    public function updatePageSeo(Request $request, string $page_name, Model $pageRecord)
    {
        $requestData = $request->all();
        $pageRecord = SEOTool::where('page_name', $page_name)->first();

        $isFilled = false;

        foreach(array_keys($this->seoInputs) as $seoInputKey) {
            if(isset($requestData[$seoInputKey]) && !empty($requestData[$seoInputKey]) ) {
                $isFilled = true;
                break;
            }
        }

        if($isFilled) {

            foreach($this->inputFiles as $inputFileKey) {
                if(isset($requestData[$inputFileKey])) {

                    $uniqueFolder = md5(Str::random(10) . time());
                    $file = $requestData[$inputFileKey];
                    $fileName = $file->getClientOriginalName();
                    $filePath = "{$this->seoToolsDirName}/seoforpages/{$page_name}/{$pageRecord->id}/{$uniqueFolder}/";

                    // Delete old file parent directory if the file exists (whether we're in store or update process)
                    if(isset($pageRecord)) {
                        if(is_file(public_path('uploads/' . $pageRecord->$inputFileKey))) @File::deleteDirectory(public_path('uploads/' . dirname($pageRecord->$inputFileKey)));
                    }

                    $file->move(public_path("uploads/$filePath"), $fileName);
                    $requestData[$inputFileKey] = $filePath . $fileName;
                }
            }

            $data = [];

            foreach(array_keys($this->seoInputs) as $key) {
                if(isset($requestData[$key])) $data[$key] = $requestData[$key];
            }

            $pageRecord->update($data);
        }

        return $pageRecord;
    }

    /**
     * Handle the store or update Seo data processes for a specific model
     *
     * @return void
     */
    private function handleSEO()
    {
        if($this->anySEOInputIsFilled()) {

            $this->uploadSEOToolsImages();
            $this->handleSEOToolRecord();
        }
    }

    /**
     * Create or update the record for seotools table attached with its relevant model.
     *
     * @return void
     */
    private function handleSEOToolRecord() : void
    {
        $seoToolRecord = SEOTool::updateOrCreate(
            ['seoable_id' => $this->model->id, 'seoable_type' => get_class($this->model)],
            $this->getOnlySEOFields(),
        );

        $this->model->seotool()->save($seoToolRecord);
    }

    /**
     * Handle the upload process of any image file related to SEO Tools
     *
     * @return void
     */
    private function uploadSEOToolsImages() : void
    {
        foreach($this->inputFiles as $inputFileKey) {
            if(isset($this->requestData[$inputFileKey])) {

                [$file, $fileName, $filePath] = $this->getNeededFileData($inputFileKey);

                // Delete old file parent directory if the file exists (whether we're in store or update process)
                if(isset($this->model->seotool)) {
                    if(is_file(public_path('uploads/' . $this->model->seotool->$inputFileKey))) @File::deleteDirectory(public_path('uploads/' . dirname($this->model->seotool->$inputFileKey)));
                }

                $file->move(public_path("uploads/$filePath"), $fileName);
                $this->requestData[$inputFileKey] = $filePath . $fileName;
            }
        }
    }

    /**
     * Check if any input from SEO Tools type is sent and filled in the request
     *
     * @return bool A flag to determine if any input from SEO Tools type is filled or not
     */
    private function anySEOInputIsFilled() : bool
    {
        $isFilled = false;

        foreach(array_keys($this->seoInputs) as $seoInputKey) {
            if(isset($this->requestData[$seoInputKey]) && !empty($this->requestData[$seoInputKey]) ) {
                $isFilled = true;
                break;
            }
        }

        return $isFilled;
    }

    /**
     * Get only the seo inputs keys and values from the request data
     *
     * @return array
     */
    private function getOnlySEOFields() : array
    {
        $data = [];

        foreach(array_keys($this->seoInputs) as $key) {
            if(isset($this->requestData[$key])) $data[$key] = $this->requestData[$key];
        }

        return $data;
    }

    /**
     * Get needed file data during storing or updating uploaded file process
     *
     * @param string $inputFileKey
     * @return array
     */
    private function getNeededFileData(string $inputFileKey)
    {
        $file = $this->requestData[$inputFileKey];
        $uniqueFolder = md5(Str::random(10) . time());

        return [$file, $file->getClientOriginalName(), "{$this->seoToolsDirName}/{$this->model->filesPath}/{$this->model->id}/{$uniqueFolder}/"];
    }
}
