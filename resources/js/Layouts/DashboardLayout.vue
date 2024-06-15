<template>
    <div class="flex h-screen bg-gray-200">
        <Sidebar/>
        <div class="flex-1 flex flex-col overflow-hidden">
            <Header/>
            <main class="flex-1 overflow-x-hidden overflow-y-auto">
                <slot/>
            </main>
        </div>
    </div>
</template>

<script>

import Header from "../Components/Header.vue";
import Sidebar from "../Components/Sidebar.vue";

export default {
    name: "DashboardLayout",
    components: {
        Header,
        Sidebar
    },
    data() {
        return {};
    },
};
</script>
