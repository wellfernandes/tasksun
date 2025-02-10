<!-- components/layout/LoginLayout.vue -->
<template>
  <div class="login-container">
    <div class="logo-container">
      <Logo />
    </div>
    <div class="form-container">
      <LoginForm />
    </div>
  </div>
</template>

<script setup>
  import Logo from '@/components/common/Logo.vue';
  import LoginForm from '@/components/feature/LoginForm.vue';
</script>

<style scoped>
.login-container {
  display: flex;
  height: 100vh;
}

.logo-container {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: flex-start;
}

.form-container {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
}
</style>
