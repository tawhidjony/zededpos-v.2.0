
        @foreach($subCategories as $pos_category)
            <div class="item">
                <div class="pos_sub_category">
                    <p class="text-center pos_s_padding"
                       data-id="{{$pos_category->id}}">{{$pos_category->name}}</p>
                </div>
            </div>
        @endforeach



