<template>
    <DashboardLayout>
        <div class="bg-white p-5">
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="name" type="text" v-model="form.name">
                    <p class="text-red-500 text-xs italic" v-if="form.errors.name">{{ form.errors.name }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="sku">
                        SKU
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="sku" type="text" v-model="form.sku">
                    <p class="text-red-500 text-xs italic" v-if="form.errors.sku">{{ form.errors.sku }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="categories">
                        Categories
                    </label>
                    <select
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="categories" v-model="form.categories" multiple>
                        <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                    </select>
                    <p class="text-red-500 text-xs italic" v-if="form.errors.categories">{{
                            form.errors.categories
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
    name: "ItemsCreate",
    components: {DashboardLayout},
    props: {
        item: {
            type: Object,
            required: true,
        },
        categories: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            form: useForm({
                name: this.item.name,
                sku: this.item.sku,
                categories: this.item.categories.map(category => category.id),
            }),
        };
    },
    methods: {
        async submit() {
            let itemRoute = route('items.update', this.item.id);
            await this.form.put(itemRoute);
        },
    }
};
</script>
