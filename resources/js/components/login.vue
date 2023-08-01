<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 ">
      <div class="bg-white p-6">
        <h1 class="text-3xl font-semibold m-6">Login</h1>
        <form @submit.prevent="submitForm">
          <div class="mb-4">
            <label for="email" class="block text-gray-700">Email:</label>
            <input v-model="email" type="email" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
          </div>
    
          <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-md">Login</button>
        </form>
      </div>
    </div>
</template>
  
  
<script>
    export default {
        data() {
            return {
                email: '',
            };
        },
        created() {
            // Effettua una chiamata API per verificare l'autenticazione
            axios.get('/api/check-auth')
            .then(response => {
                if (!response.data.authenticated) {
                // L'utente non è autenticato, reindirizzalo alla pagina di login
                    this.$router.push('/');
                }else{
                    this.$router.push('/dashboard');
                }
            })
            .catch(error => {
                // Gestisci gli errori, se necessario
                console.error(error);
            });
        },
        methods: {
            submitForm() {
                axios.post('/api/login', { email: this.email })
                .then(response => {
                    console.log(response)
                    this.$router.push('/dashboard');
                    // Gestisci la risposta dal backend
                })
                .catch(error => {
                    console.log(error)
                    // Gestisci gli errori, se necessario
                });
            },
        },
    };
</script>
  