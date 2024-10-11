<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;

class TaskController extends Controller
{
    public function fetchAllTasks(){
        //all() = "select * from tasks"
        $tasks = Tasks::all();
        //$row['colum name']
        return view('index', compact('tasks'));
    }
    
    public function createTask(){ 
        return view('create');
    }

    public function addTask(Request $request){

    $request->validate([
        'title' =>'required|max:255',
        'description' =>'required',
        'due_date' =>'required',
    ]);

    Tasks::create($request->all());

    return redirect()->route('index')->with('success', 'Task added successfully');
    }

    public function doneTask(Request $request, $id){
        $tasks = Tasks::findOrFail($id);
       

        $tasks->isCompleted = true;
        $tasks->save();

        return redirect()->route('index')->with('success', 'Task marked as done successfully');
    }
     
    // Show edit task form
    public function EditTask($id){
        $task = Tasks::findOrFail($id);
        return view('edit', compact('task'));
    }

    // Update task details
    public function updateTask(Request $request, $id){
        $task = Tasks::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'due_date' => 'required|date',
        ]);

        $task->update($request->all());

        return redirect()->route('index')->with('success', 'Task updated successfully');
    }

     // Delete task
     public function deleteTask($id){
        $task = Tasks::findOrFail($id);
        $task->delete();

        return redirect()->route('index')->with('success', 'Task deleted successfully');
    }
}
