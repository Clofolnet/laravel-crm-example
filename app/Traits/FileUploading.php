<?php

namespace App\Traits;

trait FileUploading
{
    public function fileUploadind($params, $request, $data)
    {
        foreach ($data as $field_name => $file_path) {
            if ($request->hasFile($field_name)) {
                $path =  $file_path;
                $params[$field_name] = $request->file($field_name)->store($path, 'protected_storage');
            }
        }
        return $params;
    }
}