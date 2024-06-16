<template>
    <DashboardLayout>
        <div class="w-full">
            <div class="bg-white p-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <p class="text-gray-700 text-base">{{ item.name }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">SKU</label>
                    <p class="text-gray-700 text-base">{{ item.sku }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Categories</label>
                    <ul>
                        <li v-for="(category, index) in item.categories" :key="index" class="text-gray-700 text-base">
                            {{ category.name }}
                        </li>
                    </ul>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Available</label>
                    <p class="text-gray-700 text-base">
                        <span v-if="item.isInStock">
                                        Available
                                    </span>
                        <span v-if="!item.isInStock">
                                        Non Available
                                    </span>
                    </p>
                </div>
            </div>
        </div>

    </DashboardLayout>
</template>

<script>
import DashboardLayout from "../../Layouts/DashboardLayout.vue";

export default {
    name: "ItemsShow",
    components: {DashboardLayout},
    props: {
        item: Object
    },
    data() {
        return {};
    },
};
</script>
