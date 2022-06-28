<?php

namespace Runthis\Media\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static object{ file: \Illuminate\Http\UploadedFile, storage: \Illuminate\Contracts\Filesystem\Filesystem, size: string | \Runthis\Media\Attributes\Size, url: string, path: string } create(\Runthis\Media\Requests\MediaRequest $request, string $directory = '') Create media and return object.
 */
class Media extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'media';
    }
}
