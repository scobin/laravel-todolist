<template>
    <div>
        <h2>My Todo List Component</h2>
        <div>
            <input type="text" v-model="newTodo.body" placeholder="Enter new task">
            <button @click="addTodo">+</button>
        </div>
        <ul>
            <li v-for="(todo, index) in todos" :key="index">
                <label :for="`todo-${index}`">
                    <span :class="[todo.completed ? 'line-through' : '']" >{{ todo.body }}</span>
                </label>
                <div>
                    <button @click="completed(todo)"> O </button>
                    <button @click="deleteTodo(todo)"> - </button>
                </div>
            </li>
        </ul>
    </div>
</template>
<style>
    .line-through {
        text-decoration: line-through;
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
