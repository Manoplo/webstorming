<template>
    <h1>Vista para el post con id : {{ post.id }}</h1>
</template>

<script setup>
defineProps({
    post: Array,
});
</script>

<style></style>
