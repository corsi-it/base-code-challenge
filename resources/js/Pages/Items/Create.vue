<template>
    <DashboardLayout>
        <div class="bg-white p-5">
            <form @submit.prevent="submit">
                <input type="hidden" name="item_id" v-model="form.item_id">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="start_date">
                        Start Date
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="start_date" type="date" v-model="form.start_date">
                    <p class="text-red-500 text-xs italic" v-if="form.errors.start_date">{{ form.errors.start_date }}</p>
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
            let itemRoute = route('items.store');
            await this.form.post(itemRoute);
        },
        async itemSelected(event) {
            this.form.item_id = event.target.value;
        },
    }
};
</script>
