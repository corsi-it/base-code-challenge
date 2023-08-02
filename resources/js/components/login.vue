<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 ">
      <div class="bg-white p-6">
        <h1 class="text-3xl font-semibold mb-6">Login</h1>
        <form @submit.prevent="submitForm">
          <div class="mb-4">
            <label for="email" class="block text-gray-700">Email:</label>
            <input v-model="email" type="email" required class="p-1 w-full text-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
          </div>
          <p v-if="errorMessage" class="text-red-500 mb-2">{{ errorMessage }}</p>
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
                errorMessage: ''
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
                })
                .catch(error => {
                    console.log(error)
                    if (error.response && error.response.data && error.response.data.message) {
                        this.errorMessage = error.response.data.message;
                    }
                });
            },
        },
    };
</script>
  