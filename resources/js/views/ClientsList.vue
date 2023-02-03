<script setup>
import ClientsTable from "../components/Clients/ClientsTable.vue";
import LoadingScreen from "../components/UI/LoadingScreen.vue";
import AppPage from "../components/UI/AppPage.vue";
import {useLoading} from "../use/loading";
import {onMounted, ref} from "vue";
import axios from "axios";

const { loading, startLoading, stopLoading } = useLoading();

const clients = ref([]);

onMounted(() => fetchClients())

const fetchClients = async () => {
  startLoading()

  const response = await axios.get('/api/clients');

  clients.value = response.data.data;

  stopLoading()
}
</script>

<template>
  <AppPage>
    <template #title>
      Clients List
    </template>

    <template #actions>
      <RouterLink :to="{ name: 'clients.create' }" class="button">
        Add
      </RouterLink>
    </template>

    <LoadingScreen :loading="loading" :count="clients.length">
      <ClientsTable :clients="clients" />
    </LoadingScreen>
  </AppPage>
</template>
