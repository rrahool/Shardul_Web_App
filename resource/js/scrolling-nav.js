
$(window).scroll(function(){
    var wScroll = $(window).scrollTop();
    if(wScroll >= $('#page-top').offset().top+5) {
        $("#navbar-default").addClass("navscroll") ;
    } else{
        $("#navbar-default").removeClass("navscroll") ;
    }
});


//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});
