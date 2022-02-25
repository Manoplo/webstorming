<template>
    <div class="w-3/4 mx-auto mt-20">
        <div
            v-if="$page.props.flash.message"
            class="bg-green-400 text-green-100 h-24 p-4 w-96 mx-auto rounded flex justify-center items-center absolute top-8 left-[750px] z-10 shadow-2xl"
        >
            {{ $page.props.flash.message }}
        </div>
        <div class="flex justify-between mb-3 -bottom-3">
            <h1 class="text-3xl">Stacks</h1>
            <Link
                href="/admin"
                class="p-2 bg-yellow-500 rounded hover:shadow-lg"
            >
                Go back
            </Link>
        </div>

        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            <li
                v-for="stack in stacks.data"
                :key="stack.id"
                class="py-3 sm:py-4"
            >
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
                            class="bg-red-500 text-white rounded p-3 ml-4 hover:shadow-lg hover:bg-red-700"
                            @click="deleteStack(stack.id)"
                        >
                            Delete stack
                        </button>
                    </div>
                </div>
            </li>
        </ul>
        <!--Paginator-->
        <div class="mt-6 flex w-100 sm:w-3/4 mx-auto justify-center mb-10">
            <Link
                v-for="link in stacks.links"
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
        <h1 class="mb-4">Insert a new stack</h1>
        <form
            @submit.prevent="createStack"
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
            <label for="form.image">Image URL</label>
            <input
                class="rounded-md"
                type="text"
                placeholder="https://..."
                v-model="form.image"
                id="form.name"
            />
            <div
                v-if="errors.image"
                v-text="errors.image"
                class="text-red-400"
            ></div>

            <input
                type="submit"
                class="w-1/4 p-2 rounded-md bg-yellow-500 hover:bg-yellow-700 hover:shadow-lg"
                value="CREATE STACK"
            />
        </form>
    </div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import throttle from "lodash/throttle";
import Swal from "sweetalert2";

const props = defineProps({
    stacks: Object,
    errors: Object,
});

const form = useForm({
    name: "",
    image: "",
});

const createStack = () => {
    form.post("/admin/stacks");
    form.reset();
};

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
