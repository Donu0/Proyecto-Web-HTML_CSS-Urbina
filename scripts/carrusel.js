
$(document).ready(function () {

    const $track = $('.carousel-track');
    const $slides = $('.slide');
    const $carousel = $('.carousel');
    const slideCount = $slides.length;

    let index = 0;
    let autoplaySpeed = 3000; // 3s
    let autoplay;

    function updateSlide() {
        const width = $carousel.width();
        $track.css('transform', `translateX(-${index * width}px)`);

    }

    $('.next').on('click', function () {
        index = (index + 1) % slideCount;
        updateSlide();
    });

    $('.prev').on('click', function () {
        index = (index - 1 + slideCount) % slideCount;
        updateSlide();
    });

    //--------------------------------------
    // AUTOPLAY
    //--------------------------------------
    function startAutoplay() {
        autoplay = setInterval(() => {
            index = (index + 1) % slideCount;
            updateSlide();
        }, autoplaySpeed);
    }

    function stopAutoplay() {
        clearInterval(autoplay);
    }

    startAutoplay();

    //--------------------------------------
    // PAUSE ON HOVER
    //--------------------------------------
    $carousel.on('mouseenter', stopAutoplay);
    $carousel.on('mouseleave', startAutoplay);

    //--------------------------------------
    // RESIZE HANDLING
    //--------------------------------------
    $(window).on('resize', updateSlide);

    //--------------------------------------
    // SWIPE FOR MOBILE
    //--------------------------------------
    let startX = 0;

    $carousel.on('touchstart', function (e) {
        startX = e.originalEvent.touches[0].clientX;
    });

    $carousel.on('touchend', function (e) {
        const endX = e.originalEvent.changedTouches[0].clientX;
        const diff = endX - startX;

        if (Math.abs(diff) > 50) {
            if (diff < 0) {
                index = (index + 1) % slideCount;
            } else {
                index = (index - 1 + slideCount) % slideCount;
            }
            updateSlide();
        }
    });

});
