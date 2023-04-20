@extends('admin.layouts.master')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Hóa đơn bán</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
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
                                <th>Tên khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ giao hàng</th>
                                <th>Ngày đặt</th>
                                <th>Ngày giao</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $o)
                            <tr>
                                <td>{{$o->username}}</td>
                                <td>{{$o->phone}}</td>
                                <td>{{$o->address}}</td>
                                <td>{{$o->order_date}}</td>
                                <td>{{$o->shipped_date}}</td>
                                <td>{{$o->total_money}}</td>
                                <td>
                                    <select name="cars" class="status_order" data-id="{{$o->id}}" data-url="{{route('status')}}">
                                        @foreach($order_status as $status)
                                        <option value="{{$status->id}}" @if($status->id==$o->order_status_id) selected @endif>{{$status->name}}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td><a href="{{route('orders-details',['id'=>$o->id])}}" class="btn btn-sm btn-primary">Chi tiết</a>
                                <a href="{{route('pdf',['id'=>$o->id])}}" class="btn btn-sm btn-primary mt-2">In hóa đơn</a></td>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".status_order").change(function(e) {
            var id = $(this).data("id");
            var status_id = $(this).val();
            var url=$(this).data("url");
            $.ajax({
                type: 'get',
                url: url,
                data: {
                    id: id,
                    status_id: status_id
                },
                success: function(data) {
                    swal("", "Cập nhật trạng thái đơn hàng thành công", "success");
                },
                error: function() {
                    alert("lỗi");
                }
            });
        });
    });
</script>