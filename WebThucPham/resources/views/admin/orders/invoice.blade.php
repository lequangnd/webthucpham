@extends('admin.layouts.master')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Hóa đơn nhập</h1>
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
                                <th>Ngày nhập</th>
                                <th>Nhà cung cấp</th>
                                <th>Tổng tiền</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice as $o)
                            <tr>
                                <td>{{$o->date}}</td>
                                <td>{{$o->suppliers->name}}</td>
                                <td>{{$o->total_money}}</td>
                                <td><a href="{{route('details-invoice',['id'=>$o->id])}}" class="btn btn-sm btn-primary">Chi tiết</a></td>
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