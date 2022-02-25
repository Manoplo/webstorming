<template>
    <div class="w-3/4 mx-auto mt-20">
        <div
            v-if="$page.props.flash.message"
            class="bg-green-400 text-green-100 h-24 p-4 w-96 mx-auto rounded flex justify-center items-center absolute top-8 left-[750px] z-10 shadow-2xl"
        >
            {{ $page.props.flash.message }}
        </div>
        <div class="flex justify-between mb-3 -bottom-3">
            <h1 class="text-3xl">Users</h1>
            <Link
                href="/admin"
                class="p-2 bg-yellow-500 rounded hover:shadow-lg"
            >
                Go back
            </Link>
        </div>

        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            <li v-for="user in users.data" :key="user.id" class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <img
                            class="w-8 h-8 rounded-full"
                            :src="user.image"
                            alt="Neil image"
                        />
                    </div>
                    <div class="flex-1 min-w-0">
                        <p
                            class="text-sm font-medium text-gray-900 truncate dark:text-white"
                        >
                            {{ user.name }}
                        </p>
                        <p
                            class="text-sm text-gray-500 truncate dark:text-gray-400"
                        >
                            {{ user.email }}
                        </p>
                    </div>
                    <div
                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white"
                    >
                        {{ user.id }}
                        <button
                            class="bg-red-500 text-white rounded p-3 ml-4 hover:shadow-lg hover:bg-red-700"
                            @click="deleteUser(user.id)"
                        >
                            Delete user
                        </button>
                    </div>
                </div>
            </li>
        </ul>
        <!--Paginator-->
        <div
            class="mt-6 flex flex-wrap w-100 sm:w-3/4 mx-auto justify-center mb-10"
        >
            <Link
                v-for="link in users.links"
                :href="link.url"
                v-html="link.label"
                :key="link.id"
                preserve-scroll
                class="transition ease-in-out bg-white border hover:shadow-xl border-gray-400 rounded p-3 m-1 text-gray-800 hover:bg-yellow-500 hover:text-white"
                :class="{
                    'text-white': link.active,
                    'bg-yellow-400': link.active,
                }"
            />
        </div>
        <h1 class="mb-4">Create a new user</h1>
        <form
            @submit.prevent="createUser"
            class="flex flex-col p-5 border shadow-md gap-3"
            action=""
        >
            <label for="form.name">Name</label>
            <input
                class="rounded-md"
                type="text"
                v-model="form.name"
                id="form.name"
            />
            <div
                v-if="errors.name"
                v-text="errors.name"
                class="text-red-400"
            ></div>
            <label for="form.email">Email</label>
            <input
                class="rounded-md"
                type="text"
                v-model="form.email"
                id="form.name"
            />
            <div
                v-if="errors.email"
                v-text="errors.email"
                class="text-red-400"
            ></div>
            <label for="form.location">Location</label>
            <input
                class="rounded-md"
                type="text"
                v-model="form.location"
                id="
                form.location"
            />
            <div
                v-if="errors.location"
                v-text="errors.location"
                class="text-red-400"
            ></div>
            <label for="form.bio">Bio</label>
            <input
                class="rounded-md"
                type="text"
                v-model="form.bio"
                id="form.bio"
            />
            <div
                v-if="errors.bio"
                v-text="errors.bio"
                class="text-red-400"
            ></div>
            <label for="form.password">Password</label>
            <input
                class="rounded-md"
                type="text"
                v-model="form.password"
                id="form.password"
            />
            <div
                v-if="errors.password"
                v-text="errors.password"
                class="text-red-400"
            ></div>
            <input
                type="submit"
                class="w-1/4 p-2 rounded-md bg-yellow-500 hover:bg-yellow-700 hover:shadow-lg"
                value="CREATE USER"
            />
        </form>
    </div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

import Swal from "sweetalert2";

const props = defineProps({
    users: Object,
    errors: Object,
});

const form = useForm({
    name: "",
    email: "",
    location: "",
    bio: "",
    password: "",
});

const createUser = () => {
    form.post("/admin/users");
    form.reset();
};

const deleteUser = (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "The user will be lost foreverrrrr",
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: "Yes, go to hell",
        confirmButtonColor: "#F0C400",

        toast: true,
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.delete("/admin/users/" + id);
            Swal.fire({
                title: "Bruh",
                text: "That user won´t brainstorm anymore",
                icon: "success",
                showConfirmButton: false,
                timer: 1500,
                toast: true,
            });
        }
    });
};
</script>

<style></style>
