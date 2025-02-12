<template>
  <v-card class="login-card" elevation="2">
    <v-card-title class="text-h5">Login</v-card-title>
    <v-card-text>
      <v-form @submit.prevent="handleSubmit">
        <v-text-field
          v-model="username"
          label="Email"
          required
          placeholder="Digite seu email de cadastro."
        />
        <v-text-field
          v-model="password"
          label="Senha"
          type="password"
          required
          placeholder="Digite sua senha"
        />
        <v-btn type="submit" color="primary" class="mt-4">Entrar</v-btn>
      </v-form>
    </v-card-text>
  </v-card>

  <LoginError
    :visible="loginError"
    :message="errorMessage"
    @update:visible="loginError = $event"
  />
</template>

<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/stores/auth';
import LoginError from '@/components/common/LoginError.vue';

const username = ref('');
const password = ref('');
const authStore = useAuthStore();
const loginError = ref(false);
const errorMessage = ref('');

const handleSubmit = async () => {
  try {
    const response = await useNuxtApp().$axios.post('/login', {
      email: username.value,
      password: password.value,
    });

    console.log('Login bem-sucedido:', response.data);
    authStore.login(response.data.user, response.data.token);
    navigateTo('/dashboard')
  } catch (error) {
    console.error('Erro ao fazer login:', error);
    errorMessage.value = 'Erro ao fazer login. Por favor, verifique suas credenciais.';
    loginError.value = true;
  }
};

onMounted(() => {
  authStore.init();
  if (authStore.isAuthenticated) {
    navigateTo('/dashboard');
  }
});

</script>

<style scoped>
.login-card {
  max-width: auto;
  width: 50%;
  margin: 0 auto;
  padding: 20px;
}
</style>