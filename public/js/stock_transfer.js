$(document).ready(function () {

    $(document).on('change', '#product', function () {
        var id = $(this).find("option:selected").val();
        var text = $(this).find("option:selected").text();
        if(id) {
            var limit = parseFloat($(this).find("option:selected").attr('data-limit'));
            var purchase_price = $(this).find("option:selected").attr('data-purchase_price');
            var sale_price = $(this).find("option:selected").attr('data-sale_price');
            $(this).val(null).trigger('change');
            var row_id = id;
            if(limit) {
                if ($('#selectedProductTable').find('tr#' + row_id).length != 0) {
                    var old_quantity = parseFloat($('#quantity_' + row_id).val());
                    $('#quantity_' + row_id).val(old_quantity + 1);
                    $('.quantity').trigger('change');
                    checkingQuantity(row_id);
                    // setTotalPrice();
                } else {
                    addItemWithQuantity(id, text, purchase_price, limit, sale_price);
                    // setTotalPrice();
                    checkingQuantity(row_id);
                }
            }else{
                swal('Sorry !! Product have No Quantity');
            }
        }
    });

    $(document).on('click', '.item_del', function (e) {
        e.preventDefault();
        var row = $(this).closest('tr');
        var item_id = row.attr('data-item-id');
        row.remove();
        setTotalPrice();
    });

    /* calculate the unit price after update quantity*/

    $(document).on("focus", '.quantity', function () {
        old_row_qty = $(this).val();
    }).on("change", '.quantity', function () {
        var row = $(this).closest('tr');
        if (!$.isNumeric($(this).val())) {
            $(this).val(old_row_qty);
            alert("Unexpected value");
            return;
        }
        var new_qty = parseFloat($(this).val()), id = row.attr('id');
        var purchase_price = $(this).closest('tr').find('input[name="purchase_price[]"]').val();
        if(purchase_price && new_qty) {
            row.find('.sub_total').val((purchase_price * new_qty).toFixed(2));
            row.find('#sub_total_'+id).text((purchase_price * new_qty).toFixed(2));
        }
        checkingQuantity(id);
    });
 /* calculate the unit price after update unit price=purchase_price*/

    $(document).on("focus", '.purchase_price', function () {
        old_purchase_price = $(this).val();
    }).on("change", '.purchase_price', function () {
        var row = $(this).closest('tr');
        if (!$.isNumeric($(this).val())) {
            $(this).val(old_purchase_price);
            alert("Unexpected value");
            return;
        }
        var purchase_price = parseFloat($(this).val()), id = row.attr('id');
        var new_qty = $(this).closest('tr').find('input[name="quantity[]"]').val();
        if(purchase_price && new_qty) {
            row.find('.sub_total').val((purchase_price * new_qty).toFixed(2));
            row.find('#sub_total_'+id).text((purchase_price * new_qty).toFixed(2));
        }
        checkingQuantity(id);
    });

});


function addItemWithQuantity(id, text, purchase_price, limit,sale_price) {
    var product_id = id, item_name = text, item_id = id;
    var row_no = id;
    var newTr = $('<tr id="' + row_no + '" class="' + item_id + '" data-item-id="' + item_id + '"></tr>');
    tr_html = '<td style="min-width:100px;"><input name="product_ids[]" type="hidden" class="rid" value="' + product_id + '"><span class="sname" id="name_' + row_no + '">' + item_name + '</span></td>';
    tr_html += '<td style="padding:2px;"><input class="form-control input-sm kb-pad rid text-center quantity" name="quantity[]" min="1" data-max_quantity="'+limit+'" type="number" value="1" id="quantity_' + row_no + '" onClick="this.select();" ></td>';
    tr_html += '<td style="padding:2px;"><input class="form-control input-sm kb-pad rid text-center purchase_price" name="purchase_price[]" type="number" min="0" step="0.01"  value="'+ purchase_price +'" id="purchase_price_' + row_no + '"></td>';
    tr_html += '<td style="padding:2px;"><input name="sale_price[]" type="hidden" value="' + sale_price + '"><input class="form-control input-sm kb-pad rid text-center sub_total" readonly name="sub_total[]" type="number" min="0" step="0.01" value="'+ purchase_price +'" id="sub_total_' + row_no + '"></td>';

    tr_html += '<td class="text-center"><i class="fa fa-trash-o tip pointer item_del" id="' + row_no + '" title="Remove"></i></td>';
    newTr.html(tr_html);
    newTr.prependTo("#selectedProductTable");
}

function editItemWithQuantity(id, text, code,category,total_cost,quantity,purchase_price, profit_margin,sale_price) {
    var product_id = id, item_name = text, item_id = id, product_code = code;
    var row_no = id+ '_' +code;
    var newTr = $('<tr id="' + row_no + '" class="' + item_id + '" data-item-id="' + item_id + '"></tr>');
    tr_html = '<td style="min-width:100px;"><input name="product_ids[]" type="hidden" class="rid" value="' + product_id + '"><span class="sname" id="name_' + row_no + '">' + item_name + '</span></td>';
    tr_html += '<td style="min-width:100px;"><span class="sname" id="code_' + row_no + '">' + product_code + '</span></td>';
    tr_html += '<td style="min-width:100px;"><span class="sname" id="category_' + row_no + '">' + category + '</span></td>';
    tr_html += '<td style="padding:2px;"><input class="form-control input-sm kb-pad rid text-center total_cost" name="total_cost[]" type="number" min="0" step="1" value="'+ total_cost +'" id="total_cost_' + row_no + '"></td>';
    tr_html += '<td style="padding:2px;"><input class="form-control input-sm kb-pad rid text-center quantity" name="quantity[]" min="1" type="number" value="'+ quantity +'" id="quantity_' + row_no + '" onClick="this.select();" ></td>';
    tr_html += '<td style="padding:2px;"><input class="form-control input-sm kb-pad rid text-center purchase_price" name="purchase_price[]" type="number" min="0" step="0.01"  value="'+ purchase_price +'" id="purchase_price_' + row_no + '"></td>';
    tr_html += '<td style="padding:2px;"><input class="form-control input-sm kb-pad rid text-center profit_margin" name="profit_margin[]" type="number" min="0" step="1"  value="'+ profit_margin +'" id="profit_margin_' + row_no + '"></td>';
    tr_html += '<td style="padding:2px;"><input class="form-control input-sm kb-pad rid text-center sale_price" name="sale_price[]" type="number" min="0" step="0.01" value="'+ sale_price+'" id="sale_price_' + row_no + '"></td>';

    tr_html += '<td class="text-center"><i class="fa fa-trash-o tip pointer item_del" id="' + row_no + '" title="Remove"></i></td>';
    newTr.html(tr_html);
    newTr.prependTo("#selectedProductTable");
}
function showItemWithQuantity(id, text, code,quantity,purchase_price, sub_total,sale_price) {
    var product_id = id, item_name = text, item_id = id, product_code = code;
    var row_no = id;
    var newTr = $('<tr id="' + row_no + '" class="' + item_id + '" data-item-id="' + item_id + '"></tr>');
    tr_html = '<td style="min-width:100px;"><input name="product_ids[]" type="hidden" class="rid" value="' + product_id + '"><span class="sname" id="name_' + row_no + '">' + item_name + '</span></td>';
    tr_html += '<td style="padding:2px;"><span class="sname">'+ quantity + '</span></td>';
    tr_html += '<td style="padding:2px;"><span class="sname">'+ purchase_price + '</span></td>';
    tr_html += '<td style="padding:2px;"><span class="sname">'+ sub_total + '</span></td>';

    newTr.html(tr_html);
    newTr.prependTo("#selectedProductTable");
}

function checkingQuantity(unique_id) {
    var id = 'quantity_' + unique_id;
    var quantity = parseFloat($('#' + id).val());
    var max_quantity = parseFloat($('#' + id).attr('data-max_quantity'));
    var purchase_price = parseFloat($('#purchase_price_' + unique_id).text()).toFixed(2);
    var item_id = parseInt($('#' + id).attr('data-item-id'));
    if( quantity > max_quantity){
            alert('Item Limit Crossed ');
            $('#'+id).val(quantity - (quantity-max_quantity));
            $('#sub_total_'+unique_id).text(((quantity - (quantity-max_quantity))*purchase_price).toFixed(2));

    }else{
        $('#sub_total_'+unique_id).text((quantity*purchase_price).toFixed(2));
    }
    setTotalPrice();
};

function setTotalPrice() {
    var total = 0;
    $.each($('#stock_transfersForm').find("input[name='sub_total[]']"), function (key, value) {
        total += parseFloat(value.value);
    });
    $('#total_cost').text(total.toFixed(2));
    $('input[name="total_cost"]').val(total.toFixed(2));
};