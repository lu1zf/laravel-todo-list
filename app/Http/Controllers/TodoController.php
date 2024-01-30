<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index', [
            'todos' => Todo::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request, Todo $todo)
    {
        if ($todo->create($request->all()))
            return $this->successfulAction('To-Do created successfully');

        return back()
            ->withInput($request->all())
            ->withErrors('Could not create To-Do');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        if ($todo = Todo::find($id)) return view('create', [
            'todo' => $todo
        ]);

        return $this->resourceNotFound();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, int $id)
    {
        $todo = Todo::find($id);
        if (!$todo) return back()->withErrors('Resource not found');

        if ($todo->update($request->all())) {
            return  $this->successfulAction('Item successfully updated!');
        }
    }

    public function markAsDone(int $id)
    {
        $todo = Todo::find($id);
        if (!$todo) return $this->resourceNotFound();

        $updated = $todo->update([
            'status' => 'done'
        ]);

        if (!$updated) return $this->failedAction();

        return $this->successfulAction('To-Do successfully marked as done!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $todo = Todo::find($id);
        if (!$todo) return $this->resourceNotFound();
        if (!$todo->delete()) return $this->failedAction();
        return $this->successfulAction('To-Do successfully deleted!');
    }

    private function resourceNotFound()
    {
        return redirect()
            ->route('index')
            ->withErrors('Resource not found');
    }

    private function successfulAction(string $status = '')
    {
        return redirect()
            ->route('index')
            ->with('status', $status);
    }

    private function failedAction()
    {
        return redirect()
            ->route('index')
            ->withErrors('Could not execute the requested action');
    }
}
