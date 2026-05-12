<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center sm:justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Your Tasks</h2>
                    <p class="mt-2 text-sm text-slate-500">Manage your projects, deadlines, and daily responsibilities.
                    </p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('tasks.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        New Task
                    </a>
                </div>
            </div>

            <div class="bg-white shadow-md shadow-slate-200/50 ring-1 ring-slate-200 rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-left">
                        <thead class="bg-slate-50/80 backdrop-blur-sm">
                            <tr>
                                <th class="px-6 py-5 text-xs font-bold text-slate-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-5 text-xs font-bold text-slate-500 uppercase tracking-wider">Task
                                    Info</th>
                                <th
                                    class="px-6 py-5 text-xs font-bold text-slate-500 uppercase tracking-wider hidden lg:table-cell">
                                    Slug</th>
                                <th
                                    class="px-6 py-5 text-xs font-bold text-slate-500 uppercase tracking-wider hidden sm:table-cell">
                                    Creator</th>
                                <th class="px-6 py-5 text-xs font-bold text-slate-500 uppercase tracking-wider">Priority
                                </th>
                                <th
                                    class="px-6 py-5 text-xs font-bold text-slate-500 uppercase tracking-wider hidden md:table-cell">
                                    Due Date</th>
                                <th
                                    class="px-6 py-5 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @foreach($tasks as $task)
                                <tr class="hover:bg-indigo-50/30 transition-colors duration-200 group">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400 font-medium">
                                        {{ str_pad($task->id, 3, '0', STR_PAD_LEFT) }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div
                                            class="text-sm font-bold text-slate-900 group-hover:text-indigo-700 transition-colors">
                                            {{ $task->title }}</div>
                                        <div class="text-xs text-slate-500 truncate w-40 sm:w-64 mt-1">
                                            {{ Str::limit($task->description, 50) }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 hidden lg:table-cell">
                                        <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded text-xs font-mono">
                                            {{ Str::limit($task->slug, 20) ?? 'no-slug' }}
                                        </span>
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 hidden sm:table-cell font-medium">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold">
                                                {{ substr($task->creator->name ?? 'S', 0, 1) }}
                                            </div>
                                            {{ $task->creator->name ?? 'System' }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $p = strtolower($task->priority);
                                            $badge = match ($p) {
                                                'urgent' => 'bg-rose-100 text-rose-700 ring-rose-600/20',
                                                'high' => 'bg-amber-100 text-amber-700 ring-amber-600/20',
                                                'medium' => 'bg-blue-100 text-blue-700 ring-blue-600/20',
                                                'low' => 'bg-emerald-100 text-emerald-700 ring-emerald-600/20',
                                                default => 'bg-slate-100 text-slate-700 ring-slate-600/20',
                                            };
                                            $dot = match ($p) {
                                                'urgent' => 'bg-rose-500', 'high' => 'bg-amber-500', 'medium' => 'bg-blue-500', 'low' => 'bg-emerald-500', default => 'bg-slate-500'
                                            };
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold ring-1 ring-inset {{ $badge }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $dot }} mr-1.5 animate-pulse"></span>
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                                        @php
                                            $date = \Carbon\Carbon::parse($task->due_date);
                                            $isPast = $date->isPast() && !$task->trashed();
                                        @endphp
                                        <div class="text-sm font-medium {{ $isPast ? 'text-rose-600' : 'text-slate-700' }}">
                                            {{ $date->format('M j, Y') }}
                                        </div>
                                        <div
                                            class="text-xs {{ $isPast ? 'text-rose-400 font-medium' : 'text-slate-400' }} mt-0.5">
                                            {{ $date->diffForHumans() }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div
                                            class="flex justify-end gap-2 opacity-80 group-hover:opacity-100 transition-opacity">
                                            @if ($task->trashed())
                                                <form method="POST" action="{{ route('tasks.restore', $task->id) }}"
                                                    class="inline">
                                                    @csrf
                                                    <button type="submit" title="Restore"
                                                        class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </form>
                                                <button type="button" onclick="openDeleteModal({{ $task->id }})"
                                                    title="Force Delete"
                                                    class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            @else
                                                <a href="{{ route('tasks.show', $task->slug ?: $task->id) }}" title="View"
                                                    class="p-2 text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors inline-block">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <a href="{{ route('tasks.edit', $task->id) }}" title="Edit"
                                                    class="p-2 text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors inline-block">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <button type="button" onclick="openDeleteModal({{ $task->id }})" title="Delete"
                                                    class="p-2 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors inline-block">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <div id="deleteModal-{{ $task->id }}"
                                    class="hidden fixed inset-0 bg-slate-900/40 z-50 flex justify-center items-center backdrop-blur-sm transition-opacity">
                                    <div
                                        class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 text-center border border-slate-100 transform scale-100 transition-transform">
                                        <div
                                            class="w-16 h-16 rounded-full bg-rose-100 mx-auto flex items-center justify-center mb-6">
                                            <svg class="text-rose-500 w-8 h-8" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                                </path>
                                            </svg>
                                        </div>
                                        <h3 class="mb-2 text-xl font-bold text-slate-900">Confirm Deletion</h3>
                                        <p class="mb-6 text-slate-500">Are you sure you want to
                                            {{ $task->trashed() ? "force delete" : "delete" }}<br>
                                            <strong class="text-slate-800">"{{ Str::limit($task->title, 35) }}"</strong>?
                                        </p>
                                        <div class="flex justify-center gap-3">
                                            <button type="button" onclick="closeDeleteModal({{ $task->id }})"
                                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">Cancel</button>
                                            <form method="POST"
                                                action="{{ $task->trashed() ? route('tasks.forceDelete', $task->id) : route('tasks.destroy', $task->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 bg-rose-600 text-white rounded-md">Yes, Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>

                    @if($tasks->hasPages())
                        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
                            {{ $tasks->withQueryString()->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(id) { document.getElementById('deleteModal-' + id).classList.remove('hidden'); }
        function closeDeleteModal(id) { document.getElementById('deleteModal-' + id).classList.add('hidden'); }
    </script>
</x-app-layout>