@extends('backend.layouts.master')
@section('content')
<section class="shoping-cart spad deleteCart" data-url="{{route('delete-cart')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(session()->has('cart'))
                            @foreach($cart as $id=>$c)
                            <tr>
                                <td class="shoping__cart__item">
                                    <img style="width:100px; height: 120px" src="{{$c['image']}}" alt="">
                                    <h5>{{$c['name']}}</h5>
                                </td>
                                <td class="shoping__cart__price price">
                                    {{$c['price']}}
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">

                                        <button style="cursor:pointer; border:none;" class="dec qtybtn mr-1 btn-minus">-</button>
                                        <input style="width:50px; height:22px;" data-id={{$id}} type="text" class="text-center quantity_input" data-quantity="{{$c['quantity']}}" value="{{$c['quantity']}}">
                                        <button style="cursor:pointer; border:none;" class="inc qtybtn ml-1 btn-plus">+</button>
                                    </div>
                                </td>
                                <td class="shoping__cart__total total_money">
                                    {{$c['quantity'] * $c['price']}}
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
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    <a href="#" class="primary-btn cart-btn cart-btn-right updateCart"><span class="icon_loading"></span>
                        Upadate Cart</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    @if(session()->has('cart'))
                    <ul>
                        <?php
                        $total = 0;
                        foreach ($cart as $c) {
                            $total += $c['price'] * $c['quantity'];
                        }
                        ?>
                        <li >Tổng tiền <span class="total">{{$total}}</span></li>
                    </ul>
                    @else
                    <ul>
                        <li>Tổng tiền <span>0</span></li>
                    </ul>
                    @endif
                    @if(Auth::check())
                    <a href="{{route('checkout')}}" class="primary-btn btn-order">Thanh toán</a>
                    @else
                    <a href="{{route('login')}}" class="primary-btn">Thanh toán</a>
                    @endif
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
        $(".btn-delete").click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var url = $(".deleteCart").data("url");
            $.ajax({
                type: 'get',
                url: url,
                data: {
                    id: id
                },
                success: function(data) {
                    swal("", "Xóa thành công", "success").then(function() {
                        window.location = "";
                    })
                },
                error: function() {
                    alert("lỗi");
                }
            });
        });

        $(".updateCart").click(function(e)
        {
            e.preventDefault();
            var list=[];
            $("table tbody tr td").each(function()
            {
                $(this).find("input").each(function()
                {
                    var element={id:$(this).data("id"), quantity:$(this).val()};
                    list.push(element);
                });
            });
            $.ajax({
                type:'post',
                url: 'cart/update',
                data:{
                    _token:"{{csrf_token()}}",
                    data: list
                }
            }).done(function()
            {
                swal('','Cập nhật thành công','success').then(function()
                {
                    window.location="";
                })
            })
        })

        $(".btn-plus").click(function(e){
            var total=0;
            var qty=parseInt($(this).parents("tr").find(".quantity_input").val());
            var qty =qty+1;
            $(this).parents("tr").find(".quantity_input").val(qty);
            var price=$(this).parents("tr").find(".price").text();
            var quantity=$(this).parents("tr").find(".quantity_input").val();
            $(this).parents("tr").find(".total_money").text(price * quantity);
            $(".total_money").each(function()
            {
                total=total + parseInt($(this).text());
            });
            $(".total").text(total);
        });

        $(".btn-minus").click(function(e){
            var total=0;
            var quaty=parseInt($(this).parents("tr").find(".quantity_input").val());
            var qty =quaty-1;
            if(quaty==0)
            {
               return;
            }
            $(this).parents("tr").find(".quantity_input").val(qty);
            var price=$(this).parents("tr").find(".price").text();
            var quantity=$(this).parents("tr").find(".quantity_input").val();
            $(this).parents("tr").find(".total_money").text(price * quantity);
            $(".total_money").each(function()
            {
                total=total + parseInt($(this).text());
            });
            $(".total").text(total);
        });
        $(".btn-order").click(function()
        {
            $("table tbody tr td").each(function()
        {
            $(this).find(".quantity_input").each(function()
            {
                if($(this).data("quantity")==0){
                    $(".btn-order").attr("href","#");
                    alert("Số lượng sẩn phẩm phải lớn hơn 0");
                    return false;
                }
            });
        });
        })
    });
</script>