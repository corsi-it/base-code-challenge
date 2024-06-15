<template>
    <DashboardLayout>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    SKU
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Categories
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="item in items" :key="item.id">
                                <td class="px-6 py-4 whitespace-nowrap">{{ item.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ item.sku }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ item.categories.map(category => category.name).join(', ') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span v-if="item.isInStock">
                                        Available
                                    </span>
                                    <span v-if="!item.isInStock">
                                        Non Available
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex gap-1">
                                    <a :href="showItemRoute(item)"
                                       class="text-indigo-600 hover:text-indigo-900">View</a>
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
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
    name: "ItemsIndex",
    components: {DashboardLayout},
    props: {
        items: Array
    },
    data() {
        return {};
    },
    methods: {
        showItemRoute(item) {
            return route('items.show', {
                'id': item.id
            });
        }
    }
};
</script>
