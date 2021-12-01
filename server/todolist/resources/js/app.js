require('./bootstrap');

import { createApp } from 'vue'
import TodoListComponent from './components/TodoListComponent.vue'

createApp({
    components: {
        'v-todo-list': TodoListComponent
    }
}).mount('#app')
