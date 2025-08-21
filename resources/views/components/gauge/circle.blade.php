@props([
    "score",
    "title",
    "icon",
    "twWidth" => "w-28",
    "twHeight" => "h-28",
])

<div
    data-component-theme="gauge"
    @class(["flex w-full flex-col items-center gap-2", $twWidth])
>
    <div
        @class(["audit-score relative", $twHeight])
        data-score="{{ $score }}"
        role="img"
        aria-label="Performance score {{ $score }} out of 100"
    >
        <div
            @class([sprintf("gauge-transparent-background %s %s absolute top-0 left-0 aspect-square rounded-full border", $twHeight, $twWidth), ""])
        ></div>
        <svg
            @class(["fill-transparent", $twHeight, $twWidth])
            viewBox="0 0 80 80"
        >
            <circle
                @class(["stroke-[5px] transition transition-discrete delay-150 duration-700 ease-linear"])
                cx="40"
                cy="40"
                r="36"
                stroke-dasharray="306.12"
                stroke-dashoffset="45.92"
            ></circle>
        </svg>
        <div
            @class(["absolute top-0 left-0 flex flex-col items-center justify-center gap-0", $twHeight, $twWidth])
        >
            <em
                @class([
                    "score-number font-headline text-3xl not-italic tabular-nums",
                ])
            >
                {{ $score }}
            </em>
            <span>{{ $icon }}</span>
        </div>
    </div>
    <span class="score-title flex w-full justify-center text-lg text-stone-700">
        {{ $title }}
    </span>
</div>
