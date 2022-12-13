<script src="{{asset('assets/client/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('assets/client/js/rangeSlider.js')}}"></script>
<script src="{{asset('assets/client/js/tether.min.js')}}"></script>
<script src="{{asset('assets/client/js/moment.js')}}"></script>
<script src="{{asset('assets/client/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/client/js/mmenu.min.js')}}"></script>
<script src="{{asset('assets/client/js/mmenu.js')}}"></script>
<script src="{{asset('assets/client/js/aos.js')}}"></script>
<script src="{{asset('assets/client/js/aos2.js')}}"></script>
<script src="{{asset('assets/client/js/slick.min.js')}}"></script>
<script src="{{asset('assets/client/js/fitvids.js')}}"></script>
<script src="{{asset('assets/client/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/client/js/typed.min.js')}}"></script>
<script src="{{asset('assets/client/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/client/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('assets/client/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/client/js/smooth-scroll.min.js')}}"></script>
<script src="{{asset('assets/client/js/lightcase.js')}}"></script>
<script src="{{asset('assets/client/js/search.js')}}"></script>
<script src="{{asset('assets/client/js/owl.carousel.js')}}"></script>
<script src="{{asset('assets/client/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/client/js/ajaxchimp.min.js')}}"></script>
<script src="{{asset('assets/client/js/newsletter.js')}}"></script>
<script src="{{asset('assets/client/js/jquery.form.js')}}"></script>
<script src="{{asset('assets/client/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/client/js/searched.js')}}"></script>
<script src="{{asset('assets/client/js/forms-2.js')}}"></script>
<script src="{{asset('assets/client/js/map-style2.js')}}"></script>
<script src="{{asset('assets/client/js/range.js')}}"></script>
<script src="{{asset('assets/client/js/color-switcher.js')}}"></script>
<script src="{{asset('assets/client/js/jquery-ui.js')}}"></script>
<script src="{{asset('assets/client/js/range-slider.js')}}"></script>
<script src="{{asset('assets/client/js/popper.min.js')}}"></script>
<script src="{{asset('assets/client/js/slick4.js')}}"></script>
<script src="{{asset('assets/client/js/timedropper.js')}}"></script>
<script src="{{asset('assets/client/js/jqueryadd-count.js')}}"></script>
<script src="{{asset('assets/client/js/datedropper.js')}}"></script>
<script src="{{asset('assets/client/js/leaflet.js.js')}}"></script>
<script src="{{asset('assets/client/js/leaflet-gesture-handling.min.js')}}"></script>
<script src="{{asset('assets/client/js/leaflet-providers.js')}}"></script>
<script src="{{asset('assets/client/js/leaflet.markercluster.js')}}"></script>
<script src="{{asset('assets/client/js/map-single.js')}}"></script>
<script src="{{asset('assets/client/js/inner.js')}}"></script>
<script src="{{asset('assets/client/js/popup.js')}}"></script>

        <script src="{{asset('assets/client/js/swiper.min.js')}}"></script>


<script src="{{asset('assets/client/js/range.js')}}js/color-switcher.js"></script>
<script>
    $(window).on('scroll load', function () {
        $("#header.cloned #logo img").attr("src", $('#header #logo img').attr('data-sticky-logo'));
    });

</script>

<!-- Slider Revolution scripts -->
<script src="{{asset('assets/client/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{asset('assets/client/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>

<script>
    var typed = new Typed('.typed', {
        strings: ["House ^2000", "Apartment ^2000", "Plaza ^4000"],
        smartBackspace: false,
        loop: true,
        showCursor: true,
        cursorChar: "|",
        typeSpeed: 50,
        backSpeed: 30,
        startDelay: 800
    });

</script>

<script>
    $('.slick-lancers').slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        adaptiveHeight: true,
        responsive: [{
            breakpoint: 1292,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: true,
                arrows: false
            }
        }, {
            breakpoint: 993,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: true,
                arrows: false
            }
        }, {
            breakpoint: 769,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: false
            }
        }]
    });

</script>

<script>
    $('.job_clientSlide').owlCarousel({
        items: 2,
        loop: true,
        margin: 30,
        autoplay: false,
        nav: true,
        smartSpeed: 1000,
        slideSpeed: 1000,
        navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            991: {
                items: 3
            }
        }
    });

</script>

<script>
    $('.style2').owlCarousel({
        loop: true,
        margin: 0,
        dots: false,
        autoWidth: false,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive: {
            0: {
                items: 2,
                margin: 20
            },
            400: {
                items: 2,
                margin: 20
            },
            500: {
                items: 3,
                margin: 20
            },
            768: {
                items: 4,
                margin: 20
            },
            992: {
                items: 5,
                margin: 20
            },
            1000: {
                items: 7,
                margin: 20
            }
        }
    });

</script>

<script>
    $(".dropdown-filter").on('click', function () {

        $(".explore__form-checkbox-list").toggleClass("filter-block");

    });

</script>

<!-- MAIN JS -->
<script src="{{asset('assets/client/js/script.js')}}"></script>

<!-- Detail Motels -->
<script>
    $('#reservation-date').dateDropper();
</script>
<!-- Time Dropper Script-->
<script>
    this.$('#reservation-time').timeDropper({
        setCurrentTime: false,
        meridians: true,
        primaryColor: "#e8212a",
        borderColor: "#e8212a",
        minutesInterval: '15'
    });
</script>

<script>
    $(document).ready(function() {
        $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
    });
</script>

<script>
    $('.slick-carousel').each(function() {
        var slider = $(this);
        $(this).slick({
            infinite: true,
            dots: false,
            arrows: false,
            centerMode: true,
            centerPadding: '0'
        });

        $(this).closest('.slick-slider-area').find('.slick-prev').on("click", function() {
            slider.slick('slickPrev');
        });
        $(this).closest('.slick-slider-area').find('.slick-next').on("click", function() {
            slider.slick('slickNext');
        });
    });
</script>

<!-- Detail Live-together -->
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 3,
        slidesPerGroup: 1,
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 1,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 5,
                spaceBetween: 50,
            },
        }
    });

</script>


<script>
    var box1 = document.getElementById("box1");
    var box2 = document.getElementById("box2");
    var message = document.getElementById("message");

    // console.log(banner);
    function changePosition() {
        box1.setAttribute('style', 'transition: 0.7s ease;height:400px')
        box2.setAttribute('style', 'transform:translateY(-10px);transition: 0.7s ease;')
        message.setAttribute('style', 'opacity:1;transition: 0.5s cubic-bezier(0.86, 0.32, 0.13, 0.7)')
        // box2.setAttribute('style', 'opacity:0;transition: 1s ease')
    }
</script>

