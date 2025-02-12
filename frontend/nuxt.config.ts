// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-11-01',
  devtools: { enabled: true },
  
  // Adicione CSS do Vuetify
  css: [
    'vuetify/lib/styles/main.css',
    '@mdi/font/css/materialdesignicons.css',
    '~/assets/styles/main.css'
  ],
  
  // Configurações de build
  build: {
    transpile: ['vuetify']
  },

  // Adicione Pinia
  modules: [
    '@pinia/nuxt'
  ],
  
  // Plugins
  plugins: [
    '~/plugins/vuetify.js'
  ],
  
  // Configurações do Vite
  vite: {
    define: {
      'process.env.DEBUG': false,
    },
  },
})