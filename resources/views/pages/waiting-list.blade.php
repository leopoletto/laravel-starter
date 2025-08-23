@extends('layouts.app')

@section('content')
    @php($pending = session('subscribed_pending'))
    @php($verified = session('subscribed_verified'))
    <section class="relative min-h-screen hero grid py-10  justify-center border-b border-b-stone-400">
        <div class="mx-auto max-w-3xl px-2 sm:px-6 justify-start text-center flex flex-col gap-5">
            <header>
                <nav
                    class="mx-auto flex w-full max-w-3xl items-center justify-evenly"
                    aria-label="Global"
                >
                    <div class="mx-auto flex self-center">
                        <x-brand.wrapper>
                            <x-slot:symbol>
                                <x-brand.symbol/>
                            </x-slot>
                            <x-slot:logo>
                                <x-brand.logo/>
                            </x-slot>
                        </x-brand.wrapper>
                    </div>
                </nav>
            </header>

            <h1 class="bg-emerald-900 sm:bg-transparent text-4xl sm:text-5xl mt-10 font-headline font-semibold leading-[118%] tracking-tight ">
                <span class="text-emerald-900  bg-emerald-200 px-1">Interactive Lighthouse audits,</span>
                <br class="hidden sm:flex">
                <span class="bg-emerald-900 text-emerald-200 px-1 pb-1">explained by experts</span>
            </h1>
            @if(!$verified && !$pending)
            <div
                class="mt-6 grid w-full grid-cols-2 gap-5 space-y-2 sm:space-y-0 sm:flex md:max-w-2xl"
            >
                <x-gauge.circle
                    title="Performance"
                    :score="rand(30, 60)"
                >
                    <x-slot:icon>
                        <x-icons.performance/>
                    </x-slot>
                </x-gauge.circle>
                <x-gauge.circle
                    title="Accessibility"
                    :score="rand(30, 60)"
                >
                    <x-slot:icon>
                        <x-icons.accessibility/>
                    </x-slot>
                </x-gauge.circle>
                <x-gauge.circle
                    title="Best Practices"
                    :score="rand(60, 85)"
                >
                    <x-slot:icon>
                        <x-icons.best-practices/>
                    </x-slot>
                </x-gauge.circle>
                <x-gauge.circle title="SEO" :score="rand(70, 90)">
                    <x-slot:icon>
                        <x-icons.seo-audit/>
                    </x-slot>
                </x-gauge.circle>
            </div>
            <p class="px-2 md:px-0 text-xl font-normal text-stone-600 mt-10 mb-5 leading-relaxed">
                We turn <strong>Chrome Lighthouse</strong> reports into step-by-step lessons. <br><br class="sm:hidden">
                Learn why each issue matters—and how to fix it—across.<br><br class="sm:hidden">
                Performance,
                Accessibility,
                Best Practices, and
                <abbr class="underline underline-offset-4" title="Search Engine Optimization">SEO</abbr>.
            </p>
            @endif

            @if($verified)
                <div class="rounded-xl mt-10 border border-emerald-300 p-4 bg-emerald-50 text-emerald-100">
                    <p class="font-headline text-2xl">You're in! 🎉</p>
                    <p class="mt-3 text-lg">You’ll get weekly updates on the course progress and new lessons.</p>
                    <p class="mt-1 text-lg">
                        Follow along:
                        <a class="underline underline-offset-2" href="https://x.com/leopoletto" rel="me nofollow">X</a> ·
                        <a class="underline underline-offset-2" href="https://www.linkedin.com/in/leoopoletto" rel="me nofollow">LinkedIn</a>
                    </p>
                </div>
            @elseif($pending)
                <div class="rounded-xl  mt-10 border p-4 border-orange-web-300 bg-orange-web-900/50 text-orange-web-100">
                    <p class="font-headline text-2xl">Please confirm your email 📨</p>
                    <p class="mt-3 text-lg">We’ve sent a confirmation link. Click it to join early access.</p>
                    <p class="mt-1">Didn’t get it? Check spam, or request again below.</p>
                </div>
            @endif

            @if(!$verified)
                <div class="w-full block">
                    <form class="mt-4 px-2 sm:px-0 group max-w-xl mx-auto flex flex-col sm:flex-row gap-3 justify-between"
                          action="{{ route('subscriber.register') }}" method="post">
                        @csrf
                        <input name="email" type="email" required
                               class="w-full py-3 sm:py-2  bg-white  rounded-xl invalid:ring-2 valid:ring-1 invalid:ring-stone-700/50 valid:ring-emerald-200/50 px-4 text-stone-900 placeholder-stone-400"
                               placeholder="your@email.com"
                               autocomplete="email">
                        <button type="submit"
                                class="rounded-xl w-full min-w-fit mt-2 sm:mt-0 sm:w-auto bg-emerald-200 px-5 py-4 font-normal text-emerald-900  transition-all border-b-4 border-b-smoky-black hover:border-b-6 active:border-b-4 shadow-sm  focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            {{$pending ? 'Request Again' : 'Get early access'}}
                        </button>
                    </form>
                </div>
                @error('email')
                <p class="mt-1 text-base text-red-700">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-base text-stone-700">No spam. One or two emails a month. Unsubscribe anytime.</p>
            @endif

        </div>
    </section>
@endsection
