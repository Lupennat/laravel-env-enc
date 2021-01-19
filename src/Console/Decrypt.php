<?php

namespace Lupennat\LaravelEnvEnc\Console;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use Illuminate\Encryption\Encrypter;
use Lupennat\LaravelEnvEnc\LaravelEnvEncException;
use Throwable;

class Decrypt extends Command
{

    protected $signature = 'lupennat:env-decrypt
    {environment? : environment to load}';

    protected $description = 'decrypt file env using password';

    public function handle()
    {
        $environment = $this->argument('environment') || null;
        $filename = $environment ? ".env.$environment" : '.env';

        if (!File::exists(base_path("$filename.enc"))) {
            throw new LaravelEnvEncException("File " . base_path("$filename.enc") . " not found.");
        }

        $password = $this->secret('Provide a password (min 8):');

        if (strlen($password) < 8) {
            throw new LaravelEnvEncException("The Password must be at least 8 characters.");
        }

        try {
            $content = File::get(base_path("$filename.enc"));
            $decrypter = new Encrypter($password);
            $decryptedContent = $decrypter->decrypt($content);

            File::put(base_path($filename), $decryptedContent);

            $this->success("File " . base_path($filename) . " succesfully created!");
        } catch (Throwable $e) {
            return $this->error("File " . base_path($filename) . " not created!");
        }
    }
}
