@php
    $baseClasses = 'px-4 py-2 rounded-lg text-sm font-semibold shadow-sm transition-all duration-200 inline-flex items-center justify-center gap-2 focus:outline-none focus:ring-2 focus:ring-offset-2 active:scale-95';

    $typeClasses = match ($type ?? 'default') {
        'primary' => 'bg-gradient-to-r from-indigo-600 to-violet-600 text-white hover:from-indigo-500 hover:to-violet-500 hover:shadow-md focus:ring-indigo-500',
        'secondary' => 'bg-slate-800 text-white hover:bg-slate-700 hover:shadow-md focus:ring-slate-800',
        'danger' => 'bg-gradient-to-r from-rose-500 to-red-600 text-white hover:from-rose-400 hover:to-red-500 hover:shadow-md focus:ring-rose-500',
        default => 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 hover:border-slate-300 focus:ring-slate-200',
    };
@endphp

<{{ $attributes->has('href') ? 'a' : 'button' }}
    {{ $attributes->merge(['class' => "$baseClasses $typeClasses"]) }}>

    {{ $slot }}

</{{ $attributes->has('href') ? 'a' : 'button' }}>