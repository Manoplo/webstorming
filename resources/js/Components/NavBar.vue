<template>
    <nav
        class="w-full h-14 bg-white flex items-center justify-between shadow-md p-9 fixed top-0 left-0 z-10"
    >
        <Link href="/">
            <div class="logo-box flex gap-2">
                <img
                    src="../../images/brainstorm.png"
                    class="w-8 h-8"
                    alt="Logo"
                />
                <h1 class="text-3xl lighter-h1 text-gray-800">
                    web<span class="text-3xl text-yellow-500">storming</span>
                </h1>
            </div>
        </Link>

        <div class="hidden lg:flex items-center gap-3">
            <form class="flex items-center">
                <button
                    type="submit"
                    class="bg-transparent outline-none border-none mr-3"
                >
                    <img
                        src="../../images/search.png"
                        alt="search icon"
                        class="w-5 h-5 object-cover"
                    />
                </button>
                <input
                    type="search"
                    placeholder="Search for stacks, users or webstorm ideas..."
                    class="w-96 p-2 border-gray-200 focus:outline-yellow-500 focus:shadow-lg rounded-md search-bar focus:ring-yellow-500 focus:ring-inset-0"
                />
            </form>

            <div v-if="$page.props.auth.user" class="flex items-center gap-3">
                <span class="text-md text-black font-semibold">
                    <p class="font-semibold">
                        {{ $page.props.auth.user.name }}
                    </p>
                </span>
                <Link :href="`/profiles/${$page.props.auth.user.id}`">
                    <img
                        :src="$page.props.auth.user.image"
                        class="rounded-full w-12 h-12 shadow-sm"
                        alt="Profile Image"
                    />
                </Link>
                <Link
                    class="transition ease-in-out text-sm text-black p-2 bg-yellow-400 rounded shadow-sm hover:shadow-lg hover:bg-yellow-500 hover:text-white"
                    :href="route('logout')"
                    method="post"
                    as="button"
                    >Logout</Link
                >
            </div>
            <div v-else>
                <Link
                    :href="route('login')"
                    class="transition ease-in-out text-sm text-black p-2 bg-yellow-400 rounded shadow-sm hover:shadow-lg hover:bg-yellow-500 hover:text-white"
                >
                    Log in
                </Link>

                <Link
                    :href="route('register')"
                    class="transition ease-in-out ml-4 text-sm text-black p-2 bg-yellow-400 rounded shadow-sm hover:shadow-lg hover:bg-yellow-500 hover:text-white"
                >
                    Register
                </Link>
            </div>
        </div>

        <svg
            width="24"
            height="24"
            stroke-width="1.5"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            class="lg:hidden cursor-pointer"
            @click="toggleMenu"
        >
            <path
                d="M3 5H11"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
            <path
                d="M3 12H16"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
            <path
                d="M3 19H21"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
        </svg>
    </nav>
    <!-- Mobile Menu -->
    <div
        class="mobile-menu w-full h-full fixed top-0 left-0 z-20 bg-white flex flex-col items-center justify-center gap-10"
        v-if="isOpenMenu"
    >
        <div
            class="absolute top-5 right-5 text-2xl text-black cursor-pointer"
            @click="toggleMenu"
        >
            X
        </div>

        <div v-if="$page.props.auth.user" class="flex items-center gap-3">
            <ul class="flex flex-col gap-10 justify-center items-center">
                <li>
                    <span class="text-3xl text-black font-semibold">
                        <p class="font-semibold">
                            {{ $page.props.auth.user.name }}
                        </p>
                    </span>
                </li>
                <li>
                    <Link :href="`/profiles/${$page.props.auth.user.id}`">
                        <img
                            :src="$page.props.auth.user.image"
                            class="rounded-full w-40 h-40 shadow-sm"
                            alt="Profile Image"
                        />
                    </Link>
                </li>
                <li>
                    <Link
                        class="transition ease-in-out text-3xl text-black p-5 bg-yellow-400 rounded shadow-sm hover:shadow-lg hover:bg-yellow-500 hover:text-white"
                        :href="route('logout')"
                        method="post"
                        as="button"
                        >Logout</Link
                    >
                </li>
            </ul>
        </div>
        <div v-else class="flex items-center justify-center gap-3">
            <ul class="flex flex-col gap-10 justify-center items-center">
                <li class="mb-5">
                    <Link
                        :href="route('login')"
                        class="transition ease-in-out text-3xl text-black p-5 bg-yellow-400 rounded shadow-sm hover:shadow-lg hover:bg-yellow-500 hover:text-white"
                    >
                        Log in
                    </Link>
                </li>
                <li>
                    <Link
                        :href="route('register')"
                        class="transition ease-in-out ml-4 text-3xl text-black p-5 bg-yellow-400 rounded shadow-sm hover:shadow-lg hover:bg-yellow-500 hover:text-white"
                    >
                        Register
                    </Link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { defineComponent, ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
defineComponent({
    name: Link,
});

const isOpenMenu = ref(false);

const toggleMenu = () => {
    isOpenMenu.value = !isOpenMenu.value;
};
</script>

<style scoped>
.mobile-menu {
    transition: 0.3s ease-in-out;
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>
