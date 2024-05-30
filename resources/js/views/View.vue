<template>
    <div>
        <Card :title="`${employee?.first_name} ${employee?.last_name}`" :content="employee?.field_of_employment" :employeeId="employee?.id" :status="employee?.available"></Card>
        <Card title="Skills:" :content="employee?.skills"></Card>
        <Card title="About:" :content="employee?.about"></Card>
        <div class="flex justify-between p-4">
            <router-link :to="{ name: 'edit', params: { id: employee?.id } }"><Button class="bg-purple-400 text-xl flex justify-center px-4 py-3 text-white rounded-lg">Edit</Button></router-link>
            <Button @click="deleteEmployee(employee?.id)" label="Delete" class="bg-purple-400 text-xl flex justify-center px-4 py-3 text-white rounded-lg"></Button>
        </div>
    </div>
</template>

<script setup>
import { watchEffect, ref } from 'vue';
import { useEmployeeStore } from '../stores/store';
import { useRoute, useRouter } from 'vue-router';
import Card from '@/components/Card.vue';
import Button from 'primevue/button';



const route = useRoute(); // Access the route object
const router = useRouter(); // Access the route object
const store = useEmployeeStore();

// Use a ref to store the employee data
const employee = ref({});
const deleteEmployee = async (employeeID) => {
    await store.deleteByEmployeeId(employeeID)
    router.push({ name: 'home' })
}
// Watch for changes in route.params.id and update the ref value
watchEffect(() => {
    const id = Number(route.params.id);
    employee.value = store.getEmployeeById(id);
});
</script>