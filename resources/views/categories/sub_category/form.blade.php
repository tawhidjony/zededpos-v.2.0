


<!-- Add Customer -->
<div class="modal fade" id="SubCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('sub_category.store')}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Sub Category </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-11">
                        <!--start Name-->
                        <div class="input-group">
                            <label for="name" class="col-md-3 col-form-label text-md-left">Sub Category</label>
                            <input type="text" class="form-control" placeholder="Sub Category Name"  name="name" required>
                        </div>
                        @php
                            $category=DB::table('categories')->get();
                        @endphp
                        <!--start Name-->
                        <div class="input-group">
                            <label for="name" class="col-md-3 col-form-label text-md-left">Category</label>
                            <select type="text" class="form-control" name="parent_category_id" >
                                 <option value="">Select Category Name</option>
                                @foreach($category as $category_name)
                                 <option value="{{$category_name->id}}">{{$category_name->name}}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="addSubCategory">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>