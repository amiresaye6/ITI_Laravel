@extends('layouts.app')
@section("title", $task['title'])

@section('content')
    <div class="max-w-4xl mx-auto">

        <!-- Breadcrumbs & Actions Header -->
        <div class="mb-8 sm:flex sm:items-center sm:justify-between">
            <nav class="flex items-center text-sm font-medium space-x-2 text-slate-500 mb-4 sm:mb-0"
                aria-label="Breadcrumb">
                <a href="{{ route('tasks.index') }}"
                    class="hover:text-indigo-600 transition-colors flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Home
                </a>
                <span class="text-slate-300">/</span>
                <span class="text-slate-900 truncate max-w-[200px]">{{ $task['title'] }}</span>
            </nav>

            <div class="flex gap-3">
                <x-button type="secondary" href="{{ route('tasks.edit', $task['id']) }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit Task
                </x-button>
            </div>
        </div>

        <!-- Main Task Card -->
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 ring-1 ring-slate-200 overflow-hidden relative">

            <!-- Top Color Accent border -->
            <div class="absolute top-0 left-0 w-full h-1.5 bg-linear-to-r from-indigo-500 to-violet-500"></div>

            <div class="px-8 py-10">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-8">
                    {{ $task['title'] }}
                </h1>

                <!-- Grid Data Metrics -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">

                    <!-- Due Date Card with Smart Waiting Time -->
                    @php $dueDate = \Carbon\Carbon::parse($task['due_date']); @endphp
                    <div class="bg-slate-50 rounded-xl p-4 ring-1 ring-slate-200/60 flex flex-col justify-center">
                        <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Target Date
                        </div>
                        <span class="font-bold text-slate-900">{{ $dueDate->format('M j, Y') }}</span>
                        <span
                            class="text-xs mt-1 font-medium {{ $dueDate->isPast() ? 'text-rose-500' : 'text-emerald-500' }}">
                            {{ $dueDate->diffForHumans() }}
                        </span>
                    </div>

                    <!-- Creation Card with Relative Time -->
                    <div class="bg-slate-50 rounded-xl p-4 ring-1 ring-slate-200/60 flex flex-col justify-center">
                        <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Created By
                        </div>
                        <span class="font-bold text-slate-900">{{ $task['creator'] ?? 'System' }}</span>
                        <span class="text-xs text-slate-500 mt-1">
                            {{ $task->created_at ? $task->created_at->diffForHumans() : 'Recently' }}
                        </span>
                    </div>

                    <!-- Priority Card -->
                    <div class="bg-slate-50 rounded-xl p-4 ring-1 ring-slate-200/60 flex flex-col justify-center">
                        <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Priority
                        </div>
                        <span class="font-bold text-slate-900">{{ $task['priority'] }}</span>
                    </div>

                    <!-- Status Card -->
                    <div class="bg-slate-50 rounded-xl p-4 ring-1 ring-slate-200/60 flex flex-col justify-center">
                        <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Status
                        </div>
                        <div>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ isset($task['completed']) && $task['completed'] ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ isset($task['completed']) && $task['completed'] ? 'Completed' : 'In Progress' }}
                            </span>
                        </div>
                    </div>

                </div>

                <!-- Description Block -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                        Description
                    </h3>
                    <div
                        class="bg-white rounded-xl p-6 text-slate-700 leading-relaxed ring-1 ring-inset ring-slate-200 shadow-inner">
                        {!! nl2br(e($task['description'])) !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection