# laravel-env-enc

[![GitHub license](https://img.shields.io/badge/License-MIT-green.svg)](https://github.com/mrgswift/laravel-encryptenv/blob/master/LICENSE)

This package allows you to Encrypt/Decrypt your .envs file in Laravel.

## Install

```console
$ composer require lupennat/laravel-env-enc
```

## Generate a valid key

Generate a new key based on `config.app.chiper`.

```console
$ php artisan lupennat:env-generate-key

nvK/Ay8HrB+3SAYnWSehUYajMqceBdpwvp45U3cYWd4=

```

**Store your key outside the laravel project.**

## Encrypt/Decrypt file .env

```console
$ php artisan lupennat:env-encrypt
Provide a key:
 > nvK/Ay8HrB+3SAYnWSehUYajMqceBdpwvp45U3cYWd4=
Which key cipher? [AES-256-CBC]:
  [0] AES-128-CBC
  [1] AES-256-CBC
 > 1
File /xxx/.env.enc succesfully created!
```

```console
$ php artisan lupennat:env-decrypt
Provide a key:
 > nvK/Ay8HrB+3SAYnWSehUYajMqceBdpwvp45U3cYWd4=
Which key cipher? [AES-256-CBC]:
  [0] AES-128-CBC
  [1] AES-256-CBC
 > 1
File /xxx/.env succesfully created!
```

## Manage multiple .env

```console
$ php artisan lupennat:env-encrypt local
Provide a key:
 > nvK/Ay8HrB+3SAYnWSehUYajMqceBdpwvp45U3cYWd4=
Which key cipher? [AES-256-CBC]:
  [0] AES-128-CBC
  [1] AES-256-CBC
 > 1
File /xxx/.env.local.enc succesfully created!
```

```console
$ php artisan lupennat:env-decrypt local
Provide a key:
 > nvK/Ay8HrB+3SAYnWSehUYajMqceBdpwvp45U3cYWd4=
Which key cipher? [AES-256-CBC]:
  [0] AES-128-CBC
  [1] AES-256-CBC
 > 1
File /xxx/.env.local succesfully created!
```

```console
$ cp .env.local .env
$ cp .env.prod .env
$ cp .env.xxx .env
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
