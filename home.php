<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/carousel.css">
    <title>Pagina Principal</title>
</head>

<body>
    <?php if(isset($_SESSION["user_id"])) { 
        if(isset($_SESSION['admin_dashboard']) && $_SESSION['admin_dashboard'] === true) { //check type of user and display the corresponfing dashboard
            include("includes_style/header_admin.php"); //for admin
        } else if(isset($_SESSION['admin_dashboard']) && $_SESSION['admin_dashboard'] === false){
            include("includes_style/header_home.php"); //for general user
        } ?>     
        <!-- addd contents of body in here after linking the file to the home page -->
        <section class="welcome-banner">
            <article>
                <marquee class="mar" width="100%" scrolldelay="200" scrollamount="13" direction="left" loop="infinite">B I E N V E N I D O</marquee>
            </article>
        </section>

        <!-- Image carousel -->
        <div class="container">
            <div class="carousel-container">
                <div class="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item" data-index="0">
                            <img src="icons/2.png" alt="Image 1">
                        </div>
                        <div class="carousel-item" data-index="1">
                            <img src="icons/1.png" alt="Image 2">
                        </div>
                        <div class="carousel-item" data-index="2">
                            <img src="icons/3.png" alt="Image 3">
                        </div>
                        <div class="carousel-item" data-index="3">
                            <img src="icons/4.png" alt="Image 4">
                        </div>
                        <div class="carousel-item" data-index="4">
                            <img src="icons/5.png" alt="Image 5">
                        </div>
                        <div class="carousel-item" data-index="5">
                            <img src="icons/2.png" alt="Image 1">
                        </div>
                    </div>
                    <button class="slide-control prev" onclick="prevSlide()">‹</button>
                    <button class="slide-control next" onclick="nextSlide()">›</button>
                </div>
                <ul class="slide-indicator">
                    <li><label class="slide-circulo" onclick="currentSlide(0)"></label></li>
                    <li><label class="slide-circulo" onclick="currentSlide(1)"></label></li>
                    <li><label class="slide-circulo" onclick="currentSlide(2)"></label></li>
                    <li><label class="slide-circulo" onclick="currentSlide(3)"></label></li>
                    <li><label class="slide-circulo" onclick="currentSlide(4)"></label></li>
                </ul>
            </div>
        </div>
        

        <script>
            let currentSlideIndex = 0;
            const carouselInner = document.querySelector('.carousel-inner');
            const slides = document.querySelectorAll('.carousel-item');
            const indicators = document.querySelectorAll('.slide-indicator .slide-circulo');

            function updateIndicators(index) {
                indicators.forEach(ind => ind.classList.remove('active'));
                if (index < indicators.length) {
                    indicators[index].classList.add('active');
                }
            }

            function showSlide(index) {
                carouselInner.style.transition = 'transform 0.5s ease-in-out';
                const offset = -index * 100;
                carouselInner.style.transform = `translateX(${offset}%)`;

                updateIndicators(index % (slides.length - 1));
            }

            function nextSlide() {
                currentSlideIndex++;
                if (currentSlideIndex >= slides.length) {
                    currentSlideIndex = 0; // Reset to the first real slide
                    carouselInner.style.transition = 'none';
                    carouselInner.style.transform = `translateX(0%)`;
                    setTimeout(() => {
                        carouselInner.style.transition = 'transform 0.5s ease-in-out';
                        showSlide(currentSlideIndex);
                    }, 20);
                } else {
                    showSlide(currentSlideIndex);
                }
            }

            function prevSlide() {
                if (currentSlideIndex === 0) {
                    currentSlideIndex = slides.length - 2;
                    carouselInner.style.transition = 'none';
                    const offset = -currentSlideIndex * 100;
                    carouselInner.style.transform = `translateX(${offset}%)`;
                    setTimeout(() => {
                        carouselInner.style.transition = 'transform 0.5s ease-in-out';
                        showSlide(currentSlideIndex);
                    }, 20);
                } else {
                    currentSlideIndex--;
                    showSlide(currentSlideIndex);
                }
            }

            function currentSlide(index) {
                currentSlideIndex = index;
                showSlide(currentSlideIndex);
            }

            setInterval(nextSlide, 30000); // Change image every 30 seconds

            // Initialize the first slide
            showSlide(currentSlideIndex);
        </script>
        <?php include("includes_style/footer.php"); ?>
    <?php } ?>
</body>
</html>
