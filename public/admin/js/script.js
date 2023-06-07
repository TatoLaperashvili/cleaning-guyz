$('.add-video-card').on('click', function (e) {
    e.preventDefault();
    var parent = $(this).parent().children('.video-cards');
    $(this).parent().children('.hidden-video-card').clone().addClass('video-card').appendTo(parent);
})
$(document).on('click', '.remove-video-card', function (e) {
    e.preventDefault();
    $(this).parent().remove();
})


$("body").on("click", ".deletefile", function () {
    var elem = $(this).closest('.dfie');
    var que = $(this).data("id");
    var TOKEN = $(this).data("token");

    if (confirm("დოკუმენტის წაშლა!?")) {
        $.ajax({
            url: $(this).data('route'),
            type: 'DELETE',
            data: {
                _token: TOKEN,
                que: que
            },
            dataType: 'JSON',
            success: function (response) {
                if (response.success) {
                    elem.remove()
                }
            },
        });
        $(this).parents('tr').hide('slow');
    }
});
$("body").on("click", ".deleteicon", function(){
    var elem = $(this).closest('.dicon');
    var que = $(this).data("id");
    var TOKEN = $(this).data("token");

    if (confirm("დოკუმენტის წაშლა!?")) {
        $.ajax({
            url: $(this).data('route'),
            type: 'DELETE',
            data: {_token: TOKEN, que: que},
            dataType: 'JSON',
            success: function(response) {
                if(response.success){
                    elem.remove()
                }
            },
        });
        $(this).parents('tr').hide('slow');
    }
});
$(document).ready(function () {
    $("#addmore").click(function () {
        var lang = $('html').attr('lang');
        var input_name = lang + '[Responsibilities][]';
        var new_input = '<div class="required_inp"><input name="' + input_name + '" type="text">' +
            '<input type="button" class="inputRemove" value="Remove"/></div>';
        $("#req_input").append(new_input);
    });
    $('body').on('click', '.inputRemove', function () {
        $(this).parent('div.required_inp').remove()
    });
});


