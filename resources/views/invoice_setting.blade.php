@extends('layouts.app')
@section('title','invoice setting - ')
@push('css')
@endpush
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Invoice Settings</h3>
                <hr/>
            </div>
            <div class="card-body">
                <form action="{{route('invoice.update', $invoice->id )}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <!-- start -->
                        <div class="form-group col-md-6">
                            <label for="input-25">Shop Name</label>
                            <input type="text" class="form-control form-control-square-o" value="{{$invoice->shop_name}}" name="shop_name">
                        </div>
                        <!-- end -->
                        <!-- start -->
                        <div class="form-group col-md-6">
                            <label for="input-25">Shop Address</label>
                            <textarea type="text" class="form-control" name="shop_address">{{$invoice->shop_address}}</textarea>
                        </div>
                        <!-- end -->
                         <!-- start -->
                         <div class="form-group col-md-6">
                            <label for="input-25">Phone</label>
                            <input type="text" class="form-control form-control-square-o" value="{{$invoice->shop_phone}}" name="shop_phone">
                        </div>
                        <!-- end -->
                         <!-- start -->
                         <div class="form-group col-md-6">
                            <label for="input-25">Email</label>
                            <input type="text" class="form-control form-control-square-o" value="{{$invoice->shop_email}}" name="shop_email">
                        </div>
                        <!-- end -->

                         <!--start-->
                         <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="col-md-2" style="padding-left:0;margin-top: 12px;">
                                    @if (!empty($invoice->shop_photo))
                                        <img id="favicon" src="{{URL::to($invoice->shop_photo)}}" style="width:50px; height:50px;border: 1px solid #000000">
                                    @else
                                        <img id="favicon" src="{{asset('defaultimg/imguploadicon.png')}}" style="width:50px; height:50px;border: 1px solid #000000">
                                    @endif
                                </div>
                                <div class="col-md-10" style=" padding-right: 0px; padding-left: 0px;">
                                    <label for="input-25">Change Invoice Logo</label>
                                    <input type="file" class="form-control form-control-square-o" value="" name="shop_photo" accept="image/*" onchange="document.getElementById('favicon').src = window.URL.createObjectURL(this.files[0])"
                                    >
                                </div>
                            </div>
                        </div>
                        <!-- End -->
                 
                    </div>
                    
                    <div class="form-footer">
                        <button type="submit" class="btn btn-success m-1 pull-right"><i class="fa fa-check-square-o"></i>Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
