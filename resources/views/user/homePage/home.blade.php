@extends('user.layout.master')
@section('content')
    <!-- Bottom Bar Start -->
    <div class="bottom-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-3">
                </div>
                <div class="col-md-3 offset-9">
                    <div class="user">
                        <a href="{{ route('user#history') }}" class="btn wishlist">
                            <i class="fa-solid fa-clock-rotate-left me-1"></i>
                            <span>{{ count($history) }}</span>
                        </a>
                        <a href="{{ route('user#cartPage') }}" class="btn cart me-3">
                            <i class="fa fa-shopping-cart"></i>
                            <span>{{ count($cart) }}</span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bottom Bar End -->
    <!-- Main Slider Start -->
    <div class="header">

        <div class="container-fluid">
            @if (session('updateSuccess'))
                <div class="row">
                    <div class="alert alert-success alert-dismissible fade show col-4 offset-8" role="alert">
                        <strong>{{ session('updateSuccess') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-3">
                    <div class="header-img mt-5">
                        <div class="img-item">
                            <img src="{{ asset('image/plant3.jpg') }}" />
                            <a class="img-text" href="">
                                <p>Some text goes here that describes the image</p>
                            </a>
                        </div>
                        <div class="img-item">
                            <img src="{{ asset('image/plant6.jpg') }}" />
                            <a class="img-text" href="">
                                <p>Some text goes here that describes the image</p>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="header-slider normal-slider">
                        <div class="header-slider-item">
                            <img src="{{ asset('image/bg.jpg') }}" width="800px" height="500px" alt="Slider Image" />

                        </div>
                        <div class="header-slider-item">
                            <img src="{{ asset('image/unsplash.jpg') }}" width="800px" height="500px" alt="Slider Image" />

                        </div>
                        <div class="header-slider-item">
                            <img src="{{ asset('image/plant6.jpg') }}" width="800px" height="500px" alt="Slider Image" />

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="header-img mt-5">
                        <div class="img-item">
                            <img src="{{ asset('image/plant4.jpg') }}" />
                            <a class="img-text" href="">
                                <p>Some text goes here that describes the image</p>
                            </a>
                        </div>
                        <div class="img-item">
                            <img src="{{ asset('image/plant2.jpg') }}" />
                            <a class="img-text" href="">
                                <p>Some text goes here that describes the image</p>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Slider End -->
    <!-- Feature Start-->
    <div class="feature">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fab fa-cc-mastercard"></i>
                        <h2>Secure Payment</h2>
                        <p>
                            Lorem ipsum dolor sit amet consectetur elit
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-truck"></i>
                        <h2>Worldwide Delivery</h2>
                        <p>
                            Lorem ipsum dolor sit amet consectetur elit
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-sync-alt"></i>
                        <h2>90 Days Return</h2>
                        <p>
                            Lorem ipsum dolor sit amet consectetur elit
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-comments"></i>
                        <h2>24/7 Support</h2>
                        <p>
                            Lorem ipsum dolor sit amet consectetur elit
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End-->


    <!-- Featured Product Start -->
    <div class="featured-product product">
        <div class="container-fluid">
            <div class="section-header">
                <h1>Featured Product</h1>
            </div>
            <div class="row align-items-center product-slider product-slider-4">
                @foreach ($product as $p)
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
                                    {{-- <a href="#"><i class="fa fa-heart"></i></a> --}}
                                </div>
                            </div>
                            <div class="product-price">
                                <h3><span>$</span>{{ $p->price }}</h3>
                                <a class="btn" href="{{ route('user#productDetails', $p->id) }}"><i
                                        class="fa fa-shopping-cart"></i>Buy Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Featured Product End -->

    <!-- Product List Start -->
    <div class="product-view">
        <div class="container-fluid ">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 ">
                    <div class="row">
                        @foreach ($product as $p)
                            <div class="col-md-4">
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
                                            {{-- <a href=""><i class="fa fa-heart"></i></a> --}}
                                        </div>
                                    </div>
                                    <div class="product-price">
                                        <h3><span>$</span>{{ $p->price }}</h3>
                                        <a class="btn" href=" {{ route('user#cartPage') }}"><i
                                                class="fa fa-shopping-cart"></i>Buy Now</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Product List End -->
@endsection
