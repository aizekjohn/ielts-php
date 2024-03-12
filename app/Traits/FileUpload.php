<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait FileUpload
{
    /**
     * Upload a single file to the specified folder on the local disk.
     *
     * @param  UploadedFile $file
     * @param  string $folder
     * @return array  The generated path + original file name
     */
    public function uploadSingleFile(UploadedFile $file, string $folder): array
    {
        $filename = $this->generateUniqueFilename($file);

        return [
            'path' => $file->storeAs($folder, $filename, 'public'),
            'originalName' => $file->getClientOriginalName(),
        ];
    }

    /**
     * Upload multiple files to the specified folder on the local disk.
     *
     * @param  array  $files
     * @param  string  $folder
     * @return array  The array of generated unique filenames
     */
    public function uploadMultipleFiles(array $files, string $folder): array
    {
        $filenames = [];

        foreach ($files as $file) {
            $filenames[] = $this->uploadSingleFile($file, $folder);
        }

        return $filenames;
    }

    /**
     * Generate a unique filename for the uploaded file.
     *
     * @param  UploadedFile  $file
     * @return string
     */
    protected function generateUniqueFilename(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        return Str::uuid()->toString() . '.' . $extension;
    }
}
