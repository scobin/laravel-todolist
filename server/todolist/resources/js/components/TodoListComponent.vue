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
                    <span>{{ todo.body }}</span>
                </label>
            </li>
        </ul>
    </div>
</template>
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
            }
        }
    }
</script>
