<x-frontend-layout>
     <section class="py-16">
        <div class="container flex flex-col gap-8">
            <div class="text-3xl font-semibold text-center">
                <h1>Events Related to {{$category->eng_title}}</h1>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 py-8">
                @foreach ($categoryevents as $categoryevent)
                     <x-event-card :event="$categoryevent" />
                @endforeach
            </div>
        </div>
 </section>
</x-frontend-layout>
