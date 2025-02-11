export default defineNuxtPlugin((nuxtApp) => {
  const authStore = useAuthStore();
  
  if (import.meta.client) {
    const token = localStorage.getItem('token');
    if (token) {
      authStore.token = token;
    }
  }
});