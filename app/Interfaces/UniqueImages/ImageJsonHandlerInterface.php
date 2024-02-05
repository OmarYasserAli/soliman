<?php

namespace App\Interfaces\UniqueImages;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

interface ImageJsonHandlerInterface
{
    public function setImageJsonDataForImage(array $requestData, string $imageName, string $imageKey, string $lang);

    public function getImageDetailsJsonStorageData() : array;

    public function initializeJsonDataByTheOldModel(Model $model);

    public function editSpecificFieldInImageDetails(array $requestData, Model $model, string $field, string $imageKey, string $lang);
}
