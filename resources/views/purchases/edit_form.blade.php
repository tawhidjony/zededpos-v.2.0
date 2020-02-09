<div class="card">
        <div class="card-body">
            <h3 class="box-title">Edit Purchase
            <a href="{{route('purchase.index')}}" class="btn btn-info pull-right">Back</a>
            </h3>
        </div> 
    <div class="card-body">
        <div class="row">
            <!--Start-->
            <div class="col-sm-6">
                <label for="sellPrice">Supplier Name</label>
                <div class="input-group mb-3">    
                <input type="text" class="form-control" name="" value="{{$purchasepro->purchase->supplier->name}}" disabled>
                </div>
            </div>
            <!--End--> 

            <!--Start-->
            <div class="col-sm-6">
                <label for="sellPrice">Voucher Number</label>
                <div class="input-group mb-3"> 
                <input type="text" class="form-control" name="voucher_code" value="{{$purchasepro->purchase->voucher_code}}" disabled>
                
                </div>
            </div>
            <!--End--> 
        </div>
    </div>
</div>   

   


<div class="card">
    <div class="card-body ">
        <div class="row"> 
            <table class="table" id="purchases-data-table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Product Name</th> 
                        <th scope="col">Quantity</th>
                        <th scope="col">Buy Price</th>
                        <th scope="col">Sell Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr> 
                        <td>{{$purchasepro->product->name}}</td>
                        <td><input type="text" class="form-control" value="{{$purchasepro->quantity}}" name="quantity"></td>
                        <td><input type="text" class="form-control" value="{{$purchasepro->buy_price}}" name="buy_price"></td>
                        <td><input type="text" class="form-control" value="{{$purchasepro->sell_price}}" name="sell_price"></td>
                    </tr> 
                </tbody>
              
            </table>
        </div>
        <div class="col pr-0">
                <button type="submit" class="btn btn-info  pull-right"><i class="fa fa-pencil-square-o"></i> Update</button>
        </div>
    </div>
 
</div>

