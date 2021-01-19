<?php

namespace Lupennat\LaravelEnvEnc\Console;

use Illuminate\Support\File;
use Illuminate\Console\Command;
use Illuminate\Encryption\Encrypter;
use Lupennat\LaravelEnvEnc\LaravelEnvEncException;
use Throwable;

class Encrypt extends Command
{

    protected $signature = 'lupennat:env-encrypt
    {?environment : environment to load}';

    protected $description = 'encrypt file env using password';

    public function handle()
    {
        $environment = $this->argument('environment') || null;
        $filename = $environment ? ".env.$environment" : '.env';

        if (!File::exists(base_path($filename))) {
            return $this->error("File " . base_path($filename) . " not found.");
        }

        $password = $this->secret('Provide a password (min 8):');

        if (strlen($password) < 8) {
            return $this->error("The Password must be at least 8 characters.");
        }

        try {
            $content = File::get(base_path($filename));
            $encrypter = new Encrypter($password);
            $encryptedContent = $encrypter->encrypt($content);

            File::put(base_path("$filename.enc"), $encryptedContent);

            $this->success("File " . base_path("$filename.enc") . " succesfully created!");
        } catch (Throwable $e) {
            return $this->error("File " . base_path("$filename.enc") . " not created!");
        }
    }
}
