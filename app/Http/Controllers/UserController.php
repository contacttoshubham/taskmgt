<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $tasks = User::with('taskDetails')->where('id', '=', auth()->user()->id)->get();
        $taskDetails = $tasks[0]->taskDetails;
        return view('user.assign-task', compact('taskDetails'));
    }

    public function update(Request $request) {
        $task = Task::find($request->id);
        $task->status = $request->status;
        if($task->update()) {
            return response()->json(['status'=>200, 'message'=>'Task status update successfully']);
        } else {
            return response()->json(['status'=>402, 'message'=>'Status not update']);
        }
    }
}
