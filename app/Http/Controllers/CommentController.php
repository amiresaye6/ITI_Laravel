<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $taskId)
    {
        $request->validate([
            'body' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $task = Task::findOrFail($taskId);

        $task->comments()->create([
            'body' => $request->body,
            "user_id" => $request->user_id,
        ]);

        return redirect()->route("tasks.show", $task->id);
    }
}
