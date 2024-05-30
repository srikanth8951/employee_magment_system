<template>
    <FormComponent :employeeData="employeeData" type="Edit"></FormComponent>
</template>
    
<script setup>
import FormComponent from '@/components/FormComponent.vue';
import { useEmployeeStore } from '@/stores/store';
import { useRoute } from 'vue-router';
const stote = useEmployeeStore();
const route = useRoute();
const employeeID = Number(route.params.id);
const employeeData = stote.getEmployeeById(employeeID)
</script>
    