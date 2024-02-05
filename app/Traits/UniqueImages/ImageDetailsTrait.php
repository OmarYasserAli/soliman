<?php

namespace App\Traits\UniqueImages;

use App\Models\Enhance\ImageDetails;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait ImageDetailsTrait
{
    /**
     * Get all the unique images columns names to construct there form inputs blade layout
     *
     * @return array
     */
    public function getModelUniqueImageToFormInputNames() : array
    {
        $imagesKeys = [];

        foreach($this->uniqueFiles as $key => $value) {
            $imagesKeys[] = $value['formInputKey'];
        }

        return $imagesKeys;
    }

    /**
     * Get all needed validation rules for image details related to the current model
     *
     * @return array
     */
    public function getImagesValidationRules() : array
    {
        $rules = [];

        foreach($this->uniqueFiles as $columnName) {
            $rules[$columnName . '_name']   = ['nullable', 'string', 'max:255'];
            $rules[$columnName . '_title']  = ['nullable', 'string', 'max:255'];
            $rules[$columnName . '_alt']    = ['nullable', 'string', 'max:255'];
        }

        return $rules;
    }

    /**
     * Get the path of the current image
     *
     * @param string $lang
     * @param string $key
     */
    public function getImagePath(string $key, string $lang)
    {
        return @$this->imageDetails->image_details[$key]['path'][$lang];
    }

    /**
     * Get the alt of the current image
     *
     * @param string $lang
     * @param string $key
     */
    public function getImageAlt(string $key, string $lang)
    {
        return @$this->imageDetails->image_details[$key]['alt'][$lang];
    }

    /**
     * Get the title of the current image
     *
     * @param string $lang
     * @param string $key
     */
    public function getImageTitle(string $key, string $lang)
    {
        return @$this->imageDetails->image_details[$key]['title'][$lang];
    }

    /**
     * Get the post's image.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphOne;
     */
    public function imageDetails(): MorphOne
    {
        return $this->morphOne(ImageDetails::class, 'imageable_details');
    }
}
