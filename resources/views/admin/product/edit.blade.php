@extends('admin.layout.master')
@section('title', 'Create Category')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <a class="text-dark" href="{{ route('product#list') }}">
                                <i class="fa-solid fa-arrow-left"></i>
                            </a>
                            <div class="card-title">
                                <h3 class="text-center title-2">Update Product</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1 ">
                                        <input type='hidden' name='productId' value='{{ $product->id }}'>
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                            class="img-thumbnail shadow-sm " alt="">

                                        <div class="mt-3 ">
                                            <input type="file"
                                                class=" form-control @error('productImage') is-invalid @enderror"
                                                name="productImage" id="">
                                            @error('productImage')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn bg-dark text-white col-12 " type="submit">Update</button>
                                        </div>
                                    </div>

                                    <div class="col-6">

                                        <div class=" ">
                                            <div class="form-group">
                                                <label class="control-label mb-1">Name</label>

                                                <input id="cc-pament" name="productName" type="text"
                                                    value="{{ old('productName', $product->name) }}"
                                                    class="form-control  @error('productName') is-invalid @enderror"
                                                    aria-required="true" aria-invalid="false"
                                                    placeholder="Enter Admin productName">
                                                @error('productName')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Description</label>

                                                <textarea cols="30" rows="10" id="cc-pament" name="productDescription" value=""
                                                    class="form-control  @error('productDescription') is-invalid @enderror" aria-required="true" aria-invalid="false"
                                                    placeholder="Enter Admin productDescription">{{ old('productDescription', $product->description) }}</textarea>
                                                @error('productDescription')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">Category</label>
                                                <select name="productCategory"
                                                    class="form-control  @error('productCategory') is-invalid @enderror">
                                                    <option value="">Choose category</option>
                                                    @foreach ($category as $c)
                                                        <option value="{{ $c->id }}"
                                                            @if ($product->category_id == $c->id) selected @endif>
                                                            {{ $c->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Price</label>

                                                <input id="cc-pament" name="productPrice" type="number"
                                                    value="{{ old('productPrice', $product->price) }}"
                                                    class="form-control  @error('productPrice') is-invalid @enderror"
                                                    aria-required="true" aria-invalid="false"
                                                    placeholder="Enter productPrice">
                                                @error('productPrice')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Waiting Time</label>

                                                <input id="cc-pament" name="productWaitingTime" type="text"
                                                    value="{{ old('productWaitingTime', $product->waiting_time) }}"
                                                    class="form-control  @error('productWaitingTime') is-invalid @enderror"
                                                    aria-required="true" aria-invalid="false"
                                                    placeholder="Enter  productWaitingTime">
                                                @error('productWaitingTime')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">View Count</label>
                                                <input id="cc-pament" name="viewCount" type="text" disabled
                                                    value="{{ old('viewCount', $product->view_count) }}"
                                                    class="form-control " aria-required="true" aria-invalid="false"
                                                    placeholder="Enter Admin viewCount">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Created Date</label>
                                                <input id="cc-pament" name="created_at" type="text"
                                                    value="{{ $product->created_at->format('j-F-Y') }}"
                                                    class="form-control " aria-required="true" aria-invalid="false"
                                                    placeholder="" disabled>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
