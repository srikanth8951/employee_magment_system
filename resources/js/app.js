import './bootstrap';
import './assets/main.css'
import { createApp } from 'vue'
import { createPinia } from 'pinia'


import App from './App.vue'
import router from './router'
import ToastService from 'primevue/toastservice';
import ConfirmationService from 'primevue/confirmationservice';
import PrimeVue from 'primevue/config';
import 'primeicons/primeicons.css'

//in main.js
import 'primevue/resources/themes/lara-light-green/theme.css'


const app = createApp(App)
app.use(PrimeVue);
app.use(createPinia())
app.use(router)
app.use(ToastService);
app.use(ConfirmationService);
app.mount('#app');