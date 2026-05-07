@extends('layouts.app')
@section("title", $task['title'])

@section('content')
    <div class="max-w-4xl mx-auto">

        <div class="mb-6 sm:flex sm:items-center sm:justify-between">
            <nav class="flex text-sm text-slate-500 font-medium mb-4 sm:mb-0" aria-label="Breadcrumb">
                <a href="{{ route('tasks.index') }}" class="hover:text-slate-900 transition">Tasks</a>
                <span class="mx-2 text-slate-300">/</span>
                <span class="text-slate-900 truncate w-48 sm:w-auto inline-block align-bottom">{{ $task['title'] }}</span>
            </nav>

            <div class="flex gap-2">
                <x-button type="secondary" href="{{ route('tasks.edit', $task['id']) }}">
                    Edit Task
                </x-button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <div class="px-6 py-8 sm:p-10">

                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-6">
                    {{ $task['title'] }}
                </h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8 pb-8 border-b border-slate-100">
                    <div class="flex items-center gap-2 text-sm">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span class="text-slate-500">Due Date:</span>
                        <span
                            class="font-semibold text-slate-900">{{ \Carbon\Carbon::parse($task['due_date'])->format('F j, Y') }}</span>
                    </div>

                    <div class="flex items-center gap-2 text-sm">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-slate-500">Created:</span>
                        <span class="font-semibold text-slate-900">{{ $task->created_at->format('l, F j, Y \a\t g:i A') }}</span>
                    </div>

                    <div class="flex items-center gap-2 text-sm">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <span class="text-slate-500">Priority:</span>
                        <span class="font-bold text-slate-900">{{ $task['priority'] }}</span>
                    </div>

                    <div class="flex items-center gap-2 text-sm">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-slate-500">Status:</span>
                        <span
                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-800">
                            {{ isset($task['completed']) && $task['completed'] ? 'Completed' : 'Open' }}
                        </span>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Description</h3>
                    <div class="bg-slate-50 rounded-lg p-6 text-slate-700 leading-relaxed ring-1 ring-inset ring-slate-200">
                        {!! nl2br(e($task['description'])) !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection