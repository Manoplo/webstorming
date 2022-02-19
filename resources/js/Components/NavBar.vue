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
        <div class="flex items-center gap-3">
            <form>
                <input
                    type="search"
                    placeholder="Search for stacks, users or webstorm ideas..."
                    class="w-96 p-2 border border-gray-200 focus:shadow-inner rounded-md"
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
    </nav>
</template>

<script setup>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
defineComponent({
    name: Link,
});
</script>

<style></style>
