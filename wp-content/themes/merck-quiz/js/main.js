/**
 * Created by np-admin on 11/27/2014.
 */

// for maps
/*
 *  render_map
 *
 *  This function will render a Google Map onto the selected jQuery element
 *
 *  @type	function
 *  @date	8/11/2013
 *  @since	4.3.0
 *
 *  @param	$el (jQuery element)
 *  @return	n/a
 */
function loadScript() {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp' +
        '&signed_in=true&callback=initialize';
    document.body.appendChild(script);
}

function render_map($el) {
    (function ($) {
        // var
        var $markers = $el.find('.marker');


        // vars
        var args = {
            zoom: 16,
            center: new google.maps.LatLng(0, 0),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        // create map
        var map = new google.maps.Map($el[0], args);

        // add a markers reference
        map.markers = [];

        // add markers
        $markers.each(function () {

            add_marker($(this), map);

        });

        // center map
        center_map(map);
    })(jQuery);

}

/*
 *  add_marker
 *
 *  This function will add a marker to the selected Google Map
 *
 *  @type	function
 *  @date	8/11/2013
 *  @since	4.3.0
 *
 *  @param	$marker (jQuery element)
 *  @param	map (Google Map object)
 *  @return	n/a
 */

function add_marker($marker, map) {
    (function ($) {
        // var
        var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));

        // create marker
        var marker = new google.maps.Marker({
            position: latlng,
            map: map
        });

        // add to array
        map.markers.push(marker);

        // if marker contains HTML, add it to an infoWindow
        if ($marker.html()) {
            // create info window
            var infowindow = new google.maps.InfoWindow({
                content: $marker.html()
            });

            // show info window when marker is clicked
            google.maps.event.addListener(marker, 'click', function () {

                infowindow.open(map, marker);

            });
        }
    })(jQuery);
}

/*
 *  center_map
 *
 *  This function will center the map, showing all markers attached to this map
 *
 *  @type	function
 *  @date	8/11/2013
 *  @since	4.3.0
 *
 *  @param	map (Google Map object)
 *  @return	n/a
 */

function center_map(map) {
    (function ($) {

        // vars
        var bounds = new google.maps.LatLngBounds();


        // loop through all markers and create bounds
        $.each(map.markers, function (i, marker) {

            var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());

            bounds.extend(latlng);

        });

        // only 1 marker?
        if (map.markers.length == 1) {
            // set center of map
            map.setCenter(bounds.getCenter());
            map.setZoom(16);
        }
        else {
            // fit to bounds
            map.fitBounds(bounds);
        }
    })(jQuery);

}

/* Keep webapp not go to safari */
if (("standalone" in window.navigator) && window.navigator.standalone) {

    var noddy, remotes = false;

    document.addEventListener('click', function (event) {

        noddy = event.target;

        while (noddy.nodeName !== "A" && noddy.nodeName !== "HTML") {
            noddy = noddy.parentNode;
        }

        if ('href' in noddy && noddy.href.indexOf('http') !== -1 && (noddy.href.indexOf(document.location.host) !== -1 || remotes)) {
            event.preventDefault();
            document.location.href = noddy.href;
        }

    }, false);
}

jQuery(document).ready(function () {
    (function ($) {

        $('#menu-primary-menu > li').hover(function () {
            if ($(this).find('ul').length > 0) {
                $(this).parent().addClass('mouse-over');
            }
        }, function () {
            $(this).parent().removeClass('mouse-over');
        });

        $('ul.dropdown-menu').on('hidden.bs.collapse', function () {
            $(this).prev().toggleClass('fa-chevron-right').toggleClass('fa-chevron-down');
        });

        $('#site-navigation li.dropdown i.fa').on('click', function () {
            var current_clicked = $(this);
            var current_menu_item = $(this).parent();
            if (current_clicked.hasClass('fa-chevron-down')) {
                current_clicked.toggleClass('fa-chevron-down').toggleClass('fa-chevron-right');
            }
            $('ul.dropdown-menu.collapse.in', current_menu_item.parent()).collapse('hide');
            current_menu_item.find('ul.dropdown-menu').collapse('toggle');
        });

        //For Slider using bxSlider and it's callbacks
        var mainSlider = $(".main-slider .carousel").bxSlider({
            pager: false,
            speed: 1000,
            controls: true,
            touchEnabled: true,
            adaptiveHeight: false,
            preventDefaultSwipeX: true,
            preventDefaultSwipeY: false,
            mode: 'horizontal',
            onSliderLoad: function (currentIndex) {
            }
        });
//


        $('.acf-map').each(function () {
            render_map($(this));
        });
//
//        $(".colorbox-frame").colorbox({iframe:true, width:"80%", height:"80%"});
//


        $('#owlcarousels').owlCarousel({

            // Most important owl features
            items: 2,
            itemsCustom: false,
            itemsDesktop: [1199, 2],
            itemsDesktopSmall: [992, 2],
            itemsTablet: [768, 2],
            itemsTabletSmall: [480, 2],
            itemsMobile: [320, 1],
            singleItem: false,
            itemsScaleUp: false,

            //Basic Speeds
            slideSpeed: 200,
            paginationSpeed: 800,
            rewindSpeed: 1000,

            //Autoplay
            autoPlay: false,
            stopOnHover: false,

            // Navigation
            navigation: false,
            navigationText: ["<", ">"],
            rewindNav: true,
            scrollPerPage: false,

            //Pagination
            pagination: true,
            paginationNumbers: false,

            // Responsive
            responsive: true,
            responsiveRefreshRate: 200,
            responsiveBaseWidth: window,

            // CSS Styles
            baseClass: "owl-carousel",
            theme: "owl-theme",

            //Lazy load
            lazyLoad: true,
            lazyFollow: true,
            lazyEffect: "fade",

            //Auto height
            autoHeight: false,
            autoWidth: true,

            //JSON
            jsonPath: false,
            jsonSuccess: false,

            //Mouse Events
            dragBeforeAnimFinish: true,
            mouseDrag: true,
            touchDrag: true,

            //Transitions
            transitionStyle: false,

            // Other
            addClassActive: false,

            //Callbacks
            beforeUpdate: false,
            afterUpdate: false,
            beforeInit: function (currentIndex) {
                $('.slider-residence').removeClass('loading-slider');
            },
            afterInit: false,
            beforeMove: false,
            afterMove: false,
            afterAction: false,
            startDragging: false,
            afterLazyLoad: false,

        }).data('owlCarousel');


    })(jQuery);
    jQuery.validator.addMethod("noSpace", function (value, element) {
        return value.indexOf(" ") < 0 && value != "";
    }, "No space please and don't leave it empty");
    $('.btn-signup').click(function () {
        $(this).closest('form').validate({
            rules: {
                username: {
                    required: true,
                    minlength: 6,
                    noSpace: true
                },
                email: {
                    required: true,
                    email: true
                },
                fullname: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 6
                },
                confirmPassword: {
                    required: true,
                    minlength: 6,
                    equalTo: ".password"
                }
            },
            submitHandler: function (form) {
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'ajaxSignUp',
                        form: $(form).serialize()
                    },
                    success: function (data) {
                        if (data.code == 1) {
                            $('.message-signup').addClass('alert-success').html('Successfully !').removeClass('hidden');
                            $('.signup').resetForm();
                        }
                        else {
                            $('.message-signup').addClass('alert-danger').html(data.message).removeClass('hidden');
                        }
                    },
                    error: function (e) {
                        console.log(e.message);
                    }
                });
            }
        });

    });
    $('.btn-start').click(function () {
        var randQuestion = $(this).attr('data-session');
        var questionnaire = $(this).attr('data-questionnaire');
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'ajaxContest',
                randQuestion: randQuestion,
                questionnaire: questionnaire
            },
            success: function (data) {
                window.location.href = data.link;
            },
            error: function (e) {
                console.log(e.message);
            }
        });
    });

    var singleQuestion = $('.time-remaining');
    //if(singleQuestion.length>0){
    //    if(timeEnd> timeCurrent){
    //        var timeRemaining=timeEnd-timeCurrent;
    //
    //        var i=0;
    //        function startTime() {
    //            if(timeRemaining-i>0){
    //                $('.time-remaining .remaining').html(timeRemaining-i);
    //                var t = setTimeout(startTime, 1000);
    //            }
    //            else{
    //                singleQuestion.html('<span>The End</span>');
    //                $.alert({
    //                    title: 'The End!',
    //                    content: 'This question is timeout, please click to the continue question!',
    //                    confirmButton: 'continue',
    //                    confirm: function(){
    //                        $('.form-contest').submit();
    //                    }
    //                });
    //                setTimeout(function(){
    //                    $('.form-contest').submit();
    //                }, 4000);
    //            }
    //            i++;
    //        }
    //        startTime();
    //    }
    //    else{
    //        singleQuestion.html('<span>The End</span>');
    //        $.alert({
    //            title: 'The End!',
    //            content: 'This question is timeout, please click to the continue question!',
    //            confirmButton: 'continue',
    //            confirm: function(){
    //                $('.form-contest').submit();
    //            }
    //        });
    //        setTimeout(function(){
    //            $('.form-contest').submit();
    //        }, 4000);
    //    }
    //}
    $('.form-contest').submit(function (e) {
        var link = $(this).attr('data-next');
        var contestId = $(this).attr('data-contestId');
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            //dataType: 'json',
            data: {
                action: 'ajaxContestSession',
                data: $('.form-contest').serialize()
            },
            success: function (data) {
                window.location.href = link;
            },
            error: function (e) {

            }
        });
        e.preventDefault();
    });
    $('.form-change-password').validate({
        rules: {
            password: {
                required: true,
                minlength: 6
            },
            confirmPassword: {
                required: true,
                minlength: 6,
                equalTo: ".newPassword"
            }
        },
        submitHandler: function (form) {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'ajaxChangePassword',
                    form: $(form).serialize()
                },
                success: function (data) {
                    if (data.code == 1) {
                        $('.message-signup').addClass('alert-success').html('Successfully !').removeClass('hidden');
                        $('.signup').resetForm();
                    }
                    else {
                        $('.message-signup').addClass('alert-danger').html(data.message).removeClass('hidden');
                    }
                }

            });
        }
    });
    $('.form-change-profile').submit(function (e) {
        form = $(this).serialize();
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'ajaxChangeProfile',
                form: form
            },
            success: function (data) {
                if (data.code == 1) {

                    $('.message-signup').addClass('alert-success').html('Successfully !').removeClass('hidden');
                    $('.signup').resetForm();
                }
                else {
                    $('.message-signup').addClass('alert-danger').html(data.message).removeClass('hidden');
                }
            }
        });
        e.preventDefault();
    });
    //'Do you want to leave the page? You will lose result if you go back.'
    if($('body.single').length>0){
        $('.btn-next').click(function () {
            $(window).unbind('beforeunload');
        });

        $(window).bind('beforeunload', function (e) {
            return 'You will lose result if you go back.';
        });
    }
});
