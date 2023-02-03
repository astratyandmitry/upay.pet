import {createApp} from "vue";
import App from "./App.vue";
import router from "./router";
import Vue3Toastify from 'vue3-toastify';
import axios from "axios";

import '../css/app.css';
import 'vue3-toastify/dist/index.css';

axios.defaults.baseURL = import.meta.env.VITE_API_URL;

const app = createApp(App)

app.use(router);
app.use(Vue3Toastify, {
  autoClose: 3000,
});

app.mount('#app');
