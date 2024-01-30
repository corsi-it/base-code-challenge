/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'
import {createApp} from 'vue'
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({})

import WelcomePage from './views/WelcomePage.vue'
app.component('welcome-page', WelcomePage)

import InventoryCardList from './components/InventoryCardList.vue'
app.component('inventory-card-list', InventoryCardList)

import SinglePageCard from './components/SingleCard.vue'
app.component('single-page-card', SinglePageCard)

import AdminDashboard from './views/admin/Dashboard.vue'
app.component('admin-dashboard', AdminDashboard)

import AdminInventoryTableVue from './components/admin/InventoryTable.vue'
app.component('admin-inventory-table', AdminInventoryTableVue)

import AdminItem from './components/admin/AddItem.vue'
app.component('admin-item', AdminItem)

import AdminUserRequests from './views/admin/AdminRequests.vue'
app.component('admin-user-requests', AdminUserRequests)

import RequestModal from './components/RequestModal.vue'
app.component('request-modal', RequestModal)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app')
