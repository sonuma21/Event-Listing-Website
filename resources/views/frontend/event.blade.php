<style>
    .qtyminus,
    .qtyplus {
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        padding: 5px 10px;
        cursor: pointer;
        font-size: 16px;
        border-radius: 5px;
    }

    .qtyminus:hover,
    .qtyplus:hover {
        background-color: #e0e0e0;
    }

    input#quantity {
        width: 50px;
        text-align: center;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
</style>
<x-frontend-layout>

    {{-- Event Details --}}

    <section class="py-10">

        <div class="container grid grid-cols-12 pb-2.5 border-b-[1px]">
            <div class="flex flex-col col-span-8 px-6 ">

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
            <div class="col-span-4 ml-5 bg-[var(--gray)] text-slate-300 rounded-xl px-6 py-4">
                <div class="flex flex-col gap-4 ">
                    <div class="mb-4 border-[1px] rounded-lg px-4 py-2">
                        <p class="font-semibold text-center pb-4">{{ $event->title }}</p>
                        <div class="flex items-center justify-between">
                            <p class="">Date: {{ $event->date }}</p>
                            <p>Time:
                                {{ \Carbon\Carbon::parse($event->time)->timezone('Asia/Kathmandu')->format('h:i A') }}
                            </p>
                        </div>
                        <div class="">
                            <input type="text" name="event_id" value="{{ $event->id }}" hidden>
                            <div class="flex justify-between items-center">
                                <label for="quantity">Quantity: </label>
                                <div class="flex gap-0.5 text-slate-500">
                                    <button type="button" class="qtyminus">-</button>
                                    <input type="text" id="quantity" name="quantity" value="1" readonly>
                                    <button type="button" class="qtyplus">+</button>
                                </div>
                            </div>
                            <div class="w-full flex justify-center items-center pt-4">
                                <button type="button" class="w-full px-3 py-2 rounded-lg bg-green-600 hover:bg-green-900 text-white "
                                    data-modal-target="get-ticket-modal" data-modal-toggle="get-ticket-modal">Get
                                    Tickets</button>

                            </div>
                            <!-- Modal -->
                            <div id="get-ticket-modal" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Order
                                                Summary
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="get-ticket-modal">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <div class="py-10 flex flex-col gap-1">
                                            <div class="container">
                                                <img class="shadow-lg w-full object-cover"
                                                    src="{{ $event->images && !empty($event->images) ? asset('storage/' . $event->images[0]) : asset('images/default.jpg') }}"
                                                    alt="{{ $event->name }}">

                                            </div>
                                            <div
                                                class=" container justify-center text-slate-500 items-center border-[1px] px-6 py-4 rounded-lg">
                                                <h1 class="font-medium">{{ $event->title }}</h1>
                                                <div class="flex items-center justify-between gap-2 mt-2">
                                                    <label for="modal-quantity">Quantity:</label>
                                                    <div class="flex items-center gap-0.5">
                                                        <button type="button" onclick="updateQuantity(-1)"
                                                            class="qtyminus">-</button>
                                                        <input type="number" id="modal-quantity" value="1"
                                                            min="1"
                                                            class="w-[50px] flex justify-center p-[5px] text-center border-[1px] rounded-[5px] border-gray-200"
                                                            readonly>
                                                        <button type="button" onclick="updateQuantity(1)"
                                                            class="qtyplus">+</button>
                                                    </div>
                                                </div>
                                                <p id="modal-amount">Amount: Npr. {{ $event->fees }}</p>


                                            </div>
                                            <div class="container flex justify-end items-center">
                                                <div>
                                                    <form action="{{ route('checkout') }}" method="POST">
                                                        @csrf
                                                        <input type="text" name="organizer_id"
                                                            value="{{ $event->organizer_id }}" hidden>
                                                        <input type="text" name="quantity" id="form-quantity"
                                                            value="1" hidden>
                                                        <input type="text" name="total_amount" id="form-total-amount"
                                                            value="{{ $event->fees }}" hidden>
                                                        <input type="text" name="event_id"
                                                            value="{{ $event->id }}" hidden>
                                                        <button type="submit"
                                                            class="w-full px-3 py-2 rounded-lg bg-green-600 text-white mt-4"
                                                            data-modal-hide="get-ticket-modal">Check out</button>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


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
                            <i class="fa-solid fa-phone-volume"></i> {{ $organizer->phone }}

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
                <div class="grid grid-cols-1 sm:grid-cols-4 py-8 gap-3">
                    @foreach ($relatedEvents as $relatedEvent)
                        <x-event-card :event="$relatedEvent" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-frontend-layout>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Initialize variables
        const qtyMinus = document.querySelector('.qtyminus');
        const qtyPlus = document.querySelector('.qtyplus');
        const qtyInput = document.querySelector('#quantity'); // Main page quantity input, if exists
        const modalQuantity = document.querySelector('#modal-quantity');
        const modalAmount = document.querySelector('#modal-amount');
        const formQuantityInput = document.querySelector('#form-quantity');
        const formTotalAmountInput = document.querySelector('#form-total-amount');
        const eventFees = parseFloat('{{ $event->fees }}') || 0; // Safely parse fees, default to 0 if invalid

        // Update quantity and amount
        window.updateQuantity = function(change) {
            let value = parseInt(modalQuantity.value) + change;
            if (value < 1) value = 1; // Prevent quantity from going below 1
            modalQuantity.value = value;
            if (qtyInput) qtyInput.value = value; // Sync with main input, if exists
            formQuantityInput.value = value; // Update hidden form input
            updateAmount(value);
        };

        // Update amount based on quantity
        function updateAmount(quantity) {
            const total = (eventFees * quantity).toFixed(2); // Calculate total with 2 decimal places
            modalAmount.textContent = `Amount: Npr. ${total}`; // Update amount display
            formTotalAmountInput.value = total; // Update hidden form input
        }

        // Update quantity on minus click
        if (qtyMinus) {
            qtyMinus.addEventListener('click', () => {
                updateQuantity(-1);
            });
        }

        // Update quantity on plus click
        if (qtyPlus) {
            qtyPlus.addEventListener('click', () => {
                updateQuantity(1);
            });
        }

        // Sync modal quantity and amount with main input when modal is shown
        document.addEventListener('show.bs.modal', () => {
            if (qtyInput) modalQuantity.value = qtyInput.value || 1;
            updateAmount(parseInt(modalQuantity.value));
        });

        // Initialize amount and form inputs on page load
        updateAmount(parseInt(modalQuantity.value));
    });
</script>
