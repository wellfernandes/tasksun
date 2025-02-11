import { defineStore } from 'pinia';
import { useCookie } from 'nuxt/app';

interface User {
  id: string;
  name: string;
  email: string;
}

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null as User | null,
    token: null as string | null,
  }),
  
  getters: {
    isAuthenticated(): boolean {
      return !!this.token;
    },
  },
  
  actions: {
    init() {
      const token = useCookie('auth_token').value;
      if (token) {
        this.token = token;
      }
    },
    
    login(userData: User, token: string) {
      this.user = userData;
      this.token = token;

      const authCookie = useCookie('auth_token', {
        maxAge: 30 * 24 * 60 * 60,
        path: '/'
      });
      authCookie.value = token;
    },
    
    logout() {
      this.user = null;
      this.token = null;
      
      const authCookie = useCookie('auth_token');
      authCookie.value = null;
    },
  },
});