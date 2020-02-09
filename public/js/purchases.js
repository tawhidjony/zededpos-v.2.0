
$(document).ready(function () {
    function purchasesCalculation(){
        var totalPrice = 0, priceArray = 0;
        priceArray = [];
        $('#purchases-data-table').find('tbody tr').each(function(key, element){
            var currentEle  = $(element), 
                quantity    = currentEle.find('input.quantity').val(),
                buy_price   = currentEle.find('input.buy_price').val(),
                sell_price  = currentEle.find('input.sell_price').val(),
                singleProductTotalPrice = 0; 
                if( quantity != '' && buy_price != '' ){
                    singleProductTotalPrice = (quantity * buy_price);
                    //totalPrice += singleProductTotalPrice;
                    priceArray.push(singleProductTotalPrice);
                }
                
        });
        if(priceArray.length > 0){ 
            totalPrice = priceArray.reduce(function(x, y){
                return x +=y;
            });
            $('input[name="total"]').val(totalPrice);
            var paid = $('input[name="paid"]').val();
            $('input[name="due"]').val( (totalPrice - parseInt(paid) ) );
        }
    }
    //Category Added
    if(typeof  ajaxUrls !== 'undefined') {
        $("#addCategory").on('click', function (e) {
            e.preventDefault();
            var catname = $("#CategoryModal").find('input[name="name"]').val();
            var actiontype = '';
            if (catname.length > 0) {
                var data = {name: catname};

                $.ajax({
                    url: ajaxUrls.addCat,
                    type: 'POST',
                    data: data,
                    beforeSend: function () {
                        $(".load").fadeIn("5000");
                    },
                    success: function (data) {
                        if (data.status == "success") {
                            outputhtml = '<option value>Select Category</option>';
                            $.each(data.allcat, function (key, value) {
                                outputhtml += '<option value="' + value.id + '">' + value.name + '</option>';
                            });
                            if (outputhtml) {
                                $('#selectNewProductModel').find('select[name="category_id"]').empty().append(outputhtml);
                                $('#SubCategoryModal').find('select[name="parent_category_id"]').empty().append(outputhtml);
                                $("#CategoryModal").hide();
                                $("#CategoryModal").find('input[name="name"]').val('');
                                swal("Great", "successfully Insert Category", "success").then((result)=>{
                                    $('#selectNewProductModel').show();
                                });
                            }
                        }
                    },
                    complete: function () {
                        $(".load").fadeOut("5000");
                    },
                });
            }
        });
    }


    //Sub Category Area
    if (typeof  ajaxUrls !== 'undefined'){
        $("#addSubCategory").on('click', function (e) {
        e.preventDefault();
        var catname = $("#SubCategoryModal").find('input[name="name"]').val();
        var parent_category_id = $("#SubCategoryModal").find('select[name="parent_category_id"]').val();

        if(catname.length > 0 &&  parent_category_id.length > 0 ){
            var data = {name: catname, category_id: parent_category_id};
            $.ajax({
                url: ajaxUrls.addSubCat, 
                type: 'POST', 
                data:data,
                beforeSend: function () {
                    $(".load").fadeIn("5000");
                },
                success: function (data) { 
                    if (data.status== "success") {
                        outputhtml = '<option value>Select SubCategory</option>';
                        $.each(data.allcat, function(key, value){
                            outputhtml += '<option value="'+value.id+'">'+value.name+'</option>';
                        });
                        if(outputhtml){ 
                            $('#selectNewProductModel').find('select[name="sub_category_id"]').empty().append(outputhtml);
                            $("#SubCategoryModal").hide();
                            $("#SubCategoryModal").find('input[name="name"]').val('');
                            swal("Great","successfully Insert Category" ,"success").then((result) => {
                                $('#selectNewProductModel').show();
                            });
                        }   
                    }
                },
                complete: function () {
                    $(".load").fadeOut("5000");
                },
            });
        }
    });
    }

    //Tag Sub Category Area
    if (typeof  ajaxUrls !== 'undefined'){
        $("#addTagSubCategory").on('click', function (e) {
        e.preventDefault();
        var tagcatname = $("#TagSubCategoryModal").find('input[name="name"]').val();
        var parent_tagcategory_id = $("#TagSubCategoryModal").find('select[name="parent_tagsubcategory_id"]').val();

        if(tagcatname.length > 0 &&  parent_tagcategory_id.length > 0 ){
            var data = {name: tagcatname, sub_category_id: parent_tagcategory_id};
            $.ajax({
                url: ajaxUrls.addTagSubCat, 
                type: 'POST', 
                data:data,
                beforeSend: function () {
                    $(".load").fadeIn("5000");
                },
                success: function (data) { 
                    if (data.status== "success") {
                        outputhtml = '<option value>Select TagSubCategory</option>';
                        $.each(data.alltagcat, function(key, value){
                            outputhtml += '<option value="'+value.id+'">'+value.name+'</option>';
                        });
                        if(outputhtml){ 
                            $('#selectNewProductModel').find('select[name="tag_sub_category_id"]').empty().append(outputhtml);
                            $("#TagSubCategoryModal").hide();
                            $("#TagSubCategoryModal").find('input[name="name"]').val('');
                            swal("Great","successfully Insert Tag Category" ,"success").then((result) => {
                                $('#selectNewProductModel').show();
                            });
                        }   
                    }
                },
                complete: function () {
                    $(".load").fadeOut("5000");
                },
            });
        }
    });
    }
    //Brand Modal Area
    if (typeof  ajaxUrls !== 'undefined'){
     $("#addBrand").on('click', function (e) {
        e.preventDefault(); 
        var BrandName = $("#BrandModal").find('input[name="name"]').val();

        if(BrandName.length > 0){
            var data = {name: BrandName};
            $.ajax({
                url: ajaxUrls.addBrand, 
                type: 'POST', 
                data: data,
                success: function (data) { 
                    if (data.status== "success") {
                        outputhtml = '<option value>Select Brand</option>';
                        $.each(data.allBrand, function(key, value){
                            outputhtml += '<option value="'+value.id+'">'+value.name+'</option>';
                        });
                        if(outputhtml){ 
                            $('#selectNewProductModel').find('select[name="brand_id"]').empty().append(outputhtml);
                            $("#BrandModal").hide();
                            $("#BrandModal").find('input[name="name"]').val('');
                            swal("Great","Successfully Insert Brand" ,"success").then((result) => {
                                $('#selectNewProductModel').show();
                            });
                        }   
                    }
                },
                complete: function () {
                    $(".load").fadeOut("5000");
                },
            });
        }
    });
    }
    //Product Model Area
    if (typeof  ajaxUrls !== 'undefined'){
     $("#addModel").on('click', function (e) {
        e.preventDefault();
        var ProductModalName = $("#ProductModal").find('input[name="name"]').val();

        if(ProductModalName.length > 0){
            var data =  {name: ProductModalName};
            $.ajax({
                url: ajaxUrls.addModal, 
                type: 'POST', 
                data:data,
                beforeSend: function () {
                    $(".load").fadeIn("5000");
                },
                success: function (data) { 
                    if (data.status== "success") {
                        outputhtml = '<option value>Select Model</option>';
                        $.each(data.allBModal, function(key, value){
                            outputhtml += '<option value="'+value.id+'">'+value.name+'</option>';
                        });
                        if(outputhtml){ 
                            $('#selectNewProductModel').find('select[name="pro_model_id"]').empty().append(outputhtml);
                            $("#ProductModal").hide();
                            $("#ProductModal").find('input[name="name"]').val('');
                            swal("Great","Successfully Insert Modal" ,"success").then((result) => {
                                $('#selectNewProductModel').show();
                            });
                        }   
                    }
                },
                complete: function () {
                    $(".load").fadeOut("5000");
                },
            });
        }
    });
    }

    //Product unit Area
    if (typeof  ajaxUrls !== 'undefined') {
         $("#AddUnit").on('click', function (e) {
        e.preventDefault();
        var ProductUnit = $("#ProductUnit").find('input[name="name"]').val();
        if(ProductUnit.length > 0){
            var data =  {name: ProductUnit};
            $.ajax({
                url: ajaxUrls.addUnit, 
                type: 'POST', 
                data:data,
                success: function (data) { 
                    if (data.status== "success") {
                        outputhtml = '<option value="">Select Unit</option>';
                        $.each(data.allUnit, function(key, value){
                            outputhtml += '<option value="'+value.id+'">'+value.name+'</option>';
                        });
                        if(outputhtml){ 
                            $('#selectNewProductModel').find('select[name="unit_id"]').empty().append(outputhtml);
                            $("#ProductUnit").hide();
                            $("#ProductUnit").find('input[name="name"]').val('');
                            swal("Great","Successfully Insert Modal" ,"success").then((result) => {
                                $('#selectNewProductModel').show();
                            });
                        }   
                    }
                },

            });
        }
    });//end
    }
    //Supplier
    $("#supplierAdd").on('submit', function (e) {
        e.preventDefault();
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
                if (data.status== "success") {
                    outputhtml = '<option value="">Select Supplier Name</option>';
                    $.each(data.allSupplier, function(key, value){
                        outputhtml += '<option value="'+value.id+'">'+value.name+'</option>';
                    });
                    if(outputhtml){ 
                        $('select[name="supplier_id"]').empty().append(outputhtml);
                        $("#SupplierModal").modal('hide');  
                        form[0].reset();
                        swal("Great","successfully Insert Supplier" ,"success").then((result) => {
                            //$('#selectOldProductModel').show();
                        });
                    }   
                }
            },

        });

    });//end

    function newProductFormValidation(){
        var form = $('#selectNewProductModel');
        var status = false;
        var elementArray = [
            'input[name="name"]', 
            'input[name="code_id"]', 
            'select[name="category_id"]', 
            'select[name="brand_id"]', 
            'select[name="unit_id"]', 
            'input[name="alart_quantity"]'
        ];
        var loop = $.each(elementArray, function(key, element){ 
            //console.log(form.find(element));
            if(form.find(element).val() == '' ){
                form.find(element).parents('.input-group').addClass('error');
                form.find(element).parents('.input-group').find('.error-msg').remove();
                form.find(element).parents('.input-group').append('<span class="error-msg">This field is required.</span>');
                status = false;
                return false;
            }else{
                form.find(element).parents('.input-group').removeClass('error');
                form.find(element).parents('.input-group').find('.error-msg').remove();
                status =true;
                return true;
            } 
        });
        if(loop){
            return status;
        }  
    }
    //Product Submit
    $("#newProductSubmit").on('click', function (e) { 
        e.preventDefault();
        //console.log(newProductFormValidation());
        if(newProductFormValidation()){
            var form = $('#newProductForm'); 
            var data = new FormData(form[0]); 
                data.append('requestType', 'ajax');
            var name    = form.find('input[name="name"]').val(), 
                codeid  = form.find('input[name="code_id"]').val(), 
                cat     = form.find('input[name="category_id"]').val(), 
                unit    = form.find('input[name="code_id"]').val();
            //if(){
                $.ajax({
                    //url: ajaxUrls.addProduct, 
                    url: ajaxUrls.addProduct, 
                    type: 'POST', 
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) { 
                        if (data.status == "success") {
                            var newOption = new Option(data.currentProduct.name, data.currentProduct.id, true, true);
                            $('#selectOldProductModel').find('.product-list').append(newOption);//.trigger('change');
                            $('#selectNewProductModel').modal('hide');
                            $('#selectNewProductModel').hide();
                            $('#selectNewProductModel').find('input[type="text"], select, textarea').val('');
                            var product_id = data.currentProduct.id, product_name = data.currentProduct.name;
                            var outputHtml = `<tr data-id="`+product_id+`"><th scope="row">`+( $('#purchases-data-table').find('tbody').length + 1 )+`</th>
                            <td>`+product_name+`<input type="hidden" name="product[`+product_id+`][product_id]" value="`+product_id+`" ></td>
                            <td><input type="text" class="form-control quantity" name="product[`+product_id+`][quantity]" ></td>
                            <td><input type="text" class="form-control buy_price" name="product[`+product_id+`][buy_price]" ></td>
                            <td><input type="text" class="form-control sell_price" name="product[`+product_id+`][sell_price]" ></td>
                            <td><span class="remove-product"><i class="fa fa-trash"></1></span></td></tr>`;
                            if( $('#purchases-data-table').find('tbody tr.no-data').length > 0 ){
                                $('#purchases-data-table').find('tbody tr.no-data').remove();
                            }
                            $('#purchases-data-table').find('tbody').append(outputHtml);
                        }
                    },

                });
            //}
        }

    });//end

    $('#addOldProductToTable').on('click', function(event){
        var selectModel     = $('#selectOldProductModel'),
            //supplier_id     = selectModel.find('select[name="supplier_id"]').val(),
            //supplier_name   = '',
            product_id      = selectModel.find('select[name="product_id"]').val(),
            product_name    = '',
            outputHtml      = '';
           
        if(product_id != ''){
            //supplier_name = selectModel.find('select[name="supplier_id"]').find('option[value="'+supplier_id+'"]').text();
            product_name = selectModel.find('select[name="product_id"]').find('option[value="'+product_id+'"]').text();

            //<td>`+supplier_name+`<input type="hidden" name="product[`+product_id+`][supplier]" value="`+supplier_id+`" ></td>
            outputHtml += `<tr data-id="`+product_id+`"><th scope="row">`+( $('#purchases-data-table').find('tbody').length + 0 )+`</th>
            <td>`+product_name+`<input type="hidden" name="product[`+product_id+`][product_id]" value="`+product_id+`" ></td>
            <td><input type="text" class="form-control quantity" name="product[`+product_id+`][quantity]" ></td>
            <td><input type="text" class="form-control buy_price" name="product[`+product_id+`][buy_price]" ></td>
            <td><input type="text" class="form-control sell_price" name="product[`+product_id+`][sell_price]" ></td>
            <td><span class="remove-product"><i class="fa fa-trash"></1></span></td></tr>`;
            if( $('#purchases-data-table').find('tbody tr[data-id="'+product_id+'"]').length > 0 ){
                swal ( "Oops" ,  "This Product has been added" ,  "info" );
            }else{
                if( $('#purchases-data-table').find('tbody tr.no-data').length > 0 ){
                    $('#purchases-data-table').find('tbody tr.no-data').remove();
                }
                $('#purchases-data-table').find('tbody').append(outputHtml);
                $('#selectOldProductModel').modal('hide');
            }  
        }
    });

    $('#purchases-data-table').on('keyup', 'input.quantity, input.buy_price, input#PayAmount', function(){
        purchasesCalculation();
    });
    $('#purchases-data-table').find('tbody').on('click', '.remove-product', function(event){
        $(this).parents('tr').remove();
        purchasesCalculation();
    });

});


// $(document).ready(function(){
//     if($('.product-list').length > 0) {
//         $('.product-list').select2();
//     }
// }); 

$(document).ready(function(){
    $('.products-row').on('click', '.title h5', function(event){
        $(this).parents('.single-product').siblings().removeClass('active').find('.content').slideUp();
        $(this).parents('.single-product').addClass('active').find('.content').slideDown();
    });

    $('#add-new-product').click(function(event){
        event.preventDefault();
        $('#selectNewProductModel').modal('show');
      
    });

    $('#add-exist-row').click(function(event){
        event.preventDefault();
        $('#selectOldProductModel').modal('show');
    });
    $('.products-row').on('click', 'span.close-row', function (e) {
        $(this).parents('.single-product').slideUp().remove();
    });
    $('.product-list').on('select2:select', function (e) {
        var data = e.params.data;
        console.log(data);
        $(this).parents('.single-product').find('.title h5').text(data.text);
    });
    $("#CategoryModal, #SubCategoryModal, #BrandModal, #ProductModal, #ProductUnit").on('show.bs.modal', function(event){
        $('#selectNewProductModel').hide();
    });
    $("#CategoryModal, #SubCategoryModal, #BrandModal, #ProductModal, #ProductUnit").on('hide.bs.modal', function(event){
        $('#selectNewProductModel').show();
    });
    $('#selectNewProductModel').find('input[name="code_id"]').keypress(function(event){
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

});