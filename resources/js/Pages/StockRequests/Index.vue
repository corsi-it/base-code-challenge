<template>
    <DashboardLayout>

        <nav class="mb-5">
            <div class="flex flex-col sm:flex-row justify-end">
                <div class="sm:mt-0 mt-4 text-center sm:text-right">
                    <a :href="newStockRequestUrl"
                       class="bg-primary-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        New Stock Request
                    </a>
                </div>
            </div>
        </nav>


        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Product
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Requested by
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Period
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="stockRequest in stockRequests" :key="stockRequest.id">
                                <td class="px-6 py-4 whitespace-nowrap">{{ stockRequest.item.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ stockRequest.quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ stockRequest.status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ stockRequest.requested_by.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ parseDate(stockRequest.start_date) }}
                                    -
                                    {{ parseDate(stockRequest.end_date) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex gap-2">
                                    <a :href="showStockRequestRoute(stockRequest)"
                                       class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a :href="editStockRequestRoute(stockRequest)"
                                       class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<script>

import DashboardLayout from "../../Layouts/DashboardLayout.vue";

export default {
    name: "StockRequestsIndex",
    components: {DashboardLayout},
    props: {
        stockRequests: Array,
    },
    data() {
        return {
            newStockRequestUrl: route("stockRequests.create"),
        };
    },
    methods: {
        parseDate(date) {
            if (!date) {
                return;
            }
            return new Date(date).toISOString().slice(0, 10).replaceAll("-", "/");
        },
        showStockRequestRoute(stockRequest) {
            return route('stockRequests.show', {
                'id': stockRequest.id
            });
        },
        editStockRequestRoute(stockRequest) {
            return route('stockRequests.edit', {
                'id': stockRequest.id
            });
        }
    }
};
</script>
