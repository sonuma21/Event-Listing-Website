<footer class="footer bg-[var(--primary)] text-[var(--cyan)] py-8">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <!-- Navigation Links -->
            <div class="mb-6 md:mb-0">
                <h3 class="text-lg font-bold mb-4">Explore</h3>
                <ul class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4">
                    <li><a href="{{ route('home') }}" class="hover:text-[var(--cyan)] transition-colors duration-300">Home</a></li>
                    <li><a href="#" class="hover:text-[var(--cyan)] transition-colors duration-300">Events</a></li>
                    <li><a href="#" class="hover:text-[var(--cyan)] transition-colors duration-300">About</a></li>
                    <li><a href="#" class="hover:text-[var(--cyan)] transition-colors duration-300">Contact</a></li>
                </ul>
            </div>
            <!-- Social Media Icons -->
            <div class="mb-6 md:mb-0">
                <h3 class="text-lg font-bold mb-4">Follow Us</h3>
                <div class="flex space-x-4">
                    <a href="https://facebook.com" target="_blank" class="text-white hover:text-[var(--cyan)] hover:scale-110 transition-all duration-300">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com" target="_blank" class="text-white hover:text-[var(--cyan)] hover:scale-110 transition-all duration-300">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="https://instagram.com" target="_blank" class="text-white hover:text-[var(--cyan)] hover:scale-110 transition-all duration-300">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://linkedin.com" target="_blank" class="text-white hover:text-[var(--cyan)] hover:scale-110 transition-all duration-300">
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