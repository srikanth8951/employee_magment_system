<template>
    <div class="p-5 bg-slate-100">
        <div class="flex flex-col gap-3">
            <InputText v-model="firstName" class="p-2" type="text" placeholder="First Name" />
            <InputText v-model="lastName" class="p-2" type="text" placeholder="Last Name" />
            <InputText v-model="designation" class="p-2" type="text" placeholder="Field of employment" />
        </div>
        <div>
            <div class="flex justify-between items-center">
                <h6 class="my-3 font-bold text-xl">Skills</h6>
                <Button icon="pi pi-plus" class="bg-purple-300 w-9 text-white h-9" @click="addInput"></Button>
            </div>
            <div class="space-y-2">
                <div v-for="(input, index) in skills" :key="index" class="flex justify-start items-center gap-3">
                    <InputText v-model="skills[index]" class="p-2 w-full" type="text" placeholder="Skill" />
                    <Button class="bg-purple-300 w-10 text-white h-10" icon="pi pi-minus"
                        @click="removeInput(index)"></Button>
                </div>
            </div>
        </div>
        <div>
            <div class="flex justify-between items-center">
                <h6 class="my-3 font-bold text-xl">About</h6>
            </div>
            <div class="space-y-2">
                <div class="flex justify-start items-center gap-3">
                    <Textarea class="p-2 w-full" v-model="about" rows="5" cols="30" placeholder="About"></Textarea>
                </div>
            </div>
        </div>
        <div class="my-3 text-center">

            <Button @click="back('home')"
                class="px-3 py-2 bg-purple-300 text-white mx-1">Back</Button>
            <Button @click="type === 'Edit' ? updateData() : addData()" class="px-3 py-2 bg-purple-300 text-white">{{
                type }} Employee</Button>
        </div>
    </div>
</template>

<script setup>
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Button from 'primevue/button';
import { useEmployeeStore } from '@/stores/store';
import { useToast } from "primevue/usetoast";
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const { employeeData, type } = defineProps(['employeeData', 'type']);
const skills = ref(employeeData.skills || []);
const firstName = ref(employeeData.first_name || '');
const lastName = ref(employeeData.last_name || '');
const designation = ref(employeeData.field_of_employment || '');
const about = ref(employeeData.about || '');
const store = useEmployeeStore();
const router = useRouter();
const toast = useToast();

const addInput = () => skills.value.push('');
const removeInput = async (index) => {
    // If it's an update operation, delete the skill from the server
    if (type === 'Edit') {
        const skillId = employeeData.skillIds[index];
        // console.log(employeeData.skillIds[index]);
        const deleted = await store.deleteSkill(employeeData.id, skillId);
        if (deleted) {
            // On successful deletion, remove the skill from the local array
            skills.value.splice(index, 1);
        }
    } else {
        // If it's an add operation, simply remove the skill from the local array
        skills.value.splice(index, 1);
    }
};
const addData = async () => {
    const formData = {
        firstName: firstName.value,
        lastName: lastName.value,
        fieldOfEmployment: designation.value,
        skills: skills.value,
        about: about.value,
        status: true
    };
    await store.addEmployee(formData);
    toast.add({ severity: 'info', summary: 'Confirmed', detail: 'Record added successfully', life: 3000 });
    router.push({ name: 'home' });
};
const updateData = async () => {
    const formData = {
        id: employeeData.id,
        firstName: firstName.value,
        lastName: lastName.value,
        fieldOfEmployment: designation.value,
        skills: skills.value,
        about: about.value,
        status: employeeData.status
    };
    await store.updateEmployee(formData);
    toast.add({ severity: 'info', summary: 'Confirmed', detail: 'Record updated successfully', life: 3000 });
    router.push({ name: 'home' });
};
const back = (route) => {
    router.push({ name: route });
};
</script>