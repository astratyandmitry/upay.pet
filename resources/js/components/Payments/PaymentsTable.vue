<script setup>
import {toast} from "vue3-toastify";
import {defineProps} from 'vue';
import axios from "axios";

const props = defineProps({
  hideClient: {
    type: Boolean,
    default: false,
  },
  payments: {
    type: Array,
    default: () => [],
  },
});

const handlePaid = (id) => {
  axios.post(`/api/payments/${id}/paid`)
    .then(({ data }) => toast.success(data.message))
    .catch((error) => toast.error(error.response.data.message));
};

const handleCanceled = (id) => {
  axios.post(`/api/payments/${id}/canceled`)
    .then(({ data }) => toast.success(data.message))
    .catch((error) => toast.error(error.response.data.message));
};
</script>

<template>
  <table class="table">
    <thead>
    <tr>
      <th class="th w-16">
        ID
      </th>
      <th class="th w-[320px]" v-if="!props.hideClient">
        Client
      </th>
      <th class="th">
        Payment
      </th>
      <th class="th w-24">
        Amount
      </th>
      <th class="th w-40">
        Status
      </th>
      <th class="th" colspan="2">
        Created/Paid
      </th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="payment in props.payments" :key="payment.id" class="group border-t" :class="payment.client.deleted ? 'bg-red-50' : 'hover:bg-gray-50'">
      <td class="td">
        {{ payment.id }}
      </td>
      <td class="td" v-if="!props.hideClient">
        <RouterLink :to="{ name: 'clients.detail', params: { id: payment.client.id } }" class="text-sm text-indigo-600" v-if="!payment.client.deleted">
          {{ payment.client.full_name }}
        </RouterLink>
        <div class="text-sm" v-else>
          {{ payment.client.full_name }}
        </div>
        <div class="text-xs text-gray-500 font-italic">
          {{ payment.client.email }}
        </div>
      </td>
      <td class="td">
        <div class="text-sm">
          {{ payment.uuid }}
        </div>
        <div class="text-xs text-gray-500 font-italic">
          {{ payment.description ?? 'Description in not provided' }}
        </div>
      </td>
      <td class="td text-right font-mono">
        ${{ payment.amount }}
      </td>
      <td class="td">
        <div class="badge bg-green-100 text-green-700" v-if="payment.status.key === 'paid'">
          {{ payment.status.label }}
        </div>

        <div class="badge bg-red-100 text-red-700" v-else-if="payment.status.key === 'canceled'">
          {{ payment.status.label }}
        </div>

        <div class="badge bg-indigo-100 text-indigo-700" v-else>
          {{ payment.status.label }}
        </div>
      </td>
      <td class="td w-40">
        <div class="text-xs text-gray-700">
          {{ payment.created_at }} <br>
          <span v-if="payment.paid_at" class="text-green-700">{{ payment.paid_at }}</span>
        </div>
      </td>
      <td class="td whitespace-nowrap w-24">
        <div class="actions" v-if="payment.status.key === 'pending'">
          <button class="button-icon" @click="handlePaid(payment.id)">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 w-5">
              <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
            </svg>
          </button>

          <button class="button-icon" @click="handleCanceled(payment.id)">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
              <path fill-rule="evenodd"
                    d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                    clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </td>
    </tr>
    </tbody>
  </table>

</template>

<style lang="postcss" scoped>
.table {
  @apply w-full bg-white rounded overflow-hidden drop-shadow-xl;
}

.th {
  @apply p-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider;
}

.td {
  @apply p-3 text-sm text-gray-900;
}

.actions {
  @apply flex items-center justify-around opacity-0 group-hover:opacity-100;
}

.badge {
  @apply inline-block text-xs px-3 py-2 leading-none rounded-full font-medium;
}
</style>
