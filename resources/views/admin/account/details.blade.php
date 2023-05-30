@extends('admin.layout.master')
@section('title', 'Category List')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="row">

                        </div>
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Password</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 offset-2 ">
                                            @if (Auth::user()->image == null)
                                                <img src="{{ asset('image/defaultUserImg.png') }}" alt="">
                                            @else
                                                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="">
                                            @endif
                                        </div>
                                        <div class="col-5 offset-1  ">
                                            <h5 class="my-3"><i
                                                    class="fa-solid fa-user-pen me-2"></i>{{ Auth::user()->name }}</h5>
                                            <h5 class="my-3"><i
                                                    class="fa-solid fa-envelope me-2"></i>{{ Auth::user()->email }}</h5>
                                            <h5 class="my-3"><i
                                                    class="fa-solid fa-phone me-2"></i>{{ Auth::user()->phone }}</h5>
                                            <h5 class="my-3"><i
                                                    class="fa-solid fa-mars-and-venus me-2"></i>{{ Auth::user()->gender }}
                                            </h5>

                                            <h5 class="my-3"> <i
                                                    class="fa-solid fa-address-card me-2"></i>{{ Auth::user()->address }}
                                            </h5>
                                            <h5 class="my-3"> <i
                                                    class="fa-solid fa-user-clock me-2"></i>{{ Auth::user()->created_at->format('j-F-Y') }}
                                            </h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 offset-2 mt-3">
                                                <button class="btn bg-dark ">
                                                    <a href="{{ route('admin#edit') }}"
                                                        class="text-decoration-none text-white">
                                                        <i class="fa-solid fa-pen-to-square me-2 text-white"></i> Edit
                                                        Profile

                                                    </a>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
