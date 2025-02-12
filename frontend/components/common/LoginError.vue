<template>
<v-snackbar 
    v-model="localVisible" 
    :timeout="4500"
    location="top"
    color="error"
    text-color="white"
>
    {{ message }}
    <template #action="{ attrs }">
    <v-btn color="white" text v-bind="attrs" @click="handleClose">Fechar</v-btn>
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
    default: 'Erro ao fazer login. Por favor, verifique suas credenciais.',
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