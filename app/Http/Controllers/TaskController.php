<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{


   // store new Task item
    public function store(Request $request)
    {
        // Form data Validation
        $request->validate([
            "name"  =>  "required|min:3|max:20|unique:tasks,name,null,null,todo_id,".$request->todo_id,
            "description"  =>  "required|min:3|max:1000"
        ]);

        // Create new Task to Tasks table
        $task = Task::create([
            "name"          =>  $request->name,
            "description"   =>  $request->description,
            "status"        =>  $request->status,
            "todo_id"       =>  $request->todo_id
        ]);
        return redirect()->back()->with('message', 'Task created successfully.');
    }


    
    // Update a Task
    public function update(Request $request, Task $task)
    {
        // Form data Validation
        $request->validate([
            "name"  =>  "required|min:3|max:20|unique:tasks,name,".$task->id.",id,todo_id,".$request->todo_id,
            "description"  =>  "required|min:3|max:1000"
        ]);

        // query to Update form data to tasks table
        $task = $task->update([
            "name"          =>  $request->name,
            "description"   =>  $request->description,
            "status"        =>  $request->status,
            "todo_id"       =>  $request->todo_id
        ]);
        return redirect()->back()->with('message', 'Task updated successfully.');
    }



    // Delete single Task item
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back()->with('message', 'Todo item deleted successfully.');
    
    }
}
