<template>
    <div class="h-screen w-64 bg-gray-600 text-white">
        <div class="p-6">
            <h2 class="text-2xl font-semibold mb-7">Dashboard</h2>
            <nav>
                <a v-for="item in getMenuItems" :key="item.name" :href="item.link"
                   class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    {{ item.name }}
                </a>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    name: "Sidebar",
    data() {
        return {};
    },
    computed: {
        getMenuItems() {
            let menuItems = [];

            if (this.$page.props.auth.user.role.name === "admin") {
                menuItems.push({
                    name: "Dashboard",
                    link: route("dashboard")
                });
                menuItems.push({
                    name: "Items",
                    link: route("items.index"),
                });
            }

            menuItems.push({
                name: "Stock Requests",
                link: route("stockRequests.index"),
            });

            return menuItems;
        },
    }
}
</script>
