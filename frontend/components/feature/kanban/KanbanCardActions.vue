<template>
<v-card-actions>
    <template v-if="status === 'pendente'">
    <v-btn 
        color="primary" 
        @click="$emit('move-task', task, 'pendente', 'em progresso')"
    >
        Iniciar
    </v-btn>
    </template>
    
    <template v-else-if="status === 'em progresso'">
    <v-btn 
        color="success" 
        @click="$emit('move-task', task, 'em progresso', 'concluída')"
    >
        Concluir
    </v-btn>
    </template>
</v-card-actions>
</template>

<script setup>
const props = defineProps({
task: {
    type: Object,
    required: true
},
status: {
    type: String,
    required: true
}
})

const emit = defineEmits(['move-task'])
</script>
