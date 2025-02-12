<template>
  <v-card>
    <v-card-title>Resumo de Tarefas</v-card-title>
    <v-card-text>
      <v-row v-if="isLoading">
        <v-col cols="12">
          <v-progress-circular 
            indeterminate 
            color="primary"
          ></v-progress-circular>
        </v-col>
      </v-row>
      <v-row v-else>
        <v-col cols="4">
          <v-card outlined>
            <v-card-title class="text-h6">
              {{ pendingTasksCount }}
            </v-card-title>
            <v-card-subtitle>Pendentes</v-card-subtitle>
          </v-card>
        </v-col>
        <v-col cols="4">
          <v-card outlined>
            <v-card-title class="text-h6">
              {{ inProgressTasksCount }}
            </v-card-title>
            <v-card-subtitle>Em Progresso</v-card-subtitle>
          </v-card>
        </v-col>
        <v-col cols="4">
          <v-card outlined>
            <v-card-title class="text-h6">
              {{ completedTasksCount }}
            </v-card-title>
            <v-card-subtitle>Concluídas</v-card-subtitle>
          </v-card>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  tasks: {
    type: Array,
    default: () => []
  },
  isLoading: {
    type: Boolean,
    default: false
  }
})

const pendingTasksCount = computed(() => 
  props.tasks.filter(task => task.status === 'pendente').length
)

const inProgressTasksCount = computed(() => 
  props.tasks.filter(task => task.status === 'em progresso').length
)

const completedTasksCount = computed(() => 
  props.tasks.filter(task => task.status === 'concluída').length
)
</script>