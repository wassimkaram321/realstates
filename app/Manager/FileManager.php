<?php

namespace App\Manager;

use Illuminate\Foundation\Http\FormRequest;

class FileManager
{
    public static function addFile($image , $path){
        
        $file_extension = $image->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $image->move($path, $file_name);
        $image = $file_name;
        return $image;
    }
}
