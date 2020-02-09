
<div class="modal fade" id="selectNewProductModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Select A Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <form id="newProductForm" action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @include('products.purchase_form') 
          </form>
        </div>
      </div> 

      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="newProductSubmit" type="submit" class="btn btn-primary">Save changes</button>
      </div>

    </div>
  </div>
</div>
