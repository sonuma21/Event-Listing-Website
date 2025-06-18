<section class="bg-black">
    <div class="container text-white flex items-center justify-center">
        Create your event
    </div>
</section>
<section class="bg-[var(--primary)]">
    <nav>
        <div class="container flex justify-between items-center py-2 text-black">
            <div class="">
                <img src="" alt="">
            </div>
            <div>
                <form action="#" method="get">
                    <input type="search " name="search" placeholder="search event"
                        class="border rounded-full px-4 py-1.5">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>

                </form>
            </div>
            <div>
                <button type="button" class="bg-[var(--secondary)] text-white px-4 py-2 rounded-2xl"
                    data-modal-target="request-modal" data-modal-toggle="request-modal">Create
                    Event</button>
            </div>


            <!-- Main modal -->
            <div id="request-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h1 class="text-3xl">
                                Create Your Event
                            </h1>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-hide="default-modal">
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
                            <form action="{{route('request_event')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label for="name" class="block mb-2 text-sm">Your Name:</label>
                                        <input type="text" name="name" id="name"
                                            class="w-full rounded-xl required">
                                    </div>
                                    <div>
                                        <label for="email" class="block px-1 mb-2 text-sm">Your Email:</label>
                                        <input type="email" name="email" id="email"
                                            class="w-full rounded-xl required">
                                    </div>
                                    <div>
                                        <label for="phone" class="block px-1 mb-2 text-sm">Your Phone number:</label>
                                        <input type="tel" name="phone" id="phone"
                                            class="w-full rounded-xl required">
                                    </div>
                                    <div>
                                        <label for="title" class="block px-1 mb-2 text-sm">Event Title:</label>
                                        <input type="text" name="title" id="title"
                                            class="w-full rounded-xl required">
                                    </div>
                                    <div>
                                        <label for="date" class="block px-1 mb-2 text-sm">Event Date:</label>
                                        <input type="date" name="date" id="date"
                                            class="w-full rounded-xl required">
                                    </div>
                                    <div>
                                        <label for="time" class="block px-1 mb-2 text-sm">Event Time:</label>
                                        <input type="time" name="time" id="time"
                                            class="w-full rounded-xl required">
                                    </div>
                                    <div>
                                        <label for="name" class="block px-1 mb-2 text-sm">Event Location:</label>
                                        <input type="text" name="location" id="location"
                                            class="w-full rounded-xl required">
                                    </div>
                                    <div>
                                        <label for="images" class="block px-1 mb-2 text-sm">Previously Conducted Events Photos:</label>
                                        <input type="file" class="w-full rounded-xl" name="image[]" id="image" multiple accept="image/*">
                                    </div>
                                    <div>
                                        <button class="bg-[var(--primary)] px-3 py-2 rounded-xl hover:scale-105">Send
                                            Request</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div>
                <button>Login</button>
                <button>Register</button>
            </div>
            <div>
                <button type="button"
                    class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full"
                        src="data:image/jpeg;base64,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"
                        alt="user photo">
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 dark:divide-gray-600"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">Bonnie Green</span>
                        <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">name@flowbite.com</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</section>
