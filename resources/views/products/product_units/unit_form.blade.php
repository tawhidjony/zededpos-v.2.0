<!-- Add Customer -->
<div class="modal fade" id="ProductUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('units.store')}}" method="POST" id="AddUnit">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product Unit </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-11">
                        <!--start Name-->
                        <div class="input-group">
                            <label for="name" class="col-md-2 col-form-label text-md-left">Name</label>
                            <input type="text" class="form-control" placeholder=" Product Unit Name"  name="name" required>
                            <input type="text" class="form-control" value="pro_unit" style="display: none" name="unit_name" required>
                        </div>
                        <!--End Name-->
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