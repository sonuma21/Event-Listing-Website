<footer class="footer bg-[var(--primary)] text-[var(--cyan)] py-8">
    <div class="container">
        <div class="grid grid-cols-4 gap-8 items-center">
            <div class="col-span-1 mb-6 md:mb-0">
                <a href="{{route('home')}}" class="text-2xl font-bold">Event छ !!</a>
                <p class="text-sm pt-2.5">
                    A dynamic event listing website where users access news from various sources and create legitimate
                    events, fostering community engagement, real-time updates, and seamless event promotion across
                    multiple categories.
                </p>
            </div>
            <!-- Navigation Links -->
            <div class="col-span-1 items-center text-center mb-6 md:mb-0">
                <h3 class="text-lg font-bold mb-4">Explore</h3>
                <ul class="flex flex-col md:flex-row space-y-2 md:space-x-4">
                    <li><a href="{{ route('home') }}"
                            class="hover:text-[var(--cyan)] transition-colors duration-300">Home</a></li>
                    <li><a href="{{ route('events') }}" class="hover:text-[var(--cyan)] transition-colors duration-300">Events</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-[var(--cyan)] transition-colors duration-300">Contact</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-[var(--cyan)] transition-colors duration-300">About Us</a></li>
                </ul>
            </div>
            <div class="col-span-1 mb-6 md:mb-0 items-center text-center">
                <h1 class="text-lg font-bold mb-4">
                    Create Now !!
                </h1>
               <ul class="flex flex-col space-y-2">
                   <li><a href="#">Sports</a></li>
                   <li><a href="#">Music</a></li>
                   <li><a href="#">Workshop</a></li>
                   <li><a href="#">Hackthon</a></li>
               </ul>
            </div>
            <!-- Social Media Icons -->
            <div class="col-span-1 mb-6 md:mb-0">
                <h3 class="text-lg font-bold text-center mb-4">Follow Us</h3>
                <div class="grid grid-rows-4 items-center justify-center space-y-2">
                    <a href="https://facebook.com" target="_blank"
                        class="text-white hover:text-[var(--cyan)] hover:scale-110 transition-all duration-300">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com" target="_blank"
                        class="text-white hover:text-[var(--cyan)] hover:scale-110 transition-all duration-300">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="https://instagram.com" target="_blank"
                        class="text-white hover:text-[var(--cyan)] hover:scale-110 transition-all duration-300">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://linkedin.com" target="_blank"
                        class="text-white hover:text-[var(--cyan)] hover:scale-110 transition-all duration-300">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Copyright -->
        <div class="text-center mt-8">
            <p>&copy; <span id="current-year"></span> Event Listing. All rights reserved.</p>
        </div>
    </div>
</footer>
