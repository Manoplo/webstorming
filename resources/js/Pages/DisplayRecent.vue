<template>
    <NavBar />
    <section class="flex w-3/4 justify-around mx-auto mt-32">
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
        <div class="flex w-full sm:w-1/2">
            <form class="flex items-center ml-auto">
                <button class="bg-transparent outline-none border-none mr-3">
                    <img
                        src="../../images/search.png"
                        alt="search icon"
                        class="w-5 h-5 object-cover"
                    />
                </button>
                <input
                    type="search"
                    placeholder="Search for webstorm ideas..."
                    class="w-96 p-2 border-gray-200 focus:outline-yellow-500 focus:shadow-lg rounded-md search-bar focus:ring-yellow-500 focus:ring-inset-0"
                />
            </form>
        </div>
    </section>
    <section>
        <div class="flex flex-wrap w-3/4 justify-center mx-auto mt-5 gap-10">
            <div
                v-for="card in cards.cardData"
                :key="card.id"
                class="w-full sm:w-[28%]"
            >
                <Card :href="`/posts/${card.id}`" :card="card" />
            </div>
        </div>
    </section>
</template>

<script setup>
import NavBar from "../Components/NavBar.vue";
import Vue3Lottie from "vue3-lottie";
import Newest from "../lotties/newest.json";
import Card from "../Components/PostCard.vue";
defineProps({
    cards: Object,
});
</script>

<style></style>
