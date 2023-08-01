<template>
    <div>
      <h1>Dashboard</h1>
      <!-- Contenuto della dashboard -->
      <ReviewForm />
    </div>
  </template>

<script>
import axios from 'axios';
import { useRouter } from 'vue-router';
import ReviewForm from './ReviewForm.vue';

export default {
    components: {
        ReviewForm,
    },
    created() {
        // Effettua una chiamata API per verificare l'autenticazione
        axios.get('/api/check-auth')
        .then(response => {
            if (!response.data.authenticated) {
            // L'utente non è autenticato, reindirizzalo alla pagina di login
                this.$router.push('/');
            }
        })
        .catch(error => {
            // Gestisci gli errori, se necessario
            console.error(error);
        });
    },
};
</script>