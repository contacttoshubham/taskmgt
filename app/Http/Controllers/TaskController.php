<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('task.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $validated = $request->validated();
        Task::create($validated);
        return response()->json(['status'=>200, 'message'=>'Task added successfully']);

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $tasks = Task::with('userDetails')->where('is_deleted', '=', 0)->get();
        return view('task.list', compact('tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $users = User::all();
        return view('task.edit', compact('task','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $validated = $request->validated();
        if($task->update($validated)) {
            Session::flash('message', 'Task updated successfully'); 
        } else {
            Session::flash('message', 'Some problem occurred'); 
        }
        return redirect('task-list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task) {
        $task->is_deleted = 1;
        if ($task->save()) {
            Session::flash('message', 'Task deleted successfully');
        } else {
            Session::flash('message', 'Some problem occurred');
        }
        return redirect()->route('task-list');
    }
    
}
