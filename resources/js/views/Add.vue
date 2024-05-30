<template>
  <FormComponent :employeeData="employeeData" type="Add"></FormComponent>
</template>
  
<script setup>
import FormComponent from '@/components/FormComponent.vue';

const employeeData = {
  firstName: "",
  lastName: "",
  fieldOfEmployment: "",
  skills: [''],
  about: "",
}
</script>
  