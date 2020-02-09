
$(document).ready(function () {

    $("#usersForm").on('submit', function (e) {


        var form = $(this);
        var url = form.attr("action");
        var type = form.attr("method");
        var data = form.serialize();

        $.ajax({
            url: url,
            data: data,
            type: type,
            dataType: "JSON",
            success: function (data) {
                if (data == "success") {
                    swal("Great","successfully Insert Product" ,"success");
                }
            },

        });
    });



});//end
