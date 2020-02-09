
        <div class="item">
            <div class="pos_category">
               <p class="text-center pos_c_padding"  data-id="*">All</p>
              </div>
        </div>


        @foreach($categories as $pos_category)
            <div class="item">
                <div class="pos_category">
                    <p class="text-center pos_c_padding"  data-id="{{$pos_category->id}}">{{$pos_category->name}}</p>
                </div>
            </div>
        @endforeach


