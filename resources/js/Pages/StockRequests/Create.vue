<template>
    <DashboardLayout>
        <div class="bg-white p-5">
            <form @submit.prevent="submit">
                <input type="hidden" name="item_id" v-model="form.item_id">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="item">
                        Item
                    </label>
                    <input
                        class="mb-1 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="item" type="text" @change="itemSelected">
                    <p class="text-red-500 text-xs italic" v-if="form.errors.item_id">{{ form.errors.item_id }}</p>
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
                    <p class="text-red-500 text-xs italic" v-if="form.errors.requestType">{{
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
                    <p class="text-red-500 text-xs italic" v-if="form.errors.quantity">{{ form.errors.quantity }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="start_date">
                        Start Date
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="start_date" type="date" v-model="form.start_date">
                    <p class="text-red-500 text-xs italic" v-if="form.errors.start_date">{{
                            form.errors.start_date
                        }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="end_date">
                        End Date
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="end_date" type="date" v-model="form.end_date">
                    <p class="text-red-500 text-xs italic" v-if="form.errors.end_date">{{ form.errors.end_date }}</p>
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
    data() {
        return {
            form: useForm({
                item_id: "",
                requestType: "",
                quantity: "",
                start_date: "",
                end_date: "",
            }),
        };
    },
    methods: {
        async submit() {
            let stockRequestRoute = route('stockRequests.store');
            await this.form.post(stockRequestRoute);
        },
        async itemSelected(event) {
            this.form.item_id = event.target.value;
        },
    }
};
</script>
