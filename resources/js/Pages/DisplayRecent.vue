<template>
    <NavBar />
    <section class="flex w-3/4 justify-start mx-auto mt-32">
        <div class="flex w-full items-center sm:w-1/2">
            <div class="w-16">
                <Vue3Lottie :animationData="Newest" />
            </div>
            <h1 class="text-4xl font-bold">
                Newest
                <span
                    class="text-transparent bg-clip-text bg-gradient-to-br from-yellow-400 to-yellow-600 pb-4"
                    >webstormings</span
                >
            </h1>
        </div>
    </section>
    <section>
        <div class="flex flex-wrap w-3/4 justify-center mx-auto mt-5 gap-10">
            <div
                v-for="card in cards.data"
                :key="card.id"
                class="w-full sm:w-[28%]"
            >
                <Card :href="`/posts/${card.id}`" :card="card" />
            </div>
        </div>
        <!--Paginator-->
        <div class="mt-6 flex w-100 sm:w-3/4 mx-auto justify-center mb-10">
            <Link
                v-for="link in cards.links"
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
    </section>
</template>

<script setup>
import NavBar from "../Components/NavBar.vue";
import Vue3Lottie from "vue3-lottie";
import Newest from "../lotties/newest.json";
import Card from "../Components/PostCard.vue";
import { Link } from "@inertiajs/inertia-vue3";
defineProps({
    cards: Object,
});
</script>

<style></style>
