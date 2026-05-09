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

                    <!-- Title -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Task Title</label>
                        <input type="text" name="title"
                            class="block w-full rounded-lg border-0 py-2.5 px-4 text-slate-900 shadow-sm ring-1 ring-inset {{ $errors->has('title') ? 'ring-rose-500' : 'ring-slate-300' }} focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                            placeholder="e.g., Fix database indexing" value="{{ old('title', $task['title'] ?? '') }}">
                        @error('title')
                            <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Description</label>
                        <textarea name="description" rows="4"
                            class="block w-full rounded-lg border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset {{ $errors->has('description') ? 'ring-rose-500' : 'ring-slate-300' }} focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                            placeholder="What needs to be done? Add context or notes here...">{{ old('description', isset($task) ? strip_tags($task['description']) : '') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Creator & Assignee Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Creator ID -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Creator</label>
                            <select name="creator_id"
                                class="block w-full rounded-lg border-0 py-2.5 px-4 text-slate-900 shadow-sm ring-1 ring-inset {{ $errors->has('creator_id') ? 'ring-rose-500' : 'ring-slate-300' }} bg-white focus:ring-2 focus:ring-indigo-600 sm:text-sm">
                                <option value="" disabled {{ old('creator_id', $task['creator_id'] ?? '') == '' ? 'selected' : '' }}>-- Select Creator --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('creator_id', $task['creator_id'] ?? '') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('creator_id')
                                <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Assignee ID -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Assigned To</label>
                            <select name="user_id"
                                class="block w-full rounded-lg border-0 py-2.5 px-4 text-slate-900 shadow-sm ring-1 ring-inset {{ $errors->has('user_id') ? 'ring-rose-500' : 'ring-slate-300' }} bg-white focus:ring-2 focus:ring-indigo-600 sm:text-sm">
                                <option value="" disabled {{ old('user_id', $task['user_id'] ?? '') == '' ? 'selected' : '' }}>-- Select Assignee --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $task['user_id'] ?? '') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Date & Priority Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="group">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Due Date</label>
                            <input type="date" name="due_date"
                                class="block w-full rounded-lg border-0 py-2.5 px-4 text-slate-900 shadow-sm ring-1 ring-inset {{ $errors->has('due_date') ? 'ring-rose-500' : 'ring-slate-300' }} focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                value="{{ old('due_date', $task['due_date'] ?? '') }}">
                            @error('due_date')
                                <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="group">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Priority Level</label>
                            <select name="priority"
                                class="block w-full rounded-lg border-0 py-2.5 px-4 text-slate-900 shadow-sm ring-1 ring-inset {{ $errors->has('priority') ? 'ring-rose-500' : 'ring-slate-300' }} bg-white focus:ring-2 focus:ring-indigo-600 sm:text-sm">
                                <option value="low" {{ old('priority', $task['priority'] ?? '') == 'low' ? 'selected' : '' }}>
                                    Low</option>
                                <option value="medium" {{ old('priority', $task['priority'] ?? '') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ old('priority', $task['priority'] ?? '') == 'high' ? 'selected' : '' }}>High</option>
                                <option value="urgent" {{ old('priority', $task['priority'] ?? '') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                            </select>
                            @error('priority')
                                <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Hidden status for creation (defaults to to-do) -->
                    @if(!isset($task))
                        <input type="hidden" name="status" value="to-do">
                    @endif

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