<div>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action={{ ($todo ?? false) ? route('update', ['id' => $todo->id ]) : route('store') }} method="POST">
        @csrf
        <label for="name">Name:</label>
        <input name="name" type="text" placeholder="Name" value={{ ($todo ?? false) ? $todo->name : '' }} >
        <br />
        
        <label for="description">Description:</label>
        <textarea name="description">{{ ($todo ?? false) ? $todo->description : '' }}</textarea>
        <br />
        
        <label for="due_date">Due date:</label>
        <input type="datetime-local" name="due_date" value="{{ ($todo ?? false) ? $todo->due_date : '' }}" >
        <br />

        <label for="status">Status:</label>
        <select name="status">
            <option value="pending" {{ ($todo ?? false) && $todo->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in_progress" {{ ($todo ?? false) && $todo->status == 'in_progress' ? 'selected' : '' }}>In progress</option>
            <option value="done" {{ ($todo ?? false) && $todo->status == 'done' ? 'selected' : '' }}>Done</option>
        </select>
        <br />

        @if ($todo ?? false)
            <button type="submit">Update</button>
        @else
            <button type="submit">Create</button>
        @endif
    </form>
</div>
