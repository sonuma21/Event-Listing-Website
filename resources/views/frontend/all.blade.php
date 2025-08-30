<x-frontend-layout>
     <section class="py-16 home-color">
        <div class="container flex flex-col gap-8">
            <div class="text-3xl text-white font-semibold text-center">
                <h1>All Events</h1>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 py-8">
                @foreach ($events as $event)
                     <x-event-card :event="$event" />
                @endforeach
            </div>
        </div>
 </section>
</x-frontend-layout>
