<?php
namespace App\Traits;
Trait OffresTrait
{
    function saveImages($photo,$path){
        $file_extension= $photo -> getClientOriginalExtension();
        $file_name=time().'.'.$file_extension;
        $folderPath= $path;
        $photo->move($folderPath,$file_name);
        return $file_name;
    }
}
