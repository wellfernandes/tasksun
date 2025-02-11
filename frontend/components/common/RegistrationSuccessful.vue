<template>
  <v-snackbar 
    v-model="localVisible" 
    :timeout="4500"
    location="top"
    color="green"
    text-color="white"
  >
    {{ message }}
    <template #action="{ attrs }">
      <v-btn color="pink" text v-bind="attrs" @click="handleClose">Fechar</v-btn>
    </template>
  </v-snackbar>
</template>

<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
  visible: {
    type: Boolean,
    required: true,
  },
  message: {
    type: String,
    default: 'Cadastro realizado com sucesso.',
  },
});

const emit = defineEmits(['update:visible']);
const localVisible = ref(props.visible);

watch(() => props.visible, (newValue) => {
  localVisible.value = newValue;
});

watch(localVisible, (newValue) => {
  emit('update:visible', newValue);
});

const handleClose = () => {
  localVisible.value = false;
};
</script>