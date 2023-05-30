@extends('user.layout.master')
@section('content')
    <!-- Cart Start -->
    <div class="cart-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-page-inner">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    @foreach ($cartList as $c)
                                        <tr>
                                            <td>
                                                <div class="img">
                                                    <a href="#"><img src="{{ asset('storage/' . $c->product_image) }}"
                                                            alt="Image"></a>
                                                    <p>{{ $c->product_name }}</p>
                                                </div>
                                                <input type="hidden" id="productId" value="{{ $c->product_id }}">
                                                <input type="hidden" id="userId" value="{{ $c->user_id }}">
                                                <input type="hidden" id="orderId" value="{{ $c->id }}">
                                            </td>
                                            <td class="price">{{ $c->product_price }} Kyats</td>
                                            <td>
                                                <div class="qty">
                                                    <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                    <input type="text" id="qty" value="{{ $c->qty }}">
                                                    <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </td>
                                            <td id="total">{{ $c->product_price * $c->qty }} Kyats</td>
                                            <td><button class="btnRemove"><i class="fa fa-trash"></i></button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart-page-inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="coupon">
                                    <input type="text" placeholder="Coupon Code">
                                    <button>Apply Code</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="cart-summary">
                                    <div class="cart-content">
                                        <h1>Cart Summary</h1>
                                        <p>Sub Total<span id="subTotalPrice">{{ $totalPrice }} Kyats</span></p>
                                        <p>Shipping Cost<span>5000 Kyats</span></p>
                                        <h2>Grand Total<span id="finalPrice">{{ $totalPrice + 5000 }} Kyats</span></h2>
                                    </div>
                                    <div class="cart-btn">
                                        <button id="clearBtn">Clear Cart</button>
                                        <button id="orderBtn">Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('scriptSource')
    <script src="{{ asset('cart/cart.js') }}"></script>

    <script>
        //order
        $('#orderBtn').click(function() {
            $orderList = [];
            $random = Math.floor(Math.random() * 100000000001);

            $('#dataTable tbody tr').each(function(index, row) {
                $orderList.push({
                    'user_id': $(row).find('#userId').val(),
                    'product_id': $(row).find('#productId').val(),
                    'qty': $(row).find('#qty').val(),
                    'total': $(row).find('#total').text().replace('Kyats', '') * 1,
                    'order_code': 'POS' + $random
                });
            });
            $.ajax({
                type: 'get',
                url: 'http://localhost:8000/user/ajax/order',
                data: Object.assign({}, $orderList),
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'true')
                        window.location.href = 'http://localhost:8000/user/homePage'
                }
            })
        })
        //clear button click
        $('#clearBtn').click(function() {
            $.ajax({
                type: 'get',
                url: 'http://localhost:8000/user/ajax/clear/cart',
                dataType: 'json',

            })
            $('#dataTable tbody tr').remove();
            $('#subTotalPrice').html("0 Kyats");
            $('#finalPrice').html("0 Kyats");
        })
        //remove each product list
        $('.btnRemove').click(function() {
            $parentNode = $(this).parents('tr');
            $productId = $parentNode.find('#productId').val();
            $orderId = $parentNode.find('#orderId').val();
            $.ajax({
                type: 'get',
                url: 'http://localhost:8000/user/ajax/clear/current/item',
                data: {
                    'productId': $productId,
                    'orderId': $orderId
                },
                dataType: 'json',

            })

            $parentNode.remove();
            $totalPrice = 0
            $('#dataTable tr').each(function(index, row) {
                // console.log(index + "||" + row)
                $totalPrice += Number($(row).find('#total').text().replace('Kyats', ''));

            })
            $('#subTotalPrice').html(`${$totalPrice} Kyats`);
            $('#finalPrice').html(`${$totalPrice + 5000} Kyats`);
        })
    </script>
@endsection
