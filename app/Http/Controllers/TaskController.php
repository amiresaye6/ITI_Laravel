<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Task::with(['creator', 'assignee']);

        if ($request->query("status") == "trashed") {
            $tasks = $query->onlyTrashed()->paginate(10);
        } else {
            $tasks = $query->paginate(10);
        }
        return view("tasks.index", ['tasks' => $tasks]);
    }

    public function forceDelete($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->forceDelete();
        return redirect()->route("tasks.index", ["status" => "trashed"]);
    }
    public function restore($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        // dd($task);
        $task->restore();
        return redirect()->route("tasks.index", ["status" => "trashed"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view("tasks.create", ["users" => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        Task::create($request->validated());
        return redirect()->route("tasks.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::with(['creator', 'assignee', 'comments.user'])->findOrFail($id);

        $users = User::all();

        return view("tasks.show", ['task' => $task, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        $users = User::all();
        return view("tasks.create", ["task" => $task, "users" => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->validated());
        return redirect()->route("tasks.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route("tasks.index");
    }
}
