import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import EmployeeTable from './components/EmployeeTable.vue';

const app = createApp({});

app.component('employee-table', EmployeeTable);

app.mount('#app');
