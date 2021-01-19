<?php

namespace Lupennat\LaravelEnvEnc\Console;

use Illuminate\Console\Command;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\File;
use Throwable;

class Decrypt extends Command
{

    protected $signature = 'lupennat:env-decrypt
    {environment? : environment to load}';

    protected $description = 'decrypt file env using key';

    public function handle()
    {
        $environment = $this->argument('environment');
        $filename = $environment ? ".env.$environment" : '.env';

        if (!File::exists(base_path("$filename.enc"))) {
            return $this->error("File " . base_path("$filename.enc") . " not found.");
        }

        $key = $this->secret('Provide a key:');

        $availableChipers = ['AES-128-CBC', 'AES-256-CBC'];

        $chiper = $this->choice(
            'What is key cheaper?',
            $availableChipers,
            array_search($this->laravel['config']['app.cipher'], $availableChipers)
        );

        try {
            $content = File::get(base_path("$filename.enc"));
            $decrypter = new Encrypter(base64_decode($key), $chiper);
            $decryptedContent = $decrypter->decrypt($content);

            File::put(base_path($filename), $decryptedContent);

            $this->info("File " . base_path($filename) . " succesfully created!");
        } catch (Throwable $e) {
            $this->error("File " . base_path($filename) . " not created!");
            $this->error($e->getMessage());
        }
    }
}
