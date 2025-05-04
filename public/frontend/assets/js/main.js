$(document).ready(function() {

    "use strict";
    var VerticalSlider = /** @class */ (function() {
        function VerticalSlider(selector) {
            $("#Vslider", selector).tinycarousel({
                axis: "y",
                infinite: true
            });
        }
        return VerticalSlider;
    }());
    new VerticalSlider();

    $(".chief-slider").owlCarousel({
        items: 1,
        loop: true,
        mouseDrag: false,
        touchDrag: false,
        pullDrag: false,
        rewind: true,
        autoplay: true,
        margin: 0,
        nav: false,
        dot: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut'
    });

    $(".four-slider").owlCarousel({
        items: 4,
        loop: true,
        mouseDrag: true,
        touchDrag: false,
        pullDrag: true,
        rewind: true,
        autoplay: true,
        margin: 0,
        nav: false,
        dot: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            600: {
                items: 1,
                nav: false
            },
            1000: {
                items: 4,
                nav: false,
                loop: false
            }
        }
    });

    $(".activities-slider").owlCarousel({
        items: 1,
        loop: true,
        mouseDrag: false,
        touchDrag: false,
        pullDrag: false,
        rewind: true,
        autoplay: true,
        margin: 12,
        nav: false,
        dot: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut'
    });

    $(".extended-slider").owlCarousel({
        items: 4,
        loop: false,
        mouseDrag: false,
        touchDrag: false,
        pullDrag: false,
        rewind: true,
        autoplay: true,
        margin: 12,
        nav: false,
        dot: true
    });

    $(".photo-slider").owlCarousel({
        items: 3,
        loop: true,
        mouseDrag: true,
        touchDrag: true,
        pullDrag: true,
        rewind: true,
        autoplay: false,
        margin: 0,
        nav: true,
        dots: false
    });
    $(".three-slider").owlCarousel({
        items: 3,
        loop: true,
        mouseDrag: true,
        touchDrag: true,
        pullDrag: true,
        rewind: true,
        autoplay: false,
        margin: 0,
        nav: false,
        dots: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            600: {
                items: 1,
                nav: false
            },
            1000: {
                items: 3,
                nav: false,
                loop: false
            }
        }
    });

});

$(".photo-slider").on('mousewheel', '.owl-stage', function(e) {
    if (e.deltaY > 0) {
        $(".photo-slider").trigger('next.owl');
    } else {
        $(".photo-slider").trigger('prev.owl');
    }
    e.preventDefault();
});



// fancybox
$(document).ready(function() {
    $(".fancybox").fancybox({
        'showNavArrows': true,
        'titleShow': true
    });
});



// Filter Category
$("#app-flters li").click(function() {
    $("#app-flters li").removeClass('filter-active');
    $(this).addClass('filter-active');

    var selectedFilter = $(this).data("filter");
    $("#app-wrapper").fadeTo(100, 0);

    $(".app-item").fadeOut().css('transform', 'scale(0)');

    setTimeout(function() {
        $(selectedFilter).fadeIn(100).css('transform', 'scale(1)');
        $("#app-wrapper").fadeTo(300, 1);
    }, 300);
});


jQuery.fn.liScroll = function(settings) {
    settings = jQuery.extend({
        travelocity: 0.03
    }, settings);
    return this.each(function() {
        var $strip = jQuery(this);
        $strip.addClass("newsticker")
        var stripHeight = 1;
        $strip.find("li").each(function(i) {
            stripHeight += jQuery(this, i).outerHeight(true); // thanks to Michael Haszprunar and Fabien Volpi
        });
        var $mask = $strip.wrap("<div class='mask'></div>");
        var $tickercontainer = $strip.parent().wrap("<div class='tickercontainer'></div>");
        var containerHeight = $strip.parent().parent().height(); //a.k.a. 'mask' width   
        $strip.height(stripHeight);
        var totalTravel = stripHeight;
        var defTiming = totalTravel / settings.travelocity; // thanks to Scott Waye   
        function scrollnews(spazio, tempo) {
            $strip.animate({ top: '-=' + spazio }, tempo, "linear", function() {
                $strip.css("top", containerHeight);
                scrollnews(totalTravel, defTiming);
            });
        }
        scrollnews(totalTravel, defTiming);
        $strip.hover(function() {
                jQuery(this).stop();
            },
            function() {
                var offset = jQuery(this).offset();
                var residualSpace = offset.top + stripHeight;
                var residualTime = residualSpace / settings.travelocity;
                scrollnews(residualSpace, residualTime);
            });
    });
};

$(function() {
    $("ul#ticker01").liScroll();
});