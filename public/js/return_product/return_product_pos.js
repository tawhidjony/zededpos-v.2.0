function productReturnCalculation(){

    $('#return-products-pos > tbody > tr').on('change',function(){
        let total_amount = 0;
        $('#return-products-pos > tbody > tr').each(function(){



            let the    = $(this),
                qty     = parseInt(the.find('input.qty').val()),
                price   = parseInt(the.find('input.price').val()),

                totalEachProduct = (qty * price);

                total_amount +=totalEachProduct;

                $(this).find('input.subtotal').val(totalEachProduct);
        });
        if(total_amount){
            $('.pos_footer').find('.total').val(total_amount);
        }else{
            $('.pos_footer').find('.total').val();
        }


        
        //POS Product Calculation Footer
        $('.pos_footer').on('keyup', 'input.total',function(event) {
            productReturnCalculation();
        });
    });



    // $('#return-products-pos > tbody > tr').each(function (key, el) {


    //     var  tr           = $(el),
    //          qty           = parseFloat( tr.find('input.qty').val()),
    //          price          = parseFloat( tr.find('input.price').val());

    //          subtotal    = (qty * price);
    //         tr.find('input.subtotal').val(subtotal);

    // });
}

    function returnProducts(e){
            let value =$(e).attr('id')
            let name  = $(`#rp-name-${value}`).text();
            let qty   = $(`#rp-qty-${value}`).text();
            let price = $(`#rp-price-${value}`).text();

            $('#return-products-pos > tbody > tr').on('change',function(){
                let qty     = parseInt(the.find('input.qty').val());
                console.log('Qty :', qty);

            });

            let html='';
                html +=` <tr id="product-` +value+ `">
                            <td style=" width: 20%;">${name}</td>
                            <td style=" width: 20%;"><input class="form-control qty" type="number" name="[qty]" value="0" /></td>
                            <td><input class="form-control pl-2 pr-2 price" type="number" name="[price]" value="${price}" readonly/> </td>
                            <td><input class="form-control subtotal" type="number" name="[subtotal]" value="00.00" readonly/></td>
                            <td><i class="danger fa fa-trash remove"></i></td>
                     </tr>`

            if (html != '') {
                $('#return-products-pos tbody').append(html);
            }
            productReturnCalculation();

    }



    $(document).on('click','.remove', function(e){
        let remove = $(this).closest("tr").remove();
        if(remove) {
            productReturnCalculation();
        }
    });



