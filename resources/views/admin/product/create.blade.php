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
                            <div class="col-3 offset-8">
                                <a href="{{ route('product#list') }}"><button
                                        class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Category category</h3>
                                    </div>
                                    <hr>
                                    <form action="{{ route('product#create') }}" method="post" novalidate="novalidate"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input name="productName" type="text"
                                                class="form-control @error('productName') is-invalid @enderror"
                                                @error('productName') is-invalid @enderror value="{{ old('productName') }}"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Name">
                                            @error('productName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Description</label>
                                            <input name="productDescription" type="text"
                                                class="form-control @error('productDescription') is-invalid @enderror"
                                                @error('productDescription') is-invalid @enderror
                                                value="{{ old('productDescription') }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Description">
                                            @error('productDescription')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Category</label>
                                            <select name="productCategory"
                                                class="form-control @error('productCategory') is-invalid @enderror">
                                                <option value="">Choose Category</option>
                                                @foreach ($category as $c)
                                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('productCategory')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Image</label>
                                            <input type="file"
                                                class="form-control @error('productImage') is-invalid @enderror"
                                                name="productImage" id="">
                                            @error('productImage')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Price</label>
                                            <input name="productPrice" type="text"
                                                class="form-control @error('productPrice') is-invalid @enderror"
                                                @error('productPrice') is-invalid @enderror
                                                value="{{ old('productPrice') }}" aria-required="true" aria-invalid="false"
                                                placeholder="Enter Price">
                                            @error('productPrice')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Waiting Time</label>
                                            <input name="productWaitingTime" type="text"
                                                class="form-control @error('productWaitingTime') is-invalid @enderror"
                                                @error('productWaitingTime') is-invalid @enderror
                                                value="{{ old('productWaitingTime') }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Waiting Time">
                                            @error('productWaitingTime')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <button type="submit" class="btn btn-lg btn-info btn-block">
                                                <span>Create</span>
                                                <i class="fa-solid fa-circle-right"></i>
                                            </button>
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
