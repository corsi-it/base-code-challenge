<template>
    <div>
      <h2>Scrivi una recensione di felicità per un dipendente</h2>
      <form @submit.prevent="submitReview">
        <label for="employee">Seleziona un dipendente:</label>
        <select v-model="selectedEmployee" required>
          <option v-for="employee in employees" :key="employee.id" :value="employee.id">
            {{ employee.name }}
          </option>
        </select>
  
        <label for="rating">Valutazione (da 1 a 5 stelle):</label>
        <select v-model="rating" required>
          <option v-for="star in 5" :key="star" :value="star">{{ star }}</option>
        </select>
  
        <label for="review">Recensione:</label>
        <textarea v-model="review" required></textarea>
  
        <button type="submit">Invia recensione</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        selectedEmployee: null,
        rating: 1,
        review: '',
        employees: [
          { id: 1, name: 'Dipendente 1' },
          { id: 2, name: 'Dipendente 2' },
          { id: 3, name: 'Dipendente 3' },
          // Aggiungi altri dipendenti qui...
        ],
      };
    },
    methods: {
        submitReview() {
            const reviewData = {
                employee_id: this.selectedEmployee,
                rating: this.rating,
                review: this.review,
            };
            axios.post('/api/reviews', reviewData)
              .then(response => {
                this.$router.push('/thankyou');
                // Gestisci la risposta dal backend
              })
              .catch(error => {
                // Gestisci gli errori, se necessario
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
  