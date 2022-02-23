<template>
    <div class="flex items-center justify-center gap-20 sm:gap-48 mb-5">
        <div @click="isProfile = false" class="cursor-pointer">
            <div class="flex gap-3">
                <svg
                    width="36"
                    height="36"
                    stroke-width="1.5"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M11.5 12L9 17H15L12.5 22"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <path
                        d="M20 17.6073C21.4937 17.0221 23 15.6889 23 13C23 9 19.6667 8 18 8C18 6 18 2 12 2C6 2 6 6 6 8C4.33333 8 1 9 1 13C1 15.6889 2.50628 17.0221 4 17.6073"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
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
        </div>
        <div @click="isProfile = true" class="cursor-pointer">
            <div class="flex gap-3">
                <svg
                    width="36"
                    height="36"
                    stroke-width="1.5"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <path
                        d="M19.6224 10.3954L18.5247 7.7448L20 6L18 4L16.2647 5.48295L13.5578 4.36974L12.9353 2H10.981L10.3491 4.40113L7.70441 5.51596L6 4L4 6L5.45337 7.78885L4.3725 10.4463L2 11V13L4.40111 13.6555L5.51575 16.2997L4 18L6 20L7.79116 18.5403L10.397 19.6123L11 22H13L13.6045 19.6132L16.2551 18.5155C16.6969 18.8313 18 20 18 20L20 18L18.5159 16.2494L19.6139 13.598L21.9999 12.9772L22 11L19.6224 10.3954Z"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
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
            <div
                class="sm:w-2/4 w-100 flex p-10 flex-col rounded-xl mx-auto border border-gray-300 shadow-xl mt-5"
            >
                <form
                    @submit.prevent="updateProfile"
                    class="flex flex-col gap-3 w-100 mb-5"
                >
                    <label class="text-yellow-600" for="form.name"
                        >Change your display name</label
                    >
                    <input
                        type="text"
                        v-model="form.name"
                        class="w-full p-3 border-gray-300 rounded-md focus:border-yellow-300 focus:ring focus:ring-yellow-200 focus:ring-opacity-50"
                    />
                    <label class="text-yellow-600" for="form.location">
                        Set your home</label
                    >

                    <input
                        type="text"
                        v-model="form.location"
                        class="w-full p-3 border-gray-300 rounded-md focus:border-yellow-300 focus:ring focus:ring-yellow-200 focus:ring-opacity-50"
                    />
                    <label class="text-yellow-600" for="form.bio"
                        >Tell us something about you</label
                    >
                    <input
                        type="text"
                        v-model="form.bio"
                        class="w-full p-3 border-gray-300 rounded-md focus:border-yellow-300 focus:ring focus:ring-yellow-200 focus:ring-opacity-50"
                    />
                    <input
                        type="submit"
                        class="transition ease-in-out cursor-pointer bg-yellow-400 sm:w-1/4 w-100 text-black rounded p-3 hover:text-white hover:bg-yellow-500 hover:shadow-md"
                        value="UPDATE PROFILE"
                    />
                </form>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { ref } from "vue";
import Card from "../Components/PostCard.vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";

// PROPS
const props = defineProps({
    cards: Array,
    errors: Object,
});

// VARS
const isProfile = ref(false);

// FORM
const form = useForm({
    name: usePage().props.value.auth.user.name
        ? usePage().props.value.auth.user.name
        : "",
    bio: usePage().props.value.auth.user.bio
        ? usePage().props.value.auth.user.bio
        : "",

    location: usePage().props.value.auth.user.location
        ? usePage().props.value.auth.user.location
        : "",
});

const updateProfile = () => {
    form.post(`/profiles/update/${usePage().props.value.auth.user.id}`, form);
};
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
