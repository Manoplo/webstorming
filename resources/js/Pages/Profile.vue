<template>
    <main>
        <NavBar />
        <section class="container w-3/4 mx-auto px-4 pt-28 mb-20">
            <Transition name="fade" mode="out-in">
                <div v-if="profile">
                    <div
                        class="profile-header w-100 flex flex-col justify-center items-center"
                    >
                        <!--IF USER IS AUTH USER, WE CAN EDIT PROFILE PIC-->
                        <div v-if="$page.props.auth?.user?.id === user.id">
                            <img
                                @click="onSelectImage"
                                :src="previewImage ? previewImage : user.image"
                                alt="User Image Profile"
                                class="rounded-full w-36 h-36 border-2 border-gray-200 shadow-lg cursor-pointer"
                            />
                            <div
                                v-if="errors.image"
                                v-html="errors.image"
                                class="text-red-500 font-light"
                            ></div>
                            <form @submit.prevent="saveImage">
                                <input
                                    type="file"
                                    @input="form.image = $event.target.files[0]"
                                    ref="imageSelector"
                                    class="hidden"
                                    @change="setPreviewImage"
                                />
                                <div v-if="form.image">
                                    <button
                                        type="submit"
                                        class="bg-yellow-500 text-white rounded hover:bg-yellow-600 hover:shadow-lg hover:text-white px-4 py-2 mt-2 ml-5"
                                    >
                                        Save Pic
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!--ELSE, WE CAN´T-->
                        <div v-else>
                            <img
                                :src="user.image"
                                alt="User Image Profile"
                                class="rounded-full w-36 h-36 border-2 border-gray-200 shadow-lg"
                            />
                        </div>
                        <h1 class="text-4xl text-gray-800 font-bold mt-4">
                            {{ user.name }}
                            <span
                                v-if="user.is_admin"
                                class="p-2 text-white bg-yellow-500 text-sm rounded mb-1"
                                >admin</span
                            >
                        </h1>
                        <!--Location SVG-->
                        <div class="flex gap-3 mt-2">
                            <svg
                                width="24"
                                height="24"
                                stroke-width="1.5"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M7 9.01L7.01 8.99889"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M11 9.01L11.01 8.99889"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M7 13.01L7.01 12.9989"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M11 13.01L11.01 12.9989"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M7 17.01L7.01 16.9989"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M11 17.01L11.01 16.9989"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M15 21H3.6C3.26863 21 3 20.7314 3 20.4V5.6C3 5.26863 3.26863 5 3.6 5H9V3.6C9 3.26863 9.26863 3 9.6 3H14.4C14.7314 3 15 3.26863 15 3.6V9M15 21H20.4C20.7314 21 21 20.7314 21 20.4V9.6C21 9.26863 20.7314 9 20.4 9H15M15 21V17M15 9V13M15 13H17M15 13V17M15 17H17"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            <h3 class="font-normal text-gray-500">
                                {{
                                    user.location
                                        ? user.location
                                        : "Somewhere in Webstorm City"
                                }}
                            </h3>
                        </div>
                        <!--LIKES AND STORMS COMMENTS)-->
                        <div class="sm:w-[30%] w-100 flex mt-7">
                            <div
                                class="w-1/3 border px-4 py-2 border-gray-300 rounded-tl-lg rounded-bl-lg text-center"
                            >
                                <!---IDEAS-->
                                <div class="flex justify-around items-center">
                                    <svg
                                        width="21"
                                        height="21"
                                        stroke-width="1.5"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M21 2L20 3"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                        <path
                                            d="M3 2L4 3"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                        <path
                                            d="M21 16L20 15"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                        <path
                                            d="M3 16L4 15"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                        <path
                                            d="M9 18H15"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                        <path
                                            d="M10 21H14"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                        <path
                                            d="M11.9998 3C7.9997 3 5.95186 4.95029 5.99985 8C6.02324 9.48689 6.4997 10.5 7.49985 11.5C8.5 12.5 9 13 8.99985 15H14.9998C15 13.0001 15.5 12.5 16.4997 11.5001L16.4998 11.5C17.4997 10.5 17.9765 9.48689 17.9998 8C18.0478 4.95029 16 3 11.9998 3Z"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <h3
                                        class="text-3xl font-bold text-gray-800"
                                    >
                                        {{ info.numPosts }}
                                    </h3>
                                </div>
                                <p class="text-gray-500 text-sm">
                                    webstormings
                                </p>
                            </div>
                            <div
                                class="w-1/3 border px-4 py-2 border-gray-300 text-center"
                            >
                                <!---LIKES-->
                                <div class="flex justify-around items-center">
                                    <svg
                                        width="21"
                                        height="21"
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
                                    <h3
                                        class="text-3xl font-bold text-gray-800"
                                    >
                                        15
                                    </h3>
                                </div>
                                <p class="text-gray-500 text-sm">
                                    likes collected
                                </p>
                            </div>
                            <div
                                class="w-1/3 border px-4 py-2 border-gray-300 rounded-tr-lg rounded-br-lg text-center"
                            >
                                <!---COMMENTS-->
                                <div class="flex justify-around items-center">
                                    <svg
                                        width="24"
                                        height="24"
                                        stroke-width="1.5"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
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
                                    <h3
                                        class="text-3xl font-bold text-gray-800"
                                    >
                                        {{ info.numComments }}
                                    </h3>
                                </div>
                                <p class="text-gray-500 text-sm">opinions</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-gray-500 font-light text-lg mt-3">
                                {{
                                    user.bio
                                        ? user.bio
                                        : "Some secrets must never be revealed..."
                                }}
                            </p>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <PostForm :stacks="stacks" :errors="errors" />
                </div>
            </Transition>
            <div
                v-if="$page.props.auth?.user?.id === user.id"
                class="w-1/2 flex mx-auto text-center justify-center items-center gap-4 mt-6"
            >
                <button
                    class="transition ease-in-out rounded-full w-10 h-10 bg-gray-800 p-15 text-2xl text-white hover:bg-gray-600 hover:shadow-lg"
                    @click="profile = !profile"
                >
                    <div v-if="profile">+</div>
                    <div v-else>&#60;</div>
                </button>
                <h3 v-if="profile" class="text-gray-600">
                    CREATE A NEW WEB IDEA
                </h3>
                <h3 v-else class="text-gray-600">DISPLAY PROFILE</h3>
            </div>
        </section>
        <section>
            <!--HERE COMES TAB SYSTEM COMPONENT WITH USERS POSTS, BROWSE POSTS AND BROWSE USERS-->
            <div v-if="$page.props.auth?.user?.id === user.id">
                <ProfileTabs :cards="cards" />
            </div>
            <!--THE USER IS NOT THE AUTH USER-->
            <div v-else>
                <div class="flex items-center justify-center gap-3 mb-5">
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
                    <h1 class="font-normal text-black text-center text-2xl">
                        {{ user.name }}´s
                        <span class="text-yellow-500 font-bold"
                            >webstormings</span
                        >
                    </h1>
                </div>

                <hr />
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
        </section>
    </main>
</template>

<script setup>
import NavBar from "../Components/NavBar.vue";
import PostForm from "../Components/PostForm.vue";
import Card from "../Components/PostCard.vue";
import ProfileTabs from "../Components/ProfileTabs.vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, computed, onMounted } from "vue";
import Swal from "sweetalert2";
import axios from "axios";

// PROPS
const props = defineProps({
    user: Object,
    info: Object,
    stacks: Array,
    errors: Object,
    cards: Array,
});

// VARS

const profile = ref(true);
const cards = ref([]);

const form = useForm({
    image: null,
});
const imageSelector = ref(null);
const previewImage = ref(null);

const setPreviewImage = computed(() => {
    if (form.image) {
        const prev = URL.createObjectURL(form.image);
        previewImage.value = prev;
    }
});

// FUNCTIONS
// Referenciar el click de la imagen al input type file.
const onSelectImage = () => {
    imageSelector.value.click();
};
// Load user webstorm cards.
const loadUserCards = async () => {
    const { data } = await axios.get(`/cards/${props.user.id}`);
    console.log(data);
    cards.value = data.cardData;
};
// Send image to server
const saveImage = () => {
    form.post("/profiles/save-image");
    Swal.fire({
        title: "Image saved!",
        icon: "success",
        timer: 1500,
        timerProgressBar: true,
        showConfirmButton: false,
        toast: true,
    });

    form.reset();
};

// LifeCycle Hooks
onMounted(() => {
    loadUserCards();
});
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
