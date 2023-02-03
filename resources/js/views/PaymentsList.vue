<script setup>
import PaymentsTable from "../components/Payments/PaymentsTable.vue";
import LoadingScreen from "../components/UI/LoadingScreen.vue";
import AppPage from "../components/UI/AppPage.vue";
import {useLoading} from "../use/loading";
import {onMounted, ref} from "vue";
import axios from "axios";

const { loading, startLoading, stopLoading } = useLoading();

const payments = ref([]);

onMounted(() => fetchPayments())

const fetchPayments = async () => {
  startLoading()

  const response = await axios.get('/api/payments');

  payments.value = response.data.data;

  stopLoading()
}
</script>

<template>
  <AppPage>
    <template #title>
      Payments List
    </template>

    <LoadingScreen :loading="loading" :count="payments.length">
      <PaymentsTable :payments="payments" />
    </LoadingScreen>
  </AppPage>
</template>
