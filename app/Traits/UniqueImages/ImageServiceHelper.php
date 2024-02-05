<?php

namespace App\Traits\UniqueImages;

use Illuminate\Support\Str;

trait ImageServiceHelper
{
    /**
     * Generate image title depending on the image name without the image extension separated with hyphens
     *
     * @return string
     */
    protected function separateImageNameWithHyphens(string $imageName) : string
    {
        $title = '';

        $imageParts = explode('.', $imageName);

        if(isset($imageParts[0])) $title = $this->addHyphens($imageParts[0]);

        return $title;
    }

    /**
     * Replace spaces with hyphens in any sent string
     *
     * @param string $value
     * @return string
     */
    protected function addHyphens(string $value) : string
    {
        return str_replace(' ', '-', $value);
    }

    /**
     * Generate unique directory name
     *
     * @return string
     */
    private function generateUniqueDirectoryName() : string
    {
        return md5(Str::random(10) . time());
    }
}

