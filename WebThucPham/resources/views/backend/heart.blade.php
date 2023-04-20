@extends('backend.layouts.master')
@section('content')
<section class="shoping-cart spad deleteHeart" data-url="{{route('delete-heart')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Sản phẩm</th>
                                <th>Giá</th>
                                <th>Thương hiệu</th>
                                <th>Quốc gia</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(session()->has('heart'))
                            @foreach($heart as $id=>$h)
                            <tr>
                                <td class="shoping__cart__item">
                                <a href="{{route('details',['id'=>$id])}}"><img style="width:100px; height: 120px" src="{{asset('images/'.$h['image'])}}" alt=""></a>
                                    <h5>{{$h['name']}}</h5>
                                </td>
                                <td >
                                    {{$h['price']}} đ
                                </td>
                                <td >
                                    {{$h['trademark']}}
                                </td>
                                <td >
                                    {{$h['country']}}
                                </td>
                                <td class="shoping__cart__item__close">
                                    <span class="icon_close btn-delete" data-id="{{$id}}"></span>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".btn-delete").click(function()
        {
            var id=$(this).data("id");
            var url=$(".deleteHeart").data("url");
            $.ajax({
                type:'get',
                url:url,
                data:{id:id},
                success:function(data)
                {
                    swal('','Xóa thành công','success').then(function()
                    {
                        window.location="";
                    })
                },
                error:function()
                {
                    alert("lỗi");
                }
            })
        })
    });
</script>