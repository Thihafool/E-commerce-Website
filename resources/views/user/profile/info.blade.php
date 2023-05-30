@extends('user.layout.master')
@section('title', 'Category List')
@section('content')


    <!-- My Account Start -->
    <div class="my-account">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">

                        <a class="nav-link active" id="dashboard-nav" data-toggle="pill" href="#dashboard-tab"
                            role="tab"><i class="fa fa-tachometer-alt"></i>Change Password</a>
                        <a class="nav-link" id="account-nav" data-toggle="pill" href="#account-tab" role="tab"><i
                                class="fa fa-user"></i>Account Details</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="dashboard-tab" role="tabpanel"
                            aria-labelledby="dashboard-nav">
                            <h4>Password change</h4>
                            @if (session('changePassword'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('changePassword') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('notMatch'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('notMatch') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form action="{{ route('user#changePassword') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <input class="form-control" name="oldPassword" type="password"
                                            placeholder="Current Password">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" name="newPassword" type="password"
                                            placeholder="New Password">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" name="confirmPassword" type="password"
                                            placeholder="Confirm Password">
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>




                        <div class="tab-pane fade" id="account-tab" role="tabpanel" aria-labelledby="account-nav">
                            <h4>Account Details</h4>

                            <form action="{{ route('user#updateInfo') }}" method="post">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <label for="">Name</label>
                                        <input class="form-control" name="name" value="{{ Auth::user()->name }}"
                                            type="text" placeholder=" Name">
                                    </div>


                                    <div class="col-md-6">
                                        <label for="">Phone</label>
                                        <input class="form-control" name="phone" value="{{ Auth::user()->phone }}"
                                            type="text" placeholder="Phone">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Email</label>
                                        <input class="form-control" name="email" value="{{ Auth::user()->email }}"
                                            type="text" placeholder="Email">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Gender</label>
                                        <select name="gender" class="form-control  @error('gender') is-invalid @enderror">
                                            <option value="">Choose gender</option>
                                            <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male
                                            </option>
                                            <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female
                                            </option>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="">Address</label>
                                        <input class="form-control" name="address" value="{{ Auth::user()->address }}"
                                            type="text" placeholder="Address">
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn">Update Account</button>
                                        <br><br>
                                    </div>
                                </div>
                            </form>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- My Account End -->
@endsection
