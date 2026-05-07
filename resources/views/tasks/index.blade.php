@extends('layouts.app')
@section("title", "My Tasks")

@section('content')
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Tasks</h2>
            <p class="mt-1 text-sm text-slate-500">Manage your projects and daily responsibilities.</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <x-button type="primary" href="{{ route('tasks.create') }}">
                + Add Task
            </x-button>
        </div>
    </div>

    <div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-left">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Title</th>
                        <th
                            class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider hidden sm:table-cell">
                            Creator</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Priority</th>
                        <th
                            class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider hidden md:table-cell">
                            Due Date</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach($tasks as $task)
                        <tr class="hover:bg-slate-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                {{ str_pad($task['id'], 2, '0', STR_PAD_LEFT) }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-slate-900">{{ $task['title'] }}</div>
                                <div class="text-xs text-slate-500 truncate w-40 sm:w-64">
                                    {{ Str::limit($task['description'], 40) }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 hidden sm:table-cell">
                                {{ $task['creator'] }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $p = strtolower($task['priority']);
                                    $badge = match ($p) {
                                        'urgent' => 'bg-rose-100 text-rose-700 ring-rose-600/20',
                                        'high' => 'bg-amber-100 text-amber-700 ring-amber-600/20',
                                        'medium' => 'bg-blue-100 text-blue-700 ring-blue-600/20',
                                        'low' => 'bg-emerald-100 text-emerald-700 ring-emerald-600/20',
                                        default => 'bg-slate-100 text-slate-700 ring-slate-600/20',
                                    };
                                @endphp
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ring-1 ring-inset {{ $badge }}">
                                    {{ $task['priority'] }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 hidden md:table-cell">
                                {{ \Carbon\Carbon::parse($task['due_date'])->format('M j, Y') }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex justify-center gap-2">
                                    @if (isset($task["deleted_at"]))
                                        <form method="POST" action="{{ route('tasks.restore', $task['id']) }}">
                                            @csrf
                                            <!-- @method('DELETE') -->
                                            <x-button type="primary">
                                                Restore
                                            </x-button>
                                        </form>
                                        <x-button type="danger" onclick="openDeleteModal({{ $task['id'] }})">
                                            Force Delete
                                        </x-button>

                                    @else
                                        <x-button type="primary" href="{{ route('tasks.show', $task['id']) }}">View</x-button>
                                        <x-button type="secondary" href="{{ route('tasks.edit', $task['id']) }}">Edit</x-button>
                                        <x-button type="danger" onclick="openDeleteModal({{ $task['id'] }})">
                                            Delete
                                        </x-button>
                                    @endif
                                    <div id="deleteModal-{{ $task['id'] }}"
                                        class="hidden fixed inset-0 bg-slate-900 bg-opacity-50 z-50 flex justify-center items-center backdrop-blur-sm transition-opacity">

                                        <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6 text-center">
                                            <svg class="mx-auto mb-4 text-red-500 w-12 h-12" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                                </path>
                                            </svg>

                                            <h3 class="mb-5 text-lg font-normal text-slate-500 text-center">Are you sure you
                                                want to {{ $task["deleted_at"] ? "force delete" : "delete" }}
                                                <br />
                                                <strong
                                                    class="text-slate-800">{{ substr($task['title'], 0, 40)  . (strlen($task['title']) > 45 ? "..." : "") }}</strong>?
                                            </h3>

                                            <div class="flex justify-center gap-3">
                                                <button type="button" onclick="closeDeleteModal({{ $task['id'] }})"
                                                    class="text-slate-500 bg-white hover:bg-slate-100 focus:ring-4 focus:outline-none focus:ring-slate-200 rounded-lg border border-slate-200 text-sm font-medium px-5 py-2.5 hover:text-slate-900 transition">
                                                    No, cancel
                                                </button>

                                                <form method="POST"
                                                    action="{{ $task["deleted_at"] ? route('tasks.forceDelete', $task['id']) : route('tasks.destroy', $task['id']) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center transition">
                                                        Yes, I'm sure
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $tasks->withQueryString()->links() }}
            </div>
        </div>
    </div>
    <script>
        function openDeleteModal(id) {
            document.getElementById('deleteModal-' + id).classList.remove('hidden');
        }

        function closeDeleteModal(id) {
            document.getElementById('deleteModal-' + id).classList.add('hidden');
        }
    </script>
@endsection