@extends('layouts.app')
@section('title','setting - ')
@push('css')
@endpush
@section('content')
<section class="content">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Genaral Settings</h3>
                <hr/>
            </div>
            <div class="card-body">
                <form action="{{route('settings.update', 1)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <!-- start -->
                        <div class="form-group col-md-6">
                            <label for="input-25">Change App Name</label>
                            <input type="text" class="form-control form-control-square-o" value="{{App\Models\Setting::getValue('name')}}" name="name">
                        </div>
                        <!-- end -->
                        <!--start-->
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                               
                                <div class="col-md-10" style=" padding-right: 0px;">
                                    <label for="input-25">Change Favicon Icon</label>
                                    <input type="file" class="form-control form-control-square-o" value="" name="favicon" accept="image/*" onchange="document.getElementById('favicon').src = window.URL.createObjectURL(this.files[0])"
                                    >
                                </div>
                                <div class="col-md-2" style="padding-left:10;margin-top: 17px;">
                                    @php
                                        $favicon = App\Models\Setting::getValue('favicon');
                                        if ($favicon){ 
                                            echo '<img id="favicon" src="'.URL::to($favicon).'" style="width:50px; height:50px;border: 1px solid #000000">';
                                        }else{
                                            echo '<img id="favicon" src="'.asset('defaultimg/imguploadicon.png').'" style="width:50px; height:50px;border: 1px solid #000000">';
                                        }
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <!-- End -->
                    </div>
                    
                        <h3 class="card-title mt-5">Currency & VAT Settings</h3><hr>
                 
                    <div class="form-row mt-5">
                        <!-- start -->
                        <div class="form-group col-md-6">
                            <label for="input-25">Change Vat</label>
                            <input type="text" name="vat" class="form-control" value="{{App\Models\Setting::getValue('vat')}}">
                        </div>
                        <!-- end -->

                        <!-- start -->
                        <div class="form-group col-md-6">
                            <label for="input-25">Change Currency</label>
                            <select name="currency" class="form-control">
                                <option value="৳">Bangladeshi TK</option>
                                <option value="$">Doller</option>
                                <option value="€">Euro</option>
                                <option value="﷼">Arabic</option>
                            </select>
                        </div>
                        <!-- end -->
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-success m-1 pull-right"><i class="fa fa-check-square-o"></i>Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
