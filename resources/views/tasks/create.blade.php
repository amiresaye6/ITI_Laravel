@extends('layouts.app')
@section("title", "Add New Task")

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">

            <div class="px-6 py-8 sm:p-10">
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight mb-8">Create New Task</h2>

                <form action="{{ isset($task) ? route('tasks.update', $task['id']) : route('tasks.store') }}" method="POST"
                    class="space-y-6">
                    @csrf
                    @if(isset($task))
                        @method('PUT')
                    @endif
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Task Title</label>
                        <input type="text" name="title"
                            class="block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition"
                            placeholder="e.g., Fix database indexing" required
                            value="{{isset($task) ? $task['title'] : ""}}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                        <textarea name="description" rows="4"
                            class="block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition"
                            placeholder="What needs to be done? Add context or notes here..." required>
                                    {!! isset($task) ? nl2br(e($task['description'])) : "" !!}
                                </textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Creator</label>
                        <select name="user_id"
                            class="block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition"
                            required>

                            <option value="" disabled selected>-- Select a User --</option>

                            @foreach($users as $user)
                                <option value="{{ $user->id }}" 
                                <?php echo (isset($task) && $task["user_id"] == $user->id) ? 'selected' : ''; ?>
                                >{{ $user->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Due Date</label>
                            <input type="date" name="due_date"
                                class="block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition"
                                required value="{{isset($task) ? $task['due_date'] : ""}}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Priority</label>
                            <select name="priority"
                                class="block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition">
                                <option <?php echo (isset($task) && $task["priority"] == "Low") ? 'selected' : ''; ?>
                                    value="Low">Low</option>
                                <option <?php echo (isset($task) && $task["priority"] == "Medium") ? 'selected' : ''; ?>
                                    value="Medium">Medium</option>
                                <option <?php echo (isset($task) && $task["priority"] == "High") ? 'selected' : ''; ?>
                                    value="High">High</option>
                                <option <?php echo (isset($task) && $task["priority"] == "Urgent") ? 'selected' : ''; ?>
                                    value="Urgent">Urgent</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100 flex justify-end gap-3">
                        <x-button href="{{ route('tasks.index') }}" type="default">
                            Cancel
                        </x-button>
                        <x-button type="primary">
                            {{isset($task) ? "Update Task" : "Create Task"}}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection