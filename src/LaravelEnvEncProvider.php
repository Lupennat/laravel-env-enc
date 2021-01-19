<?php

namespace Lupennat\LaravelEnvEnc;

use Illuminate\Support\ServiceProvider;
use Lupennat\LaravelEnvEnc\Console\Decrypt;
use Lupennat\LaravelEnvEnc\Console\Encrypt;

class LaravelEnvEncProvider extends ServiceProvider
{

    public function boot()
    {
        $this->commands([
            Decrypt::class,
            Encrypt::class
        ]);
    }
}
