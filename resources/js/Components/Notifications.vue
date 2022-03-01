<template>
    <div
        class="relative rounded-full hover:bg-gray-100 cursor-pointer p-4"
        @click="toggle"
    >
        <div
            class="absolute h-5 w-5 flex justify-center items-center rounded-full bg-red-600 top-2 left-2"
            v-if="notRead !== 0"
        >
            <small class="text-white"> {{ notRead }}</small>
        </div>
        <svg
            width="24"
            height="24"
            stroke-width="1.5"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            :class="{ 'text-blue-500': isOpen }"
        >
            <path
                d="M18 8.4C18 6.70261 17.3679 5.07475 16.2426 3.87452C15.1174 2.67428 13.5913 2 12 2C10.4087 2 8.88258 2.67428 7.75736 3.87452C6.63214 5.07475 6 6.70261 6 8.4C6 15.8667 3 18 3 18H21C21 18 18 15.8667 18 8.4Z"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
            <path
                d="M13.73 21C13.5542 21.3031 13.3019 21.5547 12.9982 21.7295C12.6946 21.9044 12.3504 21.9965 12 21.9965C11.6496 21.9965 11.3054 21.9044 11.0018 21.7295C10.6982 21.5547 10.4458 21.3031 10.27 21"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
        </svg>
        <ul
            v-if="isOpen"
            class="absolute top-14 sm:right-0 -right-16 bg-white shadow-lg rounded p-5 max-h-96 w-96 overflow-y-auto"
        >
            <li v-if="!notifications.length" class="w-100 rounded p-2 mb-2">
                No notifications yet!
            </li>
            <li
                v-else
                v-for="notification in notifications"
                :key="notification.id"
                class="w-100 rounded p-3 mb-2 hover:bg-blue-100"
                :class="{ 'bg-blue-100': notification.read_at === null }"
            >
                <Link
                    @click="markAsRead(notification.id, notification.data.post)"
                    :href="`/posts/${notification.data.post}`"
                >
                    <div class="flex items-center mb-2">
                        <img
                            :src="notification.data.avatar"
                            alt="user avatar"
                            class="w-10 h-10 rounded-full mr-2"
                        />
                        <h3 class="text-blue-400">
                            {{ notification.data.commenter }}
                        </h3>
                        <small class="ml-1">{{
                            notification.formatedDate
                        }}</small>
                    </div>
                    <p class="text-gray-500">has commented your idea!</p>
                </Link>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref, onBeforeMount, computed, onUpdated } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

// VARS
const notifications = ref([]);
const isOpen = ref(false);
const notRead = ref(0);

const toggle = () => {
    isOpen.value = !isOpen.value;
};

const markAsRead = (id, postId) => {
    Inertia.post(`/mark-as-read`, { id, postId });
};

onBeforeMount(() => {
    axios.get("/notifications").then(({ data }) => {
        notifications.value = data;
        notRead.value = data.filter((n) => n.read_at === null).length;
    });
});
</script>

<style></style>
