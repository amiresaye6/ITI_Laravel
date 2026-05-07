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
                                                {{ Str::limit($task['description'], 40) }}</div>
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
                                                <x-button type="primary" href="{{ route('tasks.show', $task['id']) }}">View</x-button>
                                                <x-button type="secondary" href="{{ route('tasks.edit', $task['id']) }}">Edit</x-button>
                                            </div>
                                        </td>
                                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection