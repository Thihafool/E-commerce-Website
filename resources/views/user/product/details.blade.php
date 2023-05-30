@extends('user.layout.master')
@section('content')
    <!-- Product Detail Start -->
    <div class="product-detail">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-10">
                    <a href="{{ route('user#homePage') }}" class="my-3 text-decoration-none text-dark mt-3 ">
                        <i class="fa-solid fa-arrow-left me-1"></i> back
                    </a>
                    <div class="product-detail-top">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="product-slider-single normal-slider">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
                                </div>

                            </div>
                            <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
                            <input type="hidden" id="productId" value="{{ $product->id }}">

                            <div class="col-md-7">
                                <div class="product-content">
                                    <div class="title">
                                        <h2>{{ $product->name }}</h2>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <small class="pt-1"><i
                                                class=" fa-solid fa-eye"></i>{{ $product->view_count + 1 }}</small>
                                    </div>
                                    <div class="price">
                                        <h4>Price:</h4>
                                        <p>{{ $product->price }} Kyats</p>
                                    </div>
                                    <div class="quantity">
                                        <h4>Quantity:</h4>
                                        <div class="qty">
                                            <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                            <input type="text" value="1" id="orderCount">
                                            <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>

                                    <div class="action">
                                        <a class="btn" id="addCart" href="#"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row product-detail-bottom">
                        <div class="col-lg-12">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#description">Description</a>
                                </li>

                            </ul>

                            <div class="tab-content">
                                <div id="description" class="container tab-pane active">
                                    <h4>Product description</h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. In condimentum quam ac
                                        mi
                                        viverra dictum. In efficitur ipsum diam, at dignissim lorem tempor in. Vivamus
                                        tempor hendrerit finibus. Nulla tristique viverra nisl, sit amet bibendum ante
                                        suscipit non. Praesent in faucibus tellus, sed gravida lacus. Vivamus eu diam
                                        eros.
                                        Aliquam et sapien eget arcu rhoncus scelerisque. Suspendisse sit amet neque
                                        neque.

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="product">
                        <div class="section-header">
                            <h1>Related Products</h1>
                        </div>

                        <div class="row align-items-center product-slider product-slider-3">
                            @foreach ($products as $p)
                                <div class="col-lg-3">
                                    <div class="product-item">
                                        <div class="product-title">
                                            <a href="#">{{ $p->name }}</a>

                                        </div>
                                        <div class="product-image">
                                            <a href="product-detail.html">
                                                <img src="{{ asset('storage/' . $p->image) }}" alt="Product Image">
                                            </a>
                                            <div class="product-action">
                                                <a href="{{ route('user#productDetails', $p->id) }}"><i
                                                        class="fa fa-cart-plus"></i></a>

                                            </div>
                                        </div>
                                        <div class="product-price">
                                            <h3><span>$</span>{{ $p->price }}</h3>
                                            <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy
                                                Now</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Detail End -->
@endsection

@section('scriptSource')
    <script>
        //add to cart
        $(document).ready(function() {

            //increase view count
            $.ajax({
                type: 'get',
                url: 'http://localhost:8000/user/ajax/increase/view/count',
                data: {
                    'productId': $('#productId').val()
                },
                dataType: 'json'
            })



            $('#addCart').click(function() {

                $source = {
                    'count': $('#orderCount').val(),
                    'userId': $('#userId').val(),
                    'productId': $('#productId').val()
                }
                $.ajax({
                    type: 'get',
                    url: 'http://localhost:8000/user/ajax/addToCart',
                    data: $source,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = "http://localhost:8000/user/homePage"
                        }
                    }
                })

            })

        })
    </script>
@endsection
