<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Vue3Lottie from "vue3-lottie";
import MainAnimation from "../lotties/mainAnim.json";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="Web Storming - Home" />

    <header class="flex w-3/4 m-auto mt-56">
        <div class="sm:w-1/2 w-full">
            <h1 class="sm:text-9xl text-5xl lighter-h1 text-gray-800">Web</h1>
            <h1
                class="sm:text-9xl text-5xl text-transparent bg-clip-text bg-gradient-to-br from-yellow-400 to-yellow-600 pb-4"
            >
                Storming
            </h1>
            <h2 class="text-3xl text-gray-800">
                Share your ideas and
                <span class="text-yellow-600">get feedback.</span>
            </h2>
            <div class="button-container mt-10">
                <div v-if="$page.props.auth.user">
                    <Link
                        :href="route('dashboard')"
                        class="transition ease-in-out delay-150 text-sm text-white p-3 bg-yellow-500 rounded shadow-sm hover:shadow-lg hover:bg-yellow-400"
                    >
                        Go to my Profile
                    </Link>
                </div>
                <div v-else>
                    <Link
                        :href="route('login')"
                        class="transition ease-in-out delay-150 text-sm text-white p-3 bg-yellow-500 rounded shadow-sm hover:shadow-lg hover:bg-yellow-400"
                    >
                        Log in
                    </Link>

                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="transition ease-in-out delay-150 ml-4 text-sm text-white p-3 bg-yellow-500 rounded shadow-sm hover:shadow-lg hover:bg-yellow-400"
                    >
                        Register
                    </Link>
                </div>
            </div>
        </div>
        <div class="sm:w-1/2 w-full -mt-56">
            <Vue3Lottie :animationData="MainAnimation" />
        </div>
    </header>
</template>

<style scoped>
.lighter-h1 {
    font-weight: 700;
}

.bg-gray-100 {
    background-color: #f7fafc;
    background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
}

.border-gray-200 {
    border-color: #edf2f7;
    border-color: rgba(237, 242, 247, var(--tw-border-opacity));
}

.text-gray-400 {
    color: #cbd5e0;
    color: rgba(203, 213, 224, var(--tw-text-opacity));
}

.text-gray-500 {
    color: #a0aec0;
    color: rgba(160, 174, 192, var(--tw-text-opacity));
}

.text-gray-600 {
    color: #718096;
    color: rgba(113, 128, 150, var(--tw-text-opacity));
}

.text-gray-700 {
    color: #4a5568;
    color: rgba(74, 85, 104, var(--tw-text-opacity));
}

.text-gray-900 {
    color: #1a202c;
    color: rgba(26, 32, 44, var(--tw-text-opacity));
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-gray-800 {
        background-color: #2d3748;
        background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
    }

    .dark\:bg-gray-900 {
        background-color: #1a202c;
        background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
    }

    .dark\:border-gray-700 {
        border-color: #4a5568;
        border-color: rgba(74, 85, 104, var(--tw-border-opacity));
    }

    .dark\:text-white {
        color: #fff;
        color: rgba(255, 255, 255, var(--tw-text-opacity));
    }

    .dark\:text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }
}
</style>
