@extends('backend.layouts.master');
@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Đơn vị tính</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order as $o)
        <tr>
            <td>{{$o->products->name}}</td>
            <td>{{$o->units->name}}</td>
            <td>{{$o->quantity}}</td>
            <td>{{$o->price}}</td>
            @if($o->status_id==4)
            <td><a href="{{route('comments',['id'=>$o->products_id])}}" class="btn btn-primary btn-comments">Đánh giá</a></td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
@endsection