<template>
    <NavBar />
    <section class="flex w-3/4 mx-auto mt-32">
        <div class="flex w-full items-center sm:w-1/2">
            <div class="w-16">
                <Vue3Lottie :animationData="Like" />
            </div>
            <h1 class="text-4xl font-bold">
                Popular
                <span
                    class="text-transparent bg-clip-text bg-gradient-to-br from-yellow-400 to-yellow-600 pb-4"
                    >webstormings</span
                >
            </h1>
        </div>
    </section>
    <section>
        <div v-if="isLoading">
            <div class="flex flex-col gap-3 justify-center items-center mt-56">
                <div class="w-32">
                    <Vue3Lottie :animationData="Loading" />
                </div>
                <h2>Loading...</h2>
            </div>
        </div>
        <div class="flex flex-wrap w-3/4 justify-center mx-auto mt-5 gap-10">
            <div v-for="card in cards" :key="card.id" class="w-full sm:w-[28%]">
                <Card :href="`/posts/${card.id}`" :card="card" />
            </div>
        </div>
    </section>
</template>

<script setup>
import NavBar from "../Components/NavBar.vue";
import Vue3Lottie from "vue3-lottie";
import Like from "../lotties/like.json";
import Loading from "../lotties/spinner.json";
import Card from "../Components/PostCard.vue";

import { Link } from "@inertiajs/inertia-vue3";
import { ref, onBeforeMount } from "vue";

const cards = ref([]);
const isLoading = ref(false);

const fetchCards = async () => {
    isLoading.value = true;
    const { data } = await axios.get("/cards/popular");
    const { cardData } = data;

    // Convierto el objeto de objetos en un array de objetos.
    const dataArray = Object.keys(cardData).map((key) => cardData[key]);

    // Ordeno el array de objetos por el campo likes_count y lo corto de la posición 0 a la 6.
    cards.value = dataArray
        .sort((a, b) => {
            return b.likes_count - a.likes_count;
        })
        .filter((item) => item.likes_count > 0);

    isLoading.value = false;
};
onBeforeMount(() => {
    fetchCards();
});
</script>

<style></style>
