<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" class="d-flex">
        <KanbanColumn
          title="Tarefas Pendentes"
          :tasks="pendingTasks"
          status="pendente"
          color="blue-lighten-4"
          @add-task="openNewTaskDialog"
          @move-task="moveTask"
          @delete-task="deleteTask"
        />
        
        <KanbanColumn
          title="Tarefas em Progresso"
          :tasks="progressTasks"
          status="em progresso"
          color="orange-lighten-4"
          @move-task="moveTask"
          @delete-task="deleteTask"
        />
        
        <KanbanColumn
          title="Tarefas Concluídas"
          :tasks="completedTasks"
          status="concluída"
          color="green-lighten-4"
          @delete-task="deleteTask"
        />
      </v-col>
    </v-row>

    <KanbanNewTaskDialog
      v-model="newTaskDialog"
      @create-task="createTask"
    />
  </v-container>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { useNuxtApp } from 'nuxt/app';
import { useAuthStore } from '@/stores/auth';

import KanbanColumn from './KanbanColumn.vue';
import KanbanNewTaskDialog from './KanbanNewTaskDialog.vue';

const emit = defineEmits(['tasks-updated']);
const authStore = useAuthStore();
const { $taskService } = useNuxtApp();

const pendingTasks = ref([]);
const progressTasks = ref([]);
const completedTasks = ref([]);
const newTaskDialog = ref(false);

const userId = computed(() => authStore.getUserId);

const openNewTaskDialog = () => {
  newTaskDialog.value = true;
};

const fetchTasks = async () => {
  const currentUserId = userId.value;

  try {
    const tasks = await $taskService.fetchUserTasks(currentUserId);

    pendingTasks.value = [];
    progressTasks.value = [];
    completedTasks.value = [];

    tasks.forEach(task => {
      switch(task.status) {
        case 'pendente':
          pendingTasks.value.push(task);
          break;
        case 'em progresso':
          progressTasks.value.push(task);
          break;
        case 'concluída':
          completedTasks.value.push(task);
          break;
      }
    });

    emitUpdatedTasks();
  } catch (error) {
    console.error('Erro ao buscar tarefas:', error);
  }
};

const createTask = async (taskData) => {
  try {
    const newTask = await $taskService.createTask({
      title: taskData.title,
      description: taskData.description,
      status: 'pendente',
      user_id: userId.value
    });

    pendingTasks.value.push(newTask);
    
    emitUpdatedTasks();
    
    newTaskDialog.value = false;
  } catch (error) {
    console.error('Erro ao criar tarefa:', error);
  }
};

const moveTask = async (task, fromStatus) => {
  let toStatus = '';
  
  switch(fromStatus) {
    case 'pendente':
      toStatus = 'em progresso';
      break;
    case 'em progresso':
      toStatus = 'concluída';
      break;
    default:
      return;
  }

  try {
    const updatedTask = await $taskService.updateTask(task.id, { 
      status: toStatus 
    });

    let sourceArray = getArrayByStatus(fromStatus);
    let targetArray = getArrayByStatus(toStatus);

    const index = sourceArray.findIndex(t => t.id === task.id);
    if (index !== -1) {
      sourceArray.splice(index, 1);
      targetArray.push(updatedTask);

      emitUpdatedTasks();
    }
  } catch (error) {
    console.error('Erro ao mover tarefa:', error);
  }
};

const emitUpdatedTasks = () => {
  const allTasks = [
    ...pendingTasks.value, 
    ...progressTasks.value, 
    ...completedTasks.value
  ];
  emit('tasks-updated', allTasks);
};

const getArrayByStatus = (status) => {
  switch (status) {
    case 'pendente': return pendingTasks.value;
    case 'em progresso': return progressTasks.value;
    case 'concluída': return completedTasks.value;
    default: return [];
  }
};

const deleteTask = async (task) => {
  try {
    await $taskService.deleteTask(task.id);

    const taskList = getArrayByStatus(task.status);
    const index = taskList.findIndex(t => t.id === task.id);
    if (index !== -1) {
      taskList.splice(index, 1);
    }

    emitUpdatedTasks();
  } catch (error) {
    console.error('Erro ao excluir tarefa:', error);
  }
};

onMounted(() => {
  if (userId.value) {
    fetchTasks();
  }
});
</script>