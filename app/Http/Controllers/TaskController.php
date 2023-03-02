<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('task.index');
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
    public function store(Request $request)
    {
        $request->validate([
            "name"  =>  "required|min:3|max:20|unique:tasks,name,null,null,todo_id,".$request->todo_id,
            "description"  =>  "required|min:3|max:1000"
        ]);
        $task = Task::create([
            "name"          =>  $request->name,
            "description"   =>  $request->description,
            "status"        =>  $request->status,
            "todo_id"       =>  $request->todo_id
        ]);
        return redirect()->back()->with('message', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            "name"  =>  "required|min:3|max:20|unique:tasks,name,".$task->id.",id,todo_id,".$request->todo_id,
            "description"  =>  "required|min:3|max:1000"
        ]);
        $task = $task->update([
            "name"          =>  $request->name,
            "description"   =>  $request->description,
            "status"        =>  $request->status,
            "todo_id"       =>  $request->todo_id
        ]);
        return redirect()->back()->with('message', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back()->with('message', 'Todo item deleted successfully.');
    
    }
}
