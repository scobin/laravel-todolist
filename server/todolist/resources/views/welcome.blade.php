<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
            <div>
                <!-- 1. title -->
                <h2>My Todo List</h2>
                <!-- 3. "add todo" form-->
                <form action="{{ route('todo.store') }}" method="post">
                @csrf
                    <input type="text" name="todo_body" id="todo_body"
                    placeholder="Enter your task">
                    <input type="submit" value="+">
                </form>
                <!-- 2. todo list -->
                <ul>
                    @foreach ($todos as $key => $todo)
                        <li>
                            <span>
                                {{ $todo->body }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
    </body>
</html>
