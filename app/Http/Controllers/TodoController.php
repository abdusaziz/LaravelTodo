<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{

    // Todo list page
    public function index()                                     
    {
        $todos = Todo::withCount('task')
        ->withCount(['task as remaining_count' => function ($query) {
            $query->where('status', 0);
        }])
        ->withCount(['task as completed_count' => function ($query) {
            $query->where('status', 1);
        }])
        ->where('user_id', Auth::user()->id)
        ->paginate(10); 

        return view("Todo.index", compact('todos'));
    }



    // store new Todo item
    public function store(Request $request)                     
    {
        // Form data Validation
        $request->validate([
            "name"  =>  "required|min:3|max:20|unique:todos,name,null,null,user_id," . Auth::user()->id
        ]);

        // query to Insert form data to Todo table
        $query = Todo::create([
            "name"  =>  $request->name,
            "user_id"   =>  Auth::user()->id
        ]);

        if ($query) {
            $message = "New Todo Successfully Created";
        } else {
            $message = "New Todo not Created";
        }

        return redirect()->back()->with('message', 'Task created successfully.');
    }



    // Task list of a Todo item
    public function show(Todo $todo)                            
    {
        $tasks = Task::orderBy('status', 'desc')->where('todo_id', $todo->id)->paginate(5);         
        return view('Todo.show', compact(['tasks', 'todo']));
    }



    // Rename a Task
    public function update(Request $request, Todo $todo)        
    {       
        // Form data Validation
        $request->validate([
            "name" => "required|min:3|max:20|unique:todos,name," . $todo->id . ",id,user_id," . Auth::user()->id
        ]);

        // query to Update form data to Todos table
        $todo->update([
            "name"  =>  $request->name,
            "user_id"   =>  Auth::user()->id
        ]);
        return redirect()->route('todo.index')->with('message', 'Name updated successfully');
    }



    // Delete Todo item
    public function destroy(Todo $todo)                         
    {
        $todo->delete();
        return redirect()->route('todo.index')->with('message', 'Todo item deleted successfully.');
    }
}
