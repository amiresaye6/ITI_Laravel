@extends('layouts.app')
@section("title", isset($task) ? "Edit Task" : "Add New Task")

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 ring-1 ring-slate-200 overflow-hidden">

            <div class="bg-slate-50/50 border-b border-slate-100 px-8 py-6">
                <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    {{ isset($task) ? 'Edit Task Info' : 'Create New Task' }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">Fill out the information below to keep your project on track.</p>
            </div>

            <div class="px-8 py-8">
                <form action="{{ isset($task) ? route('tasks.update', $task['id']) : route('tasks.store') }}" method="POST"
                    class="space-y-6">
                    @csrf
                    @if(isset($task)) @method('PUT') @endif

                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Task Title</label>
                        <input type="text" name="title"
                            class="block w-full rounded-lg border-0 py-2.5 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all duration-200 group-hover:ring-slate-400"
                            placeholder="e.g., Fix database indexing" required
                            value="{{isset($task) ? $task['title'] : ""}}">
                    </div>

                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Description</label>
                        <textarea name="description" rows="4"
                            class="block w-full rounded-lg border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all duration-200 group-hover:ring-slate-400"
                            placeholder="What needs to be done? Add context or notes here..."
                            required>{!! isset($task) ? strip_tags($task['description']) : "" !!}</textarea>
                    </div>

                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Assigned To</label>
                        <div class="relative">
                            <select name="user_id"
                                class="block w-full appearance-none rounded-lg border-0 py-2.5 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all duration-200 group-hover:ring-slate-400 bg-white"
                                required>
                                <option value="" disabled selected>-- Select a Team Member --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" <?php    echo (isset($task) && $task["user_id"] == $user->id) ? 'selected' : ''; ?>>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="group">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Due Date</label>
                            <input type="date" name="due_date"
                                class="block w-full rounded-lg border-0 py-2.5 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all duration-200 group-hover:ring-slate-400"
                                required value="{{isset($task) ? $task['due_date'] : ""}}">
                        </div>
                        <div class="group">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Priority Level</label>
                            <div class="relative">
                                <select name="priority"
                                    class="block w-full appearance-none rounded-lg border-0 py-2.5 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all duration-200 group-hover:ring-slate-400 bg-white">
                                    <option <?php echo (isset($task) && $task["priority"] == "Low") ? 'selected' : ''; ?>
                                        value="Low">Low</option>
                                    <option <?php echo (isset($task) && $task["priority"] == "Medium") ? 'selected' : ''; ?>
                                        value="Medium">Medium</option>
                                    <option <?php echo (isset($task) && $task["priority"] == "High") ? 'selected' : ''; ?>
                                        value="High">High</option>
                                    <option <?php echo (isset($task) && $task["priority"] == "Urgent") ? 'selected' : ''; ?>
                                        value="Urgent">Urgent</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100 flex justify-end gap-3">
                        <x-button href="{{ route('tasks.index') }}" type="default">Cancel</x-button>
                        <x-button type="primary">
                            {{isset($task) ? "Save Changes" : "Create Task"}}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection