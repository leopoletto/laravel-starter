@props([
    "symbol",
    "logo",
])
<span
    {{ $attributes->class(["-m-1.5 flex items-center justify-center gap-1 lg:py-3"]) }}
    {{ $attributes->except(["class"]) }}
>
    {{ $symbol }}
    {{ $logo }}
</span>
