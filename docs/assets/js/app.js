$(document).ready(function () {

    $(".main-slider").owlCarousel({
        rtl: true,
        items: 1,
        autoplay: 1000,
        // smartSpeed: 200,
        nav: true,
        animateIn: 'slideInLeft',
       animateOut: 'slideOutRight',
        
        loop: true,
        responsiveBaseElement: window,
        navText: ['بعدی', 'قبلی'],
    });

    $(" .useablity-slider").owlCarousel({
        animateIn: 'slideInLeft',
        animateOut: 'slideOutRight',
       
        rtl: true,
        items: 2,
        nav: true,
        navText: ['بعدی', 'قبلی'],
        autoplay: false,
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

    $("#donated").on('mouseenter','.user-donated', function () {
        $(this).append(heart);
    });
    $("#donated").on('mouseleave','.user-donated', function () {
        $(this).find(".userIsLove").remove();
    });
    
    
    // , function () {
    //     $(this).find("span:last").remove();
    // });
});