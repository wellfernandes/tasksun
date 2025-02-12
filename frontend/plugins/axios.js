import axios from 'axios';

export default defineNuxtPlugin((nuxtApp) => {
  const apiClient = axios.create({
    baseURL: 'http://localhost/api/v1',
    timeout: 10000,
    headers: {
      'Content-Type': 'application/json',
    },
  });

  apiClient.interceptors.request.use((config) => {
    const authStore = useAuthStore();
    
    if (authStore.token) {
      config.headers['Authorization'] = `Bearer ${authStore.token}`;
    }
    return config;
  }, (error) => {
    return Promise.reject(error);
  });

  apiClient.interceptors.response.use(
    (response) => response,
    (error) => {
      const authStore = useAuthStore();

      if (error.response?.status === 401) {
        authStore.logout();
        navigateTo('/login');
      }

      return Promise.reject(error);
    }
  );

  const taskService = {
    async fetchUserTasks(userId) {
      try {
        const response = await apiClient.get(`/tasks/user/${userId}`);
        return response.data;
      } catch (error) {
        console.error('Erro ao buscar tarefas', error);
        throw error;
      }
    },

    async createTask(task) {
      try {
        const response = await apiClient.post('/tasks', task);
        return response.data;
      } catch (error) {
        console.error('Erro ao criar tarefa', error);
        throw error;
      }
    },

    async updateTask(taskId, updates) {
      try {
        const response = await apiClient.patch(`/tasks/${taskId}`, updates);
        return response.data;
      } catch (error) {
        console.error('Erro ao atualizar tarefa', error);
        throw error;
      }
    },

    async deleteTask(taskId) {
      try {
        await apiClient.delete(`/tasks/${taskId}`);
      } catch (error) {
        console.error('Erro ao deletar tarefa', error);
        throw error;
      }
    }
  };

  nuxtApp.provide('axios', apiClient);
  nuxtApp.provide('taskService', taskService);
});