$(document).ready(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    $(function () {
        $("select#product_category").change();
    });

    $('form').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    //For edit pos form
    if ($('form#pos_edit_form').length > 0) {
        pos_form_obj = $('form#pos_edit_form');
    } else {
        pos_form_obj = $('form#pos_form');
    }
    if ($('form#pos_edit_form').length > 0 || $('form#pos_form').length > 0) {
        initialize_printer();
    }

    // sumbit cousmtomer form
    $(document).on('click', '#submit_customer', function () {
        var data = $('#customerForm').serialize();
        var url = $('#customerForm').attr('action');

        $.ajax({
            method: "POST",
            url: url,
            data: data,
            dataType: "json",
            success: function (result) {
                if (result.success == 1) {
                    Lobibox.notify('success', {
                        pauseDelayOnHover: false,
                        continueDelayOnInactiveTab: false,
                        // icon: image,
                        sound: false,
                        position: 'top right',
                        showClass: 'zoomIn',
                        hideClass: 'zoomOut',
                        size: 'mini',
                        rounded: true,
                        width: 250,
                        height: 'auto',
                        delay: 1000,
                        msg: result.message,
                    });
                    $('#customerForm')[0].reset();
                    $('#customer_modal .close').click();
                } else {
                    if (typeof result.errors == 'object') {
                        $.each(result.errors, function (index, value) {
                            $('#_' + index).text(value).delay(5000).hide(1);
                        });
                    } else {
                        Lobibox.notify('error', {
                            pauseDelayOnHover: false,
                            continueDelayOnInactiveTab: false,
                            // icon: image,
                            sound: false,
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            size: 'mini',
                            rounded: true,
                            width: 250,
                            height: 'auto',
                            delay: 1000,
                            msg: result.message,
                        });
                    }
                }
            },
            error: function (response) {
                if (typeof response.errors == 'object') {
                    $.each(response.errors, function (index, value) {
                        $('#_' + index).text(value);
                    });
                } else {
                    swal('Sorry! Something Wrong');
                }
            }
        });
    });

    /*pos category and brand product list*/

    $(document).on('change', "select#product_category, select#product_brand", function () {
        var category_id = $('#product_category').find("option:selected").val();
        var brand_id = $('#product_brand').find("option:selected").val();
        if (category_id) {
            $.ajax({
                method: "get",
                url: public_path + '/category_products',
                dataType: "json",
                data: {'category_id': category_id, 'brand_id': brand_id},
                beforeSend: function () {
                    $('div#product_list').html('');
                    $('#suggestion_page_loader').fadeIn();
                },
                success: function (result) {
                    if (result.success) {
                        $('#suggestion_page_loader').fadeOut();
                        $('div#product_list').html(result.html);

                    } else {
                        $('#suggestion_page_loader').fadeOut();
                        swal.error(result.msg);
                    }

                }
            });

        }
    });

    /*search customer and get*/

    $('#search_customer').select2({
        ajax: {
            url: public_path + '/get_customers',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            }
        },
        minimumInputLength: 2,
        noResults: function () {
            var name = $("#search_customer").val();
            return '<button type="button" data-name="' + name + '" class="btn btn-link add_new_customer"><i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>&nbsp; ' + 'add_name_as_new_customer', {'name': name} + '</button>';
        },

        escapeMarkup: function (markup) {
            return markup;
        }

    });
    /* $('#search_customer').on('select2:select', function (e) {
         var data = e.params.data;
         console.log(data);
     });*/


    /* search product and get */
    $("#search_product").autocomplete({
        source: public_path + "/pos_product",
        minLength: 2,
        response: function (event, ui) {
            if (ui.content.length == 1) {
                ui.item = ui.content[0];
                $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                $(this).autocomplete('close');
            } else if (ui.content.length == 0) {
                swal('Sorry !! No product Found')
            }
        },
        select: function (event, ui) {
            $(this).val(null);
            var row_id = ui.item.id + '_' + ui.item.code;
            if ($('#selectedProductTable').find('tr#' + row_id).length != 0) {
                var old_quantity = parseFloat($('#quantity_' + row_id).val());
                $('#quantity_' + row_id).val(old_quantity + 1);
                $('.quantity').trigger('change');
                checkingQuantity(row_id);
                setTotalPrice();
            } else {
                addItemWithQuantity(ui.item.id, ui.item.name, ui.item.code, ui.item.sale_price, ui.item.present_quantity)
                checkingQuantity(row_id);
                setTotalPrice();
            }
        }
    })
        .autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>").append("<div>" + item.name + "</div>").appendTo(ul);
    };

    /*select product on click product*/

    $(document).on('click', '.product-card', function () {
        var code = $(this).attr('data-product_codes');
        $('#search_product').val(code);
        $('#search_product').trigger('input');
    });

    $(document).on('click', '.item_del', function (e) {
        e.preventDefault();
        var row = $(this).closest('tr');
        var item_id = row.attr('data-item-id');
        row.remove();
        setTotalPrice();
    });

    /* calculate the subtotal after update quantity*/

    $(document).on("focus", '.quantity,.sale_price', function () {
        old_row_qty = $(this).val();
    }).on("change", '.quantity,.sale_price', function () {
        var row = $(this).closest('tr');
        if (!$.isNumeric($(this).val())) {
            $(this).val(old_row_qty);
            swal("Unexpected value");
            return;
        }
        var new_qty = parseFloat(row.find('input[name="quantity[]"]').val()), id = row.attr('id');
        var sale_price = row.find('input[name="sale_price[]"]').val();
        if (sale_price && new_qty) {
            var subtotal = parseFloat((sale_price * new_qty).toFixed(2));
            row.find('.subtotal').val(subtotal);
        }
        checkingQuantity(id);
        setTotalPrice();
    });

    /* update vat and discount per product */

    $(document).on('change', 'input[name="vat[]"],input[name="unit_price[]"],select[name="discount_type[]"],input[name="discount[]"]', function () {
        var row = $(this).closest('tr');
        var vat = row.find('input[name="vat[]"]').val();
        var unit_price = parseFloat(row.find('input[name="unit_price[]"]').val());
        var discount_type = row.find('select[name="discount_type[]"]').find("option:selected").val();
        var discount = row.find('input[name="discount[]"]').val();

        var sale_price = 0, vat_amount = 0, discount_amount;
        if (vat) {
            vat_amount = (unit_price * vat) / 100;
            sale_price = unit_price + vat_amount;
        }
        if (discount_type == 'fixed') {
            discount_amount = discount;
            sale_price -= discount_amount;
        } else {
            discount_amount = (sale_price * discount) / 100;
            sale_price -= discount_amount;
        }
        row.find('input[name="sale_price[]"]').val(sale_price);
        row.find('input[name="sale_price[]"]').trigger('change');
        row.find('input[name="vat_amount[]"]').val(vat_amount);
        row.find('input[name="discount_amount[]"]').val(discount_amount);
    });

    /*if cash amount greater than payable then show return */

    $(document).on('change', 'input[name="cash_amount"]', function () {
        var cash_amount = parseFloat($(this).val());
        var total_payable = parseFloat($('input[name="total_payable"]').val());

        $('input#return_amount').val((cash_amount - total_payable).toFixed(2)).trigger('change');

        /*if (cash_amount > total_payable) {
            $('.return_amount').removeClass('hide').show(300);
            $('input#return_amount').val(cash_amount - total_payable).trigger('change');
        } else {
             $('.return_amount').addClass('hide');
        }*/

    });


    //submit sale and print invoice

    $('button#submit_pos_form').click(function () {

        // check product is in cart or not.
        if ($('table#selectedProductTable tbody').find('tr').length <= 0) {
            swal('No Product Added');
            return false;
        } else {
            var data = pos_form_obj.serialize();
            var url = pos_form_obj.attr('action');

            $.ajax({
                method: "POST",
                url: url,
                data: data,
                dataType: "json",
                success: function (result) {
                    if (result.success == 1) {
                        reset_pos_form();
                        Lobibox.notify('success', {
                            pauseDelayOnHover: false,
                            continueDelayOnInactiveTab: false,
                            // icon: image,
                            sound: false,
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            size: 'mini',
                            rounded: true,
                            width: 250,
                            height: 'auto',
                            delay: 1000,
                            msg: result.message,

                        });
                        //Check if enabled or not
                        if (result.invoice.printable) {
                            pos_print(result.invoice);
                        }
                    } else {
                        Lobibox.notify('error', {
                            pauseDelayOnHover: false,
                            continueDelayOnInactiveTab: false,
                            // icon: image,
                            sound: false,
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            size: 'mini',
                            rounded: true,
                            width: 250,
                            height: 'auto',
                            delay: 1000,
                            msg: result.message,

                        });
                    }
                }
            });
        }
    });


});

initSocket = function () {
    try {
        if (socket == null) {
            socket = new WebSocket(socket_host);
            socket.onopen = function () {

            };
            socket.onmessage = function (msg) {

            };
            socket.onclose = function () {
                socket = null;
            };
        }
    } catch (e) {
        console.log(e);
    }
}

function initialize_printer() {
    if ($('input#printer_type').data('printer_type') == 'printer') {
        initSocket();
    }
}


function addItemWithQuantity(id, text, code, sale_price, max_quantity) {
    var product_id = id, item_name = text, item_id = id;
    var row_no = id + '_' + code;
    var newTr = $('<tr id="' + row_no + '" class="' + item_id + '" data-item-id="' + item_id + '"></tr>');
    tr_html = '<td><input name="product_ids[]" type="hidden" class="rid" value="' + product_id + '"><span class="sname" id="name_' + row_no + '">' + item_name + ' ' + code + '</span>' +
        '<span class="sname pull-right" data-toggle="modal" data-target="#edit_product_price_modal_' + row_no + '" id="modal_' + row_no + '"><i class="fa fa-edit"></i></span>' +
        '<div class="modal fade edit_product_price_model" id="edit_product_price_modal_' + row_no + '" tabindex="-1" role="dialog" style="display: none;">' +
        '<div class="modal-dialog" role="document">' +
        '<div class="modal-content">' +
        '<div class="modal-header">' +
        '<h5 class="modal-title pull-left">' + item_name + ' - ' + code + '</h5>' +
        '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>' +
        '</div>' +
        '<div class="modal-body">' +
        '<div class="row">' +
        '<div class="form-group col-12 ">' +
        '<label class="col-md-5 col-form-label text-md-left">Unit Price</label>' +
        '<input type="number" min="0" step="0.01" name="unit_price[]" class="form-control col-md-5 d-inline-block " value="' + sale_price + '" aria-invalid="false">' +
        '</div>' +
        '<div class="form-group col-12 ">' +
        '<label class="col-md-5 col-form-label text-md-left">VAT(%)</label>' +
        '<input class="form-control col-md-5 d-inline-block" name="vat[]" type="number" min="0" step="1" value="0">' +
        '<input class="form-control" name="vat_amount[]" type="hidden" min="0" step="0.1" value="0">' +
        '</div>' +
        '<div class="form-group col-12 col-sm-6 ">' +
        '<label>Discount Type</label>' +
        '<select class="form-control valid" name="discount_type[]" aria-invalid="false"><option value="fixed" selected="selected">Fixed</option><option value="percentage">Percentage</option></select>' +
        '</div>' +
        '<div class="form-group col-12 col-sm-6 ">' +
        '<label>Discount</label>' +
        '<input class="form-control valid" name="discount[]" type="number" min="0" step="1" value="0.00" aria-invalid="false">' +
        '<input class="form-control" name="discount_amount[]" type="hidden" min="0" step="0.1" value="0">' +
        '</div>' +

        '</div>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</td>';
    tr_html += '<td style="padding:2px;"><input required class="form-control input-sm kb-pad rid text-center quantity" name="quantity[]" data-max_quantity="' + max_quantity + '" min="1" type="number" value="1" id="quantity_' + row_no + '" onClick="this.select();" ></td>';
    tr_html += '<td style="padding:2px;"><input required class="form-control input-sm kb-pad rid text-center sale_price" name="sale_price[]" type="number" min="0" step="0.1" value="' + sale_price + '" id="sale_price_' + row_no + '"></td>';
    tr_html += '<td style="padding:2px;"><input class="form-control input-sm kb-pad rid text-center subtotal" name="subtotal[]" type="number" min="0" step="0.1"  value="' + sale_price + '" id="subtotal_' + row_no + '"></td>';

    tr_html += '<td class="text-center"><i class="fa fa-trash-o tip pointer item_del" id="' + row_no + '" title="Remove"></i></td>';
    newTr.html(tr_html);
    newTr.prependTo("#selectedProductTable");
}


function editItemWithQuantity(id, text, code, unit_price, sale_price, quantity, max_quantity, sub_total, vat, vat_total, discount_type, discount, discount_total) {
    var product_id = id, item_name = text, item_id = id;
    var row_no = id + '_' + code;
    var newTr = $('<tr id="' + row_no + '" class="' + item_id + '" data-item-id="' + item_id + '"></tr>');
    tr_html = '<td><input name="product_ids[]" type="hidden" class="rid" value="' + product_id + '"><span class="sname" id="name_' + row_no + '">' + item_name + ' ' + code + '</span>' +
        '<span class="sname pull-right" data-toggle="modal" data-target="#edit_product_price_modal_' + row_no + '" id="modal_' + row_no + '"><i class="fa fa-edit"></i></span>' +
        '<div class="modal fade edit_product_price_model" id="edit_product_price_modal_' + row_no + '" tabindex="-1" role="dialog" style="display: none;">' +
        '<div class="modal-dialog" role="document">' +
        '<div class="modal-content">' +
        '<div class="modal-header">' +
        '<h5 class="modal-title pull-left">' + item_name + ' - ' + code + '</h5>' +
        '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>' +
        '</div>' +
        '<div class="modal-body">' +
        '<div class="row">' +
        '<div class="form-group col-12 ">' +
        '<label class="col-md-5 col-form-label text-md-left">Unit Price</label>' +
        '<input type="number" min="0" step="0.01" name="unit_price[]" class="form-control col-md-5 d-inline-block " value="' + unit_price + '" aria-invalid="false">' +
        '</div>' +
        '<div class="form-group col-12 ">' +
        '<label class="col-md-5 col-form-label text-md-left">VAT(%)</label>' +
        '<input class="form-control col-md-5 d-inline-block" name="vat[]" type="number" min="0" step="1" value="' + vat + '">' +
        '<input class="form-control" name="vat_amount[]" type="hidden" min="0" step="0.1" value="' + vat_total + '">' +
        '</div>' +
        '<div class="form-group col-12 col-sm-6 ">' +
        '<label>Discount Type</label>' +
        '<select class="form-control valid" name="discount_type[]" id="discount_type_' + id + '_' + code + '"  aria-invalid="false"><option value="fixed" >Fixed</option><option value="percentage">Percentage</option></select>' +
        '</div>' +
        '<div class="form-group col-12 col-sm-6 ">' +
        '<label>Discount</label>' +
        '<input class="form-control valid" name="discount[]" type="number" min="0" step="1" value="' + discount + '" aria-invalid="false">' +
        '<input class="form-control" name="discount_amount[]" type="hidden" min="0" step="0.1" value="' + discount_total + '">' +
        '</div>' +

        '</div>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</td>';
    tr_html += '<td style="padding:2px;"><input required class="form-control input-sm kb-pad rid text-center quantity" name="quantity[]" data-max_quantity="' + max_quantity + '" min="1" type="number" value="' + quantity + '" id="quantity_' + row_no + '" onClick="this.select();" ></td>';
    tr_html += '<td style="padding:2px;"><input required class="form-control input-sm kb-pad rid text-center sale_price" name="sale_price[]" type="number" min="0" step="0.1" value="' + sale_price + '" id="sale_price_' + row_no + '"></td>';
    tr_html += '<td style="padding:2px;"><input class="form-control input-sm kb-pad rid text-center subtotal" name="subtotal[]" type="number" min="0" step="0.1"  value="' + sub_total + '" id="subtotal_' + row_no + '"></td>';

    tr_html += '<td class="text-center"><i class="fa fa-trash-o tip pointer item_del" id="' + row_no + '" title="Remove"></i></td>';
    newTr.html(tr_html);
    newTr.prependTo("#selectedProductTable");
}

function checkingQuantity(unique_id) {
    var id = 'quantity_' + unique_id;
    var quantity = parseFloat($('#' + id).val());
    var max_quantity = parseFloat($('#' + id).attr('data-max_quantity'));
    var sale_price = parseFloat($('#sale_price_' + unique_id).text()).toFixed(2);
    var item_id = parseInt($('#' + id).attr('data-item-id'));
    if (quantity > max_quantity) {
        if (typeof items == 'undefined') {
            swal('Sorry !! Item Limit Crossed');
            $('#' + id).val(quantity - (quantity - max_quantity));
            $('#subtotal_' + unique_id).text(((quantity - (quantity - max_quantity)) * sale_price).toFixed(2));
        } else {
            var index = $.inArray(item_id, items.ids);
            if ((index >= 0)) {
                // console.log('old product');
                var old_value = items.quantity[index];
                if (quantity > (max_quantity + old_value)) {
                    swal('Sorry !! Item Limit Crossed');
                    $('#' + id).val(old_value + max_quantity);
                    $('#subtotal_' + unique_id).text(((old_value + max_quantity) * sale_price).toFixed(2));
                } else {
                    $('#' + id).val(quantity);
                    $('#subtotal_' + unique_id).text((quantity * sale_price).toFixed(2));
                }
            } else {
                swal('Sorry !! Item Limit Crossed');
                $('#' + id).val(quantity - (quantity - max_quantity));
                $('#subtotal_' + unique_id).text(((quantity - (quantity - max_quantity)) * sale_price).toFixed(2));
            }
        }
    } else {
        $('#subtotal_' + unique_id).text(parseFloat((quantity * sale_price).toFixed(2)));
    }
};

function setTotalPrice() {
    var total = 0;
    $.each($('#pos_form,#pos_edit_form').find("input[name='subtotal[]']"), function (key, value) {
        total += parseFloat(value.value);
    });
    $('#net_total').text(total.toFixed(2));
    $("input[name='net_total']").val(total.toFixed(2));

    var vat = parseFloat($('input[name="vat_on_total"]').val());
    var vat_charge = (total * vat) / 100;
    $('#vat_charge').text(vat_charge.toFixed(2));
    $("input[name='vat_amount_of_total']").val(vat_charge.toFixed(2));

    var discount_type = $("input[name='discount_type_of_total']").val();
    var discount = parseFloat($("input[name='discount_on_total']").val());
    var discount_amount;
    if (discount_type == 'fixed') {
        discount_amount = discount;
        $("input[name='discount_amount_of_total']").val(discount_amount);
    } else {
        discount_amount = (total * discount) / 100;
        $('#discount_amount_of_total').text(discount_amount.toFixed(2));
        $("input[name='discount_amount_of_total']").val(discount_amount);
    }
    var total_payable = (total + vat_charge - discount_amount);
    $('#total_payable').text(total_payable.toFixed(2));
    $("input[name='total_payable']").val(total_payable.toFixed(2));
};


/*print invoice */
function pos_print(invoice) {
    //If printer type then connect with websocket
    if (invoice.printer_type == 'printer') {

        var content = invoice;
        content.type = 'print-receipt';

        //Check if ready or not, then print.
        if (socket.readyState != 1) {
            initSocket();
            setTimeout(function () {
                socket.send(JSON.stringify(content));
            }, 700);
        } else {
            socket.send(JSON.stringify(content));
        }

    } else if (invoice.html_content != '') {
        //If printer type browser then print content
        $('#print_container').html((invoice.html_content).replace(/(^"|"$)/g, ''));
        setTimeout(function () {
            window.print();
        }, 1200);
    }
}

//    reset form

function reset_pos_form() {

    //If on sale page then redirect to sales list

    if (window.location.href .split('/').slice(-2)[0]=='sales') {
        setTimeout(function () {
            window.location = public_path + '/sales';
        }, 4000);
        return true;
    }
    if (window.location.href .split('/').slice(-3)[0]=='sales') {
        setTimeout(function () {
            window.location = public_path + '/sales';
        }, 4000);
        return true;
    }
    if ($('form#pos_edit_form').length > 0) {
        setTimeout(function () {
            window.location = public_path + '/pos/create/';
        }, 4000);
        return true;
    }

    if (pos_form_obj[0]) {
        pos_form_obj[0].reset();
    }
    // set_default_customer();

    $('#selectedProductTable tbody tr').remove();
    $('#net_total, #vat_charge, #total_payable,#discount_amount_of_total').text(0);
    $('input[name="net_total"], input[name="vat_amount_of_total"],input[name="discount_amount_of_total"],input[name="total_payable"],input[name="cash_amount"]').val(0);

    $('select#search_customer').val(1).trigger('change');
    $('select.payment_method').val('cash').trigger('change');

}

/*set selected discount type */

function setSelectedIndex(s, valsearch) {

// Loop through all the items in drop down list

    for (i = 0; i < s.options.length; i++) {

        if (s.options[i].value == valsearch) {

// Item is found. Set its property and exit

            s.options[i].selected = true;

            break;

        }

    }

    return;

}

