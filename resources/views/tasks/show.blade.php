<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $task->title }}
            </h2>
            <a href="{{ route('tasks.edit', $task->id) }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition ease-in-out duration-150">
                Edit Task
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 ring-1 ring-slate-200 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-linear-to-r from-indigo-500 to-violet-500"></div>

                <div class="px-8 py-10">
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-8">
                        {{ $task->title }}
                    </h1>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
                        @php $dueDate = \Carbon\Carbon::parse($task->due_date); @endphp
                        <div class="bg-slate-50 rounded-xl p-4 ring-1 ring-slate-200/60 flex flex-col justify-center">
                            <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
                                Target Date
                            </div>
                            <span class="font-bold text-slate-900">{{ $dueDate->format('M j, Y') }}</span>
                            <span
                                class="text-xs mt-1 font-medium {{ $dueDate->isPast() ? 'text-rose-500' : 'text-emerald-500' }}">
                                {{ $dueDate->diffForHumans() }}
                            </span>
                        </div>

                        <div class="bg-slate-50 rounded-xl p-4 ring-1 ring-slate-200/60 flex flex-col justify-center">
                            <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
                                Created By
                            </div>
                            <span class="font-bold text-slate-900">{{ $task->creator->name ?? 'System' }}</span>
                            <span class="text-xs text-slate-500 mt-1">
                                {{ $task->created_at ? $task->created_at->diffForHumans() : 'Recently' }}
                            </span>
                        </div>

                        <div class="bg-slate-50 rounded-xl p-4 ring-1 ring-slate-200/60 flex flex-col justify-center">
                            <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
                                Assigned To
                            </div>
                            <span class="font-bold text-slate-900">{{ $task->assignee->name ?? 'Unassigned' }}</span>
                        </div>

                        <div class="bg-slate-50 rounded-xl p-4 ring-1 ring-slate-200/60 flex flex-col justify-center">
                            <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
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

                    <div class="mb-10">
                        <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                            Description
                        </h3>
                        <div
                            class="bg-white rounded-xl p-6 text-slate-700 leading-relaxed ring-1 ring-inset ring-slate-200 shadow-inner">
                            {!! nl2br(e($task->description)) !!}
                        </div>
                    </div>

                    @if(isset($task->images) && $task->images->count() > 0)
                        <div class="mb-10 pt-6 border-t border-slate-100">
                            <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                                Attached Images
                            </h3>
                            <div class="flex gap-4 overflow-x-auto pb-4">
                                @foreach($task->images as $image)
                                    <a href="{{ $image->url }}" target="_blank" class="shrink-0">
                                        <img src="{{ $image->url }}"
                                            class="h-40 w-40 object-cover rounded-xl shadow-sm border border-slate-200 hover:opacity-80 transition">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mt-12 pt-8 border-t border-slate-100">
                        <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                            Discussion ({{ $task->comments->count() ?? 0 }})
                        </h3>

                        <div class="space-y-6 mb-10">
                            @forelse ($task->comments as $comment)
                                <div
                                    class="flex gap-4 p-5 rounded-2xl bg-slate-50 ring-1 ring-slate-200/60 transition-all hover:ring-indigo-200 hover:shadow-md hover:bg-white">
                                    <div
                                        class="shrink-0 w-10 h-10 rounded-full bg-linear-to-br from-indigo-500 to-violet-500 text-white flex items-center justify-center font-bold shadow-sm">
                                        {{ substr($comment->user->name ?? 'U', 0, 1) }}
                                    </div>
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

                        <div class="bg-indigo-50/30 rounded-2xl p-6 ring-1 ring-indigo-100">
                            <h4 class="font-bold text-slate-800 mb-4 text-sm uppercase tracking-wider">Leave a comment
                            </h4>
                            <form action="{{ route('tasks.comments.store', $task->id) }}" method="POST">
                                @csrf

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

                                <div class="mb-4">
                                    <textarea name="body" rows="3"
                                        class="block w-full rounded-lg border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset {{ $errors->has('body') ? 'ring-rose-500' : 'ring-slate-300' }} focus:ring-2 focus:ring-indigo-600 sm:text-sm resize-none"
                                        placeholder="Type your comment here..." required></textarea>
                                    @error('body')
                                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition-all text-sm font-medium">
                                        Post Comment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>