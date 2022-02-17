<template>
    <div class="min-h-screen bg-gray-50">
        <main class="w-3/4 mx-auto pt-32 flex flex-wrap">
            <section class="sm:w-1/2 w-100 flex">
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
                            <h3 class="text-gray-500 text-2xl">
                                by
                                <Link :href="`/profiles/${data.user.id}`">
                                    <span
                                        class="text-blue-500 font-bold hover:text-blue-300"
                                        >{{ data.user.name }}</span
                                    >
                                </Link>
                            </h3>
                            <small class="text-gray-400 mb-2">
                                published {{ data.post.created_at }}</small
                            >
                            <div class="flex justify-center mb-3">
                                <img
                                    src="../../images/stack.png"
                                    alt="stack icon"
                                    width="24"
                                    height="24"
                                />
                                <span class="ml-2 text-gray-500">
                                    {{ data.stack.name }} - {{ data.post.type }}
                                </span>
                            </div>
                        </div>
                        <p class="text-yellow-400 font-bold">App name:</p>
                        <h3 class="text-gray-700 font-bold text-2xl">
                            {{ data.post.title }}
                        </h3>
                        <p class="text-yellow-400 font-bold mt-3">
                            Webstorming idea:
                        </p>
                        <h3 class="text-sm text-gray-700 font-normal mt-2">
                            {{ data.post.description }}
                        </h3>
                    </div>
                    <div
                        class="footer flex justify-start items-center pb-5 pl-5 pr-5 ml-4"
                    >
                        <div class="flex">
                            <svg
                                @click="like"
                                width="36"
                                height="36"
                                stroke-width="1.5"
                                viewBox="0 0 24 24"
                                :fill="liked ? '#BB1C1C' : '#fff'"
                                class="cursor-pointer"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M22 8.86222C22 10.4087 21.4062 11.8941 20.3458 12.9929C17.9049 15.523 15.5374 18.1613 13.0053 20.5997C12.4249 21.1505 11.5042 21.1304 10.9488 20.5547L3.65376 12.9929C1.44875 10.7072 1.44875 7.01723 3.65376 4.73157C5.88044 2.42345 9.50794 2.42345 11.7346 4.73157L11.9998 5.00642L12.2648 4.73173C13.3324 3.6245 14.7864 3 16.3053 3C17.8242 3 19.2781 3.62444 20.3458 4.73157C21.4063 5.83045 22 7.31577 22 8.86222Z"
                                    stroke="currentColor"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            <span class="text-gray-500 ml-2">{{
                                likeCount
                            }}</span>
                            <svg
                                width="36"
                                height="36"
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
                            <!--REPORT SVG-->
                            <svg
                                width="36"
                                height="36"
                                stroke-width="1.5"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                class="ml-5 cursor-pointer"
                                @click="sendReport"
                            >
                                <path
                                    d="M20.0429 21H3.95705C2.41902 21 1.45658 19.3364 2.22324 18.0031L10.2662 4.01533C11.0352 2.67792 12.9648 2.67791 13.7338 4.01532L21.7768 18.0031C22.5434 19.3364 21.581 21 20.0429 21Z"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                />
                                <path
                                    d="M12 9V13"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                />
                                <path
                                    d="M12 17.01L12.01 16.9989"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            <!--EDIT SVG-->
                            <div v-if="$page.props.auth.user === data.user.id">
                                <Link :href="`/posts/edit/${data.post.id}`">
                                    <svg
                                        width="36"
                                        height="36"
                                        stroke-width="1.5"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="ml-5"
                                    >
                                        <path
                                            d="M13.0207 5.82839L15.8491 2.99996L20.7988 7.94971L17.9704 10.7781M13.0207 5.82839L3.41405 15.435C3.22652 15.6225 3.12116 15.8769 3.12116 16.1421V20.6776H7.65669C7.92191 20.6776 8.17626 20.5723 8.3638 20.3847L17.9704 10.7781M13.0207 5.82839L17.9704 10.7781"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <span class="text-gray-500 ml-2">Edit</span>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="w-100 sm:w-1/2">
                <div class="border border-gray-300 rounded overflow-y-scroll">
                    <div v-for="message in data.messages" :key="message.id">
                        <div class="flex items-center p-2">
                            <img
                                :src="message.authors.image"
                                alt="avatar"
                                class="w-10 h-10 rounded-full mr-2"
                            />
                            <div class="flex-1">
                                <div class="flex items-center">
                                    <h3 class="text-gray-900 font-semibold">
                                        {{ message.comments.body }}
                                    </h3>
                                    <span class="text-gray-500 ml-2">
                                        {{ message.comments.created_at }}
                                    </span>
                                </div>
                                <p class="text-gray-700">{{ comment.body }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import { usePage } from "@inertiajs/inertia-vue3";
import { ref, computed } from "vue";
import Swal from "sweetalert2";

// PROPS

const props = defineProps({
    data: Object,
});

// VARS

const liked = ref(false);
const likeCount = ref(0);

// FUNCTIONS

const like = () => {
    liked.value = !liked.value;
    liked.value ? likeCount.value++ : likeCount.value--;

    // TODO: send like to server
    /* Inertia.post("/posts/like", {
        post_id: props.data.post.id,
        user_id: props.data.user.id,
    }); */
};

const sendReport = () => {
    if (!usePage().props.value.auth.user) {
        Swal.fire({
            title: "Oops!",
            text: "You must be logged in to report a post",
            icon: "error",
            confirmButtonColor: "#F0C400",
        });
    }

    // TODO, SEND EMAIL NOTIFICACTION TO ADMIN
};
</script>

<style></style>
