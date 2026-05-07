<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title", "TaskFlow Manager")</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Custom Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        /* Custom Scrollbar for elegance */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="bg-linear-to-br from-slate-50 to-slate-100 text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- Glassmorphism Navbar -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200/80 shadow-sm">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="bg-indigo-500/10 p-2 rounded-xl">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                    <h1
                        class="text-xl font-bold bg-clip-text text-transparent bg-linear-to-r from-slate-900 to-indigo-800 tracking-tight">
                        TaskFlow</h1>
                </div>
                <div class="flex items-center gap-6">
                    <a href="{{ route('tasks.index') }}"
                        class="text-slate-500 hover:text-indigo-600 transition-colors font-medium text-sm">My Tasks</a>
                    <a href="{{ route('tasks.index', ['status' => 'trashed']) }}"
                        class="text-slate-500 hover:text-rose-600 transition-colors font-medium text-sm">Trash</a>
                    <a href="{{ route('tasks.create') }}"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 text-sm font-medium flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Add Task
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="grow  mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full animate-fade-in">
        @yield('content')
    </main>

</body>

</html>