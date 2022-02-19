<template>
    <main>
        <section class="container w-3/4 mx-auto px-4 pt-28">
            <div
                class="profile-header w-100 flex flex-col justify-center items-center"
            >
                <!--IF USER IS AUTH USER, WE CAN EDIT PROFILE PIC-->
                <div v-if="$page.props.auth.user.id === user.id">
                    <img
                        @click="onSelectImage"
                        :src="previewImage ? previewImage : user.image"
                        alt="User Image Profile"
                        class="rounded-full w-36 h-36 border-2 border-gray-200 shadow-lg cursor-pointer"
                    />
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
                        <h3 class="text-3xl font-bold text-gray-800">4</h3>
                        <p class="text-gray-500 text-sm">webstormings</p>
                    </div>
                    <div
                        class="w-1/3 border px-4 py-2 border-gray-300 text-center"
                    >
                        <h3 class="text-3xl font-bold text-gray-800">15</h3>
                        <p class="text-gray-500 text-sm">likes collected</p>
                    </div>
                    <div
                        class="w-1/3 border px-4 py-2 border-gray-300 rounded-tr-lg rounded-br-lg text-center"
                    >
                        <h3 class="text-3xl font-bold text-gray-800">31</h3>
                        <p class="text-gray-500 text-sm">opinions</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { ref, computed } from "vue";

// PROPS
const props = defineProps({
    user: Object,
});

// VARS

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
// Send image to server
const saveImage = () => {
    form.post("/profiles/save-image");
    console.log("Saved!");
};
</script>

<style></style>
