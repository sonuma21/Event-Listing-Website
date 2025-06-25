<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

    </footer>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
        integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
        let currentIndex = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.dot');
        const totalSlides = slides.length;
        let autoSlideInterval;

        function showSlide(index) {
            if (index >= totalSlides) currentIndex = 0;
            else if (index < 0) currentIndex = totalSlides - 1;
            else currentIndex = index;

            document.querySelector('.carousel').style.transform = `translateX(-${currentIndex * 100}%)`;

            dots.forEach(dot => dot.classList.remove('active'));
            dots[currentIndex].classList.add('active');
        }

        function nextSlide() {
            showSlide(currentIndex + 1);
        }

        function prevSlide() {
            showSlide(currentIndex - 1);
        }

        function startAutoSlide() {
            autoSlideInterval = setInterval(nextSlide, 5000);
        }

        function stopAutoSlide() {
            clearInterval(autoSlideInterval);
        }

        document.querySelector('.next').addEventListener('click', () => {
            stopAutoSlide();
            nextSlide();
            startAutoSlide();
        });

        document.querySelector('.prev').addEventListener('click', () => {
            stopAutoSlide();
            prevSlide();
            startAutoSlide();
        });

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                stopAutoSlide();
                showSlide(index);
                startAutoSlide();
            });
        });

        // Start auto sliding
        startAutoSlide();

        // Pause auto sliding on hover
        document.querySelector('.carousel-container').addEventListener('mouseenter', stopAutoSlide);
        document.querySelector('.carousel-container').addEventListener('mouseleave', startAutoSlide);
    </script>
</body>

</html>
