import {computed, ref} from "vue";
import {defineStore} from "pinia";
import axios from "axios";
import {toast} from "vue3-toastify";

export const useAuthStore = defineStore("auth", () => {
  const user = ref(localStorage.getItem("user") ? JSON.parse(localStorage.getItem("user")) : null);

  const isLoggedIn = computed(() => user.value?.token);

  const login = (email, password) => {
    return new Promise((resolve, reject) => {
      axios
        .post(`/api/auth/login`, {
          email, password,
        })
        .then(({data}) => {
          user.value = data;
          localStorage.setItem("user", JSON.stringify(user.value));

          resolve(true);
        }).catch((error) => {
          toast.error(error.response.data.message);

          reject(false);
      });
    });
  };

  const token = computed(() => user.value?.token);

  const logout = () => {
    return new Promise((resolve, reject) => {
      axios.post(`/api/auth/logout`).then(() => {
        user.value = null;
        localStorage.removeItem("user");

        resolve(true);
      }).catch((error) => {
        toast.error(error.response.data.message);

        reject(false);
      });
    });
  };

  return {
    isLoggedIn, token, login, logout,
  };
});
