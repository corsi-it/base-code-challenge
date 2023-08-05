<p align="center"><a href="https://www.linkedin.com/in/alessandro-spadini-2b16b0138/" target="_blank"><img src="https://media.licdn.com/dms/image/D4D16AQEzYb3RJGPIUQ/profile-displaybackgroundimage-shrink_350_1400/0/1688475645782?e=1696464000&v=beta&t=yroJDZ-m8mVsquJK-mEIrxHcrqukVY4gv1ZG94roNXc" width="400"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Code Challenge per Corsi.it

La "traccia" per questo esercizio è il file "code_challenge_alessandro_spadini.pdf".

Questa soluzione utilizza Sail e dunque docker compose per un deploy rapido.

## 1. Installazione delle dipendenze

Per iniziare bisogna impostare le variabili d'ambiente importandole dal file .env.example, su Linux e OSX basterà dare il comando:

``cp .env.example .env``

Dopodiché è necessario installare le dipendenze coi comandi:

``composer install``

e

``npm install``

infine, accertarsi di aver generato la chiave per Laravel col comando:

``php artisan key:generate``

## 2. Popolamento del database

TODO - WIP

## 3. Esecuzione locale

Per lanciare il portale usando Sail, usare il comando:

``./vendor/bin/sail up``


