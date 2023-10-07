(function ($) {
    ("use strict");
jQuery(document).ready(function($) {
    var customUploader;

    $(document).on('click', '.custom-media-upload', function(e) {
        e.preventDefault();

        if (customUploader) {
            customUploader.open();
            return;
        }

        customUploader = wp.media({
            title: 'Select Brand Image',
            button: {
                text: 'Upload',
            },
            multiple: false
        });

        customUploader.on('select', function() {
            var attachment = customUploader.state().get('selection').first().toJSON();
            $('.custom-media-url').val(attachment.url);
            $('.custom-media-image').attr('src', attachment.url);
        });

        customUploader.open();
    });

    $(document).on('click', '.custom-media-remove', function(e) {
        e.preventDefault();
        $('.custom-media-url').val('');
        $('.custom-media-image').attr('src', '');
        return false;
    });

    $(document).on('click', '.submit input[type="submit"]', function(e) {
        $('.custom-media-url').val('');
        $('.custom-media-image').attr('src', '');
    });

    // Add the ajaxComplete event handler
    jQuery(document).ajaxComplete(function(event, request, options) {
        if (request && 4 === request.readyState && 200 === request.status
            && options.data && 0 <= options.data.indexOf('action=add-tag')) {

            var res = wpAjax.parseAjaxResponse(request.responseXML, 'ajax-response');
            if (!res || res.errors) {
                return;
            }

            // Automatically remove the image
            $('.custom-media-url').val('');
            $('.custom-media-image').attr('src', '');
        }
    });
});

})(jQuery);


