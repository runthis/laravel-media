<?php

namespace Runthis\Media;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Runthis\Media\Attributes\Size;
use Runthis\Media\Contracts\Media as MediaContract;
use Runthis\Media\Requests\MediaRequest;

use function asset;
use function config;

class Media implements MediaContract
{
    /**
     * The storage disk.
     */
    protected string $disk = 'media.disk';

    /**
     * This file system.
     */
    protected Filesystem $storage;

    /**
     * Create the media.
     *
     * @return object{
     *  file: \Illuminate\Http\UploadedFile,
     *  storage: \Illuminate\Contracts\Filesystem\Filesystem,
     *  size: string | \Runthis\Media\Attributes\Size,
     *  url: string,
     *  path: string
     * }
     */
    public function create(MediaRequest $request, string $directory = ''): object
    {
        $this->request = $request;
        $file = $this->storeFile($directory);

        return (object) [
            'file' => $this->getFile(),
            'storage' => $this->getStorage(),
            'size' => new Size($this->getFile()->getSize()),
            'url' => asset(Storage::url($file)),
            'path' => $this->getStorage()->path($file),
        ];
    }

    /**
     * Get the storage.
     */
    protected function getStorage(): Filesystem
    {

        if (!isset($this->storage)) {
            $this->storage = Storage::disk(config($this->disk));
        }

        return $this->storage;
    }

    /**
     * Get the uploaded file.
     */
    protected function getFile(): UploadedFile
    {

        if (!isset($this->file)) {
            $this->file = $this->request->file('file');
        }

        return $this->file;
    }

    /**
     * Store the uploaded file.
     */
    protected function storeFile(string $directory): string|bool
    {
        return $this->getStorage()->putFile($directory, $this->getFile());
    }
}
