@extends('admin.layouts.master')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sản phẩm</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('add-products')}}">Thêm sản phẩm</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>Tên Sản phẩm</th>
                                <th>Ảnh</th>
                                <th>Hạn sử dụng</th>
                                <th>Thành phần</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $p)
                            <tr>
                                <td>{{$p->name}}</td>
                                <td><img style="width:100px; height:120px;" src="{{asset('images/'.$p->image)}}" alt=""></td>
                                <td>{{$p->exp}}</td>
                                <td>{{$p->ingredient}}</td>
                                <td><a href="{{route('update',['id'=>$p->id])}}" class="btn btn-sm btn-primary">Sửa</a>
                                <a href="{{route('details_product',['id'=>$p->id])}}" class="btn btn-sm btn-primary">Chi tiết</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
    @endsection
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>

    </script>