<div class="modal fade" id="SupplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('suppliers.store')}}" method="POST" id="supplierAdd">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Supplier </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-11">
                        <!--start Name-->
                        <div class="input-group mb-3">
                            <label for="name" class="col-md-2 col-form-label text-md-left">Name</label>
                            <input type="text" class="form-control" placeholder="Supplier name"  name="name">
                        </div>
                        <!--End Name-->
                        <!--start Email-->
                        <div class="input-group mb-3">
                            <label for="email" class="col-md-2 col-form-label text-md-left">Email</label>
                            <input type="email" class="form-control" placeholder="Supplier Email"  name="email">
                        </div>
                        <!--End Email-->
                        <!--start Phone-->
                        <div class="input-group mb-3">
                            <label for="phone" class="col-md-2 col-form-label text-md-left">Phone</label>
                            <input type="number" class="form-control" placeholder="Supplier Phone"  name="phone">
                        </div>
                        <!--End Phone-->
                        <!--start Address-->
                        <div class="input-group mb-3">
                            <label for="address" class="col-md-2 col-form-label text-md-left">Address</label>
                            <textarea type="text" class="form-control" placeholder="Supplier Address"  name="address"></textarea>
                        </div>
                        <!--End Address-->
                    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>