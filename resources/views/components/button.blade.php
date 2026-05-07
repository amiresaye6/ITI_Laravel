@php
    // Define our base styles that every button shares
    $baseClasses = 'px-4 py-2 rounded text-sm font-medium shadow-sm transition inline-flex items-center justify-center';
    
    // Apply specific colors based on the "type" parameter we passed in
    $typeClasses = match($type) {
        'primary' => 'bg-indigo-600 text-white hover:bg-indigo-700',
        'secondary' => 'bg-emerald-600 text-white hover:bg-emerald-700',
        'danger' => 'bg-red-500 text-white hover:bg-red-600',
        default => 'bg-gray-200 text-gray-800 hover:bg-gray-300',
    };
@endphp

<{{ $attributes->has('href') ? 'a' : 'button' }} 
    {{ $attributes->merge(['class' => "$baseClasses $typeClasses"]) }}>
    
    {{ $slot }}
    
</{{ $attributes->has('href') ? 'a' : 'button' }}>