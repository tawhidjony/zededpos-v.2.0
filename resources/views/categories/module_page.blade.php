@extends('layouts.app')
@section('title','Category - ')
@push('css')
@endpush
@section('content')
    <div class="card-area">
        <div class="row">
                <!-- Category Section Start -->
                @if((auth()->user()->can('category.create') || auth()->user()->can('category.index')) || auth()->user()->hasRole('super-admin'))
                    @if(auth()->user()->can('category.create') || auth()->user()->hasRole('super-admin'))
                    <div class="col-xl-3 col-md-6">
                        <a href="#" data-toggle="modal" data-target="#CategoryModal">
                            <div class="card-content card-no-padding">
                                <p>Add Category </p>
                                <span class="bg-green"><i class="fas fa-pen-square"></i></span>
                            </div>
                        </a>
                    </div>
                    @endif

                    @if(auth()->user()->can('category.index') || auth()->user()->hasRole('super-admin'))
                    <!--  -->
                    <div class="col-xl-3 col-md-6">
                        <a href="{{route('category.index')}}">
                            <div class="card-content card-no-padding">
                                <p>All Category </p>
                                <span class="bg-red"><i class="fas fa-list-alt"></i></span>
                            </div>
                        </a>
                    </div>
                    @endif
                @endif
                <!-- Category Section End -->

                <!--Sub Category Section Start -->
                @if((auth()->user()->can('sub_category.create') || auth()->user()->can('sub_category.index')) || auth()->user()->hasRole('super-admin'))
                    @if(auth()->user()->can('sub_category.create') || auth()->user()->hasRole('super-admin'))
                    <div class="col-xl-3 col-md-6">
                        <a href="#" class="A_color waves-effect waves-light" data-toggle="modal" data-target="#SubCategoryModal">
                            <div class="card-content card-no-padding">
                                <p>Sub Category </p>
                                <span class="bg-green"><i class="fas fa-pen-square"></i></span>
                            </div>
                        </a>
                    </div>
                    @endif
                    @if(auth()->user()->can('sub_category.index') || auth()->user()->hasRole('super-admin'))
                    <!--  -->
                    <div class="col-xl-3 col-md-6">
                        <a href="{{route('sub_category.index')}}">
                            <div class="card-content card-no-padding">
                                <p>All Sub Category</p>
                                <span class="bg-red"><i class="fas fa-clipboard-list"></i></span>
                            </div>
                        </a>
                    </div>
                    @endif
                @endif
                <!-- Sub Category Section End -->
                 <!-- Child Subcategory Section Start -->
                 {{-- @if((auth()->user()->can('chilTag.create') || auth()->user()->can('chilTag.index')) || auth()->user()->hasRole('super-admin'))
                    @if(auth()->user()->can('chilTag.create') || auth()->user()->hasRole('super-admin'))
                    <div class="col-xl-3 col-md-6">
                        <a href="#" data-toggle="modal" data-target="#TagSubCategoryModal">
                            <div class="card-content card-no-padding">
                                <p>Add Tag </p>
                                <span class="bg-green"><i class="fas fa-pen-square"></i></span>
                            </div>
                        </a>
                    </div>
                    @endif
                    @if(auth()->user()->can('chilTag.index') || auth()->user()->hasRole('super-admin'))
                    <!--  -->
                    <div class="col-xl-3 col-md-6">
                        <a href="{{route('chilTag.index')}}">
                            <div class="card-content card-no-padding">
                                <p>All Tag </p>
                                <span class="bg-red"><i class="fas fa-list-alt"></i></span>
                            </div>
                        </a>
                    </div>
                    @endif
                 @endif --}}
                <!-- Child Subcategory End -->

                <!-- Brand Section Start -->
                @if((auth()->user()->can('pro_brands.create') || auth()->user()->can('pro_brands.index')) || auth()->user()->hasRole('super-admin'))
                    @if(auth()->user()->can('pro_brands.create') || auth()->user()->hasRole('super-admin'))
                    <div class="col-xl-3 col-md-6">
                        <a href="#" data-toggle="modal" data-target="#BrandModal">
                            <div class="card-content card-no-padding">
                                <p>Add Brand </p>
                                <span class="bg-green"><i class="fas fa-pen-square"></i></span>
                            </div>
                        </a>
                    </div>
                    @endif
                    @if(auth()->user()->can('pro_brands.index') || auth()->user()->hasRole('super-admin'))
                    <!--  -->
                    <div class="col-xl-3 col-md-6">
                        <a href="{{route('pro_brands.index')}}">
                            <div class="card-content card-no-padding">
                                <p>All Brand </p>
                                <span class="bg-red"><i class="fas fa-list-alt"></i></span>
                             </div>
                        </a>
                    </div>
                    @endif
                @endif
                <!-- Brand Section End -->

                <!-- Model Section Start -->
                @if((auth()->user()->can('pro_models.create') || auth()->user()->can('pro_models.index')) || auth()->user()->hasRole('super-admin'))
                    @if(auth()->user()->can('pro_models.create') || auth()->user()->hasRole('super-admin'))
                    <div class="col-xl-3 col-md-6">
                        <a href="#" data-toggle="modal" data-target="#ProductModal">
                            <div class="card-content card-no-padding">
                                <p>Add Model </p>
                                <span class="bg-green"><i class="fas fa-pen-square"></i></span>
                            </div>
                        </a>
                    </div>
                    @endif
                    @if(auth()->user()->can('pro_models.index') || auth()->user()->hasRole('super-admin'))
                    <!--  -->
                    <div class="col-xl-3 col-md-6">
                        <a href="{{route('pro_models.index')}}">
                            <div class="card-content card-no-padding">
                                <p>All Model </p>
                                <span class="bg-red"><i class="fas fa-list-alt"></i></span>
                            </div>
                        </a>
                    </div>
                    @endif
                @endif
                <!-- Model Section End -->

                
        </div>
    </div>



    @include('categories.category.form_cat')
    @include('categories.sub_category.sub_form')
    @include('categories.child_sub_category.tag_form')
    @include('categories.brand.brand_form')
    @include('categories.pro_model.model_form')


@endsection
@push('js')
    <script src="{{asset('js/purchases.js')}}"></script>
@endpush
