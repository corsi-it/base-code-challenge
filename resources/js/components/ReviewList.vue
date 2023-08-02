<template>
    <div class="min-h-screen bg-gray-100 py-8">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-semibold mb-6">Review List</h2>
        <form @submit.prevent="filterReviews" class="mb-6">
          <div class="mb-4">
            <label for="email" class="block text-gray-700">Email filter:</label>
            <input v-model="filter.email" type="text" id="email" class="p-1 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
          </div>
    
          <div class="mb-4">
            <label for="rating" class="block text-gray-700">Rating filter:</label>
            <select v-model="filter.rating" id="rating" class="p-1 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
              <option value="">All rating</option>
              <option v-for="star in 5" :key="star" :value="star"><span v-html="getStarHTML(star)"></span></option>
            </select>
          </div>
    
          <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-md">Filter</button>
        </form>
    
        <table class="w-full">
          <thead>
            <tr class="bg-gray-200">
              <th class="px-4 py-2">Email</th>
              <th class="px-4 py-2">Ranking</th>
              <th class="px-4 py-2">Review</th>
              <th class="px-4 py-2">Created</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="review in paginatedReviews" :key="review.id" class="border-t">
              <td class="px-4 py-2">{{ review.employee.email }}</td>
              <td class="px-4 py-2" v-html="getStarHTML(review.rating)"></td>
              <td class="px-4 py-2">{{ review.comment }}</td>
              <td class="px-4 py-2">{{ new Date(review.created_at).toLocaleString() }}</td>
            </tr>
          </tbody>
        </table>
    
        <div v-if="totalPages > 1" class="mt-4 flex items-center justify-center">
          <button @click="prevPage" :disabled="currentPage === 1" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md mr-2">Prev</button>
          <span class="text-gray-600">Page {{ currentPage }} di {{ totalPages }}</span>
          <button @click="nextPage" :disabled="currentPage === totalPages" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md ml-2">Next</button>
        </div>
      </div>
    </div>
  </template>
  
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        reviews: [],
        filter: {
          email: '',
          rating: '',
        },
        currentPage: 1,
        reviewsPerPage: 10,
      };
    },
    computed: {
      filteredReviews() {
        let filtered = this.reviews;
  
        if (this.filter.email) {
          filtered = filtered.filter(review => review.employee.email.includes(this.filter.email));
        }
  
        if (this.filter.rating) {
          filtered = filtered.filter(review => review.rating === parseInt(this.filter.rating));
        }
  
        return filtered;
      },
      paginatedReviews() {
        const start = (this.currentPage - 1) * this.reviewsPerPage;
        const end = start + this.reviewsPerPage;
        return this.filteredReviews.slice(start, end);
      },
      totalPages() {
        return Math.ceil(this.filteredReviews.length / this.reviewsPerPage);
      },
    },
    methods: {
    getStarHTML(star) {
        const   filledStar = '&#9733;';
        const emptyStar = '&#9734;';
        const stars = filledStar.repeat(star) + emptyStar.repeat(5 - star);
        return stars;
    },
      fetchReviews() {
        axios.get('/api/reviews')
          .then(response => {
            console.log(response)
            this.reviews = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
      filterReviews() {
        this.currentPage = 1;
      },
      nextPage() {
        if (this.currentPage < this.totalPages) {
          this.currentPage++;
        }
      },
      prevPage() {
        if (this.currentPage > 1) {
          this.currentPage--;
        }
      },
    },
    created() {
      this.fetchReviews();
    },
  };
  </script>
  