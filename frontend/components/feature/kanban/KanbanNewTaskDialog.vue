<template>
<v-dialog 
    :model-value="modelValue" 
    @update:model-value="$emit('update:modelValue', $event)"
    max-width="500"
>
    <v-card>
    <v-card-title>Nova Tarefa</v-card-title>
    <v-card-text>
        <v-text-field 
        v-model="newTask.title" 
        label="Título da Tarefa"
        />
        <v-textarea 
        v-model="newTask.description" 
        label="Descrição"
        />
    </v-card-text>
    <v-card-actions>
        <v-btn @click="createTask">Criar Tarefa</v-btn>
        <v-btn @click="$emit('update:modelValue', false)">Cancelar</v-btn>
    </v-card-actions>
    </v-card>
</v-dialog>
</template>

<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
modelValue: Boolean
})

const emit = defineEmits(['update:modelValue', 'create-task'])

const newTask = ref({
title: '',
description: ''
})

const createTask = () => {
if (newTask.value.title) {
    emit('create-task', newTask.value)
    emit('update:modelValue', false)
    newTask.value = { title: '', description: '' }
}
}

watch(() => props.modelValue, (newValue) => {
if (!newValue) {
    newTask.value = { title: '', description: '' }
}
})
</script>  