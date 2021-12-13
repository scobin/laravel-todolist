<template>
    <div class="pt-5">
        <h2><i class="bi bi-list-task pe-1"></i>My Todo List Component</h2>
        <div class="row p-4">
            <input class="col" type="text" v-model="newTodo.body" placeholder="Enter new task">
            <button class="col-auto btn btn-primary mx-1" @click="addTodo">+</button>
        </div>
        <transition-group name="list" tag="ul" class="list-group">
            <li v-for="(todo, index) in todos" :key="todo"
                class="list-group-item d-flex align-items-center">
                <div class="form-check m-auto">
                    <input class="form-check-input"
                    type="checkbox"
                    :id="`todo-${index}`"
                    :checked="todo.completed"
                    @change="completed(todo)">
                </div>
                <label :for="`todo-${index}`" class="flex-fill">
                    <span :class="[todo.completed ? 'line-through' : '']" >{{ todo.body }}</span>
                </label>
                <div>
                    <button class="border-0 btn btn-outline-danger" @click="deleteTodo(todo)"><i class="bi bi-trash"></i></button>
                </div>
            </li>
        </transition-group>
    </div>
</template>
<style>
    .line-through {
        text-decoration: line-through;
    }
    .list-enter-active,
    .list-leave-active {
        transition: all 1s ease;
    }
    .list-enter-from {
        opacity: 0;
        transform: translateY(-30px);
    }
    .list-leave-to {
        opacity: 0;
        transform: translateX(-300px);
    }
</style>
<script>
    export default {
        data: function() {
            return {
                todos: [],
                newTodo: {
                    body: ""
                }
            }
        },
        mounted() {
            this.fetchTodos()
        },
        methods: {
            fetchTodos() {
                axios.get('/api/todos')
                .then( res => {
                    console.log(res)
                    console.log(res.status)
                    if (res.status == 200) {
                        this.todos = res.data
                    }
                })
                .catch( error => {
                    console.log(error)
                })
            },
            addTodo() {
                if (this.newTodo.body == '') {
                    return
                }
                axios.post('api/todo',{
                    body: this.newTodo.body
                }).then( res => {
                    console.log(res)
                    if (res.status == 201) {
                        // clear input
                        this.newTodo.body = ''
                        this.todos.unshift(res.data)
                    }
                }).catch( error => {
                    console.log(error)
                })
            },
            completed(todo) {
                axios.put(`api/todo/${todo.id}`, {
                    completed: !todo.completed
                }).then( res => {
                    console.log(res)
                    if (res.status == 200) {
                        // update todo
                        todo.completed = !todo.completed
                    }
                }).catch( error => {
                    console.log(error)
                })
            },
            deleteTodo(todo) {
                axios.delete(`api/todo/${todo.id}`)
                .then( res => {
                    console.log(res)
                    if (res.status == 204) {
                        this.todos = this.todos.filter(item => item != todo)
                    }
                }).catch( error => {
                    console.log(error)
                })
            }
        }
    }
</script>
