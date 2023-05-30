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
                                <h2 class="title-1">Product List</h2>
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
                                <strong>{{ session('deleteSuccess') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add item
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    <div class="row mt-3 m-0">
                        <div class="col-1 offset-11 btn btn-sm btn-dark  ">
                            <h3 class="text-white mt-1"> <i class="fa-solid fa-database me-2 "></i>
                                {{ $products->total() }}
                            </h3>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        @if (count($products))
                            <table class="table table-data2 text-center ">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th> Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>View Count</th>
                                        <th>Waiting Time</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $p)
                                        <tr class="tr-shadow ">
                                            <td class="col-2"><img class="w-50 img-thumbnail"
                                                    src="{{ asset('storage/' . $p->image) }}" alt=""></td>
                                            <td class="col-3 ">{{ $p->name }}</td>
                                            <td class="col-2">{{ $p->description }}</td>
                                            <td class="col-2">{{ $p->price }}</td>
                                            <td class="col-2"> <i class="fa-solid fa-eye"></i>{{ $p->view_count }}</td>
                                            <td class="col-2">{{ $p->waiting_time }}</td>
                                            <td class="col-2">
                                                <div class="table-data-feature">

                                                    <a href="{{ route('product#edit', $p->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#delete', $p->id) }}"
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
                                {{ $products->appends(request()->query())->links() }}
                            </div>
                        @else
                            <h1 class="text-center text-secondary">There is no products</h1>
                        @endif
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>

@endsection
