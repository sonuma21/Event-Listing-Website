@props(['event'])
<div class="event-card">
    <a href="{{route('event', $event->id)}}">
        <div class="aspect-16-9">
            <img src="{{ $event->images && !empty($event->images) ? asset('storage/' . $event->images[0]) : asset('images/default.jpg') }}"
                 alt="{{ $event->title }}">
        </div>
        <div class="content">
            <h5>{{ $event->title }}</h5>
            <p>Date: {{$event->date}}</p>
            <p>Time: {{ \Carbon\Carbon::parse($event->time)->timezone('Asia/Kathmandu')->format('h:i A') }}</p>
            <p>Location: {{$event->location}}</p>
        </div>
    </a>
</div>
