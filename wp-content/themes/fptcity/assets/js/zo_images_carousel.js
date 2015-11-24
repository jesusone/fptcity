/**
 * Created by John Nguyen on 04-08-2015.
 */
(function($) {
    "use strict";

    $(document).ready(function () {
        $('.zo_images_carousel').each(function() {
            var $this = $(this);
            $this.slick({
                fade: false,
                responsive: [
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 360,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });     
    });
}(jQuery));