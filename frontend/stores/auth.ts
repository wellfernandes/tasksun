import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null as any,
    token: null as string | null
  }),
  
  getters: {
    isAuthenticated(): boolean {
      return !!this.token
    }
  },
  
  actions: {
    login(userData: any, token: string) {
      this.user = userData
      this.token = token
    },
    
    logout() {
      this.user = null
      this.token = null
    }
  }
})