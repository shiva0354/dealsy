(function ($) {
    'use strict';

    //  Count Up
    function counter() {
        var oTop;
        if ($('.counter').length !== 0) {
            oTop = $('.counter').offset().top - window.innerHeight;
        }
        if ($(window).scrollTop() > oTop) {
            $('.counter').each(function () {
                var $this = $(this),
                    countTo = $this.attr('data-count');
                $({
                    countNum: $this.text()
                }).animate({
                    countNum: countTo
                }, {
                    duration: 1000,
                    easing: 'swing',
                    step: function () {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function () {
                        $this.text(this.countNum);
                    }
                });
            });
        }
    }
    $(window).on('scroll', function () {
        counter();
    });
    // $(document).ready(function () {
    //     $('.select-category').select2();
    // });
    // bottom to top
    $('#top').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 'slow');
        return false;
    });
    // bottom to top

    $(document).on('ready', function () {

        // Nice Select
        // $('select').niceSelect();
        // -----------------------------
        //  Client Slider
        // -----------------------------
        $('.category-slider').slick({
            slidesToShow: 8,
            infinite: true,
            arrows: false,
            autoplay: false,
            autoplaySpeed: 2000
        });

    });

    // Client Slider
    $('.category-slider').slick({
        dots: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        nextArrow: '<i class="fa fa-chevron-right arrow-right"></i>',
        prevArrow: '<i class="fa fa-chevron-left arrow-left"></i>',
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: false
            }
        }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    // trending-ads-slide

    $('.trending-ads-slide').slick({
        dots: false,
        arrows: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 800,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });


    // product-slider
    $('.product-slider').slick({
        // dots: true,
        arrows: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: false,
        nextArrow: '<i class="fa fa-chevron-right arrow-right"></i>',
        prevArrow: '<i class="fa fa-chevron-left arrow-left"></i>',
        // customPaging: function (slider, i) {
        //   var image = $(slider.$slides[i]).data('image');
        //   return '<img class="img-fluid" src="' + image + '" alt="product-img">';
        // }
    });

    //language switch
    $('#language-switcher').on('change', function () {
        switcher();
        function switcher() {
            let locale = $('#language-switcher').val();
            $.ajax({
                url: "/set/locale/-XXX-".replace('-XXX-', locale),
                type: "get",
                success: function (response) {
                    if (response == 'success') {
                        location.reload();
                        console.log('success');
                    } else {
                        alert(response);
                    }
                }
            });
        }
    });

    //wishlist
    $(document).on('click', '#addToWishlist', function (evt) {
        var id = $(this).data('data');
        $.ajax({
            type: "GET",
            url: "/posts/wishlist/" + id,
            dataType: "json",
            success: function (data) {
                if (data == "unauthenticated") {
                    alert("Please login first!");
                    window.location = "/login";
                } else if (data.type == "attach") {
                    $("#wishlist" + id).removeClass("text-white");
                    console.log(data['message']);
                } else if (data.type == "detach") {
                    $("#wishlist" + id).addClass("text-white");
                }
            }
        });
    });

})(jQuery);
