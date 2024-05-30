<template>
    <div class="card text-black my-4 px-4">
        <Card>
            <template #title>
                <div class="flex justify-between">
                    <p>{{ title ? title : 'Loading...' }}</p>
                    <div v-if="status !== null && status !== undefined">
                        <ToggleButton @change="updateStatus(employeeId)"
                            :class="{ 'bg-green-600': checked, 'bg-red-600': !checked }" onLabel=" " offLabel=" "
                            v-model="checked">
                        </ToggleButton>
                    </div>
                </div>
            </template>
            <template #content>
                <p class="m-0" v-if="content && !Array.isArray(content)">
                    {{ content }}
                </p>
                <div class="m-0" v-else-if="content && Array.isArray(content)">
                    <ul v-for="(skill, index) in content" :key="index">
                        <li>{{ skill }}</li>
                    </ul>
                </div>
                <p class="m-0" v-else>
                    Loading employee details...
                </p>
            </template>
        </Card>
    </div>
</template>

<script setup>
import Card from 'primevue/card';
import { defineProps, ref, watch } from 'vue';
import ToggleButton from 'primevue/togglebutton';
import { useEmployeeStore } from '@/stores/store';

const props = defineProps(['title', 'content', 'status', 'employeeId']);

const checked = ref(props.status === 1);

const store = useEmployeeStore();

const updateStatus = (employeeId) => {
    store.updateEmployeeStatus(employeeId, checked.value);
};

// Watch for changes in props.status and update checked value
watch(
    () => props.status,
    (newStatus) => {
        checked.value = newStatus === 1;
    },
    { immediate: true }
);
</script>
