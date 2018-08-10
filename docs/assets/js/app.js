$(document).ready(function () {

    $(" .main-slider").owlCarousel({
        // autoPlay: true,
        // stopOnHover: true,
        // slideSpeed: 200,
        // paginationSpeed: 800,
        // rewindSpeed: 1000,
        // navigationText: ["prev", "next"],
        // rewindNav: true,
        // singleItem: true,
        // transitionStyle: "backSlide",
        // responsive: true,
        // responsiveRefreshRate: 200,
        // responsiveBaseWidth: window,
        rtl: true,

        items:1,
        autoplay: 1000,
        smartSpeed: 200,
        nav: false,

        animateIn: 'bounceInLeft',
        animateOut: 'bounceOutRight',
        //responsive: true,
        loop: true,

        responsiveBaseElement: window
    });

    $(" .useablity-slider").owlCarousel({

        rtl: true,

        items:2,
        nav: true,
        navText: ['بعدی','قبلی'],
        autoplay: false,
        
        

        
    });

});