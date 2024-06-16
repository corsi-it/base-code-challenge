<template>
    <DashboardLayout>
        <div class="bg-white p-5">
            <form @submit.prevent="submit">
                <input type="hidden" name="item_id" v-model="form.item_id">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="item">
                        Item
                    </label>
                    <!-- Filters -->
                    <div class="mb-4 flex gap-5 items-center">
                        <label for="name" class="">Name</label>
                        <input v-model="filters.name" placeholder="Filter by name"
                               class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                        <label for="category" class="">Category</label>
                        <select v-model="filters.category"
                                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option selected="selected" value="">All Categories</option>
                            <!-- Option to remove the filter -->
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>

                    <!-- Table -->
                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Select
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Categories
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in filteredItems" :key="item.id">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <input type="radio" :value="item.id" v-model="selectedItem"
                                       @change="itemSelected(item.id)">
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ item.name }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ item.categories.map(category => category.name).join(', ') }}
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <p class="text-red-500 text-xs italic mt-3" v-if="form.errors.item_id">{{ form.errors.item_id }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
                        Request type
                    </label>
                    <select
                        class="mb-1 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="requestType" v-model="form.requestType">
                        <option value="buy">Buy</option>
                        <option value="sell">Sell</option>
                    </select>
                    <p class="text-red-500 text-xs italic mt-3" v-if="form.errors.requestType">{{
                            form.errors.requestType
                        }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
                        Quantity
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="quantity" type="number" v-model="form.quantity">
                    <p class="text-red-500 text-xs italic mt-3" v-if="form.errors.quantity">{{
                            form.errors.quantity
                        }}</p>
                </div>
                <div class="mb-4" v-if="form.requestType === 'sell'">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="start_date">
                        Start Date
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="start_date" type="date" v-model="form.start_date">
                    <p class="text-red-500 text-xs italic mt-3" v-if="form.errors.start_date">{{
                            form.errors.start_date
                        }}</p>
                </div>
                <div class="mb-4" v-if="form.requestType === 'sell'">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="end_date">
                        End Date
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="end_date" type="date" v-model="form.end_date">
                    <p class="text-red-500 text-xs italic mt-3" v-if="form.errors.end_date">{{
                            form.errors.end_date
                        }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit" :disabled="form.processing">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </DashboardLayout>
</template>

<script>
import {useForm} from "@inertiajs/vue3";
import DashboardLayout from "../../Layouts/DashboardLayout.vue";

export default {
    name: "StockRequestsCreate",
    components: {DashboardLayout},
    props: {
        items: {
            type: Array,
            required: true,
        },
        categories: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            filters: {
                name: "",
                category: 0,
            },
            form: useForm({
                item_id: "",
                requestType: "",
                quantity: "",
                start_date: "",
                end_date: "",
            }),
        };
    },
    computed: {
        filteredItems() {
            return this.items.filter(item => {

                let keep = true;

                if (this.filters.name.length > 0) {
                    if (!item.name.toLowerCase().includes(this.filters.name.toLowerCase())) {
                        keep = false;
                    }
                }

                if (this.filters.category !== 0 && this.filters.category !== "") {
                    let keepCategories = false;
                    for (let category of item.categories) {
                        if (category.id === this.filters.category) {
                            keepCategories = true;
                            break;
                        }
                    }
                    if (!keepCategories) {
                        keep = false;
                    }
                }

                return keep;
            });
        },
    },
    methods: {
        async submit() {
            let stockRequestRoute = route('stockRequests.store');
            await this.form.post(stockRequestRoute);
        },
        async itemSelected(itemId) {
            this.form.item_id = itemId;
        },
    }
};
</script>
