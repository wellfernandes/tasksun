<template>
  <v-container fluid>
    <v-row>

      <v-col cols="12">
        <v-card>
          <v-card-title class="d-flex justify-space-between align-center">
            <span>Olá, {{ userName }}</span>
            <v-btn class="logout-button" @click="logout">
              <v-icon>mdi-logout</v-icon>
              Sair
            </v-btn>
          </v-card-title>
        </v-card>
      </v-col>

      <v-col cols="12" md="4">
        <DashboardQuickStats
          :tasks="allTasks" 
        />
      </v-col>

      <v-col cols="12" md="8">
        <DashboardProductivityChart 
          :tasks="allTasks"
        />
      </v-col>

      <v-col cols="12">
        <KanbanBoard 
          @tasks-updated="updateTasks"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'
import { useNuxtApp } from 'nuxt/app'
import DashboardQuickStats from '@/components/feature/DashboardQuickStats.vue'
import DashboardProductivityChart from '@/components/feature/DashboardProductivityChart.vue'
import KanbanBoard from '@/components/feature/kanban/KanbanBoard.vue'

const authStore = useAuthStore()
const router = useRouter()
const { $taskService } = useNuxtApp()
const userName = ref(authStore.user?.name || 'Usuário')
const allTasks = ref([])

const fetchTasks = async () => {
  const userId = authStore.getUserId
  
  if (!userId) {
    console.error('User ID is undefined. Cannot fetch tasks.')
    return
  }

  try {
    const tasks = await $taskService.fetchUserTasks(userId)
    allTasks.value = tasks
  } catch (error) {
    console.error('Erro ao buscar tarefas:', error)
  }
}

const updateTasks = (updatedTasks) => {
  allTasks.value = updatedTasks
}

const logout = () => {
  authStore.logout()
  router.push('/login')
}

onMounted(() => {
  if (!authStore.isAuthenticated) {
    router.push('/login')
    return
  }
  
  fetchTasks()
})
</script>