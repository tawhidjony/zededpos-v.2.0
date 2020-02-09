@push('css')
    <link rel="stylesheet" href="{{asset('assets/Select-List-form/css/jquery-customselect-1.9.1.css')}}"/>
    <link href="{{asset('assets/Select-List-form/src/jquery-customselect.css')}}" rel='stylesheet' />
    <link rel="stylesheet" href="{{asset('css/customeselect2.css')}}">
@endpush
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
                <div class="modal-body" style="width:148%">

                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Sub Category Name"  name="name" required>
                            <input type="text" class="form-control" style="display: none" value="sub_cat_name"  name="sub_name" required>
                        @php
                            $category=DB::table('categories')->get();
                        @endphp
                    </div>

                    <div class="col-sm-8 modal-select2 mt-3">
                        <select type="text" class="form-control sub-category-select2 custom-select " name="category_id">
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
@push('js')

    <script src="{{asset('assets/Select-List-form/js/jquery-customselect-1.9.1.min.js')}}"></script>
    <script src="{{asset('assets/Select-List-form/src/jquery-customselect.js')}}"></script>

    <script>
        $(function() {
        $(".sub-category-select2").customselect();
      });
    </script>
    
@endpush