<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-yellow-100"
    >
        <div class="flex justify-center items-center">
            <Link href="/">
                <img
                    src="../../images/brainstorm.png"
                    alt="Logo"
                    width="100"
                    height="100"
                    class="mx-auto"
                />
                <h1 class="sm:text-5xl text-xl lighter-h1 text-gray-800">
                    web<span
                        class="sm:text-5xl text-xl text-transparent bg-clip-text bg-gradient-to-br from-yellow-400 to-yellow-600"
                        >storming</span
                    >
                </h1>
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
