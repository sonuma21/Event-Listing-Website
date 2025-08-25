<section class=" bg-[var(--cyan-magic)] text-white">
    <div class="container flex items-center gap-2">
        <div class=" flex gap-1">
            <p>Notices</p> <i class="ml-2 fa-solid fa-bullhorn"></i>
        </div>
        <div class="flex items-center w-full">
            <marquee behavior="scroll" direction="left" onmouseover="this.stop()" onmouseout="this.start()">
                @foreach ($latest_events as $event)
                    <a href="{{ route('event', $event->id) }}"><i class="ml-8 fa-solid fa-bullhorn"></i>
                        {{ $event->title }}</a>
                @endforeach
            </marquee>
        </div>
    </div>
</section>
<section class="bg-[var(--primary)]">
    <nav>
        <div class="container flex justify-between items-center py-2 text-[var(--cyan)]">
            <div class="font-bold flex items-center text-xl  ">
                <a href="{{ route('home') }}">Event छ !!</a>
            </div>
            <div>
                <form action="{{ route('compare') }}" method="get" class="relative w-[300px]">
                    <input class="w-full border border-[var(--cyan)] px-4 py-2 pr-12 rounded-full" type="text"
                        name="q" placeholder="search event">
                    <button
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 font-bold px-3 py-1 text-[var(--cyan)] hover:text-[var(--cyan-magic)] text-lg rounded-full cursor-pointer ">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
            <div>
                <button type="button" class=" text-white border-2 border-[var(--cyan)] px-4 py-2 rounded-2xl"
                    data-modal-target="request-modal" data-modal-toggle="request-modal">Create
                    Event</button>
            </div>


            <!-- Main modal -->
            <div id="request-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-[var(--primary)] text-white rounded-lg shadow-sm">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t text-[var(--cyan)] border-gray-200">
                            <h1 class="text-3xl">
                                Create Your Event
                            </h1>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:text-[var(--cyan)] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-hide="request-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4">
                            <form action="{{ route('request_event') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label for="name" class="block mb-2 text-sm">Your Name: <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                                            class="w-full rounded-xl">
                                        @error('name')
                                            <div class="text-red-500">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="email" class="block px-1 mb-2 text-sm">Your Email: <span
                                                class="text-red-500">*</span></label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                                            class="w-full rounded-xl">
                                        @error('email')
                                            <div class="text-red-500">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="phone" class="block px-1 mb-2 text-sm">Your Phone number:<span
                                                class="text-red-500">*</span></label>
                                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                            class="w-full rounded-xl required">
                                        @error('phone')
                                            <div class="text-red-500">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <div>
                                        <label for="title" class="block px-1 mb-2 text-sm">Event Title:<span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                                            class="w-full rounded-xl">
                                        @error('title')
                                            <div class="text-red-500">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="date" class="block px-1 mb-2 text-sm">Event Date:<span
                                                class="text-red-500">*</span></label>
                                        <input type="date" name="date" id="date" value="{{ old('date') }}"
                                            class="w-full rounded-xl required">
                                        @error('date')
                                            <div class="text-red-500">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="time" class="block px-1 mb-2 text-sm">Event Time:<span
                                                class="text-red-500">*</span></label>
                                        <input type="time" name="time" id="time"
                                            value="{{ old('time') }}" class="w-full rounded-xl required">
                                        @error('time')
                                            <div class="text-red-500">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="name" class="block px-1 mb-2 text-sm">Event Location:<span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="location" id="location"
                                            value="{{ old('location') }}" class="w-full rounded-xl">
                                        @error('location')
                                            <div class="text-red-500">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="images" class="block px-1 mb-2 text-sm">Previously Conducted
                                            Events Photos:</label>
                                        <input type="file" class="w-full rounded-xl" name="image[]"
                                            id="image" multiple accept="image/*">
                                    </div>
                                    <div class="mb-2">
                                        <label for="categories" class="block text-sm mb-2">
                                            Select categories:<span class="text-red-500">*</span>
                                        </label>
                                        <div
                                            class=" w-full px-3 py-1.25 grid grid-cols-2 border border-slate-500 rounded-xl transition ease-in-out overflow-y-auto">
                                            @foreach ($categories as $category)
                                                <div class="flex items-center mb-2">
                                                    <input type="checkbox" id="category-{{ $category->id }}"
                                                        name="categories[]" value="{{ $category->id }}"
                                                        class="h-4 w-4 text-[var(--cyan)] border-gray-300 rounded focus:ring-[var(--cyan)]">
                                                    <label for="category-{{ $category->id }}"
                                                        class="ml-2 text-sm text-white hover:text-[var(--cyan)]">
                                                        {{ $category->eng_title }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <!-- Radio buttons to toggle fees requirement -->
                                        <div class="mb-2 mt-3">
                                            <label class="inline-flex items-center mr-4">
                                                <input type="radio" name="feesOption" value="required"
                                                    class="mr-2" onchange="toggleFees(this.value)">
                                                <span>Fees Required</span>
                                            </label>
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="feesOption" value="not-required"
                                                    class="mr-2" onchange="toggleFees(this.value)" checked>
                                                <span>No Fees</span>
                                            </label>
                                        </div>
                                        <!-- Fees input field, initially hidden -->
                                        <div id="feesContainer"
                                            class="relative flex items-center {{ old('feesOption') == 'required' ? '' : 'hidden' }}">
                                            <label for="fees" class="block px-1 mb-2 text-sm">Event Fees:<span
                                                    class="text-red-500">*</span></label>
                                            <div class="relative flex items-center">
                                                <span class="absolute left-3 text-gray-500">NRP</span>
                                                <input type="number" name="fees" id="fees" step="5.00"
                                                    min="0" value="{{ old('fees') }}"
                                                    class="w-full pl-12 rounded-xl border-slate-500 {{ old('feesOption') == 'required' ? 'required' : '' }}">
                                            </div>
                                            @error('fees')
                                                <div class="text-red-500">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>



                                </div>
                                <div class="flex justify-center items-center mt-6">
                                    <button type="submit"
                                        class="border-2 border-[var(--cyan)] px-6 py-3   text-white rounded-xl hover:scale-105">Send
                                        Request</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <div class="relative">
                <button type="button"
                    class="flex items-center p-2 text-white hover:text-[var(--cyan)] transition duration-150 ease-in-out"
                    id="user-menu-button" aria-expanded="false" aria-haspopup="true"
                    data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <i class="fa-solid fa-user text-xl"></i>
                </button>

                <!-- Dropdown menu -->
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-50 hidden" id="user-dropdown">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="user-menu-button">
                        @guest
                            <li>
                                <a href="{{ route('register') }}"
                                    class="block px-4 py-2 text-blue-600 hover:bg-blue-50 hover:text-blue-800 transition duration-150 ease-in-out">
                                    Sign Up
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}"
                                    class="block px-4 py-2 text-gray-600 hover:bg-blue-50 hover:text-gray-800 transition duration-150 ease-in-out">
                                    Login
                                </a>
                            </li>
                        @else
                            <li>
                                <p class="block px-4 py-2 text-gray-800 font-bold">Welcome {{ Auth::user()->name }}</p>
                            </li>
                            <li>
                                <a href="{{ route('checkout.history') }}"
                                    class="block px-4 py-2 hover:bg-blue-50 hover:text-gray-800 transition duration-150 ease-in-out">
                                    Checkout History

                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 hover:text-red-800 transition duration-150 ease-in-out">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
            <script>
                function toggleFees(value) {
                    const feesContainer = document.getElementById('feesContainer');
                    const feesInput = document.getElementById('fees');
                    feesContainer.classList.toggle('hidden', value !== 'required');
                    feesInput.required = value === 'required';
                }
            </script>

        </div>



    </nav>
</section>
