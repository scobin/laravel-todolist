<template>
    <div>
        <h2>My Todo List Component</h2>
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
                todos: []
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
        }
    }
</script>
