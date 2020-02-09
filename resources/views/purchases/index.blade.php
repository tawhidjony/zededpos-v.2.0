@extends('layouts.app')
@section('title','purchase - ')
@push('css')
    @include('layouts.datatable_css')
@endpush
@section('content')


    <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <!--start box Header-->
                    <div class="card-body">
                        <h3 >All Purchase
                        <a href="{{route('purchase.create')}}" class="btn btn-info pull-right">Add Purchase</a>
                         <a href="{{url('/purchases')}}" class="btn btn-info pull-right mr-2">Back</a>
                        </h3>
                        <hr/>
                    </div>
                    <!--End box Header-->

                    <!--Start box body-->
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Product Name</th>
                                    <th>Supplier Name</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Buy Price</th>
                                    <th>Sell Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($purchase as $key=> $row)
                            <tr>
                                <td>{{$key + 1 }}</td> 
                                <td>{{$row->product->name}}</td>
                                <td>{{$row->purchase->supplier->name}}</td>
                                <td>
                                    @if($row->product->photo)
                                        <img src="{{URL::to($row->product->photo)}}" style="width: 60px; height: 60px">
                                    @else
                                        <img src="{{URL::to('defaultimg/imguploadicon.png')}}" style="width: 60px; height: 60px">
                                    @endif
                                </td>
                                <td>{{$row->quantity}}</td>
                                <td>{{$row->buy_price}}</td>
                                <td>{{$row->sell_price}}</td>

                                <td>
                                    <div class="btn-group m-1">


                                        <a href="{{route('purchase.show',$row->id)}}">
                                            <button class="btn btn-outline-dark  ml-2"><i class="fa fa-eye"></i></button>
                                        </a>
                                        <a href="{{route('purchase.edit',$row->id)}}">
                                            <button class="btn btn-outline-success  ml-2"><i class="fa fa-pencil-square-o"></i></button>
                                        </a>
                                        <form user="deleteForm" method="POST" action="{{route('purchase.destroy',$row->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:void(0);"
                                               onclick="deleteWithSweetAlert(event,parentNode);">
                                                <button class="btn btn-outline-danger  ml-2"><i class="fa fa-trash-o "></i></button>
                                            </a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>

                        </table>
                        {{$purchase->links()}}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- End box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

@endsection

@push('js')
    @include('layouts.datatable_js')
@endpush
