<?php

namespace App\Http\Controllers;

use Illuminate\Http\UploadedFile;

abstract class Controller
{
    /**
     * Store an uploaded file on the public disk safely, with a move() fallback
     * when realpath() on the PHP temp directory returns false on Windows.
     */
    protected function storePublicFile(UploadedFile $file, string $directory): string
    {
        $realPath = $file->getRealPath();
        if ($realPath !== false && $realPath !== '' && is_file($realPath)) {
            return $file->store($directory, 'public');
        }

        $directory = trim($directory, '/');
        $filename = $file->hashName();
        $targetDir = storage_path('app/public/'.$directory);

        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file->move($targetDir, $filename);

        return $directory.'/'.$filename;
    }
}
