import { useAuthStore } from '~/stores/auth'

export default defineNuxtRouteMiddleware((to, from) => {
  const authStore = useAuthStore();
  const publicRoutes = ['/login', '/register'];

  const token = typeof window !== 'undefined' ? localStorage.getItem('token') : null;

  if (token) {
    authStore.token = token;
  }

  if (authStore.isAuthenticated) {
    if (to.path === '/login') {
      return navigateTo('/dashboard');
    }
  } else {
    if (!publicRoutes.includes(to.path)) {
      return navigateTo('/login');
    }
  }
});