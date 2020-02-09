$(document).ready(function () {

    $(document).on('change', '#product', function () {
        var id = $(this).find("option:selected").val();
        var code = $(this).find("option:selected").text();
        if(id) {
            var text = $(this).find("option:selected").attr('data-name');
            var category = $(this).find("option:selected").attr('data-category');
            $(this).val(null).trigger('change');
            var row_id = id + '_' + code;
            if ($('#selectedProductTable').find('tr#' + row_id).length != 0) {
                var old_quantity = parseFloat($('#quantity_' + row_id).val());
                $('#quantity_' + row_id).val(old_quantity + 1);
                $('.quantity').trigger('change');
                // checkingQuantity(row_id);
                setTotalPrice();
            } else {
                addItemWithQuantity(id, text, code, category);
                setTotalPrice();
                // checkingQuantity(row_id);
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

    /* calculate the unit price after update total cost*/

    var old_row_qty;
    $(document).on("focus", '.total_cost', function () {
        old_total_cost = $(this).val();
    }).on("change", '.total_cost', function () {
        var row = $(this).closest('tr');
        if (!$.isNumeric($(this).val())) {
            $(this).val(old_total_cost);
            alert("Unexpected value");
            return;
        }
        var total_cost = parseFloat($(this).val()), id = row.attr('id');
        var new_qty = $(this).closest('tr').find('input[name="quantity[]"]').val();
        if(total_cost && new_qty) {
            var unit_price = parseFloat((total_cost / new_qty).toFixed(2));
            row.find('.purchase_price').val(unit_price);
            row.find('#purchase_price_'+id).text(unit_price);
            var margin = parseFloat($(this).closest('tr').find('input[name="profit_margin[]"]').val());
            if(margin){
                var sale_price = parseFloat((unit_price +  ((unit_price * margin)/100)).toFixed(2));
                row.find('.sale_price').val(sale_price);
                row.find('#sale_price_'+id).text(sale_price);
            }
        }
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
        var total_cost = $(this).closest('tr').find('input[name="total_cost[]"]').val();
        if(total_cost && new_qty) {
            var unit_price = parseFloat((total_cost / new_qty).toFixed(2));
            row.find('.purchase_price').val(unit_price);
            row.find('#purchase_price_'+id).text(unit_price);
            var margin = $(this).closest('tr').find('input[name="profit_margin[]"]').val();
            if(margin){
                var sale_price = parseFloat((unit_price +  ((unit_price * margin)/100)).toFixed(2));
                row.find('.sale_price').val(sale_price);
                row.find('#sale_price_'+id).text(sale_price);
            }
        }
        setTotalPrice();
    });

    /* calculate the sale price after update margin */

    $(document).on("focus", '.profit_margin', function () {
        old_margin = $(this).val();
    }).on("change", '.profit_margin', function () {

        var row = $(this).closest('tr');
        if (!$.isNumeric($(this).val())) {
            $(this).val(old_margin);
            alert("Unexpected value");
            return;
        }
        var new_margin = parseFloat($(this).val()), id = row.attr('id');
        var unit_price = parseFloat($(this).closest('tr').find('input[name="purchase_price[]"]').val());
        if(unit_price && new_margin) {
            row.find('.sale_price').val((unit_price +  ((unit_price * new_margin)/100) ).toFixed(2));
            row.find('#sale_price_'+id).text((unit_price + ((unit_price * new_margin)/100)).toFixed(2));
        }
    });

    /* calculate the sale price after update unit price */

    $(document).on("focus", '.purchase_price', function () {
        old_unit_price = $(this).val();
    }).on("change", '.purchase_price', function () {

        var row = $(this).closest('tr');
        if (!$.isNumeric($(this).val())) {
            $(this).val(old_unit_price);
            alert("Unexpected value");
            return;
        }
        var new_unit_price = parseFloat($(this).val()), id = row.attr('id');
        var margin = $(this).closest('tr').find('input[name="profit_margin[]"]').val();
        if(new_unit_price && margin){
            var sale_price = parseFloat((new_unit_price +  ((new_unit_price * margin)/100)).toFixed(2));
            row.find('.sale_price').val(sale_price);
            row.find('#sale_price_'+id).text(sale_price);
        }
    });
});


function addItemWithQuantity(id, text, code,category) {
    var product_id = id, item_name = text, item_id = id, product_code = code;
    var row_no = id+ '_' +code;
    var newTr = $('<tr id="' + row_no + '" class="' + item_id + '" data-item-id="' + item_id + '"></tr>');
    tr_html = '<td style="min-width:100px;"><input name="product_ids[]" type="hidden" class="rid" value="' + product_id + '"><span class="sname" id="name_' + row_no + '">' + item_name + '</span></td>';
    tr_html += '<td style="min-width:100px;"><span class="sname" id="code_' + row_no + '">' + product_code + '</span></td>';
    tr_html += '<td style="min-width:100px;"><span class="sname" id="category_' + row_no + '">' + category + '</span></td>';
    tr_html += '<td style="padding:2px;"><input required class="form-control input-sm kb-pad rid text-center total_cost" name="total_cost[]" type="number" min="0" step="1" value="0" id="total_cost_' + row_no + '"></td>';
    tr_html += '<td style="padding:2px;"><input required class="form-control input-sm kb-pad rid text-center quantity" name="quantity[]" min="1" type="number" value="1" id="quantity_' + row_no + '" onClick="this.select();" ></td>';
    tr_html += '<td style="padding:2px;"><input required class="form-control input-sm kb-pad rid text-center purchase_price" name="purchase_price[]" type="number" min="0" step="0.01"  value="" id="purchase_price_' + row_no + '"></td>';
    tr_html += '<td style="padding:2px;"><input class="form-control input-sm kb-pad rid text-center profit_margin" name="profit_margin[]" type="number" min="0" step="1"  value="" id="profit_margin_' + row_no + '"></td>';
    tr_html += '<td style="padding:2px;"><input required class="form-control input-sm kb-pad rid text-center sale_price" name="sale_price[]" type="number" min="0" step="0.01" value="" id="sale_price_' + row_no + '"></td>';

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
function showItemWithQuantity(id, text, code,category,total_cost,quantity,purchase_price, profit_margin,sale_price) {
    var product_id = id, item_name = text, item_id = id, product_code = code;
    var row_no = id+ '_' +code;
    var newTr = $('<tr id="' + row_no + '" class="' + item_id + '" data-item-id="' + item_id + '"></tr>');
    tr_html = '<td style="min-width:100px;"><input name="product_ids[]" type="hidden" class="rid" value="' + product_id + '"><span class="sname" id="name_' + row_no + '">' + item_name + '</span></td>';
    tr_html += '<td style="min-width:100px;"><span class="sname" id="code_' + row_no + '">' + product_code + '</span></td>';
    tr_html += '<td style="min-width:100px;"><span class="sname" id="category_' + row_no + '">' + category + '</span></td>';
    tr_html += '<td style="padding:2px;"><span class="sname">'+ total_cost + '</span></td>';
    tr_html += '<td style="padding:2px;"><span class="sname">'+ quantity + '</span></td>';
    tr_html += '<td style="padding:2px;"><span class="sname">'+ purchase_price + '</span></td>';
    tr_html += '<td style="padding:2px;"><span class="sname">'+ profit_margin + '</span></td>';
    tr_html += '<td style="padding:2px;"><span class="sname">'+ sale_price + '</span></td>';

    newTr.html(tr_html);
    newTr.prependTo("#selectedProductTable");
}

function checkingQuantity(unique_id) {
    var id = 'quantity_' + unique_id;
    var quantity = parseFloat($('#' + id).val());
    var max_quantity = parseFloat($('#' + id).attr('data-max_quantity'));
    var sale_price = parseFloat($('#price_' + unique_id).text()).toFixed(2);
    var due_amount = parseFloat($('#due_amount_' + unique_id).text()).toFixed(2);
    var paid_amount = parseFloat($('#due_amount_' + unique_id).attr('data-paid_amount'));
    var item_id = parseInt($('#' + id).attr('data-item-id'));
    if( quantity > max_quantity){
        if($.isEmptyObject(items)){
            alert('Item Limit Crossed ');
            $('#'+id).val(quantity - (quantity-max_quantity));
            $('#net_price_'+unique_id).text(((quantity - (quantity-max_quantity))*sale_price).toFixed(2));
            $('#due_amount_'+unique_id).text(((quantity - (quantity-max_quantity))*sale_price).toFixed(2));
        }else{
            var index = $.inArray(item_id, items.ids);
            var size = $('#size_'+unique_id,).text();
            var hasSize = $.inArray(size, items.size);
            // console.log(index,size,hasSize);
            if((index >= 0) && (hasSize>=0)){
                // console.log('old product');
                var old_value = items.quantity[hasSize];
                if(quantity > (max_quantity + old_value)){
                    alert('Item Limit Crossed ');
                    $('#'+id).val(old_value + max_quantity);
                    $('#net_price_'+unique_id).text(((old_value + max_quantity)*sale_price).toFixed(2));
                    $('#due_amount_'+unique_id).text((((old_value + max_quantity)*sale_price)-paid_amount).toFixed(2));
                }else{
                    $('#'+id).val(quantity);
                    $('#net_price_'+unique_id).text((quantity*sale_price).toFixed(2));
                    $('#due_amount_'+unique_id).text(((quantity*sale_price)-paid_amount).toFixed(2));
                }
            }else{
                alert('Item Limit Crossed ');
                $('#'+id).val(quantity - (quantity-max_quantity));
                $('#net_price_'+unique_id).text(((quantity - (quantity-max_quantity))*sale_price).toFixed(2));
                $('#due_amount_'+unique_id).text((((quantity - (quantity-max_quantity))*sale_price)-paid_amount).toFixed(2));
            }
        }
    }else{
        $('#net_price_'+unique_id).text((quantity*sale_price).toFixed(2));
        $('#due_amount_'+unique_id).text(((quantity*sale_price)- paid_amount).toFixed(2));
    }
    setTotalPrice();
};

function setTotalPrice() {
    var total = 0;
    $.each($('#stocksForm').find("input[name='total_cost[]']"), function (key, value) {
        total += parseFloat(value.value);
    });
    $('#grand_total_cost').text(total.toFixed(2));
    $('input[name="grand_total_cost"]').val(total.toFixed(2));
};