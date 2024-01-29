<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>To-Do List</title>
    </head>
    <body>
        <h1>To-Do List</h1>
        <a href={{ route('create') }}>Create todo</a>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->get('status'))
            <ul>
                <li> {{ session()->get('status') }} </li>
            </ul>
        @endif
        <h2>Items</h2>
        <ol>
            @foreach ($todos as $key => $todo)    
                <li>{{ $todo->name }} - 
                    <a href="{{ route('done', ['id' => $todo->id]) }}">Mark as done</a> |
                    <a href={{ route('edit', ['id' => $todo->id]) }}>Edit</a> |
                    <a href="{{ route('destroy', ['id' => $todo->id]) }}">Delete</a>
                </li>
                <p>{{ $todo->description }}</p>
                @if ($todo->due_date ?? false)
                    <p> {{ $todo->due_date }} </p>
                @endif
                <p>Status: {{ $todo->status }}</p>
            @endforeach
        </ol>
    </body>
</html>