<template>
    <div
        class="sm:w-2/4 w-100 flex p-10 flex-col rounded mx-auto border border-gray-300 shadow-xl"
    >
        <form class="flex flex-col gap-3 w-100" @submit.prevent="sendPost">
            <!--POST TITLE-->
            <label for="title" class="text-yellow-600">Name of your app</label>
            <input
                type="text"
                placeholder="ie: 'Facestagram'"
                v-model="form.title"
                class="w-full p-3 border-gray-300 rounded-md focus:border-yellow-300 focus:ring focus:ring-yellow-200 focus:ring-opacity-50"
            />
            <div v-if="errors.title" class="text-red-500 font-weight-light">
                {{ errors.title }}
            </div>
            <!--POST DESCRIPTION-->
            <label for="description" class="text-yellow-600"
                >Brief description</label
            >
            <input
                type="text"
                placeholder="ie: 'A social media app for sharing your face'"
                v-model="form.description"
                class="w-full p-3 border-gray-300 rounded-md focus:border-yellow-300 focus:ring focus:ring-yellow-200 focus:ring-opacity-50"
            />
            <div v-if="errors.description" class="text-light text-red-500">
                {{ errors.description }}
            </div>
            <!--POST TYPE-->
            <label class="text-yellow-600" for="type"
                >What kind of app are you building?</label
            >
            <select
                class="w-full p-3 border-gray-300 rounded-md focus:border-yellow-300 focus:ring focus:ring-yellow-200 focus:ring-opacity-50"
                id="type"
                v-model="form.type"
            >
                <option value="E-commerce">E-commerce</option>
                <option value="Blog">Blog</option>
                <option value="Social Network">Social Network</option>
                <option value="Chat">Chat</option>
                <option value="Web3">Web3</option>
                <option value="Education">Education</option>
                <option value="Medical">Medical</option>
                <option value="Dashboard">Dashboard</option>
                <option value="Service">Service</option>
                <option value="Other">Other</option>
            </select>
            <!--STACKS-->
            <label class="text-yellow-600" for="type"
                >Choose your prefered client/server stack</label
            >
            <select
                class="w-full p-3 border-gray-300 rounded-md focus:border-yellow-300 focus:ring focus:ring-yellow-200 focus:ring-opacity-50"
                id="stacks"
                v-model="form.stack_id"
            >
                <option
                    v-for="stack in stacks"
                    :key="stack.id"
                    :value="stack.id"
                    class="text-gray-700"
                >
                    {{ stack.name }}
                </option>
            </select>
            <input
                type="submit"
                class="transition ease-in-out cursor-pointer bg-yellow-400 sm:w-1/4 w-100 text-black rounded p-3 hover:text-white hover:bg-yellow-500 hover:shadow-md"
                value="CREATE"
            />
        </form>
    </div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { usePage, useForm } from "@inertiajs/inertia-vue3";
import { ref, computed } from "vue";
import Swal from "sweetalert2";

const props = defineProps({
    stacks: Array,
    errors: Object,
});

const form = useForm({
    title: "",
    description: "",
    stack_id: "",
    type: "",
});

const sendPost = () => {
    form.post("/posts/store");
    if (props.errors !== null) {
        props.errors = null;
        return;
    }
    Swal.fire({
        title: "Post Created!",
        text: "Your post has been created!",
        icon: "success",
        showConfirmButton: false,
        timer: 1500,
        toast: true,
    });
};
</script>

<style></style>
