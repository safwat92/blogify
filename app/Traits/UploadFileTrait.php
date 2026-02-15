<?php

namespace App\Traits;

trait UploadFileTrait
{
    public function uploadFile($request, $inputName, $folder)
    {
        if ($request->hasFile($inputName)) {
            return $request->file($inputName)->store($folder, 'public');
        }
        return null;
    }
}
