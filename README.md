# Laravel Media

A tiny laravel package to conveniently handle single file media uploads with little configuration.



## Installation

    composer require runthis/laravel-media



## Usage

Add to the file you want to process uploads in, such as a controller.

    use Runthis\Media\Facades\Media;
    use Runthis\Media\Requests\MediaRequest;


Include the `MediaRequest` class in the function parameter and execute the `create` method on the `Media` facade.

Example:

    public function upload(MediaRequest $request) {
        $test = Media::create($request);
        dd($test);
    }

Inside the `dd()` you can see the complete object details and process these as you see fit (such as keeping track of these uploads in a database if you like).

Within the object results is a `size` key. You can simply echo this out to get the bytes, or you can add `->pretty()` to get a prettier output.
You can also pass a string parameter to the `pretty()` method.

Options:

    l: lowercase suffix (12.45 mb instead of 12.45 MB)
    s: spacing omitted (12.45MB instead of 12.45 MB)
    b: Ending "B" removed (12.45 M instead of 12.45 MB)

Examples:

    $test->size->pretty('sb'); // 12.45M
    $test->size->pretty('ls'); // 12.45m
    $test->size->pretty('l'); // 12.45 mb
    $test->size->pretty('bl'); // 12.45 m


*The `Media::create` method expects a file with the key named file.*



## Publish Config

If you want, run the below command to add a media.php file to your config folder.

    php artisan vendor:publish --tag="media-config"

From the media config file you can change the storage disk name and the rules for the media (such as file types, size limit, etc).



## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

