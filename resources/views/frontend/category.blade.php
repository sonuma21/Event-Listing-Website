<x-frontend-layout>
     <section>
        <div class="container">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 py-8">
                @foreach ($categoryevents as $categoryevent)
                     <x-event-card :event="$categoryevent" />
                @endforeach
            </div>
        </div>
 </section>
</x-frontend-layout>
