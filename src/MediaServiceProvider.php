<?php

namespace Runthis\Media;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MediaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('media')->hasConfigFile();
        $this->app->bind('media', static fn ($app) => new Media());
    }
}
