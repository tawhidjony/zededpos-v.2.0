$(document).ready(function () {

    // Pos Product Category
    $('.product_category_slider').owlCarousel({
        loop:true,
        dots: false,
        margin:10,
        nav:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });//end

    //POS Product Show Category id
    $('.pos_category p').on('click', function () {
        var cat= $(this).attr('data-id');
        $.ajax({
            type: 'get',
            url: ajaxUrls.catbyproductUrl,
            data: 'cat_id=' + cat ,
            success:function(response){
                var html = '', subCat = '';
                $.each(response.products, function(key, value){

                    html +=`<div class="col-lg-3 ">
                                    <a href="" class="productLink" data-id="`+value.id+`">
                                        <div class="card">
                                            <img class="pos_product_img" src="`+value.photo+`" alt="">
                                            <span class="text-center pos_product_font" data-toggle="tooltip" title="`+value.name+`">`+value.name+`</span>
                                        </div>
                                    </a>
                                </div>`;


                });
                //subCat += '<div class="owl-theme mt-2 sub_cat" style="display: none;">';
                $.each(response.subcats, function(key, value){
                    subCat += '<div class="item"><div class="pos_sub_category">';
                    subCat += '<p class="text-center pos_s_padding" data-id="'+value.id+'">'+value.name+'</p>';
                    subCat += '</div></div>';
                });
                if(subCat != ''){
                    $('.sub_cat_slider').empty().append(subCat);
                    $('.sub_cat_slider').owlCarousel({
                        loop:true,
                        dots: false,
                        margin:10,
                        nav:false,
                        items:4,
                        responsive:{
                            0:{
                                items:1
                            },
                            600:{
                                items:3
                            },
                            1000:{
                                items:4
                            }
                        }
                    }).trigger('refresh.owl.carousel');

                }else{
                    $('.sub_cat_slider').trigger('destroy.owl.carousel').empty();
                }
                //subCat += '</div>';
                if(html != ''){
                    $('#zeded_pos_ctg').empty().append(html);
                }

            }
        });
    });//end

    //POS Product Show subCategory id
    $('.product_category_pos').on('click', '.pos_sub_category p', function () {
        var subcat= $(this).attr('data-id');
        $.ajax({
            type: 'get',
            url: ajaxUrls.subcatbyproductUrl,
            data: 'subcat_id=' + subcat ,
            success:function(response){
                var html = '';
                $.each(response, function(key, value){

                    html +=`<div class="col-lg-3 ">
                                        <a href="" class="productLink" data-id="`+value.id+`">
                                            <div class="card">
                                                <img class="pos_product_img" src="`+value.photo+`" alt="">
                                                <span class="text-center pos_product_font" data-toggle="tooltip" title="`+value.name+`">`+value.name+`</span>
                                            </div>
                                        </a>
                                    </div>`;
                    if(html != ''){
                        $('#zeded_pos_ctg').empty().append(html);
                    }
                });

            }
        });
    });//end

    //POS Total Product Calculating
    function calcution(){
        var totalprice = 0, grandTotla= 0, discunt = 0, payamount = 0, returnAmount=0, due=0, currentdue = 0, grandTotla2=0;

        $('#Pos_Product_table tbody tr').each(function (key, el) {
            var tr          = $(el),
                qty         = parseInt( tr.find('input.qty').val() ),
                price       = parseInt( tr.find('input.price').val() ),
                subtotal    = (qty * price);

            totalprice  += subtotal;
            tr.find('input.subtotal').val(subtotal);
        });

        discunt = $('input.discunt').val() != '' ? parseInt( $('input.discunt').val() ) : 0;
        due = $('input.due-amount').val() != '' ? parseInt( $('input.due-amount').val() ) : 0;
        // payamount = $('input.payamount').val() != '' ? parseInt( $('input.payamount').val() ) : 0;
        // grandTotalTwo = $('input.grand-totla-two').val() != '' ? parseInt( $('input.grand-totla-two').val() ) : 0;

        grandTotla = ( totalprice - ( ( totalprice * discunt) / 100 ) );
        currentdue = (due - grandTotla);

         returnAmount = ( grandTotla - due);

        // extraPaymentAmount = (grandTotla - grandTotalTwo);


        if(totalprice){
            $('.pos_footer').find('.total').val(totalprice);
        }else{
            $('.pos_footer').find('.total').val(totalprice);
        }

        if(grandTotla) {
            $('.pos_footer').find('.grand-totla').val(grandTotla);
        }else{
            $('.pos_footer').find('.grand-totla').val(grandTotla);
        }

        if(returnAmount >= currentdue) {
            $('.pos_footer').find('.return-amount').val(returnAmount);
        }else{
            $('.pos_footer').find('.return-amount').val(Math.abs(0) );
        }

        if( currentdue >= returnAmount) {
            $('.pos_footer').find('.current-due').val(currentdue);
        }else{
            $('.pos_footer').find('.current-due').val(Math.abs(0) );
        }

        // //
        // if(grandTotalTwo){
        //     $('.pos_footer').find('').val(grandTotalTwo);
        // }
        // if(grandTotla > grandTotalTwo){
        //     $('.pos_footer').find('.extra-payment').val(Math.abs(extraPaymentAmount) );
        // }else {
        //     $('.pos_footer').find('.extra-payment').val(0);
        // }
        //
        // //
        // if(payamount > grandTotla){
        //     $('.pos_footer').find('.return-amount').val(Math.abs(returnAmount) );
        //     $('.pos_footer').find('.due-amount').val(0);
        // }
        //
        // if (grandTotla > payamount){
        //     $('.pos_footer').find('.due-amount').val(due);
        //     $('.pos_footer').find('.return-amount').val(Math.abs(0) );
        // }
        // if (grandTotla == payamount) {
        //     $('.pos_footer').find('.due-amount').val(0);
        //     $('.pos_footer').find('.return-amount').val(Math.abs(0) );
        // }
    }//end

    //POS Product Quantity Check
    function quantityCheck (productId, currentQty){
        var total_qty = null;
        $.ajax({
            type: 'get',
            url: ajaxUrls.checkQtyUrl,
            data: 'product_id=' + productId,
            async: false,
            success: function (response) {
                total_qty = response.total_qty;
            }
        });
        if(total_qty !== null ){
            return total_qty;
        }
    }//end

    // POS Product Available Quantity Check
    $('#Pos_Product_table').on('change', 'input.form-control.qty',function(event){
        var currentVal = parseInt( $(this).val() ),
            productId = parseInt( $(this).parents('tr').attr('id').replace('product-', '') ),
            total_qty = 1;
        if(currentVal <=0){
            $(this).val(total_qty);
        }else{
            total_qty = quantityCheck (productId);
        }
        console.log(total_qty);
        if(currentVal > total_qty){
            $(this).val( parseInt( total_qty) );
        }
        calcution();
    });//end
    //POS Product Price Check
    function priceCheck (productId){
        var sell_price = null;
        $.ajax({
            type: 'get',
            url: ajaxUrls.checkPriceUrl,
            data: 'product_id=' + productId,
            async: false,
            success: function (response) {
                sell_price = response.sell_price;
            }
        });
        if(sell_price !== null ){
            return sell_price;
        }
    }//end

    //POS Product Available Price Check
    $('#Pos_Product_table').on('change', 'input.form-control.price',function(event){
        var currentValue = parseInt( $(this).val() ),
            productId = parseInt( $(this).parents('tr').attr('id').replace('product-', '') );
        var sellPrice =priceCheck(productId);
        if(currentValue <=(sellPrice-1)){
            $(this).val(sellPrice);
        }
        calcution();
    });//end

    // POS Product Add when click the products
    $('#zeded_pos_ctg ').on('click', '.productLink', function (event) {
        event.preventDefault();
        var product= $(this).attr('data-id');
        if($('#Pos_Product_table #product-'+product).length > 0){
            total_qty = quantityCheck (product);
            var currentQty = parseInt( $('#Pos_Product_table #product-'+product).find('input.qty').val() );
            if( (currentQty + 1 ) <= total_qty){
                var updateqty = $('#Pos_Product_table #product-'+product).find('input.qty').val( (currentQty+1) );
            }

            if(updateqty){
                calcution();
            }
        }else {
            $.ajax({
                type: 'get',
                url: ajaxUrls.productDetailsUrl,
                data: 'product_id=' + product,
                success: function (response) {
                    var html = '';
                    html += `<tr id="product-` + response.id + `">
                                            <td>`+response.name+`<input type="text" style="display: none"  name="products[` + response.id + `][product_id]" value="` + response.id + `" /> </td>
                                            <td style=" width: 1%;"><input class="form-control qty" type="number" name="products[` + response.id + `][qty]" value="1" /> </td>
                                            <td><input class="form-control price" type="number" name="products[` + response.id + `][price]" value="` + response.purchase.sell_price +`"/> </td>
                                            <td><input class="form-control subtotal" type="number" name="products[` + response.id + `][subtotal]" value="" readonly/></td>
                                            <td><i class="danger fa fa-trash remove"></i></td>
                                        </tr>`;
                    if (html != '') {
                        $('#Pos_Product_table tbody').append(html);
                    }
                    calcution();
                },
            });
        }
        $(document).on('click', '.remove', function () {
            $(this).closest("tr").remove();
        });
        $(document).on('click','.remove', function(e){
            var remove = $(this).closest("tr").remove();
            if(remove) {
                calcution();
            }});
    });//end

    //POS Product Calculation Footer
    $('.pos_footer').on('keyup', 'input.discunt',function(event) {
        calcution();
    });

    $('.pos_footer').on('keyup', 'input.payamount',function(event) {
        calcution();
    });

    //Pos Product Search
    function getProductByKeyword(keyword){
        $.ajax({
            type: 'get',
            url: ajaxUrls.productSearchsUrl,
            data: 'search=' + keyword ,
            success:function(response){
                console.log(response);
                var html = '';
                $.each(response, function(key, value){

                    html +=`<div class="col-lg-3 ">
                                <a href="" class="productLink" data-id="`+value.id+`">
                                    <div class="card">
                                        <img class="pos_product_img" src="`+value.photo+`" alt="">
                                        <span class="text-center pos_product_font" data-toggle="tooltip" title="`+value.name+`">`+value.name+`</span>
                                    </div>
                                </a>
                            </div>`;


                });
                if(html != ''){
                    $('#zeded_pos_ctg').empty().append(html);
                }

            }
        });
    }
    $('#pos-product-search-form').submit(function(event){
        event.preventDefault();
    });
    $('#pos-product-search').on('keyup', function(event){
        var keyword = $(this).val();
        if(keyword.length > 1){
            getProductByKeyword(keyword);
        }
    });

    $("#PaymentMethods").change(function(){
        let val  = $(this).val();
        let bankList = ["Sonali Bank Limited","Janata Bank Limited","Agrani Bank Limited","Rupali Bank Limited","BASIC Bank Limited","Bangladesh Development Bank Limited","AB Bank Limited","Bangladesh Commerce Bank Limited","Bank Asia Limited","BRAC Bank Limited","City Bank Limited","Dhaka Bank Limited","Dutch-Bangla Bank Limited","Eastern Bank Limited","IFIC Bank Limited","Jamuna Bank Limited","Meghna Bank Limited","Mercantile Bank Limited","National Bank Limited","National Credit & Commerce Bank Limited","NRB Bank Limited","NRB Commercial Bank Ltd","NRB Global Bank Limited","One Bank Limited","Padma Bank Limited","Premier Bank Limited","Prime Bank Limited","Pubali Bank Limited","Shimanto Bank Ltd","Standard Bank Limited","Trust Bank Limited","United Commercial Bank Ltd","Uttara Bank Limited","Southeast Bank Ltd.","Al-Arafah Islami Bank Limited","EXIM Bank Limited","First Security Islami Bank Limited","ICB Islamic Bank Limited","Islami Bank Bangladesh Limited","Shahjalal Islami Bank Limited","Social Islami Bank Limited","Union Bank Limited","Bank Al-Falah Limited","Citibank N.A","Commercial Bank of Ceylon PLC","Habib Bank Limited","HSBC","National Bank of Pakistan","Standard Chartered Bank","State Bank of India","Woori Bank"];

        if(val== 'check'){
            let html  = '<div class="col-sm-6"><input type="number" name="check_no" class="form-control mt-2"' +
                ' placeholder="Check No:" required></div><div class="col-sm-6 mt-2"><select type="text" name="bank_name"' +
                ' class="form-control mt-2 Bank-Name-Select" required>';
            html += '<option value="">Select Bank</option>';
            $.each(bankList, function(key, val){
                html += '<option value="'+val+'">'+val+'</option>';
            });
            html += '</select></div><div class="col-sm-12"><input type="text" name="check_owner_name"' +
                ' class="form-control' +
                ' mt-2"placeholder="Check Owner Name" required></div>';
            $("#ShowPaymentFiled").html(html);
            $('.Bank-Name-Select').select2();
        }else if(val== 'debit_credit'){
            let debithtml ='<div class="col-sm-6"><input type="number" name="card_invoice_no" class="form-control' +
                ' mt-2"' +
                ' placeholder="Debit / Credit Card No:" required></div><div class="col-sm-6 mt-2"><select' +
                ' type="text"' +
                ' name="bank_name"' +
                ' class="form-control mt-2 Bank-Name-Select" required>';
            debithtml +='<option value="">Select Bank</option>';
            $.each(bankList, function(key, val){
                debithtml += '<option value="'+val+'">'+val+'</option>';
            });
            debithtml +=' </select></div><div class="col-sm-12"><input type="text" name="card_owner_name"' +
                ' class="form-control mt-2" placeholder="Debit / Credit Card Owner Name" required></div>';
            $("#ShowPaymentFiled").html(debithtml);
            $('.Bank-Name-Select').select2();
        }else{
            $("#ShowPaymentFiled").empty();
        }
    });

});//main end
