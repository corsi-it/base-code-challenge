<template>
    <header class="bg-gray-800 text-white px-6 py-4 flex justify-between items-center">
        <div class="text-m font-semibold">{{ username }}</div>
        <nav>
            <a href="#" class="text-white hover:text-gray-300 mx-2">Home</a>
            <a href="#" class="text-white hover:text-gray-300 mx-2">About</a>
            <a href="#" class="text-white hover:text-gray-300 mx-2">Contact</a>
            <!-- Add more links here -->
        </nav>
    </header>
</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            username: 'Username' // Replace 'Username' with the actual username or a variable
        }
    }
}
</script>
