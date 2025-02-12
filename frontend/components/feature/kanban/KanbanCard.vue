<template>
<v-card class="mb-2 task-card">
    <v-card-title class="text-subtitle-2">
    {{ task.title }}
    </v-card-title>
    
    <v-card-text>
    {{ task.description }}
    </v-card-text>
    
    <v-card-actions>
    <v-btn 
        color="primary" 
        @click="moveToNextStatus"
    >
        Mover
    </v-btn>
    </v-card-actions>

    <v-card-actions>
    <v-btn 
        color="primary" 
        @click="deleteTask"
    >
        Excluir
    </v-btn>
    </v-card-actions>
</v-card>
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

const emit = defineEmits(['move-task', 'delete-task'])
const moveToNextStatus = () => {

let nextStatus = '';

switch(props.status) {
    case 'pendente':
    nextStatus = 'em progresso';
    break;
    case 'em progresso':
    nextStatus = 'concluída';
    break;
    default:
    return;
}

emit('move-task', props.task);
}

const deleteTask = () => {
  emit('delete-task', props.task);
}
</script>

<style scoped>
.task-card {
    margin-bottom: 8px;
    transition: all 0.3s ease;
}
</style>