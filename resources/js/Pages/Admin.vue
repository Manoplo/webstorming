<template>
    <main class="w-screen h-screen flex items-center justify-center">
        <nav>
            <p>Welcome, {{ $page.props.auth?.user?.name.split(" ")[0] }}</p>
            <h1 class="text-yellow-500 text-4xl font-normal">Admin Panel</h1>
            <div class="flex justify-center items-center gap-5 mt-5">
                <Link
                    class="transition-all ease-in-out p-5 border rounded-xl hover:shadow-lg"
                    :href="route('users')"
                >
                    <h2 class="text-2xl">Users</h2>
                </Link>
                <Link
                    class="transition-all ease-in-out p-5 border rounded-xl hover:shadow-lg"
                    :href="route('stacks')"
                >
                    <h2 class="text-2xl">Stacks</h2>
                </Link>
            </div>
        </nav>
    </main>
</template>

<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
</script>

<style></style>
