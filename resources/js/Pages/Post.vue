<template>
    <main class="w-3/4 mx-auto mt-32 flex">
        <section class="sm:w-1/2 w-100">
            <div class="w-100">
                <div
                    class="sm:w-4/5 w-100 rounded-lg border border-gray-200 shadow-xl overflow-hidden"
                >
                    <div class="relative flex justify-center">
                        <img :src="data.stack.image" alt="stack image" />
                        <div class="absolute top-[85%]">
                            <img
                                :src="data.user.image"
                                alt="user image"
                                class="rounded-full w-24 h-24 border-2 border-white shadow-lg"
                            />
                        </div>
                    </div>

                    <div class="p-10 mt-6 flex flex-col justify-center">
                        <div class="flex flex-col text-center justify-center">
                            <h3 class="text-gray-500 text-xl">
                                by
                                <Link :href="`/profiles/${data.user.id}`">
                                    <span
                                        class="text-blue-500 hover:text-blue-300"
                                        >{{ data.user.name }}</span
                                    >
                                </Link>
                            </h3>
                            <small class="text-gray-400 mb-2">
                                published {{ data.post.created_at }}</small
                            >
                        </div>
                        <p class="text-yellow-600 font-bold">App name:</p>
                        <h3 class="text-gray-700 font-bold text-2xl">
                            {{ data.post.title }}
                        </h3>
                        <p class="text-yellow-600 font-bold">
                            Webstorming idea:
                        </p>
                        <h3 class="text-sm text-gray-700 font-semibold">
                            {{ data.post.description }}
                        </h3>
                    </div>
                    <div class="footer flex justify-around">
                        <div class="flex">
                            <svg
                                width="24"
                                height="24"
                                stroke-width="1.5"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M22 8.86222C22 10.4087 21.4062 11.8941 20.3458 12.9929C17.9049 15.523 15.5374 18.1613 13.0053 20.5997C12.4249 21.1505 11.5042 21.1304 10.9488 20.5547L3.65376 12.9929C1.44875 10.7072 1.44875 7.01723 3.65376 4.73157C5.88044 2.42345 9.50794 2.42345 11.7346 4.73157L11.9998 5.00642L12.2648 4.73173C13.3324 3.6245 14.7864 3 16.3053 3C17.8242 3 19.2781 3.62444 20.3458 4.73157C21.4063 5.83045 22 7.31577 22 8.86222Z"
                                    stroke="currentColor"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            <span class="text-gray-500 ml-2">230</span>
                            <svg
                                width="24"
                                height="24"
                                stroke-width="1.5"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                class="ml-5"
                            >
                                <path
                                    d="M8 10L12 10L16 10"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M8 14L10 14L12 14"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 13.8214 2.48697 15.5291 3.33782 17L2.5 21.5L7 20.6622C8.47087 21.513 10.1786 22 12 22Z"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            <span class="text-gray-500 ml-2">44</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-1/2">
            <div>
                <h1>Aquí van los mensajes</h1>
            </div>
        </section>
    </main>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
defineProps({
    data: Array,
});
</script>

<style></style>
