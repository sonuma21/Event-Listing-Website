@props(['event'])
<div class="event-card flex flex-col max-w-sm min-h-[250px] border rounded-lg shadow hover:shadow-xl transition-shadow duration-200">
    <a href="{{route('event', $event->id)}}" class="no-underline text-gray-900">
        <div class=" w-full aspect-[16/9]">
            <img src="{{ $event->images && !empty($event->images) ? asset('storage/' . $event->images[0]) : asset('images/default.jpg') }}"
                 alt="{{ $event->title }}"
                 class="w-full h-full object-cover rounded-t-lg">
        </div>
        <div class="p-4 flex-grow">
            <h5 class="text-lg truncate mb-0">{{ $event->title }}</h5>
            <p>Date: {{$event->date}}</p>
            <p>Time: {{ \Carbon\Carbon::parse($event->time)->timezone('Asia/Kathmandu')->format('h:i A') }}</p>
            <p>Location:{{$event->location}}</p>
        </div>
    </a>
</div>
