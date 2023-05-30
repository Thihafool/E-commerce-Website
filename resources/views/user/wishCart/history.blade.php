@extends('user.layout.master')
@section('content')
    <!-- Cart Start -->
    <div class="cart-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 offset-2">
                    <div class="cart-page-inner">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Date</th>
                                        <th>Order Id</th>
                                        <th>Total Price</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    @foreach ($order as $o)
                                        <tr>
                                            <td class="align-middle">{{ $o->created_at->format('F-j-Y') }} </td>
                                            <td class="align-middle">{{ $o->order_code }} </td>
                                            <td class="align-middle">{{ $o->total_price }} </td>
                                            <td class="align-middle" id="price">
                                                @if ($o->status == 0)
                                                    <span class="text-warning"><i class="fa-sharp fa-solid fa-timer"></i>
                                                        Pending</span>
                                                @elseif($o->status == 1)
                                                    <span class="text-success"><i
                                                            class="fa-solid fa-check"></i>Success</span>
                                                @elseif($o->status == 2)
                                                    <span class="text-danger"><i
                                                            class="fa-solid fa-circle-exclamation me-2"></i>Reject</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $order->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
