<template>
    <div class="min-h-screen bg-gray-100">
      <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-6">
          <h1 class="text-3xl font-semibold">Happiness</h1>
        </div>
      </header>
      <main class="container mx-auto px-4 py-8">
        <!-- Contenuto della dashboard -->
        <ReviewForm />


        <ReviewList />
      </main>
    </div>
</template>


<script>
import axios from 'axios';
import { useRouter } from 'vue-router';
import ReviewForm from './ReviewForm.vue';
import ReviewList from './ReviewList.vue';

export default {
    components: {
        ReviewForm,
        ReviewList,
    },
    created() {
        // Effettua una chiamata API per verificare l'autenticazione
        axios.get('/api/check-auth')
        .then(response => {
            if (!response.data.authenticated) {
                // L'utente non è autenticato
                this.$router.push('/');
            }
        })
        .catch(error => {
            console.error(error);
        });
    },
};
</script>