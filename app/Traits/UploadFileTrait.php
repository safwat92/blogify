<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UploadFileTrait
{
    public function uploadFile(Request $request, string $inputName = null, string $folder)
    {
        if ($request->hasFile($inputName)) {
            return $request->file($inputName)->store($folder, 'public');
        }
        return null;
    }
}
