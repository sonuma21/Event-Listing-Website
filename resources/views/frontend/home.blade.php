<x-frontend-layout>

    {{-- Hero Section --}}

    <section class="">
        <div class="carousel-container">
            <div class="carousel">
                <div class="carousel-slide">
                    <img src="https://cdn.evbstatic.com/s3-build/fe/build/images/ce8b59a5f92f51cefbb4209ee83c0c0d-music_desktop.webp"
                        alt="Slide 1">
                    {{-- <div class="carousel-caption"></div> --}}
                </div>
                <div class="carousel-slide">
                    <img src="https://cdn.evbstatic.com/s3-build/fe/build/images/ce8b59a5f92f51cefbb4209ee83c0c0d-music_desktop.webp"
                        alt="Slide 2">
                    {{-- <div class="carousel-caption"></div> --}}
                </div>
                <div class="carousel-slide">
                    <img src="https://cdn.evbstatic.com/s3-build/fe/build/images/ce8b59a5f92f51cefbb4209ee83c0c0d-music_desktop.webp"
                        alt="Slide 3">
                    {{-- <div class="carousel-caption"></div> --}}
                </div>
            </div>
            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>
            <div class="dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </section>


    {{-- categories --}}

    <section class="py-4">
        <div class="container">
            <div class="pb-8 flex justify-center items-center">
                <h1 class="text-black text-3xl  border-b-[1px] max-w-fit">Browse through your desired interest</h1>
            </div>
            <div class="hidden lg:flex items-center justify-center">
                <ul class="flex gap-6">
                    @foreach ($categories as $category)
                        <li class="flex flex-col items-center">
                            <a href="{{ route('category', $category->slug) }}"
                                class="flex flex-col items-center text-gray-800 no-underline hover:scale-105 transition-transform duration-200">
                                <div
                                    class="w-30 h-30 rounded-full bg-white border-2 border-gray-300 flex items-center justify-center overflow-hidden shadow-sm hover:shadow-md">
                                    <img src="{{ asset('storage/' . $category->image)}}"
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

    <section>
        <div class="container space-y-10">

            @foreach ($categories as $category)
                <div>
                    <h1
                        class="text-3xl mb-5 bg-light-primary py-2 px-3 border-l-4 border-[var(--primary)] mt-5 primary rounded-lg shadow-md">
                        {{ $category->eng_title }}
                    </h1>
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
