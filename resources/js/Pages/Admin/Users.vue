<template>
    <div class="w-3/4 mx-auto mt-20">
        <div class="flex justify-between mb-3 -bottom-3">
            <h1 class="text-3xl">Users</h1>
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
                            class="bg-red-500 text-white rounded p-3 ml-4"
                            @click="deleteUser(user.id)"
                        >
                            Delete user
                        </button>
                    </div>
                </div>
            </li>
        </ul>
        <!--Paginator-->
        <div class="mt-6 flex w-100 sm:w-3/4 mx-auto justify-center mb-10">
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
    </div>
</template>

<script setup>
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import throttle from "lodash/throttle";
import Swal from "sweetalert2";

const props = defineProps({
    users: Object,
    filters: Object,
});

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
