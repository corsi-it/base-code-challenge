<p align="center"><a href="https://www.linkedin.com/in/alessandro-spadini-2b16b0138/" target="_blank"><img src="https://media.licdn.com/dms/image/D4D16AQEzYb3RJGPIUQ/profile-displaybackgroundimage-shrink_350_1400/0/1688475645782?e=1696464000&v=beta&t=yroJDZ-m8mVsquJK-mEIrxHcrqukVY4gv1ZG94roNXc" width="400"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Code Challenge per Corsi.it

La "traccia" per questo esercizio è il file "code_challenge_alessandro_spadini.pdf".

Questa soluzione utilizza Sail e dunque docker compose per un deploy rapido.

Ho cercato di soddisfare almeno i requisiti minimi, mi scuso in anticipo per i componenti un po' spartani, ma alla fine non sono riuscito a ritagliarmi molto tempo per questa code challenge.

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

Si può eseguire il comando:

``php artisan migrate:fresh --seed``

Per lanciare tutte le migration e popolare il database con dati d'esempio.
Verranno creati 101 utenti e 500 recensioni. Verrà inoltre popolato il database delle parole proibite, che però non ho avuto il tempo di implementare.
Se non si dispone di un'installazione locale di php, bisognerà prima passare al punto 3. "Esecuzione locale" e poi lanciare i comandi all'interno del container dell'applicazione.

## 3. Esecuzione locale

Per lanciare il portale usando Sail, usare il comando:

``./vendor/bin/sail up``

che creerà i container per l'ambiente di test e con la configurazione di base servirà l'applicazione web sulla porta 81, come specificato nel file .env

Alternativamente, dopo che sail ha creato i container, una volta cambiate opportunamente le variabili per puntare il database nel file .env, si può anche eseguire l'applicazione con:

``php artisan serve``

che servirà l'applicazione sulla porta 8000.

## 4. Comandi speciali

Come richiesto nella traccia, con un comando del tipo: 

``php artisan reviews:create --email=xxxx --review=xxxx
--rating=x``

è possibile inserire direttamente una recensione.

