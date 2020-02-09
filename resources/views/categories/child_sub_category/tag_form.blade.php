@push('css')
    <link rel="stylesheet" href="{{asset('assets/Select-List-form/css/jquery-customselect-1.9.1.css')}}"/>
    <link href="{{asset('assets/Select-List-form/src/jquery-customselect.css')}}" rel='stylesheet' />
    <link rel="stylesheet" href="{{asset('css/customeselect2.css')}}">
@endpush
<!-- Add Customer -->
<div class="modal fade" id="TagSubCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('chilTag.store')}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Tag </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!--start Name-->
                                <input type="text" class="form-control" placeholder="Tag Name"  name="name" required>
                                <input type="text" class="form-control" style="display: none" value="tag_sub_cat_name"  name="tag_sub_name" required>
                            @php
                                $subcategory=DB::table('sub_categories')->get();
                            @endphp
                        </div>
                        <!--start Name-->
                        <div class="col-sm-12 modal-select2 mt-3">
                            <select type="text" class="form-control tag-sub-category-select2 custom-select" name="sub_category_id" required >
                                    <option value="">Select Category Name</option>
                                @foreach($subcategory as $subcategory_name)
                                    <option value="{{$subcategory_name->id}}">{{$subcategory_name->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="addTagSubCategory">Save changes</button>
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
        $(".tag-sub-category-select2").customselect();
      });
    </script>
    
@endpush