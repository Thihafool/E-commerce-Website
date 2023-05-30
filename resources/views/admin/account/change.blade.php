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
                        <div class="col-lg-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Password</h3>
                                    </div>
                                    @if (session('changePassword'))
                                        <div class="col-12">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('changePassword') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif
                                    @if (session('notMatch'))
                                        <div class="col-12">
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('notMatch') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif
                                    <hr>
                                    <form action="{{ route('admin#changePassword') }}" method="post"
                                        novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label mb-1">Old Password</label>
                                            <input name="oldPassword" type="password"
                                                class="form-control @error('oldPassword') is-invalid @enderror"
                                                @error('oldPassword') is-invalid @enderror value="{{ old('oldPassword') }}"
                                                aria-required="true" aria-invalid="false" placeholder="Old Password">
                                            @error('oldPassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">New Password</label>
                                            <input name="newPassword" type="password"
                                                class="form-control @error('newPassword') is-invalid @enderror"
                                                @error('newPassword') is-invalid @enderror value="{{ old('newPassword') }}"
                                                aria-required="true" aria-invalid="false" placeholder="New Password">
                                            @error('newPassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Confirm Password</label>
                                            <input name="confirmPassword" type="password"
                                                class="form-control @error('confirmPassword') is-invalid @enderror"
                                                @error('confirmPassword') is-invalid @enderror
                                                value="{{ old('confirmPassword') }}" aria-required="true"
                                                aria-invalid="false" placeholder="Confirm Password">
                                            @error('confirmPassword')
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
