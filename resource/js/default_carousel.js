$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        items:1,
        loop:true,
        nav:true
    });

    function heroSlideFunc() {

        $('.hero-slide .owl-item').removeClass('next prev');

        var currentSlide = $('.hero-slide .owl-item.active');
        currentSlide.next('.hero-slide .owl-item').addClass('next');
        currentSlide.prev('.hero-slide .owl-item').addClass('prev');

        var nextSlideTag = $('.hero-slide .owl-item.next').find('.lead').html();
        var prevSlideTag = $('.hero-slide .owl-item.prev').find('.lead').html();

        document.querySelector('.hero-slide .owl-nav .owl-prev').innerHTML = 'prev';
        $('.hero-slide .owl-nav .owl-prev').html('<span>'+ prevSlideTag +'<i class="ti-arrow-left"></i>'+'</span>');

        document.querySelector('.hero-slide .owl-nav .owl-next').innerHTML = 'next';
        $('.hero-slide .owl-nav .owl-next').html('<span>'+ nextSlideTag +'<i class="ti-arrow-right"></i>'+'</span>');
    }

    heroSlideFunc();

    $('.hero-slide').on('translated.owl.carousel', function(){
        heroSlideFunc();
    });

    $(".owl-item.active .hero .circle").each(function(index){
        if($(this).hasClass('off')){ $(this).removeClass('off') }else {
            $(this).addClass('off');
        }

    });

    $('.hero-slide').on('translate.owl.carousel', function(){
        $(".hero-slide .hero .circle img").removeClass('bounceIn');
        $(".circle-content").removeClass("show");
        $(".objective").removeClass("close");
    });

    $('.hero-slide').on('translated.owl.carousel', function(){
        $(".hero-slide .hero .circle img").addClass('bounceIn');
    });

    function eventSlider() {

        $('.event-slide .owl-item').removeClass('next prev');

        var currentSlide = $('.event-slide .owl-item.active');
        currentSlide.next('.event-slide .owl-item').addClass('next');
        currentSlide.prev('.event-slide .owl-item').addClass('prev');

        document.querySelector('.event-slide .owl-nav .owl-prev').innerHTML = 'prev';
        $('.event-slide .owl-nav .owl-prev').html('<i class="ti-angle-left"></i>');

        document.querySelector('.event-slide .owl-nav .owl-next').innerHTML = 'next';
        $('.event-slide .owl-nav .owl-next').html('<i class="ti-angle-right"></i>');
    }
    eventSlider();

    $(".objective").click(function (e) {
        e.preventDefault();
        var activeCircle= $(".hero-slide .owl-item.active .hero .circle-content");
        $(activeCircle).addClass("show");
    });
    $(".close-content").click(function(){
        var activeCircle= $(".hero-slide .owl-item.active .hero .circle-content");
        $(activeCircle).removeClass("show");
    });

});

$(document).ready(function(){
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
});


