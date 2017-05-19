// Custom JS
$(document).ready(function() {
    // on click of reserve button preserve the selected location in hidden field.
    $('body').on('click', '.reserve_button', function(e) {
        $('#stand_id').val($(this).data('standid'));
    });
});