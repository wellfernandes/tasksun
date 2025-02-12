<template>
  <v-card class="mx-2 flex-grow-1" width="300" elevation="2">
    <v-card-title :class="`bg-${color}`">
      {{ title }}
    </v-card-title>

    <v-card-text class="pa-0">
      <v-list>
        <KanbanCard
          v-for="task in tasks"
          :key="task.id"
          :task="task"
          :status="status"
          @move-task="(task) => $emit('move-task', task, status)"
          @delete-task="$emit('delete-task', $event)"
        />
      </v-list>
    </v-card-text>

    <v-card-actions v-if="status === 'pendente'">
      <v-btn 
        block 
        color="primary" 
        @click="$emit('add-task')"
      >
        Nova Tarefa
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script setup>
import KanbanCard from './KanbanCard.vue';

const props = defineProps({
  title: {
    type: String,
    required: true
  },
  tasks: {
    type: Array,
    default: () => []
  },
  status: {
    type: String,
    validator: (value) => ['pendente', 'em progresso', 'concluída'].includes(value)
  },
  color: {
    type: String,
    default: 'primary'
  }
});

const emit = defineEmits(['add-task', 'move-task', 'delete-task']);
</script>

<style scoped>
.bg-blue-lighten-4 {
background-color: #e3f2fd;
}

.bg-orange-lighten-4 {
background-color: #fff3e0;
}

.bg-green-lighten-4 {
background-color: #e8f5e9;
}
</style>