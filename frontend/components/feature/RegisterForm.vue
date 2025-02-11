<template>
  <div class="container">
    <v-card class="register-card" elevation="2">
      <v-card-title class="text-h5">Cadastro</v-card-title>
      <v-card-text>
        <v-form @submit.prevent="handleSubmit">
          <v-text-field
            v-model="username"
            label="Nome de Cadastro"
            required
            placeholder="Digite seu nome."
          />
          <v-text-field
            v-model="email"
            label="Email"
            required
            placeholder="Digite seu email para cadastro."
          />
          <v-text-field
            v-model="password"
            label="Senha"
            type="password"
            required
            placeholder="Digite sua senha"
          />
          <v-text-field
            v-model="password_confirmation"
            label="Repita a senha"
            type="password"
            required
            placeholder="Digite sua senha"
          />
          <v-btn type="submit" color="primary" class="mt-4">Entrar</v-btn>
        </v-form>
      </v-card-text>
    </v-card>

  </div>
  <RegistrationSuccessful
      :visible="snackbar"
      @update:visible="snackbar = $event"
    />
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useAuthStore } from '@/stores/auth';
import RegistrationSuccessful from '@/components/common/RegistrationSuccessful.vue';

const username = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');
const authStore = useAuthStore();
const snackbar = ref(false);

const handleSubmit = async () => {
  try {
    const response = await useNuxtApp().$axios.post('/register', {
      name: username.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value,
    });

    console.log('Response: ', response)

    snackbar.value = true;
    console.log('Cadastro bem-sucedido:', response.data);
    authStore.login(response.data.user, response.data.token);

    await nextTick();
    setTimeout(() => {
      navigateTo('/login');
    }, 5000);
    
  } catch (error) {
    console.error('Erro ao fazer cadastro:', error);
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
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.register-card {
  width: 50%;
  padding: 20px;
}
</style>
