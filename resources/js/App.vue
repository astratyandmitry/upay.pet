<script setup>
import {ref} from "vue";

const message = ref('Hello World!')
</script>

<template>
    <h1 class="title">
        {{ message }}
    </h1>
</template>

<style lang="postcss" scoped>
.title {
    @apply text-center text-4xl text-gray-700;
}
</style>
