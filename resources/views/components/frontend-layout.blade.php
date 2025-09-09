<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">


</head>

<body>
    @include('sweetalert::alert')

    <header class="sticky top-0 z-10">
        <x-frontend-navbar />
    </header>
    <main>
        {{ $slot }}
    </main>
    <footer>
        <x-frontend-footer/>
    </footer>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
        integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let currentIndex = 0;
            const carousel = document.querySelector('.carousel');
            const slides = document.querySelectorAll('.carousel-slide');
            const dots = document.querySelectorAll('.dot');
            const totalSlides = slides.length;
            let autoSlideInterval;
            let isDragging = false;
            let startPos = 0;
            let currentTranslate = 0;
            let prevTranslate = 0;

            if (!carousel || !slides.length || !dots.length) return;

            function updateSlidePosition() {
                carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
                dots.forEach(dot => dot.classList.remove('active'));
                dots[currentIndex]?.classList.add('active');
            }

            function showSlide(index) {
                if (index >= totalSlides) currentIndex = 0;
                else if (index < 0) currentIndex = totalSlides - 1;
                else currentIndex = index;
                carousel.style.transition = 'transform 0.5s ease-in-out';
                updateSlidePosition();
            }

            function nextSlide() {
                showSlide(currentIndex + 1);
            }

            function prevSlide() {
                showSlide(currentIndex - 1);
            }

            function startAutoSlide() {
                stopAutoSlide();
                autoSlideInterval = setInterval(nextSlide, 5000);
            }

            function stopAutoSlide() {
                clearInterval(autoSlideInterval);
            }

            // Button navigation
            const nextButton = document.querySelector('.next');
            const prevButton = document.querySelector('.prev');

            nextButton?.addEventListener('click', () => {
                stopAutoSlide();
                nextSlide();
                startAutoSlide();
            });

            prevButton?.addEventListener('click', () => {
                stopAutoSlide();
                prevSlide();
                startAutoSlide();
            });

            // Dot navigation
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    stopAutoSlide();
                    showSlide(index);
                    startAutoSlide();
                });
            });

            // Touch support
            carousel.addEventListener('touchstart', (e) => {
                startPos = e.touches[0].clientX;
                isDragging = true;
                carousel.style.transition = 'none';
                stopAutoSlide();
            });

            carousel.addEventListener('touchmove', (e) => {
                if (!isDragging) return;
                const currentPosition = e.touches[0].clientX;
                const diff = currentPosition - startPos;
                currentTranslate = prevTranslate + diff;
                carousel.style.transform = `translateX(${currentTranslate}px)`;
            });

            carousel.addEventListener('touchend', () => {
                isDragging = false;
                carousel.style.transition = 'transform 0.5s ease-in-out';
                const movedBy = currentTranslate - prevTranslate;

                if (movedBy < -100 && currentIndex < totalSlides - 1) {
                    nextSlide();
                } else if (movedBy > 100 && currentIndex > 0) {
                    prevSlide();
                } else {
                    updateSlidePosition();
                }

                prevTranslate = currentIndex * -100;
                startAutoSlide();
            });

            // Mouse hover
            const carouselContainer = document.querySelector('.carousel-container');
            carouselContainer.addEventListener('mouseenter', stopAutoSlide);
            carouselContainer.addEventListener('mouseleave', startAutoSlide);

            // Initialize
            startAutoSlide();
            updateSlidePosition();

            // Handle window resize
            window.addEventListener('resize', () => {
                carousel.style.transition = 'none';
                updateSlidePosition();
                setTimeout(() => {
                    carousel.style.transition = 'transform 0.5s ease-in-out';
                }, 0);
            });
        });

    </script>
    <script>
         document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.event-card');

              const observer = new IntersectionObserver(
                 (entries) => {
                      entries.forEach((entry) => {
                         if (entry.isIntersecting) {
                             entry.target.classList.add('visible');

                            observer.unobserve(entry.target);
                      }
                 });
              },
                {
                 threshold: 0.1,
                 rootMargin: '0px 0px -50px 0px'
                 }
             );

             cards.forEach((card) => observer.observe(card));
        });
    </script>
</body>

</html>
