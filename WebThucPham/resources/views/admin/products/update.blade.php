@extends('admin.layouts.master')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Basics</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active" aria-current="page">Form Basics</li>
        </ol>
    </div>
    <!-- Form Basic -->
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Form Basic</h6>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('update-products',['id'=>$products->id])}}" name="products" onsubmit="return validate()">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" value="{{$products->name}}" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Danh mục sản phẩm</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="categories">
                                @foreach($categories as $c)
                                <option value="{{$c->id}}" @if($products->categories_id == $c->id) selected @endif>{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thành phần</label>
                            <input type="text" value="{{$products->ingredient}}" name="ingredient" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hạn sử dụng</label>
                            <input type="text" value="{{$products->exp}}" name="exp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="image" accept="image/*" class="custom-file-input" id="customFile" onchange="chooseFile(this)">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Thương hiệu</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="trademarks">
                                @foreach($trademarks as $t)
                                <option value="{{$t->id}}" @if($products->trademarks_id == $t->id) selected @endif>{{$t->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Nước sản xuất</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="countries">
                                @foreach($countries as $c)
                                <option value="{{$c->id}}" @if($products->countries_id == $c->id) selected @endif>{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Nhà cung cấp</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="suppliers">
                                @foreach($suppliers as $s)
                                <option value="{{$s->id}}" @if($invoices->suppliers_id == $s->id) selected @endif>{{$s->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả</label>
                            <input type="text" value="{{$products->description}}" name="description" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <img style="width:100px; height:120px;" src="{{asset('images/'.$products->image)}}" alt="" class="image_choose">
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    function chooseFile(fileInput) {
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".image_choose ").attr('src', e.target.result);
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
    function validate()
    {
        if(document.products.name.value=="")
        {
            alert("Tên sản phẩm không được để trống");
            return false;
        }
        if(document.products.ingredient.value=="")
        {
            alert("Thành phần sản phẩm không được để trống");
            return false;
        }
        if(document.products.exp.value=="")
        {
            alert("Hạn sử dụng sản phẩm không được để trống");
            return false;
        }
        if(document.products.description.value=="")
        {
            alert("Mô tả sản phẩm không được để trống");
            return false;
        }
    }
</script>