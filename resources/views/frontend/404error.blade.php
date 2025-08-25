<x-frontend-layout>
    <section class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-200 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="container mx-auto text-center">
            <div class="max-w-lg mx-auto">
                <!-- Font Awesome Icon -->
                <div class="mb-6">
                    <i class="fas fa-exclamation-triangle text-7xl text-[var(--secondary)]"></i>
                </div>

                <!-- Heading -->
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">404 - Page Not Found</h1>

                <!-- Message -->
                <p class="text-lg sm:text-xl text-gray-600 mb-8">
                    Oops! It seems you’ve wandered off the beaten path. The page you’re looking for doesn’t exist.
                </p>

                <!-- Call to Action -->
                <a href="{{ route('home') }}"
                   class="inline-block bg-[var(--secondary)] text-white px-8 py-3 hover:bg-[var(--dark-secondary)] rounded-lg text-lg font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    Back to Home
                </a>
            </div>
        </div>
    </section>
</x-frontend-layout>
