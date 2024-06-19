<template>
    <div>

        <Card :title="`${employee?.first_name} ${employee?.last_name}`" :content="employee?.field_of_employment"
            :employeeId="employee?.id" :status="employee?.available"></Card>
        <Card title="Skills:" :content="employee?.skills"></Card>
        <Card title="About:" :content="employee?.about"></Card>
        <div class="flex justify-between p-4">
            <router-link :to="{ name: 'home' }">
                <Button class="bg-purple-400 text-xl flex justify-center px-4 py-3 text-white rounded-lg">Back</Button>
            </router-link>
            <div class="flex gap-1">
                <router-link :to="{ name: 'edit', params: { id: employee?.id } }">
                    <Button
                        class="bg-purple-400 text-xl flex justify-center px-4 py-3 text-white rounded-lg">Edit</Button>
                </router-link>
                <Button @click="handleDeleteClick" label="Delete"
                    class="bg-purple-400 text-xl flex justify-center px-4 py-3 text-white rounded-lg"></Button>
            </div>

        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useEmployeeStore } from '../stores/store';
import { useRouter } from 'vue-router';
import Card from '@/components/Card.vue';
import Button from 'primevue/button';
import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";

const confirm = useConfirm();
const toast = useToast();

const router = useRouter();
const store = useEmployeeStore();

const employee = ref({});

const handleDeleteClick = () => {
    confirm.require({
        message: 'Do you want to delete this record?',
        header: 'Confirmation',
        icon: 'pi pi-info-circle',
        rejectLabel: 'Cancel',
        rejectProps: {
            label: 'Cancel',
            severity: 'secondary',
            outlined: true
        },
        acceptProps: {
            label: 'Delete',
            severity: 'danger'
        },
        accept: async () => {
            await store.deleteByEmployeeId(employee.value.id);
            toast.add({ severity: 'info', summary: 'Confirmed', detail: 'Record deleted', life: 3000 });
            router.push({ name: 'home' });
        },
        reject: () => {
            toast.add({ severity: 'error', summary: 'Rejected', detail: 'You have rejected', life: 3000 });
        }
    });
};

const fetchEmployeeData = async () => {
    const id = Number(router.currentRoute.value.params.id);
    employee.value = await store.getEmployeeById(id);
};

// Fetch employee data before component is created
fetchEmployeeData();
</script>
