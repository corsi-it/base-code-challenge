<template>
    <div class="h-screen w-64 bg-gray-400 text-white">
        <div class="p-6">
            <h2 class="text-2xl font-semibold mb-7">Admin Dashboard</h2>
            <nav>
                <a href="#"
                   class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Dashboard
                </a>
                <a href="#"
                   class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Users
                </a>
                <a href="#"
                   class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Settings
                </a>
                <!-- Add more links here -->
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    name: "Sidebar",
}
</script>
