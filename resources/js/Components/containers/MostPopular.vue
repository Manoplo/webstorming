<template>
    <section>
        <div class="flex flex-wrap w-3/4 justify-center mx-auto gap-10">
            <div v-for="card in cards" :key="card.id" class="w-100 sm:w-[28%]">
                <PostCard :href="`/posts/${card.id}`" :card="card" />
            </div>
        </div>
    </section>
</template>

<script setup>
import PostCard from "../PostCard";
import { ref, onBeforeMount, defineComponent } from "vue";
import axios from "axios";

defineComponent({
    name: PostCard,
});

/* defineProps({
    cards: Array,
}); */

const cards = ref([]);

const fetchCards = async () => {
    const { data } = await axios.get("/cards/popular");
    const { cardData } = data;

    // Convierto el objeto de objetos en un array de objetos.
    const dataArray = Object.keys(cardData).map((key) => cardData[key]);

    // Ordeno el array de objetos por el campo likes_count y lo corto de la posición 0 a la 6.
    cards.value = dataArray
        .sort((a, b) => {
            return b.likes_count - a.likes_count;
        })
        .filter((item) => item.likes_count > 0)
        .slice(0, 6);
};
onBeforeMount(() => {
    fetchCards();
});
</script>

<style></style>
