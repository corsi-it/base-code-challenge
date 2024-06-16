<template>
    <DashboardLayout>
        <div class="w-full">
            <div class="bg-white p-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Request Type</label>
                    <p class="text-gray-700 text-base">{{ requestType }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                    <p class="text-gray-700 text-base">{{ stockRequest.quantity }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                    <p class="text-gray-700 text-base">{{ stockRequest.status }}</p>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<script>
import DashboardLayout from "../../Layouts/DashboardLayout.vue";

export default {
    name: "StockRequestShow",
    components: {DashboardLayout},
    props: {
        stockRequest: Object
    },
    data() {
        return {};
    },
    computed: {
        requestType() {
            return this.stockRequest.quantity < 0 ? 'Sell' : 'Buy';
        }
    }
};
</script>
