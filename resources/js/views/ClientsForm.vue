<script setup>
import ClientsForm from "../components/Clients/ClientsForm.vue";
import AppPage from "../components/UI/AppPage.vue";
</script>

<template>
  <AppPage>
    <template #title>
      Client Management
    </template>

    <ClientsForm />
  </AppPage>
</template>

<style lang="postcss" scoped>

</style>
