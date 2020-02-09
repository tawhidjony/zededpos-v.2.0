<div class="pos" id="Zededpos-style">
    <div class="force-overflow">
        <table class="table table-bordered " id="Pos_Product_table">
            <thead class="text-center">
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
                <td><i class="btn btn-danger fa fa-trash"></i></td>
            </tr>
            </thead>
            <tbody class="text-center">
                 @foreach($return_product_edit->sale as $old_invoice)
                    <tr id="product-{{$old_invoice->product_id}}">
                        <td>{{$old_invoice->product->name}}<input type="text" style="display: none"
                         name="products[{{$old_invoice->product_id}}][product_id]" value="{{$old_invoice->product_id}}" /> </td>

                        <td style=" width: 1%;"><input class="form-control qty" type="number" name="products[{{$old_invoice->product_id}}][qty]" value="{{$old_invoice->qty}}" /> </td>
                        <td><input class="form-control price" type="number" name="products[{{$old_invoice->product_id}}][price]" value="{{$old_invoice->price}}"/> </td>
                        <td><input class="form-control subtotal" type="number"
                                   name="products[{{$old_invoice->product_id}}][subtotal]" value="{{$old_invoice->subtotal}}" readonly/></td>
                        <td><i class="danger fa fa-trash remove"></i></td>
                    </tr>
                 @endforeach
            </tbody>
        </table>
    </div>
  </div>