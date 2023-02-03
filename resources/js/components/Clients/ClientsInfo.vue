<script setup>
import PaymentsTable from "../Payments/PaymentsTable.vue";
import { defineProps } from "vue";

const props = defineProps({
  client: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <table class="table">
    <tr>
      <th class="th">ID:</th>
      <td class="td">{{ props.client.id }}</td>
    </tr>
    <tr class="border-t">
      <th class="th">Full Name:</th>
      <td class="td">{{ props.client.full_name }}</td>
    </tr>
    <tr class="border-t">
      <th class="th">Phone:</th>
      <td class="td">{{ props.client.phone }}</td>
    </tr>
    <tr class="border-t">
      <th class="th">E-mail:</th>
      <td class="td">{{ props.client.email }}</td>
    </tr>
    <tr class="border-t">
      <th class="th">Created:</th>
      <td class="td">{{ props.client.created_at }}</td>
    </tr>
  </table>

  <div class="mt-8">
    <div v-if="props.client.payments">
      <h4>Payments</h4>

      <PaymentsTable :payments="props.client.payments" :hide-client="true" />
    </div>

    <div v-else class="text-sm p-4 rounded bg-gray-200 text-gray-600 font-italic">
      Client has not payments yet.
    </div>
  </div>
</template>

<style lang="postcss" scoped>
.table {
  @apply w-full bg-white border-collapse border border-gray-200 rounded overflow-hidden drop-shadow-xl;
}

.th {
  @apply border-r text-right p-4 bg-gray-50 text-xs font-medium text-gray-500 uppercase tracking-wider;
}

.td {
  @apply p-4 text-sm text-gray-900;
}

h4 {
  @apply text-2xl font-semibold mb-4;
}
</style>
