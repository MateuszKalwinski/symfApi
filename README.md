# [SymfAPI]


## Uruchomienie projektu

Aplikacja oparta jest na frameworku Symfony 6. Proszę zapoznaj się z wymaganiami
[Wymagania techniczne - ]([https://link-url-here.org](https://symfony.com/doc/current/setup.html#technical-requirements))

Dla mnie było to PHP v8.1.6, Node v17.7.2, NPM v8.5.2, Composer v2.2.8

```sh
git clone https://github.com/MateuszKalwinski/symfApi.git
composer install
npm install
npm run watch
```

Stwórz bazę danych MySql i uzupełnij plik .env, a następnie uruchom polecenia

```sh
symfony console doctrine:migrations:migrate
symfony serve:start
```

wejdź na adres

```sh
127.0.0.1:8000
```
aby zapełnić bazę danych uruchom polecenie 

```sh
php bin/console fetch-data-from-api
```
