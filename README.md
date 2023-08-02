# Office Happiness

Benvenuto nel progetto Office Happiness! Questo progetto Laravel utilizza Sail CLI per semplificare l'ambiente di sviluppo.

## Requisiti di Sistema

Prima di iniziare, assicurati di avere installato quanto segue sul tuo sistema:

1. [Docker](https://www.docker.com/products/docker-desktop) - Per l'esecuzione dei container di sviluppo.
2. [Docker Compose](https://docs.docker.com/compose/install/) - Per la gestione dei servizi multi-container.

## Istruzioni per l'installazione

Segui questi passaggi per configurare il progetto sul tuo ambiente locale:

1. **Clonare il repository**:

   ```bash
   git clone https://github.com/corsi-it/base-code-challenge
   cd base-code-challenge

2. **Installazione delle dipendenze:**

    ```bash
    sail up -d
    sail composer install
    sail npm install
    sail npm run dev

3. **Migrazioni e Seed:**

    ```bash
    sail artisan migrate --seed

4. **Avvia il server di sviluppo:**

    ```bash
    sail up -d

Il server sarà accessibile all'indirizzo http://localhost:90.

**Risoluzione dei problemi**

* Se si verificano problemi con le porte in uso, assicurarsi che nessun altro servizio stia utilizzando le stesse porte utilizzate da Sail.
* Se Sail non funziona correttamente, puoi provare a ricreare l'ambiente eseguendo 
    ```bash
    sail down -v 
    sail up