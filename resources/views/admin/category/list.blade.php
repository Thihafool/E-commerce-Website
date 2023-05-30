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
                                <h2 class="title-1">Category List</h2>
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
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add item
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
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
                                {{ $category->total() }}
                            </h3>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        @if (count($category))
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Name</th>
                                        <th>Created Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category as $c)
                                        <tr class="tr-shadow">
                                            <td>{{ $c->id }}</td>
                                            <td>{{ $c->name }}</td>
                                            <td>{{ $c->created_at->format('j-F-Y') }}</td>
                                            <td>
                                                <div class="table-data-feature">

                                                    <a href="{{ route('category#edit', $c->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('category#delete', $c->id) }}"
                                                        onclick="return confirm('Are you sure you want to Delete?');">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $category->appends(request()->query())->links() }}
                            </div>
                        @else
                            <h1 class="text-center text-secondary">There is no categories</h1>
                        @endif
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>

@endsection
