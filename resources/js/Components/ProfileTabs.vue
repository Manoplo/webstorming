<template>
    <div class="flex items-center justify-center gap-20 sm:gap-48 mb-5">
        <div @click="isProfile = false" class="cursor-pointer">
            <h2
                class="text-gray-600 text-2xl"
                :class="{
                    underline: !isProfile,
                    'decoration-gray-900': !isProfile,
                    'decoration-4': !isProfile,
                    'underline-offset-8': !isProfile,
                }"
            >
                YOUR WEBSTORMS
            </h2>
        </div>
        <div @click="isProfile = true" class="cursor-pointer">
            <h2
                class="text-gray-600 text-2xl"
                :class="{
                    underline: isProfile,
                    'decoration-gray-900': isProfile,
                    'decoration-4': isProfile,
                    'underline-offset-8': isProfile,
                }"
            >
                EDIT PROFILE
            </h2>
        </div>
    </div>
    <hr />
    <Transition name="fade" mode="out-in">
        <div v-if="!isProfile">
            <section>
                <div
                    v-if="!cards.length"
                    class="flex justify-center mx-auto mt-5"
                >
                    <h1 class="text-3xl font-normal">
                        No contributions yet... 🙁
                    </h1>
                </div>
                <div
                    v-else
                    class="flex flex-wrap w-3/4 justify-center mx-auto mt-5 gap-10"
                >
                    <div
                        v-for="card in cards"
                        :key="card.id"
                        class="w-100 sm:w-[28%]"
                    >
                        <Card :href="`/posts/${card.id}`" :card="card" />
                    </div>
                </div>
            </section>
        </div>
        <div v-else>
            <h1>Formulario de user info</h1>
        </div>
    </Transition>
</template>

<script setup>
import { ref } from "vue";
import Card from "../Components/PostCard.vue";

const props = defineProps({
    cards: Array,
});

const isProfile = ref(false);
</script>

<style scoped>
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
.fade-enter-to,
.fade-leave-from {
    opacity: 1;
}
.fade-enter-active {
    transition: opacity 0.3s ease-in-out;
}
.fade-leave-active {
    transition: opacity 0.3s ease-in-out;
}
</style>
