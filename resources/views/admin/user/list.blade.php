@extends('admin.layout.master')
@section('title', 'Category List')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">User List</h2>
                            </div>
                        </div>
                        @if (session('createSuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('createSuccess') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('deleteSuccess'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong> {{ session('deleteSuccess') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                    </div>
                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key : {{ request('key') }}</h4>
                        </div>
                        <div class="col-3 offset-9">
                            <form action="{{ route('category#List') }}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input class="form-control" type="text" name="key" value="{{ request('key') }}"
                                        id="">
                                    <button class="btn btn-dark" type="submit">
                                        <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3 m-0">
                        <div class="col-1 offset-11 btn btn-sm btn-dark  ">
                            <h3 class="text-white mt-1"> <i class="fa-solid fa-database me-2 "></i>
                                {{ $users->total() }}
                            </h3>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        @if (count($users))
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email </th>
                                        <th>Gender</th>
                                        <th>Role</th>
                                        <th>Address</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="tr-shadow">
                                            <input type="hidden" class="userId" value="{{ $user->id }}">
                                            <td class="col-2">
                                                @if ($user->image == null)
                                                    <img src="{{ asset('image/defaultUserImg.png') }}" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $user->image) }}" alt="">
                                                @endif
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->gender }}</td>
                                            <td>
                                                <select class="form-control role">
                                                    <option value="admin"
                                                        @if ($user->role == 'admin') selected @endif>Admin</option>
                                                    <option value="user"
                                                        @if ($user->role == 'user') selected @endif>User</option>

                                                </select>
                                            </td>
                                            <td>{{ $user->address }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $users->appends(request()->query())->links() }}
                            </div>
                        @else
                            <h1 class="text-center text-secondary">There is no users</h1>
                        @endif
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.role').change(function() {
                $currentStatus = $(this).val();

                $parentNode = $(this).parents('tr')

                $userId = $parentNode.find('.userId').val();

                $data = {
                    'userId': $userId,
                    'role': $currentStatus
                }

                $.ajax({
                    type: 'get',
                    url: 'http://localhost:8000/user/change/role',
                    data: $data,
                    dataType: 'json',
                    success: function(response) {

                    }

                })

            })

        })
    </script>
@endsection
