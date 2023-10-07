/*==================================================
        Nest Theme Js 
==================================================*/
(function ($) {
    ("use strict"); 
    jQuery(document).ready(function($) {
        $('.admin-notice-debug_enabled').each(function() {
            var notice = $(this);
            var colors = [
                '#3f3eed',
                '#161c29',
                '#121623'
            ];
            var currentIndex = 0;
    
            setInterval(function() {
                currentIndex = (currentIndex + 1) % colors.length;
                var nextColor = colors[currentIndex];
                
                notice.css('background-image', 'linear-gradient(to right, ' + nextColor + ', ' + colors[currentIndex] + ')');
            }, 2000);
        });
    }); 
})(jQuery);

