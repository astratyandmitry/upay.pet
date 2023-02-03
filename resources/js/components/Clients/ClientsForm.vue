<script setup>
import {toast} from "vue3-toastify";
import {useRouter} from "vue-router";
import axios from "axios";
import {onMounted, ref} from "vue";

const router = useRouter();
const updating = router.currentRoute.value.params.id;

const form = ref({
  full_name: '',
  email: '',
  phone: '',
})

onMounted(() => {
  if (updating) {
    axios.get(`/api/clients/${router.currentRoute.value.params.id}`)
      .then(response => {
        form.value = response.data.data
      })
  }
})

const emailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

const handleSubmit = () => {
  if (form.value.full_name.trim() === '' || form.value.email.trim() === '' || form.value.phone.trim() === '') {
    toast.error('Please fill all the fields')
  } else if (!emailRegex.test(form.value.email)) {
    toast.error('Please enter a valid email address')
  } else {
    if (updating) {
      axios.put(`/api/clients/${router.currentRoute.value.params.id}`, form.value)
        .then(({data}) => {
          toast.success(data.message)
          router.push({name: 'clients.detail', params: {id: data.client.id}})
        })
    } else {
      axios.post('/api/clients', form.value)
        .then(({data}) => {
          toast.success(data.message)
          router.push({name: 'clients.detail', params: {id: data.client.id}})
        })
    }
  }
}
</script>

<template>
  <div class="form">
    <div class="field">
      <label for="full_name" class="label">Name <strong>*</strong></label>
      <input type="text" id="full_name" placeholder="Full Name" class="input" v-model="form.full_name" required>
    </div>

    <div class="field">
      <label for="phone" class="label">Phone <strong>*</strong></label>
      <input type="text" id="phone" placeholder="Phone Number" class="input" v-model="form.phone" required>
    </div>

    <div class="field">
      <label for="email" class="label">E-mail <strong>*</strong></label>
      <input type="email" id="email" placeholder="E-mail" class="input" v-model="form.email" required>
    </div>

    <div class="flex justify-end">
      <button class="button" @click="handleSubmit">
        {{ updating ? 'Update Client' : 'Store Client' }}
      </button>
    </div>
  </div>
</template>
