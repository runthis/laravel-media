<?php

namespace Runthis\Media\Contracts;

use Runthis\Media\Requests\MediaRequest;

interface Media
{
    /**
     * Create the media.
     *
     * @return array{
     *  file: \Illuminate\Http\UploadedFile,
     *  storage: \Illuminate\Contracts\Filesystem\Filesystem,
     *  size: string | \Runthis\Media\Attributes\Size,
     *  url: string
     * }
     */
    public function create(MediaRequest $request, string $directory = ''): object;
}
