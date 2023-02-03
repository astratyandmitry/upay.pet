<script setup>
import AppHeader from "./components/UI/AppHeader.vue";
</script>

<template>
  <div class="app">
    <AppHeader />

    <main class="main">
      <div class="container mx-auto px-4">
        <router-view />
      </div>
    </main>
  </div>
</template>

<style lang="postcss" scoped>
.app {
  @apply w-full min-h-screen bg-gray-100 antialiased pt-[60px];
}

.main {
  @apply py-12;
}
</style>
