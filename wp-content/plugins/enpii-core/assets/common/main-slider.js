/**
 * Created by hungtran on 5/11/16.
 */
jQuery(document).ready(function(){
    (function( $ ) {
        if($('div.main-slider .slider-inner').hasClass('loading-slider')){
            var autoplay = $('input#autoplay').val();
            var transition = $('input#transition').val();
            var itemSlider = $('.main-slider .slider-inner .slider-item').length;
            var mainSlider='';
            if(itemSlider>1){
                if(autoplay ==0){
                    mainSlider = $('.main-slider .slider-inner').bxSlider({
                        pager: true,
                        speed: transition,
                        controls: true,
                        touchEnabled: true,
                        adaptiveHeight: false,
                        preventDefaultSwipeX: true,
                        preventDefaultSwipeY: false,
                        mode: 'horizontal',
                        onSliderLoad: function(currentIndex){
                           $('.slider-inner').removeClass('loading-slider') ;
                        }
                    });
                }
                else{
                    mainSlider = $('.main-slider .slider-inner').bxSlider({
                        pager: true,
                        speed: transition,
                        controls: true,
                        touchEnabled: true,
                        adaptiveHeight: false,
                        preventDefaultSwipeX: true,
                        preventDefaultSwipeY: false,
                        auto: true,
                        pause: autoplay,
                        mode: 'horizontal',
                        onSliderLoad: function(currentIndex){
                            $('.slider-inner').removeClass('loading-slider') ;
                        }
                    });
                }
            }
        }
    })( jQuery );
});