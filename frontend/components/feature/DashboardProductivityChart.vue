<template>
  <v-card>
    <v-card-title>Produtividade</v-card-title>
    <v-card-text>
      <v-row>
        <v-col cols="12" md="6">
          <v-card outlined>
            <v-card-title>Tarefas Concluídas</v-card-title>
            <v-card-text class="text-h4">
              {{ completedTasksCount }} / {{ totalTasksCount }}
            </v-card-text>
          </v-card>
        </v-col>
        <v-col cols="12" md="6">
          <v-card outlined>
            <v-card-title>Taxa de Conclusão</v-card-title>
            <v-card-text class="text-h4">
              {{ completionRate }}%
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>

      <v-row v-if="props.tasks.length > 0" class="mt-4">
        <v-col cols="12">
          <v-card outlined>
            <v-card-title>Distribuição de Tarefas</v-card-title>
            <v-card-text>
              <div class="d-flex align-center">
                <div class="mr-4">
                  <div class="d-flex align-center">
                    <v-icon color="blue" class="mr-2">mdi-circle</v-icon>
                    Pendentes: {{ pendingTasksCount }}
                  </div>
                  <div class="d-flex align-center">
                    <v-icon color="orange" class="mr-2">mdi-circle</v-icon>
                    Em Progresso: {{ inProgressTasksCount }}
                  </div>
                  <div class="d-flex align-center">
                    <v-icon color="green" class="mr-2">mdi-circle</v-icon>
                    Concluídas: {{ completedTasksCount }}
                  </div>
                </div>
              </div>
            </v-card-text>
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
  }
})

const totalTasksCount = computed(() => props.tasks.length)

const pendingTasksCount = computed(() => 
  props.tasks.filter(task => task.status === 'pendente').length
)

const inProgressTasksCount = computed(() => 
  props.tasks.filter(task => task.status === 'em progresso').length
)

const completedTasksCount = computed(() => 
  props.tasks.filter(task => task.status === 'concluída').length
)

const completionRate = computed(() => {
  if (totalTasksCount.value === 0) return 0
  return Math.round((completedTasksCount.value / totalTasksCount.value) * 100)
})
</script>

<style scoped>
.task-status-icon {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  margin-right: 8px;
}
</style>