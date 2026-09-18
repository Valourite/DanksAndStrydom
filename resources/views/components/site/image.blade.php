@props(['name', 'priority' => false, 'sizes' => '(min-width: 1024px) 480px, (min-width: 640px) 448px, 100vw'])
@php
    $photo = config('imagery.images.'.$name);
    $srcset = collect($photo['variants'])->map(fn ($path, $width) => asset($path).' '.$width.'w')->implode(', ');
@endphp
<img src="{{ asset($photo['path']) }}" srcset="{{ $srcset }}" sizes="{{ $sizes }}"
     alt="{{ $photo['alt'] }}" width="{{ $photo['width'] }}" height="{{ $photo['height'] }}"
     loading="{{ $priority ? 'eager' : 'lazy' }}" @if ($priority) fetchpriority="high" @endif
     {{ $attributes }}>
