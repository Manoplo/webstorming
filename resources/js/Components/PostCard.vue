<template>
    <Link class="w-100">
        <div
            class="transition ease-in-out card rounded border border-gray-200 min-h-[400px] hover:shadow-xl"
        >
            <div>
                <img :src="card.stack_image" alt="stack image" />
            </div>
            <div class="card-body p-5">
                <div>
                    <h2>{{ card.title }}</h2>
                    <h3>By {{ card.user_name }}</h3>
                    <p>{{ card.created_at }}</p>
                </div>
            </div>
        </div>
    </Link>
</template>

<script setup>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

defineComponent({
    name: Link,
});

defineProps({
    card: Object,
});
</script>

<style></style>
