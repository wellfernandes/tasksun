<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller{
    
    public function index(){
        return Task::all();
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $task = Task::create($request->all());
        return response()->json($task, 201);
    }   

    public function show(Task $task){
        return $task;
    }

    public function update(Request $request, Task $task){
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'status' => 'sometimes|required|string',
            'user_id' => 'sometimes|required|exists:users,id',
        ]);

        $task->update($request->all());
        return $task;
    }

    public function destroy(Task $task){
        $task->delete();
        return response()->noContent();
    }
}