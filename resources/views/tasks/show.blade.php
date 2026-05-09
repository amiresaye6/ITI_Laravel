@extends('layouts.app')
@section("title", $task->title)

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
                <span class="text-slate-900 truncate max-w-[200px]">{{ $task->title }}</span>
            </nav>

            <div class="flex gap-3">
                <x-button type="secondary" href="{{ route('tasks.edit', $task->id) }}">
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
            <div class="absolute top-0 left-0 w-full h-1.5 bg-linear-to-r from-indigo-500 to-violet-500"></div>

            <div class="px-8 py-10">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-8">
                    {{ $task->title }}
                </h1>

                <!-- Grid Data Metrics -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
                    <!-- Target Date -->
                    @php $dueDate = \Carbon\Carbon::parse($task->due_date); @endphp
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

                    <!-- Creator Card -->
                    <div class="bg-slate-50 rounded-xl p-4 ring-1 ring-slate-200/60 flex flex-col justify-center">
                        <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Created By
                        </div>
                        <span class="font-bold text-slate-900">{{ $task->creator->name ?? 'System' }}</span>
                        <span class="text-xs text-slate-500 mt-1">
                            {{ $task->created_at ? $task->created_at->diffForHumans() : 'Recently' }}
                        </span>
                    </div>

                    <!-- Assignee Card -->
                    <div class="bg-slate-50 rounded-xl p-4 ring-1 ring-slate-200/60 flex flex-col justify-center">
                        <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Assigned To
                        </div>
                        <span class="font-bold text-slate-900">{{ $task->assignee->name ?? 'Unassigned' }}</span>
                    </div>

                    <!-- Status / Priority Card -->
                    <div class="bg-slate-50 rounded-xl p-4 ring-1 ring-slate-200/60 flex flex-col justify-center">
                        <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Priority
                        </div>
                        <div>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800 uppercase tracking-wider">
                                {{ $task->priority }}
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
                        {!! nl2br(e($task->description)) !!}
                    </div>
                </div>

                <!-- ================= COMMENTS SECTION ================= -->
                <div class="mt-12 pt-8 border-t border-slate-100">
                    <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z">
                            </path>
                        </svg>
                        Discussion ({{ $task->comments->count() ?? 0 }})
                    </h3>

                    <!-- List Existing Comments -->
                    <div class="space-y-6 mb-10">
                        @forelse ($task->comments as $comment)
                            <div
                                class="flex gap-4 p-5 rounded-2xl bg-slate-50 ring-1 ring-slate-200/60 transition-all hover:ring-indigo-200 hover:shadow-md hover:bg-white">
                                <!-- Avatar -->
                                <div
                                    class="shrink-0 w-10 h-10 rounded-full bg-linear-to-br from-indigo-500 to-violet-500 text-white flex items-center justify-center font-bold shadow-sm">
                                    {{ substr($comment->user->name ?? 'U', 0, 1) }}
                                </div>
                                <!-- Comment Content -->
                                <div class="grow">
                                    <div class="flex items-baseline justify-between mb-1">
                                        <h4 class="font-bold text-slate-900 text-sm">
                                            {{ $comment->user->name ?? 'Unknown User' }}</h4>
                                        <span
                                            class="text-xs text-slate-400 font-medium">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="text-sm text-slate-600 leading-relaxed">
                                        {{ $comment->body }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div
                                class="text-center py-8 text-slate-400 text-sm italic bg-slate-50/50 rounded-xl ring-1 ring-slate-100">
                                No comments yet. Start the conversation below!
                            </div>
                        @endforelse
                    </div>

                    <!-- Add New Comment Form -->
                    <div class="bg-indigo-50/30 rounded-2xl p-6 ring-1 ring-indigo-100">
                        <h4 class="font-bold text-slate-800 mb-4 text-sm uppercase tracking-wider">Leave a comment</h4>

                        <form action="{{ route('tasks.comments.store', $task->id) }}" method="POST">
                            @csrf

                            <!-- Select User -->
                            <div class="mb-4">
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Post as:</label>
                                <select name="user_id"
                                    class="block w-full rounded-lg border-0 py-2.5 px-4 text-slate-900 shadow-sm ring-1 ring-inset {{ $errors->has('user_id') ? 'ring-rose-500' : 'ring-slate-300' }} focus:ring-2 focus:ring-indigo-600 sm:text-sm bg-white"
                                    required>
                                    <option value="" disabled selected>-- Select your user profile --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Comment Body -->
                            <div class="mb-4">
                                <textarea name="body" rows="3"
                                    class="block w-full rounded-lg border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset {{ $errors->has('body') ? 'ring-rose-500' : 'ring-slate-300' }} focus:ring-2 focus:ring-indigo-600 sm:text-sm resize-none"
                                    placeholder="Type your comment here..." required></textarea>
                                @error('body')
                                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 text-sm font-medium flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Post Comment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- ================= END COMMENTS SECTION ================= -->
            </div>
        </div>
    </div>
@endsection