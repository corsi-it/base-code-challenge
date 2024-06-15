<template>
    <header class="bg-gray-800 text-white px-6 py-4 flex justify-between items-center">
        <div class="text-m font-semibold">{{ $page.props.auth.user.name }}</div>
        <nav>
            <a :href="logoutRoute" class="text-white hover:text-gray-300 mx-2">Logout</a>
        </nav>
    </header>
</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            logoutRoute: route('logout')
        }
    }
}
</script>
