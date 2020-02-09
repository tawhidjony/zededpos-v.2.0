<div class="card">
    <div class="card-title">
        <h3>Supplier</h3>  
    </div> 
    <div class="card-body">
        <div class="row">
            <!--Start-->
            <div class="col-sm-6">
                <label for="sellPrice">Supplier Name</label>
                <div class="input-group mb-3">

                    <select type="text" class="form-control {{ $errors->has('supplier_id') ? ' is-invalid' : '' }}"
                            id="select2" name="supplier_id" required>
                        <option value>Select Supplier Name</option>
                        @foreach($suppliers as $key => $supplier)
                            <option value="{{$supplier->id}}"
                                    @if($purchase->supplier_id && $purchase->supplier_id == $supplier->id) selected @endif >{{$supplier->name}}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <span class="input-group-text pb-0 pt-0">
                        <a href="#" data-toggle="modal" data-target="#SupplierModal"><i class="fa fa-plus"></i> </a>
                        </span>
                    </div>
                    @if ($errors->has('supplier_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('supplier_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <!--End--> 

            <!--Start-->
            <div class="col-sm-6">
                <label for="sellPrice">Voucher Number</label>
                <div class="input-group mb-3"> 
                    <input type="text" class="form-control{{ $errors->has('voucher_code') ? ' is-invalid' : '' }}"
                   placeholder="Voucher Number" name="voucher_code" autofocus required>
                    @if ($errors->has('voucher_code'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('voucher_code') }}</strong>
                        </span>
                    @endif 
                </div>
            </div>
            <!--End--> 
        </div>
    </div>
</div>   


<div class="card">

    <div class="card-title">
        <h3>Products
        <a href="" id="add-new-product" class="btn btn-info pull-right">Add New Product</a>
        <a href="" id="add-exist-row" class="btn btn-info pull-right mr-2">Add Exist Product</a></h3> 
    </div> 
    <div class="card-body ">
        <div class="row"> 
            <table class="table" id="purchases-data-table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Product Name</th> 
                        <th scope="col">Quantity</th>
                        <th scope="col">Buy Price</th>
                        <th scope="col">Sell Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="no-data"> 
                        <td colspan="6">No Product Selected</td> 
                    </tr> 
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6"></td> 
                    </tr>
                    <tr>
                        <td colspan="4">Total:</td>
                        <td   colspan="2"><input id="Total" type="number" class="form-control {{ $errors->has('total') ? ' is-invalid' : '' }}" name="total"
                       value="@if($purchase->total){{$purchase->total}}@else{{ old('total') }}@endif" ></td>
                    </tr>
                    <tr>
                        <td  colspan="4">Paid:</td>
                        <td   colspan="2"><input id="PayAmount" type="number" class="form-control {{ $errors->has('paid') ? ' is-invalid' : '' }}" name="paid"
                       value="@if($purchase->paid){{$purchase->paid}}@else{{ old('paid') }}@endif" required></td>
                    </tr>
                    <tr>
                        <td  colspan="4">Due:</td>
                        <td  colspan="2"><input id="DueAmount" type="number" class="form-control {{ $errors->has('paid') ? ' is-invalid' : '' }}" name="due"
                       value="@if($purchase->due){{$purchase->due}}@else{{ old('due') }}@endif"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-info pull-right">Submit</button>
    </div>
</div>



