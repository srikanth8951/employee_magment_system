<template>
    <div>
        <div class="card">
            <DataView :value="employees">
                <template #list="slotProps">
                    <div v-for="(item, index) in slotProps.items" :key="index" class="w-full p-3">
                        <div class="flex flex-col xl:flex-row xl:items-start p-4 gap-4 border-2 rounded-lg"
                            :class="{ 'border-green-500': item.available, 'border-red-500': !item.available }">
                            <div class="flex flex-col sm:flex-row justify-between items-center flex-1 gap-4">
                                <div class="flex flex-col items-center sm:items-start gap-3">
                                    <div class="text-2xl font-bold text-surface-900 dark:text-surface-0">{{
                item.first_name }} {{ item.last_name }}</div>
                                    <div class="flex items-center gap-3">
                                        <span class="flex flex-col gap-2">
                                            <span class="font-semibold text-center md:text-start">{{
                item.field_of_employment }}</span>
                                            <span class="text-center md:text-start">{{ (item.about).substring(0, 50)
                                                }}{{ item.about.length > 50 ? '...' : '' }}</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="font-bold text-xl flex justify-center items-center">
                                    <router-link :to="{ name: 'view', params: { id: item.id } }"><Button
                                            icon="pi pi-eye"></Button></router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </DataView>
            <div class="px-3">
                <router-link :to="{ name: 'add' }">
                    <Button
                        class="bg-purple-400 w-full text-xl flex justify-center py-3 text-white rounded-lg">Add</Button>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onMounted } from "vue";
import { useEmployeeStore } from "@/stores/store";
import DataView from 'primevue/dataview';
import Button from 'primevue/button';

const store = useEmployeeStore();

// Fetch employees on component mount
onMounted(() => {
    store.fetchEmployees();
});

// Use a computed property to watch the store data
const employees = computed(() => store.employees);
</script>
