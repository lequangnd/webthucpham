@extends('backend.layouts.master')
@section('content')
<!-- Categories Section Begin -->
<section class="categories cart" data-url="{{route('add_cart')}}">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{asset('backend/img/categories/cat-1.jpg')}}">
                            <h5><a href="#">Trái cây</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{asset('backend/img/categories/cat-2.jpg')}}">
                            <h5><a href="#">Hoa quả sấy</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{asset('backend/img/categories/cat-3.jpg')}}">
                            <h5><a href="#">Rau củ</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{asset('backend/img/categories/cat-4.jpg')}}">
                            <h5><a href="#">Nước</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{asset('backend/img/categories/cat-5.jpg')}}">
                            <h5><a href="#">Thịt</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad addHeart" data-url="{{route('add-heart')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm nổi bật</h2>
                    </div>
                    <div class="featured__controls">
                        
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
            @foreach($products as $p)
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" >
                            <img src="{{asset('images/'.$p->image)}}" class="image-{{$p->id}}" alt="">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#" class="btn-heart" data-id="{{$p->id}}"><i class="fa fa-heart" ></i></a></li>
                                <li><a href="{{route('details',['id'=>$p->id])}}"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#" class="btn-cart "  data-id="{{$p->id}}"><i class="fa fa-shopping-cart "></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">{{$p->name}}</a></h6>
                            <h5>{{$p->price}} đ</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{asset('backend/img/banner/banner-1.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{asset('backend/img/banner/banner-2.jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->


    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>Tin tức</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{asset('backend/img/blog/blog-1.jpg')}}" alt="">
                        </div>
                        <div class="blog__item__text">
                            <h5><a href="#">Mẹo nấu ăn giúp việc nấu ăn trở nên đơn giản</a></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{asset('backend/img/blog/blog-2.jpg')}}" alt="">
                        </div>
                        <div class="blog__item__text">
                            
                            <h5><a href="#">6 cách chuẩn bị bữa sáng cho tuổi 30</a></h5>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{asset('backend/img/blog/blog-3.jpg')}}" alt="">
                        </div>
                        <div class="blog__item__text">
                           
                            <h5><a href="#">Thăm trang trại sạch ở việt Name</a></h5>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

@endsection
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function()
    {
        $(".btn-heart").click(function(e)
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
        });

        $(".btn-cart").click(function(e)
        {
            e.preventDefault();
            var id=$(this).data("id");
            var url=$(".cart").data("url");
            var image=$(".image-"+id).attr('src');
            $.ajax({
                type:'get',
                url:url,
                data:{id:id,image:image},
                success:function(data)
                {
                   swal('','Đã thêm vào giỏ hàng','success').then(function()
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