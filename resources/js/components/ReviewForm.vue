<template>
  <div class="flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 shadow-md rounded-lg w-96">
      <h2 class="text-3xl font-semibold mb-6">Write a review for an employee</h2>
      <form @submit.prevent="submitReview">
        <div class="mb-4">
          <label for="employee" class="block text-gray-700">Select an employee:</label>
          <select v-model="selectedEmployee" required class="p-1 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            <option v-for="employee in employees" :key="employee.id" :value="employee.id">{{ employee.name }}</option>
          </select>
        </div>
  
        <div class="mb-4">
          <label for="rating" class="block text-gray-700">Rating (1 to 5 star):</label>
          <select v-model="rating" required class="p-1 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            <option v-for="star in 5" :key="star" :value="star"><span v-html="getStarHTML(star)"></span></option>
          </select>
        </div>
  
        <div class="mb-4">
          <label for="review" class="block text-gray-700">Review:</label>
          <textarea v-model="review" required class="p-1 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"></textarea>
        </div>
        <p v-if="errorMessage" class="text-red-500 mb-2">{{ errorMessage }}</p>
        <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-md">Send</button>
      </form>
    </div>
  </div>
</template>

  
  <script>
  export default {
    data() {
      return {
        selectedEmployee: null,
        rating: 1,
        review: '',
        employees: [],
        errorMessage:''
      };
    },
    methods: {
        getStarHTML(star) {
          const   filledStar = '&#9733;';
          const emptyStar = '&#9734;';
          const stars = filledStar.repeat(star) + emptyStar.repeat(5 - star);
          return stars;
        },
        submitReview() {
            const reviewData = {
                employee_id: this.selectedEmployee,
                rating: this.rating,
                review: this.review,
            };
            axios.post('/api/reviews', reviewData)
              .then(response => {
                this.$router.push('/thankyou');
              })
              .catch(error => {
                if (error.response && error.response.data && error.response.data.errors) {
                  const reviewErrors = error.response.data.errors.review;
                  if (reviewErrors && reviewErrors.length > 0) {
                    this.errorMessage = reviewErrors[0];
                  } else {
                    this.errorMessage = 'Errore di validazione della recensione.';
                  }
                } else {
                  // Gestisci altri tipi di errori, se necessario
                  console.error(error);
                }
              });
        },
        fetchEmployees() {
            // Ottieni la lista degli utenti dal backend
             axios.get('/api/users')
            .then(response => {
                this.employees = response.data;
            })
            .catch(error => {
                console.error(error);
            });
        },
    },
    created() {
        // Ottieni la lista degli utenti al caricamento del componente
        this.fetchEmployees();
    },
  };
  </script>
  