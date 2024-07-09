<?php

namespace Lupennat\LaravelEnvEnc\Console;

use Illuminate\Console\Command;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\File;
use Throwable;

class Encrypt extends Command
{

    protected $signature = 'lupennat:env-encrypt
    {environment? : environment to load} {--K|key=} {--C|chiper=AES-256-CBC : AES-128-CBC or AES-256-CBC}';

    protected $description = 'encrypt file env using key';

    public function handle()
    {
        $environment = $this->argument('environment');
        $filename = $environment ? ".env.$environment" : '.env';

        if (!File::exists(base_path($filename))) {
            return $this->error("File " . base_path($filename) . " not found.");
        }

        $key = $this->options()['key'] ?? $this->secret('Provide a key:');

        $availableChipers = ['AES-128-CBC', 'AES-256-CBC'];

        $chiper = $this->options()['chiper'] ?? $this->choice(
            'What is key cheaper?',
            $availableChipers,
            array_search($this->laravel['config']['app.cipher'], $availableChipers)
        );

        if(!in_array($chiper, $availableChipers)) {
            return $this->error("Chiper '" . $chiper .  "' not valid.");
        }

        $encrypter = new Encrypter(base64_decode($key), $chiper);

        try {
            $content = File::get(base_path($filename));
            $encrypter = new Encrypter(base64_decode($key), $chiper);
            $encryptedContent = $encrypter->encrypt($content);

            File::put(base_path("$filename.enc"), $encryptedContent);

            $this->info("File " . base_path("$filename.enc") . " succesfully created!");
        } catch (Throwable $e) {
            $this->error("File " . base_path("$filename.enc") . " not created!");
            $this->error($e->getMessage());
        }
    }
}
