<?php

namespace Lupennat\LaravelEnvEnc\Console;

use Illuminate\Console\Command;
use Illuminate\Encryption\Encrypter;

class GenerateKey extends Command
{

    protected $signature = 'lupennat:env-generate-key';

    protected $description = 'generate password to encrypt/decrypt envs';

    public function handle()
    {

        $this->line(base64_encode(
            Encrypter::generateKey($this->laravel['config']['app.cipher'])
        ));
    }
}
