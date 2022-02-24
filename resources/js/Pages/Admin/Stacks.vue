<template>
    <div class="w-3/4 mx-auto mt-20">
        <div class="flex justify-between mb-3 -bottom-3">
            <h1 class="text-3xl">Stacks</h1>
        </div>

        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            <li v-for="stack in stacks" :key="stack.id" class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <img
                            class="w-12 h-8 rounded"
                            :src="stack.image"
                            alt="Neil image"
                        />
                    </div>
                    <div class="flex-1 min-w-0">
                        <p
                            class="text-sm font-medium text-gray-900 truncate dark:text-white"
                        >
                            {{ stack.name }}
                        </p>
                    </div>
                    <div
                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white"
                    >
                        {{ stack.id }}
                        <button
                            class="bg-red-500 text-white rounded p-3 ml-4"
                            @click="deleteStack(stack.id)"
                        >
                            Delete stack
                        </button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import throttle from "lodash/throttle";
import Swal from "sweetalert2";

const props = defineProps({
    stacks: Array,
});

const deleteStack = (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "The stack will be lost foreverrrrr",
        icon: "warning",
        showDenyButton: true,
        confirmButtonText: "Yes, go to hell",
        confirmButtonColor: "#F0C400",

        toast: true,
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.delete("/admin/stacks/" + id);
            Swal.fire({
                title: "Bruh",
                text: "That stack was an absolute mess",
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
