<template>
    <header
        class="flex w-100 sm:w-3/4 mx-auto justify-center mt-32 mb-10 items-center"
    >
        <div class="w-10 h-10">
            <Vue3Lottie :animationData="EditAnimation" />
        </div>
        <h1 class="text-4xl font-light ml-3">
            <span class="text-yellow-600 font-semibold">Edit</span> your app
        </h1>
    </header>
    <div
        class="sm:w-2/4 w-100 flex p-10 flex-col rounded mx-auto border border-gray-300 shadow-xl"
    >
        <form class="flex flex-col gap-3 w-100" @submit.prevent="editPost">
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
            <div class="flex gap-6">
                <input
                    type="submit"
                    class="transition ease-in-out cursor-pointer bg-yellow-400 sm:w-1/4 w-100 text-black rounded p-3 hover:text-white hover:bg-yellow-500 hover:shadow-md"
                    value="EDIT"
                />
                <Link
                    :href="`/posts/${post.id}`"
                    class="transition ease-in-out cursor-pointer rounded bg-red-400 p-3 text-white hover:text-black hover:bg-red-500"
                    >Cancel</Link
                >
            </div>
        </form>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
import Vue3Lottie from "vue3-lottie";
import EditAnimation from "../lotties/edit.json";

const props = defineProps({
    post: Object,
    stack: Object,
    stacks: Array,
    errors: Object,
});

const form = useForm({
    title: props.post.title,
    description: props.post.description,
    type: props.post.type,
    stack_id: props.stack.id,
});

const editPost = () => {
    form.post(`/posts/update/${props.post.id}`, {
        title: form.title,
        description: form.description,
        type: form.type,
        stack_id: form.stack_id,
    });
};
</script>

<style></style>
