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
	```

2. **Installazione delle dipendenze:**

    ```bash
    sail up --build
    sail composer install
    sail npm install
    sail npm run dev
    ```

3. **Migrazioni e Seed:**

    ```bash
    sail artisan migrate --seed
    ```

4. **Avvia il server di sviluppo:**

    ```bash
    sail up -d
    ```

	Il server sarà accessibile all'indirizzo http://localhost:90.

**Risoluzione dei problemi**

* Se si verificano problemi con le porte in uso, assicurarsi che nessun altro servizio stia utilizzando le stesse porte utilizzate da Sail.
* Se Sail non funziona correttamente, puoi provare a ricreare l'ambiente eseguendo

```bash
sail down -v 
sail up
```

**Usage**

Puoi effettuare un login utilizzando una di queste email

- test@corsi.it
- tester@corsi.it
- john@corsi.it
- jane@corsi.it

Puoi creare una review da CLI usando

```bash
sail artisan reviews:create --email="john@corsi.it" --review="test review from CLI" --rating=4
```

**Testing**
    creato un test per la creazione delle recensioni ed uno per il testing del webhook

```bash
sail artisan test
```

le parti relative alle top player zone frontend non sono state sviluppate...

**Librerie per il frontend**

* Vue.js: Vue.js è un framework JavaScript progressivo per la costruzione di interfacce utente interattive. È leggero, flessibile e facile da imparare, consentendo di creare componenti riutilizzabili e complesse applicazioni frontend.
* Vue Router: Vue Router è una libreria di routing per Vue.js. Ci permette di creare una navigazione a singola pagina (SPA) all'interno dell'applicazione Vue, gestendo le route e il rendering delle componenti corrispondenti.
* Vue Axios: Vue Axios è un plugin per semplificare l'uso di Axios (un client HTTP) in un progetto Vue. Ci consente di eseguire chiamate API e interagire con il backend in modo semplice ed efficiente.
* Tailwind CSS: Tailwind CSS è un framework CSS utilizzato per creare interfacce moderne e personalizzate. Utilizza una filosofia di progettazione basata su classi utilitarie per consentire una maggiore flessibilità nello stile delle componenti.
