<template>
    <section>
        <div class="flex flex-wrap w-3/4 mx-auto gap-10">
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
    const { data } = await axios.get("/cards/recent");
    console.log(data);

    cards.value = data;
};
onBeforeMount(() => {
    fetchCards();
});
</script>

<style></style>
