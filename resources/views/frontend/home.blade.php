<x-frontend-layout>

    {{-- Hero Section --}}

    <section class="">
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

    <section>
        <div class="container space-y-10">

            @foreach ($categories as $category)
                <div>
                    <h1
                        class="text-3xl mb-5  py-2 px-3 border-l-4 border-[var(--primary)] mt-5 primary rounded-lg shadow-md">
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
