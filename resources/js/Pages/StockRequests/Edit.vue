<template>
    <DashboardLayout>
        <div class="bg-white p-5">
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="requestType">
                        Request Type
                    </label>
                    <select
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="requestType" v-model="form.requestType">
                        <option value="buy">Buy</option>
                        <option value="sell">Sell</option>
                    </select>
                    <p class="text-red-500 text-xs italic" v-if="form.errors.requestType">{{ form.errors.requestType }}</p>
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
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                        Status
                    </label>
                    <select
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="status" v-model="form.status">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <p class="text-red-500 text-xs italic" v-if="form.errors.status">{{ form.errors.status }}</p>
                </div>

                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit" :disabled="form.processing">
                        Update
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
    name: "StockRequestEdit",
    components: {DashboardLayout},
    props: {
        stockRequest: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            form: useForm({
                requestType: this.stockRequest.requestType,
                quantity: this.stockRequest.quantity,
                status: this.stockRequest.status,
            }),
        };
    },
    methods: {
        async submit() {
            let stockRequestRoute = route('stockRequests.update', this.stockRequest.id);
            await this.form.put(stockRequestRoute);
        },
    }
};
</script>