@extends('admin.layout.master')
@section('title', 'Category List')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="table-responsive table-responsive-data2">
                        <a class="text-dark" href="{{ route('user#orderList') }} "><i
                                class="fa-solid fa-arrow-left-long"></i>Back
                        </a>
                    </div>
                    <div class="row">
                        <div class="alert alert-warning col-3 offset-9" role="alert">
                            Delivery Fees is not included
                        </div>
                    </div>

                    <table class="table table-data2 text-center">
                        <thead>
                            <tr class="">
                                <th>Order Id</th>
                                <th> Customer Name</th>
                                <th>Product Image </th>
                                <th>Product Name </th>
                                <th>Order Date</th>
                                <th>Qty</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($orderList as $o)
                                <tr class="tr-shadow ">
                                    <input type="hidden" class="orderId" value="{{ $o->id }}">

                                    <td class="col-2">{{ $o->id }}</td>
                                    <td class="col-2">{{ $o->user_name }}</td>
                                    <td class="col-2"><img src="{{ asset('storage/' . $o->product_image) }} "
                                            class="img-thumbnail" alt=""></td>
                                    <td class="col-2">{{ $o->product_name }}</td>
                                    <td class="col-2">{{ $o->created_at->format('j-F-Y') }}</td>
                                    <td class="col-2">{{ $o->qty }}</td>
                                    <td class="col-2">{{ $o->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{-- {{$order->appends(request()->query())->links()}} --}}
                    </div>


                    {{-- @else
                <h3 class="text-center text-secondary mt-5">There is no Pizza here</h3>
                @endif --}}
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
