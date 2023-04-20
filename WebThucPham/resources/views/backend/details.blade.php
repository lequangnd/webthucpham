@extends('backend.layouts.master')
@section('content')
<section class="product-details spad product_id" data-id="{{$products->id}}" data-url="{{route('add-cart')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large image" src="{{asset('images/'.$products->image)}}" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl="img/product/details/product-details-2.jpg" src="img/product/details/thumb-1.jpg" alt="">
                        <img data-imgbigurl="img/product/details/product-details-3.jpg" src="img/product/details/thumb-2.jpg" alt="">
                        <img data-imgbigurl="img/product/details/product-details-5.jpg" src="img/product/details/thumb-3.jpg" alt="">
                        <img data-imgbigurl="img/product/details/product-details-4.jpg" src="img/product/details/thumb-4.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3 class="name">{{$products->name}}</h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(18 reviews)</span>
                    </div>
                    <div class="product__details__price price">{{$details_product->price}}</div>
                    <p>{{$products->description}}</p>
                    @foreach($d_product as $d)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input units" data-id="{{$d->units_id}}" data-price="{{$d->price}}" data-image="{{$d->image}}" type="radio" name="units" id="{{$d->id}}" value="{{$d->units_id}}" />
                        <label class="form-check-label" for="{{$d->id}}">{{$d->units->name}}</label>
                    </div>
                    @endforeach
                    </br>

                    <div class="product__details__quantity mt-5">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input id="quantity" type="text" value="1">
                            </div>
                        </div>
                    </div>
                    <a href="#" class="primary-btn btn-addCart">Thêm vào giỏ hàng</a>
                    <ul>
                        <li><b>Hạn sử dụng</b> <span>{{$products->exp}}</span></li>
                        <li><b>Thương hiệu</b> <span>{{$products->trademarks->name}} <samp></li>
                        <li><b>Nước sản xuất</b> <span>{{$products->countries->name}}</span></li>
                        <li><b>Share on</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">Reviews <span>(1)</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <p>{{$products->description}} </p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <table class="table table-striped">
                                    <thead>
                                       <tr>
                                        
                                       </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($comments as $c)
                                        <tr>
                                            <td>{{$c->users->name}}</td>
                                            <td>{{$c->content}}</td>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->
@endsection
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function(e) {
        $(".units").click(function(e) {
            var image = "{!! asset('images/" + $(this).data("image") + "')!!}";
            var price = $(this).data("price");
            $(".price").text(price);
            $(".image").attr('src', image);
        });

        $(".btn-addCart").click(function(e) {
            e.preventDefault();
            var id = $(".product_id").data("id");
            var price = $(".price").text();
            var units_id = $(".units:checked").val();
            var quantity = $("#quantity").val();
            var image = $(".image").attr('src');
            var name = $(".name").text();
            var url = $(".product_id").data("url");
            $.ajax({
                type: 'get',
                url: url,
                data: {
                    id: id,
                    name: name,
                    price: price,
                    units_id: units_id,
                    quantity: quantity,
                    image: image,
                },
                success: function(data) {
                    if(data['message'])
                    {
                        swal("", "Vui lòng chọn đơn vị tính", "info");
                    }else
                    {
                        swal("", "Thêm vào giỏ hàng thành công", "success").then(function()
                        {
                            window.location="";
                        })
                    }

                    
                },
                error: function() {
                    alert("lỗi")
                }
            })
        });

    });
</script>