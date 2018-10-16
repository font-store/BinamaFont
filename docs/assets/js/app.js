$(document).ready(function () {

    $(".main-slider").owlCarousel({
        rtl: true,
        items: 1,
        autoplay: 1000,
        // smartSpeed: 200,
        nav: false,
        //  animateIn: 'slideInLeft',
        // animateOut: 'slideOutRight',

        loop: true,
        responsiveBaseElement: window,
        navText: ['بعدی', 'قبلی'],
    });



    $(" .useablity-slider").owlCarousel({
        animateIn: 'slideInLeft',
        animateOut: 'slideOutRight',

        rtl: true,
        items: 2,
        nav: false,
        navText: ['بعدی', 'قبلی'],
        autoplay: false,
    });


    var slide = $(this);
    var owl = $('.owl-carousel', this);
    $('.textslider-prev', slide).hide();
    owl.owlCarousel({
        rtl: true,
        items: 1,
        responsiveBaseElement: window,
        autoplay: false,
        nav: false,
        margin: 10,
    });
    owl.on('translated.owl.carousel', function (event) {
        var item = event.item.index;
        var pages = event.item.count - 1;
        var page = event.item.index;
        if (page === 0) {
            $('.textslider-prev', slide).hide();
        } else {
            $('.textslider-prev', slide).show();
        }

        if (page === pages) {
            $('.textslider-next', slide).hide();
        } else {
            $('.textslider-next', slide).show();
        }


    });
    $('.textslider-prev', slide).on('click', function (e) {
        owl.trigger('prev.owl.carousel');
        e.stopPropagation();

    });
    $('.textslider-next', slide).on('click', function (e) {
        e.stopPropagation();
        owl.trigger('next.owl.carousel');

    });


   

    function getDonations() {
        $.getJSON("donates/binama.json", function (data) {
            var items = [];
            $.each(data, function (key, val) {
                var img = $('<img>').prop('src', 'https://s.gravatar.com/avatar/' + val.EmailMD5 + '?noemail&s=50&d=wavatar');
                var name = $("<div/>").addClass('name').html(val.FullName);
                if (val.CustomDescription === '#') {
                    var user = $('<div>').addClass('user-donated').append(img, name);
                } else {
                    var user = $('<a>').addClass('user-donated').prop('href', val.CustomDescription).append(img, name);
                }
                $('#donated').append(user);

            });
        })
    };

    getDonations();


    var heart = $('<i class="userIsLove fa fa-heart" aria-hidden="true"></i>');

    $("#donated").on('mouseenter', '.user-donated', function () {
        $(this).append(heart);
    });
    $("#donated").on('mouseleave', '.user-donated', function () {
        $(this).find(".userIsLove").remove();
    });


    $('.content-moreBTT').on('click', function () {
        var p = $(this).closest('.content-text');
        $(this).hide();
        $('.content-more', p).removeClass('is-hidden').slideToggle("slow");
    })
});