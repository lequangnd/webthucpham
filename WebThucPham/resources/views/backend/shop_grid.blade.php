@extends('backend.layouts.master')
@section('content')
<section class="product spad addHeart" data-url="{{route('add-heart')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul>
                                @foreach($category as $c)
                                <li><a href="{{route('category',['id'=>$c->id])}}">{{$c->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                
                                
                                        <form action="{{route('price')}}">
                                        <input type="text" name="min"  placeholder="nhập giá bắt đầu">
                                        <input type="text" name="max"  placeholder="nhập giá kết thúc">
                                        <button type="submit" class="btn btn-primary">search</button>
                                        </form>
                                   
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Sản phẩm</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        @foreach($products as $p)
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{asset('images/'.$p->image)}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                    @foreach($products as $p)
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                            <img src="{{asset('images/'.$p->image)}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Giảm giá</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach($products as $p)
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg">
                                            <img src="{{asset('images/'.$p->image)}}" alt="">
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#" class="btn-heart" data-id="{{$p->id}}"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="{{route('details',['id'=>$p->id])}}"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <h5><a href="#">{{$p->name}}</a></h5>
                                            <div class="product__item__price">{{$p->price}}</div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{count($products)}}</span> Sản phẩm</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($products as $p)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg">
                                <img src="{{asset('images/'.$p->image)}}" alt="">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#" class="btn-addHeart" data-id="{{$p->id}}"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="{{route('details',['id'=>$p->id])}}"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">{{$p->name}}</a></h6>
                                    <h5>{{$p->price}}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function()
    {
        $(".btn-heart, .btn-addHeart").click(function(e)
        {
            e.preventDefault();
            var id=$(this).data("id");
            var url=$(".addHeart").data("url");
            $.ajax({
                type:'get',
                url:url,
                data:{id:id},
                success:function(data)
                {
                    if(data["message"])
                    {
                        swal('','Sản phẩm đã tồn tại.','info');
                    }
                    else{
                        swal('','Thêm sản phẩm thành công.','success').then(function()
                        {
                            window.location="";
                        })
                    }
                },
                error:function()
                {
                    alert("lỗi");
                }
            })
        })
    });
</script>