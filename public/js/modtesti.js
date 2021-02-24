jQuery(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });
});

$('.load-ajax-modal').click(function(){

    $.ajax({
        type : 'GET',
        url : $(this).data('path'),

        success: function(result) {
            $('#dynamic-modal div.modal-body').html(result);
        }
    });
});
