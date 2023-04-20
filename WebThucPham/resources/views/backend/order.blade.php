@extends('backend.layouts.master');
@section('content')
<table class="table">
    <thead>
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
        @foreach($order as $o)
        <tr>
            <td>{{$o->username}}</td>
            <td>{{$o->phone}}</td>
            <td>{{$o->address}}</td>
            <td>{{$o->order_date}}</td>
            <td>{{$o->shipped_date}}</td>
            <td>{{$o->total_money}}</td>
            <td>
                {{$o->order_status->name}}
            </td>

            <td><a href="{{route('user_order_details',['id'=>$o->id])}}" class="btn btn-sm btn-primary">Chi tiết</a>
            @if($o->order_status_id==1)
            <a href="{{route('delete_order_details',['id'=>$o->id])}}" class="btn btn-sm btn-danger">Hủy</a></td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
@endsection