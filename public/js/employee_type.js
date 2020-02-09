$(document).ready(function(){

    //Added
    $(".btnAdd").click(function(e){
        e.preventDefault();

        var data = $('#customerForm').serialize();
        var url = $('#customerForm').attr('action');
        $.ajax({
            method: "POST",
            url: url,
            data: data,
            dataType: "json",
            success: function (result) {
                console.log(result);
                var html='<tr><td>'+result.id+'</td><td>'+ result.name+'</td><td><div class="btn-group m-1"><form user="deleteForm" method="POST" action=""><a href="javascript:void(0);" onclick="deleteWithSweetAlert(event,parentNode);" ><button  class="btn btn-outline-danger  ml-2"  ><i class="fa fa-trash-o "></i></button></a></form></div></td></tr>';
                $(".item_table tbody").before(html);
                $('#customerForm')[0].reset();
                $('#basicExampleModal .close').click();

            }

        });
    });

    //btnRemove
    $(".btnRemove").click(function(e){
        e.preventDefault();

    });


    //delete
    // $("#deleteForm").click(function(){
    //     var url = $('#deleteForm').attr('action');
    //     $.ajax(
    //         {
    //             url: url,
    //             type: 'DELETE',
    //             data: {
    //                 "id": id,
    //                 "_token": token,
    //             },
    //             success: function (){
    //                 console.log("it Works");
    //             }
    //         });
    //
    // });
});
