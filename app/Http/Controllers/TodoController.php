<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

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
    public function store(StoreTodoRequest $request)
    {
        $created = Todo::create($request->all());
        if ($created) return redirect('/');

        return back()->withInput($request->all());
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
        $todo = Todo::find($id);
        if ($todo) return view('create', [
            'todo' => $todo
        ]);

        return redirect('/')->withErrors('Resource not found');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, int $id)
    {
        $todo = Todo::find($id);
        if (!$todo) return back()->withErrors('Resource not found');

        if ($todo->update($request->all())) {
            session()->flash('status', 'Item successfuly updated!');
            return  redirect('/');
        }
    }

    public function markAsDone(int $id)
    {
        $todo = Todo::find($id);
        if (!$todo) return redirect('/')->withErrors('Resource not found');

        $updated = $todo->update([
            'status' => 'done'
        ]);

        if (!$updated) return redirect('/')->withErrors('Resource could not be updated');

        session()->flash('status', 'To-Do successfuly marked as done!');
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $todo = Todo::find($id);
        if (!$todo) return redirect('/')->withErrors('Resource not found');
        if (!$todo->delete()) return redirect('/')->withErrors('Resource could not be deleted');

        session()->flash('status', 'To-Do successfuly deleted!');
        return redirect('/');
    }
}
