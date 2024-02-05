<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public static function savePublicFile(UploadedFile $file, $path, $name = null)
    {
        $extension = empty(($e = $file->getClientOriginalExtension())) ? $file->extension() : $e;

        if ($name) {
            $fileName = $name . '.' .  $extension;
        } else {
            // generate token
            $token = md5(Str::random(40) . microtime());
            // appened token to file extension
            $fileName = $token . "." . $extension;
        }

        // save file and return path
        $file->storeAs("public/" . $path, $fileName);
        $path = 'storage/'. $path .'/'. $fileName;
        return $path;
    }

    public static function deleteFile($path)
    {
        if ($path) {
            Storage::delete($path);
        }

        return;
    }
}
