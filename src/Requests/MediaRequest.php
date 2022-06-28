<?php

namespace Runthis\Media\Requests;

use Illuminate\Foundation\Http\FormRequest;

use function config;

class MediaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'file' => config('media.rules'),
        ];
    }
}
