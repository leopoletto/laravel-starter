@extends('layouts.app')

@section('content')
    <section class="relative min-h-screen hero grid grid-rows-12 justify-center pb-24 border-b border-b-stone-400">
        <div class="row-span-8 mx-auto max-w-3xl px-6 justify-end  text-center flex flex-col gap-5">
            <header>
                <nav
                    class="mx-auto flex w-full max-w-3xl items-center justify-evenly"
                    aria-label="Global"
                >
                    <div class="mx-auto flex self-center">
                        <x-brand.wrapper>
                            <x-slot:symbol>
                                <x-brand.symbol />
                            </x-slot>
                            <x-slot:logo>
                                <x-brand.logo  />
                            </x-slot>
                        </x-brand.wrapper>
                    </div>
                </nav>
            </header>
            <h1 class="text-6xl font-headline font-semibold leading-tight tracking-tight text-smoky-black-600">
                <span class="text-emerald">Interactive audits</span>, <br>explained by experts.
            </h1>
            <p class="text-xl text-stone-600">
                We turn Lighthouse audits into guided lessons.
                See why each issue matters, across network, rendering, accessibility, and more.
            </p>

            @if(session('message'))
            <p class="mt-3 text-2xl text-emerald-300">{{session('message')}}</p>
            @else
            <form class="mt-4 group flex gap-3 justify-center" action="{{ route('register') }}" method="post">
                @csrf

                <input name="email" type="email" required
                       class="w-full py-4 bg-white max-w-sm rounded-xl border border-stone-600 px-4 text-stone-900 placeholder-stone-400 focus:outline-none focus:ring-2 focus:border-transparent focus:ring-emerald"
                       placeholder="your@email.com">
                <button type="submit"
                        class="rounded-xl bg-emerald-600 px-5 py-3 font-medium text-emerald-100  transition-all border-b-1 hover:border-b-4 hover:border-b-smoky-black active:border-b-1 shadow-sm  focus:outline-none focus:ring-2 focus:ring-emerald-600">
                    Get early access
                </button>
            </form>
            @error('email')
            <p class="mt-3 text-base text-red-700">{{ $message }}</p>
            @enderror
            <p class="mt-3 text-base text-stone-700">No spam. One or two emails a month. Unsubscribe anytime.</p>
            @endif




        </div>
        <span class="row-span-4"></span>
    </section>
@endsection
