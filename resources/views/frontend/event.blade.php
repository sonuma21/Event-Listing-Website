<x-frontend-layout>

    {{-- Event Details --}}

    <section class="py-10">

        <div class="container grid grid-cols-12 pb-2.5 border-b-[1px]">
            <div class="flex flex-col col-span-8 px-6 border-r-[4px] ">

                <div class="w-full">
                    <img class="rounded-lg shadow-lg w-full object-cover"
                        src="{{ $event->images && !empty($event->images) ? asset('storage/' . $event->images[0]) : asset('images/default.jpg') }}"
                        alt="{{ $event->name }}">

                </div>
                <div class="ml-5">
                    <div class="">
                        <h1 class="text-4xl font-semibold text-black border-slate-500 mt-5 mb-3 py-2.5 border-b-[1px]">
                            {{ $event->title }}
                        </h1>
                    </div>
                    <div class="font-semibold text-lg mt-5 pb-2.5 border-b-[1px]">
                        <p>Date: {{ $event->date }}</p>
                        <p>Time: {{ \Carbon\Carbon::parse($event->time)->timezone('Asia/Kathmandu')->format('h:i A') }}
                        </p>
                        <p>Location: {{ $event->location }}</p>
                        <p>Fees:
                            @if ($event->fees && $event->fees > 0)
                                <span>Rs. {{ $event->fees }}/-</span>
                            @else
                                <span class=" bg-green-500 text-white   px-4 py-0.5  rounded-lg">Free</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <h1 class="text-lg py-2.5 border-b-[1px] border-slate-500 text-blue-600 ">Organized By:
                            {{ $organizer->name }}
                        </h1>
                    </div>
                    <div>
                        <h1 class="text-lg py-2.5 font-bold ">Refund Policy:

                        </h1>
                        <ul class="list-disc pl-5 text-lg space-y-3">
                            <li><strong>Eligibility for Refunds</strong>: Refunds are available if requested at least 7
                                days before the event date
                                ({{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}). Requests after this
                                period may not be honored.</li>
                            <li><strong>Event Cancellation</strong>: If the event is canceled by the organizer
                                ({{ $event->organizer ? $event->organizer->name : 'Unknown Organizer' }}), a full refund
                                will be issued to all ticket holders.</li>
                            <li><strong>Attendee Cancellation</strong>: Cancellations by attendees within 7 days of
                                purchase are eligible for a full refund. Cancellations after this period but before the
                                7-day pre-event deadline may receive a 50% refund.</li>
                            <li><strong>Processing Time</strong>: Approved refunds will be processed within 7-14
                                business days and returned to the original payment method.</li>
                            <li><strong>Non-Refundable Cases</strong>: No refunds will be issued for no-shows or
                                cancellations after the 7-day pre-event deadline.</li>
                            <li><strong>Contact Us</strong>: To request a refund, please contact our support team at <a
                                    href="mailto:support@eventछ.com.np"
                                    class="text-blue-600 hover:underline">support@eventछ.com.np</a> with your ticket
                                details.</li>
                        </ul>

                    </div>

                </div>


            </div>
            <div class="col-span-4 ml-5">
                <div class="flex flex-col gap-4 ">
                    <div class="mb-4">
                        <button>payment</button>
                    </div>
                    <div>
                        <div class="mb-4">
                            <h1 class="text-lg font-bold py-2.5">Requirements:</h1>
                            <ul class="list-disc list-inside">
                                 {!! $event->requirements ?? 'No requirements' !!}
                            </ul>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold">
                            Contact no.
                        </h1>
                        <p>
                            <i class="fa-solid fa-phone-volume"></i> {{$organizer->phone}}

                        </p>
                        <p class="text-sm mt-2.5 text-blue-400">
                            For any query feel free to contant given number.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Other Events You May Like --}}
    <section>
        <div class="container">
            <div>
                <div class="flex items-center pb-2.5 font-bold text-3xl text-black border-b-[1px] border-slate-500">
                    <h1>Other Events You May Like</h1>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-4 py-8">
                    @foreach ($relatedEvents as $relatedEvent)
                        <x-event-card :event="$relatedEvent" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-frontend-layout>
