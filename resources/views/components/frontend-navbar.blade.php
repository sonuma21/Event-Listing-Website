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
                    <input class="w-full text-black border border-[var(--cyan)] px-4 py-2 pr-12 rounded-full"
                        type="text" name="q" placeholder="search event">
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
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t text-[var(--cyan)] border-gray-200">
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
                            <form id="event-request-form" action="{{ route('request_event') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label for="name" class="block mb-2 text-sm">Your Name: <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                                            class="w-full text-gray-900 rounded-xl @error('name') border-red-500 @enderror" placeholder="Enter your full name">
                                        @error('name')
                                            <div class="error-message text-red-500 text-sm mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div id="name-error" class="error-message text-red-500 text-sm mt-1 hidden">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="email" class="block px-1 mb-2 text-sm">Your Email: <span
                                                class="text-red-500">*</span></label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                                            class="w-full text-gray-900 rounded-xl @error('email') border-red-500 @enderror" placeholder="example@gmail.com">
                                        @error('email')
                                            <div class="error-message text-red-500 text-sm mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div id="email-error" class="error-message text-red-500 text-sm mt-1 hidden">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="phone" class="block px-1 mb-2 text-sm">Your Phone number:<span
                                                class="text-red-500">*</span></label>
                                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                            class="w-full text-gray-900 rounded-xl @error('phone') border-red-500 @enderror" placeholder="98XXXXXXXX">
                                        @error('phone')
                                            <div class="error-message text-red-500 text-sm mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div id="phone-error" class="error-message text-red-500 text-sm mt-1 hidden">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="title" class="block px-1 mb-2 text-sm">Event Title:<span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                                            class="w-full text-gray-900 rounded-xl @error('title') border-red-500 @enderror" placeholder="Enter event title">
                                        @error('title')
                                            <div class="error-message text-red-500 text-sm mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div id="title-error" class="error-message text-red-500 text-sm mt-1 hidden">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="date" class="block px-1 mb-2 text-sm">Event Date:<span
                                                class="text-red-500">*</span></label>
                                        <input type="date" name="date" id="date"
                                            value="{{ old('date') }}"
                                            class="w-full text-gray-900 rounded-xl @error('date') border-red-500 @enderror"
                                            min="{{ now()->format('Y-m-d') }}">
                                        @error('date')
                                            <div class="error-message text-red-500 text-sm mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div id="date-error" class="error-message text-red-500 text-sm mt-1 hidden">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="time" class="block px-1 mb-2 text-sm">Event Time:<span
                                                class="text-red-500">*</span></label>
                                        <input type="time" name="time" id="time"
                                            value="{{ old('time') }}"
                                            class="w-full text-gray-900 rounded-xl @error('time') border-red-500 @enderror">
                                        @error('time')
                                            <div class="error-message text-red-500 text-sm mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div id="time-error" class="error-message text-red-500 text-sm mt-1 hidden">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="location" class="block px-1 mb-2 text-sm">Event Location:<span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="location" id="location"
                                            value="{{ old('location') }}"
                                            class="w-full text-gray-900 rounded-xl @error('location') border-red-500 @enderror" placeholder="Enter event location">
                                        @error('location')
                                            <div class="error-message text-red-500 text-sm mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div id="location-error"
                                            class="error-message text-red-500 text-sm mt-1 hidden"></div>
                                    </div>
                                    <div>
                                        <label for="images" class="block px-1 mb-2 text-sm">Previously Conducted
                                            Events Photos:</label>
                                        <input type="file" class="w-full rounded-xl" name="image[]"
                                            id="image" multiple accept="image/*">
                                        @error('image')
                                            <div class="error-message text-red-500 text-sm mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @error('image.*')
                                            <div class="error-message text-red-500 text-sm mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div id="image-error" class="error-message text-red-500 text-sm mt-1 hidden">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="categories" class="block text-sm mb-2">Select categories:<span
                                                class="text-red-500">*</span></label>
                                        <div
                                            class="w-full px-3 py-1.25 grid grid-cols-2 border border-slate-500 rounded-xl transition ease-in-out overflow-y-auto">
                                            @foreach ($categories as $category)
                                                <div class="flex items-center mb-2">
                                                    <input type="checkbox" id="category-{{ $category->id }}"
                                                        name="categories[]" value="{{ $category->id }}"
                                                        class="h-4 w-4 text-[var(--cyan)] border-gray-300 rounded focus:ring-[var(--cyan)]"
                                                        {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                                                    <label for="category-{{ $category->id }}"
                                                        class="ml-2 text-sm text-white hover:text-[var(--cyan)]">
                                                        {{ $category->eng_title }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('categories')
                                            <div class="error-message text-red-500 text-sm mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div id="categories-error"
                                            class="error-message text-red-500 text-sm mt-1 hidden"></div>
                                    </div>
                                    <div class="relative col-span-2">
                                        <div class="mb-2 mt-3">
                                            <label class="inline-flex items-center mr-4">
                                                <input type="radio" name="feesOption" value="required"
                                                    class="mr-2" onchange="toggleFees(this.value)"
                                                    {{ old('feesOption') == 'required' ? 'checked' : '' }}>
                                                <span>Fees Required</span>
                                            </label>
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="feesOption" value="not-required"
                                                    class="mr-2" onchange="toggleFees(this.value)"
                                                    {{ old('feesOption') != 'required' ? 'checked' : '' }}>
                                                <span>No Fees</span>
                                            </label>
                                        </div>
                                        @error('feesOption')
                                            <div class="error-message text-red-500 text-sm mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div id="feesOption-error"
                                            class="error-message text-red-500 text-sm mt-1 hidden"></div>
                                        <div id="feesContainer"
                                            class="relative flex items-center {{ old('feesOption') == 'required' ? '' : 'hidden' }}">
                                            <label for="fees" class="block px-1 mb-2 text-sm">Event Fees:<span
                                                    class="text-red-500">*</span></label>
                                            <div class="relative flex items-center">
                                                <span class="absolute left-3 text-gray-500">NRP</span>
                                                <input type="number" name="fees" id="fees" step="5.00"
                                                    min="0" value="{{ old('fees') }}"
                                                    class="w-full pl-12 text-gray-900 rounded-xl  @error('fees') border-red-500 @enderror">
                                            </div>
                                            @error('fees')
                                                <div class="error-message text-red-500 text-sm mt-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div id="fees-error"
                                                class="error-message text-red-500 text-sm mt-1 hidden"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-center items-center mt-6">
                                    <button type="submit" id="submit-btn"
                                        class="border-2 border-[var(--cyan)] px-6 py-3 text-white rounded-xl hover:scale-105">
                                        Send Request
                                    </button>
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

            <script></script>


        </div>



    </nav>
</section>
<script>
    function toggleFees(value) {
        const feesContainer = document.getElementById('feesContainer');
        const feesInput = document.getElementById('fees');
        feesContainer.classList.toggle('hidden', value !== 'required');
        feesInput.required = value === 'required';
    }

    // Enhanced form submission to handle AJAX and modal persistence
    document.getElementById('event-request-form').addEventListener('submit', function(event) {
        // Reset previous client-side error messages (preserve server errors)
        document.querySelectorAll('.error-message').forEach(error => {
            if (!error.classList.contains('server-error')) {
                error.textContent = '';
                error.classList.add('hidden');
            }
        });

        let hasErrors = false;

        // Client-side validation for immediate feedback
        const requiredFields = [{
                id: 'name',
                message: 'Name is required'
            },
            {
                id: 'email',
                message: 'A valid email is required'
            },
            {
                id: 'phone',
                message: 'Phone number is required'
            },
            {
                id: 'title',
                message: 'Event title is required'
            },
            {
                id: 'date',
                message: 'Event date is required'
            },
            {
                id: 'time',
                message: 'Event time is required'
            },
            {
                id: 'location',
                message: 'Event location is required'
            }
        ];

        requiredFields.forEach(field => {
            const input = document.getElementById(field.id);
            if (!input.value.trim()) {
                showError(field.id, field.message);
                hasErrors = true;
            }
        });

        // Email format check
        const emailInput = document.getElementById('email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailInput.value && !emailRegex.test(emailInput.value)) {
            showError('email', 'Please enter a valid email address');
            hasErrors = true;
        }

        // Categories check
        const categories = document.querySelectorAll('input[name="categories[]"]:checked');
        if (categories.length === 0) {
            showError('categories', 'At least one category is required');
            hasErrors = true;
        }

        // Fees check
        const feesOption = document.querySelector('input[name="feesOption"]:checked');
        if (feesOption && feesOption.value === 'required') {
            const feesInput = document.getElementById('fees');
            if (!feesInput.value || feesInput.value < 0) {
                showError('fees', 'Please enter a valid fee amount');
                hasErrors = true;
            }
        }

        // Phone number format check (Nepali mobile)
        const phoneInput = document.getElementById('phone');
        const phoneRegex = /^98[0-9]{8}$/;
        if (phoneInput.value && !phoneRegex.test(phoneInput.value.replace(/\D/g, ''))) {
            showError('phone', 'Phone number must start with 98 followed by 8 digits (Nepali mobile format)');
            hasErrors = true;
        }

        // Name format check (letters and spaces only, starting with letter)
        const nameInput = document.getElementById('name');
        const nameRegex = /^[A-Za-z][A-Za-z\s]*$/;
        if (nameInput.value && !nameRegex.test(nameInput.value.trim())) {
            showError('name', 'Name must start with an alphabet letter and contain only letters and spaces');
            hasErrors = true;
        }

        // Gmail email check
        const gmailRegex = /^.+@gmail\.com$/;
        if (emailInput.value && !gmailRegex.test(emailInput.value.toLowerCase())) {
            showError('email', 'Email must be a Gmail address (e.g., example@gmail.com)');
            hasErrors = true;
        }

        if (hasErrors) {
            event.preventDefault();
            return false;
        }

        // If no client errors, submit via AJAX to handle server validation
        submitFormAJAX(this);
        event.preventDefault();
    });

    function showError(fieldId, message) {
        let errorElement = document.getElementById(fieldId + '-error');
        if (!errorElement) {
            // Fallback for categories and feesOption
            if (fieldId === 'categories') {
                errorElement = document.getElementById('categories-error');
            } else if (fieldId === 'feesOption') {
                errorElement = document.getElementById('feesOption-error');
            } else if (fieldId === 'image') {
                errorElement = document.getElementById('image-error');
            } else if (fieldId === 'fees') {
                errorElement = document.getElementById('fees-error');
            }
        }

        if (errorElement) {
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
            // Mark as client error to distinguish from server
            errorElement.classList.remove('server-error');
            errorElement.classList.add('client-error');
        }

        // Highlight invalid field
        const input = document.getElementById(fieldId);
        if (input) {
            input.classList.add('border-red-500');
            input.classList.add('shake'); // Add shake animation for emphasis
        }

        // For categories, highlight the container
        if (fieldId === 'categories') {
            const container = document.querySelector('.grid.grid-cols-2.border');
            if (container) {
                container.classList.add('border-red-500');
            }
        }

        // For feesOption, highlight radio inputs
        if (fieldId === 'feesOption') {
            const radios = document.querySelectorAll('input[name="feesOption"]');
            radios.forEach(radio => radio.classList.add('border-red-500'));
        }
    }

    // CSS for shake animation (inline for demo)
    const style = document.createElement('style');
    style.textContent = `
        .shake {
            animation: shake 0.5s ease-in-out;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        .error-message {
            transition: opacity 0.3s ease;
        }
        .error-message:not(.hidden) {
            opacity: 1;
        }
    `;
    document.head.appendChild(style);

    function submitFormAJAX(form) {
        const formData = new FormData(form);
        const submitBtn = document.getElementById('submit-btn');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Sending...';
        submitBtn.disabled = true;

        fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    return response.json().catch(() => response.text()).then(data => {
                        throw new Error(data || 'Server error');
                    });
                }
            })
            .then(data => {
                if (data.success) {
                    // Success - close modal or show success message
                    // Replace alert with your toast notification
                    if (typeof toast !== 'undefined') {
                        toast("Your request is submitted successfully", "success");
                    } else {
                        alert('Request submitted successfully!');
                    }
                    const modal = document.getElementById('request-modal');
                    if (window.Flowbite && window.Flowbite.Modal) {
                        const instance = window.Flowbite.Modal.getInstance(modal) || new window.Flowbite.Modal(
                            modal);
                        instance.hide();
                    } else {
                        modal.classList.add('hidden');
                    }
                    // Redirect or refresh as needed
                    window.location.href = "{{ route('home') }}";
                }
            })
            .catch(error => {
                let errors = {};
                // Handle Laravel validation errors (usually in response body as JSON)
                if (error.message && typeof error.message === 'string') {
                    try {
                        errors = JSON.parse(error.message);
                    } catch (e) {
                        // If not JSON, check if it's a ValidationException response
                        console.error('Server error:', error.message);
                        alert('An error occurred. Please try again.');
                        return;
                    }
                } else if (error.response && error.response.data) {
                    errors = error.response.data.errors || error.response.data;
                }

                // Display server errors for each invalid field
                if (typeof errors === 'object' && Object.keys(errors).length > 0) {
                    Object.keys(errors).forEach(field => {
                        const messages = Array.isArray(errors[field]) ? errors[field] : [errors[field]];
                        messages.forEach(message => {
                            showServerError(field, message);
                        });
                    });
                } else {
                    alert('An error occurred. Please try again.');
                }
            })
            .finally(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
    }

    function showServerError(fieldId, message) {
        let errorElement = document.getElementById(fieldId + '-error');
        if (!errorElement) {
            // Fallback for special fields
            if (fieldId === 'categories') {
                errorElement = document.getElementById('categories-error');
            } else if (fieldId === 'feesOption') {
                errorElement = document.getElementById('feesOption-error');
            } else if (fieldId === 'image' || fieldId === 'image.*') {
                errorElement = document.getElementById('image-error');
            } else if (fieldId === 'fees') {
                errorElement = document.getElementById('fees-error');
            }
        }

        if (errorElement) {
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
            errorElement.classList.add('server-error');
            errorElement.classList.remove('client-error');
        }

        // Highlight invalid field with red border and shake animation
        const input = document.getElementById(fieldId);
        if (input) {
            input.classList.add('border-red-500', 'shake');
        }

        // Special handling for categories
        if (fieldId === 'categories') {
            const container = document.querySelector('.grid.grid-cols-2.border');
            if (container) {
                container.classList.add('border-red-500');
            }
        }

        // Special handling for feesOption
        if (fieldId === 'feesOption') {
            const radios = document.querySelectorAll('input[name="feesOption"]');
            radios.forEach(radio => radio.parentElement.classList.add('text-red-500'));
        }

        // For image errors
        if (fieldId === 'image' || fieldId === 'image.*') {
            const fileInput = document.getElementById('image');
            if (fileInput) {
                fileInput.classList.add('border-red-500', 'shake');
            }
        }
    }

    // Auto-open modal on page load if there are server errors (non-AJAX fallback)
    @if ($errors->any())
        <
        script >
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('request-modal');
                if (modal && modal.classList.contains('hidden')) {
                    modal.classList.remove('hidden');
                    // Show server errors in client-side elements too
                    @foreach ($errors->all() as $error)
                        console.log('Server error: {{ $error }}');
                    @endforeach
                    // If using Flowbite, initialize/open modal
                    if (window.Flowbite && window.Flowbite.Modal) {
                        const instance = new window.Flowbite.Modal(modal);
                        instance.show();
                    }
                }
                // Highlight fields with server errors
                @foreach ($errors->keys() as $field)
                    const input = document.getElementById('{{ $field }}');
                    if (input) {
                        input.classList.add('border-red-500', 'shake');
                    }
                @endforeach
            });
</script>
@endif

// Clear errors on input focus to allow re-validation
document.addEventListener('DOMContentLoaded', function() {
const inputs = document.querySelectorAll('input, select, textarea');
inputs.forEach(input => {
input.addEventListener('focus', function() {
const fieldId = this.id || this.name.replace('[]', '');
const errorElement = document.getElementById(fieldId + '-error') || document.querySelector(`[for="${fieldId}"] +
.error-message`);
if (errorElement && !errorElement.classList.contains('server-error')) {
errorElement.textContent = '';
errorElement.classList.add('hidden');
this.classList.remove('border-red-500', 'shake');
}
});
});
});
</script>
