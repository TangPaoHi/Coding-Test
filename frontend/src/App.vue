<script setup>
import {ref,onMounted} from 'vue'
import axios from 'axios'

const API_URL = 'http://127.0.0.1:8000/api/items'
const items = ref([])
const name = ref('')

const isLoading = ref(false)
const errorMessage = ref('')

const getItem = async () => {
  try{
    const res = await axios.get(API_URL)
    items.value = res.data
  } catch(e){
    errorMessage.value = "Failed to connect to backend.Please ensure'php artisan serve'is running."
    console.error(e)
  } finally {
    isLoading.value = false
  }
}

const addItem = async () => {
  if(!name.value.trim()) {
    errorMessage.value = "Input Cannot Be Empty!"
    return
  }
  errorMessage.value = "";
  isLoading.value = true ; 
  try {
    const res = await axios.post(API_URL,{name:name.value})
    items.value.unshift(res.data)
    name.value = ''
  } catch (e) {
   errorMessage.value = "Failed to add Item."
  } finally {
    isLoading.value = false ;
  }
}

const deleteItem = async (id) =>  {
  try{
    await axios .delete(`${API_URL}/${id}`)
    items.value = items.value.filter (i => i.id !== id)
  } catch (e) {
     errorMessage.value = "Delete Failed!"
  }
}

onMounted(getItem)
</script>

<template>
  <div style="max-width: 500px; margin: 50px auto; font-family: sans-serif; padding: 20px; border: 1px solid #eee; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <h2 style="color: #42b883; text-align: center;">Task Manager</h2>
    
    <div v-if="errorMessage" style="background: #fff1f0; color: #ff4d4f; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #ffccc7; font-size: 14px;">
      {{ errorMessage }}
    </div>
    
    <div style="display: flex; gap: 10px; margin-bottom: 20px;">
      <input 
        v-model="name" 
        @keyup.enter="addItem" 
        placeholder="What needs to be done?" 
        style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
        :disabled="isLoading" 
      >
      <button 
        @click="addItem" 
        style="padding: 10px 20px; background-color: #42b883; color: white; border: none; border-radius: 4px; cursor: pointer;"
        :disabled="isLoading"
      >
        {{ isLoading ? 'Adding...' : 'Add' }}
      </button>
    </div>

    <div v-if="isLoading" style="text-align: center; color: #666; padding: 20px;">
      Loading tasks...
    </div>

    <ul v-else style="list-style: none; padding: 0;">
      <li v-for="item in items" :key="item.id" style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f5f5f5;">
        <span>{{ item.name }}</span>
        <button @click="deleteItem(item.id)" style="color: #ff4444; border: none; background: none; cursor: pointer;">Delete</button>
      </li>
    </ul>
    
    <p v-if="!isLoading && items.length === 0" style="text-align: center; color: #999;">No tasks yet. Add one above!</p>
  </div>
</template>


<style >
body { background-color: #f9f9f9; }
</style>
