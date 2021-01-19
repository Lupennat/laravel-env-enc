# laravel-env-enc

[![GitHub license](https://img.shields.io/badge/License-MIT-green.svg)](https://github.com/mrgswift/laravel-encryptenv/blob/master/LICENSE)

This package allows you to Encrypt/Decrypt your .envs file in Laravel.

## Install

```console
$ composer require lupennat/laravel-env-enc
```

## Encrypt/Decrypt file .env

```console
$ php artisan lupennat:encrypt-env
Provide a password (min 8):
> Password
File /xxx/.env.enc succesfully created!
```

```console
$ php artisan lupennat:decrypt-env
Provide a password (min 8):
> Password
File /xxx/.env succesfully created!
```

## Manage multiple .env

```console
$ php artisan lupennat:encrypt-env local
Provide a password (min 8):
> Password
File /xxx/.env.local.enc succesfully created!
```

```console
$ php artisan lupennat:decrypt-env local
Provide a password (min 8):
> Password
File /xxx/.env.local succesfully created!
```

## Hide sensitive data

add these lines in the .gitignore file

```txt
.env*
!.env.*.enc
```

Encrypt your env files and push on your repository.

## License

[MIT](https://github.com/Lupennat/laravel-env-enc/blob/main/LICENSE)
