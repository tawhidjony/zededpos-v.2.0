@extends('layouts.app')
@section('title','Account User - ')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                   <!--profile image-->
                    <div class="card-title mb-4">
                        <div class="d-flex justify-content-start">
                            <div class="image-container">
                                <img src="{{URL::to(Auth::user()->photo)}}" id="Profile_picture" style="width: 150px; height: 150px" class="img-thumbnail" />

                            </div>
                            <div class="userData ml-3">
                                <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">Name: {{auth()->user()->name}}</h2>
                                <h6 class="d-block"><b>Email:</b> {{auth()->user()->email}}</h6>
                                <h6 class="d-block"><b>Role:</b> {{auth()->user()->getRoleNames()->first()}} </h6>
                            </div>
                            <div class="ml-auto">
                                <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
                            </div>
                        </div>
                    </div>
                    <!--profile image End-->
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#profileinfo" role="tab" aria-controls="profileinfo" aria-selected="true">Profile Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#profileEdit" role="tab" aria-controls="profileEdit" aria-selected="false">Profile Edit</a>
                                </li>
                            </ul>
                            <div class="tab-content ml-1" id="myTabContent">
                                <div class="tab-pane fade show active" id="profileinfo" role="tabpanel" aria-labelledby="profileinfo-tab">


                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Full Name </label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{auth()->user()->name}}
                                        </div>
                                    </div>
                                    <hr />

                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Email</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{auth()->user()->email}}
                                        </div>
                                    </div>
                                    <hr />


                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Role</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{auth()->user()->getRoleNames()->first()}}
                                        </div>
                                    </div>
                                    <hr />

                                </div>
                                <div class="tab-pane fade" id="profileEdit" role="tabpanel" aria-labelledby="profileEdit-tab">

                                        <form action="{{url('account/'.auth()->user()->id)}}" method="post" enctype="multipart/form-data" >
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-8">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Name</label>
                                                <div class="col-lg-8">
                                                    <input name="name"
                                                           class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                           type="text"
                                                           value="@if($user->name){{$user->name}}@else{{ old('name') }}@endif"
                                                           required>
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                                <div class="col-lg-8">
                                                    <input name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                           type="email"
                                                           value="@if($user->email){{$user->email}}@else{{ old('email') }}@endif"
                                                           required>
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Profile Picture</label>
                                                <div class="col-lg-8">
                                                    <input  name="photo" class="form-control {{ $errors->has('photo') ? ' is-invalid' : '' }}" accept="image/*" type="file"
                                                            onchange="document.getElementById('Profile_picture').src = window.URL.createObjectURL(this.files[0])">
                                                    @if ($errors->has('photo'))
                                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('photo') }}</strong>
                                            </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Current Password</label>
                                                <div class="col-lg-8">
                                                    <input id="current_password" type="password"
                                                           class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}"
                                                           name="current_password" @if(!$user->password) required @endif>

                                                    @if ($errors->has('current_password'))
                                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('current_password') }}</strong>
                                            </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Password</label>
                                                <div class="col-lg-8">
                                                    <input id="password" type="password"
                                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                           name="password" @if(!$user->password) required @endif>

                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Confirm password</label>
                                                <div class="col-lg-8">
                                                    <input id="password-confirm" type="password" class="form-control"
                                                           name="password_confirmation" @if(!$user->password) required @endif>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                                <div class="col-lg-8">
                                                    <input type="submit" class="btn btn-primary" value="Save Changes">
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                            </div>
                                        </form>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>

@endsection


