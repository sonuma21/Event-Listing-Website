<x-frontend-layout>

    <section>

        <div class="container py-10">

            <h2 class="text-3xl font-bold text-black text-center ">
                "Compare Result for {{$q}}"
            </h2>
             <div class="grid grid-cols-3 gap-4 py-5">
                @foreach ($results as $event)
                     <x-event-card :event="$event"/>
                 @endforeach
             </div>
        </div>
    </section>
</x-frontend-layout>
