<?php

namespace App\Http\Controllers;

use App\Services\TaskManager;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TaskManager $taskManager)
    {
        $tasks = $taskManager->getAll();
        return view("tasks.index", ['tasks' => $tasks]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("tasks.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, TaskManager $taskManager)
    {
        $newData = $request->except("_token");
        $taskManager->addTask($newData);
        return redirect()->route("tasks.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, TaskManager $taskManager)
    {
        $task = $taskManager->find($id);

        if (!$task) {
            abort(404);
        }
        return view("tasks.show", ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, TaskManager $taskManager)
    {
        $task = $taskManager->find($id);
        return view("tasks.create", ["task" => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, TaskManager $taskManager)
    {
        // echo "botato";
        $newData = $request->except("_token");
        // var_dump($newData);
        $taskManager->updateTask($id, $newData);
        // return;
        return redirect()->route("tasks.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, TaskManager $taskManager)
    {
        $taskManager->deleteTask($id);
    }
}
