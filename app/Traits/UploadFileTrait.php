<?php

namespace App\Traits;

use File;

trait UploadFileTrait
{
    public function uploadFile($file,$path)
    {
        return $file->store('avatars');
    }
}
