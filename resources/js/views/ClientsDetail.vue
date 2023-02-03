<script setup>
import ClientsInfo from "../components/Clients/ClientsInfo.vue";
import AppPage from "../components/UI/AppPage.vue";
import {useRouter} from "vue-router";
import {onMounted, ref} from "vue";
import axios from "axios";
import {useLoading} from "../use/loading";
import LoadingScreen from "../components/UI/LoadingScreen.vue";

const { loading, startLoading, stopLoading } = useLoading();

const router = useRouter();
const client = ref({});

onMounted(() => fetchClient())

const fetchClient = async () => {
  startLoading()

  const response = await axios.get(`/api/clients/${router.currentRoute.value.params.id}`);

  client.value = response.data.data;

  stopLoading()
}
</script>

<template>
  <AppPage>
    <template #title>
      Client Details
    </template>

    <template #actions v-if="client.id">
      <RouterLink :to="{ name: 'clients.edit', params: { id: client.id } }" class="button">
        Edit
      </RouterLink>
    </template>

    <LoadingScreen :loading="loading" :count="client.id">
      <ClientsInfo :client="client" />
    </LoadingScreen>
  </AppPage>
</template>
