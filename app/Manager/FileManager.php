<?php

namespace App\Manager;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\File;

class FileManager
{
    public static function addFile($image, $path)
    {

        $file_extension = $image->getClientOriginalExtension();
        $file_name = rand() . time() . '.' . $file_extension;
        $image->move($path, $file_name);
        $image = $file_name;
        return $file_name;
    }
    public static function getFileName($file)
    {


        return $file->getClientOriginalName();
    }
    public static function deleteFile($image, $path = 'images')
    {

            $imageName = basename($image);

            $imagePath = public_path($path . $imageName);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            return true;
    }
}
