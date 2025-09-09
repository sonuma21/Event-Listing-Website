<x-frontend-layout>

    {{-- Hero Section --}}

    <section class="bg-[var(--primary)]">
        <div class="carousel-container">
            <div class="carousel" id="carousel">
                @foreach ($carousels as $index => $carousel)
                    @php
                        $images = is_array($carousel->images) ? $carousel->images : [$carousel->images];
                    @endphp
                    @foreach ($images as $image)
                        <div class="carousel-slide">
                            <img src="{{ asset('storage/' . $image) }}" alt="Slide {{ $index + 1 }}">
                        </div>
                    @endforeach
                @endforeach
            </div>
            <button class="prev">❮</button>
            <button class="next">❯</button>
            <div class="dots" id="dots">
                @foreach ($carousels as $index => $carousel)
                    @php
                        $images = is_array($carousel->images) ? $carousel->images : [$carousel->images];
                    @endphp
                    @foreach ($images as $imageIndex => $image)
                        <span class="dot {{ $imageIndex === 0 && $index === 0 ? 'active' : '' }}"></span>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>


    {{-- categories --}}

    <section class="pt-12 pb-16 bg-[var(--primary)]">
        <div class="container">
            <div
                class="flex justify-center text-white home-color items-center border-2 rounded-full border-[var(--cyan)] max-w-fit mx-auto px-4 py-2">
                <h1 class=" text-3xl">Browse through your desired interest</h1>
            </div>
            <div class="hidden lg:flex items-center pt-8 justify-center">
                <ul class="flex gap-6">
                    @foreach ($categories as $category)
                        <li class="flex flex-col items-center">
                            <a href="{{ route('category', $category->slug) }}"
                                class="flex flex-col items-center text-[var(--cyan)] no-underline hover:scale-105 transition-transform duration-200">
                                <div
                                    class="w-30 h-30 rounded-full bg-white border-2 border-[var(--cyan)] flex items-center justify-center overflow-hidden shadow-sm hover:shadow-md">
                                    <img src="{{ asset('storage/' . $category->image) }}"
                                        alt="{{ $category->eng_title }}" class="w-full h-full object-cover">
                                </div>
                                <span class="mt-2 text-sm font-medium text-center">{{ $category->eng_title }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- Specific Category --}}

    <section class="home-color py-16">
        <div class="container space-y-10">

            @foreach ($categories as $category)
                <div>
                    <div class="bg-[var(--primary)] text-white border-l-4 border-white shadow-md rounded-lg">
                        <h1
                            class="text-3xl mb-5  py-2 px-3  primary ">
                            {{ $category->eng_title }}
                        </h1>
                    </div>
                    <div class=" grid grid-cols-1 sm:grid-cols-4 gap-3">

                        @foreach ($category->events as $event)
                            <div class="">
                                <x-event-card :event="$event" />
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

        </div>
    </section>

    


</x-frontend-layout>
