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
    getUserId(): string | null {
      return this.user ? this.user.id : null;
    },
  },
  
  actions: {
    init() {
      const token = useCookie('auth_token').value;
      if (token) {
        this.token = token;
      }

      const storedUser = localStorage.getItem('auth_user');
      if (storedUser) {
        try {
          this.user = JSON.parse(storedUser);
        } catch (error) {
          console.error('Erro ao recuperar dados armazenados:', error);
        }
      }
    },
    
    login(userData: User, token: string) {
      this.user = userData;
      this.token = token;

      localStorage.setItem('auth_user', JSON.stringify(userData));

      const authCookie = useCookie('auth_token', {
        maxAge: 30 * 24 * 60 * 60,
        path: '/'
      });
      authCookie.value = token;
    },
    
    logout() {
      this.user = null;
      this.token = null;

      localStorage.removeItem('auth_user');

      const authCookie = useCookie('auth_token');
      authCookie.value = null;
    },
  },
});