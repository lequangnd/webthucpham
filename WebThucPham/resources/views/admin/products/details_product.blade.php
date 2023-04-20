@extends('admin.layouts.master')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 product_delete"  data-url="{{route('delete-details-product')}}">
        <h1 class="h3 mb-0 text-gray-800">Chi tiết sản phẩm</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
        </ol>
    </div>
    <div class="row product" data-id="{{$id}}" data-url="{{route('add-details-product')}}">
        <div class="col-4 product_update" data-url="{{route('update-details-product')}}">
            <form action="" id="details_submit" name="products">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Đơn vị tính</label>
                    <select class="form-control" id="units">
                        @foreach($units as $u)
                        <option value="{{$u->id}}">{{$u->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Số lượng</label>
                    <input type="text" name="quantity" class="form-control" id="quantity" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Giá nhập</label>
                    <input type="text" name="import_price" class="form-control" id="import_price" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Giá bán</label>
                    <input type="text" name="price" class="form-control" id="price" aria-describedby="emailHelp">
                </div>
                <div class="form-group row">
                    <div class="custom-file col-6">
                        <input type="file" name="image" accept="image/*" class="custom-file-input" id="image" onchange="chooseFile(this)">
                        <label class="custom-file-label" for="customFile">Choose file</label>

                    </div>
                    <div class="custom-file col-6">
                        <img style="width:100px; height:120px;" src="" class="image_choose" alt="">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-8">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Đơn vị tính</th>
                                        <th>Số lượng</th>
                                        <th>Giá nhập</th>
                                        <th>Giá bán</th>
                                        <th>Ảnh</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($details_product as $d)
                                    <tr>
                                        <td class="units" data-id="{{$d->units_id}}">{{$d->units->name}}</td>
                                        <td class="quantity">{{$d->quantity}}</td>
                                        <td class="import_price">{{$d->import_price}}</td>
                                        <td class="price">{{$d->price}}</td>
                                        <td class="image_product" data-image="{{$d->image}}"><img style="width:100px; height:120px;" src="{{asset('images/'.$d->image)}}" alt=""></td>
                                        <td><button disabled class="btn btn-sm btn-primary btn-update" data-id="{{$d->id}}">Sửa</button>
                                            <button disabled class="btn btn-sm btn-danger btn-delete" data-id="{{$d->id}}">Xóa</button>
                                        </td>
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
    </div>

</div>
@endsection
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
    $(document).ready(function(e) {
        $("#details_submit").submit(function(e) {
            e.preventDefault();
            var product_id = $(".product").data("id");
            var url = $(".product").data("url");
            var units = $("#units").val();
            var quantity = $("#quantity").val();
            var import_price = $("#import_price").val();
            var price = $("#price").val();
            var fileValueAfterChange = $("#image").val();
            fileValueAfterChange = fileValueAfterChange.substring(fileValueAfterChange.lastIndexOf("\\") + 1, fileValueAfterChange.length);
            $.ajax({
                type: 'get',
                url: url,
                data: {
                    product_id: product_id,
                    units: units,
                    quantity: quantity,
                    import_price: import_price,
                    price: price,
                    image: fileValueAfterChange
                },
                success: function(data) {
                    if (data["message"]) {
                        swal("", "Đơn vị tính bị trùng.", "info");
                    } else {
                        swal("", "Thêm thành công.", "success").then(function(e) {
                            window.location = "";
                        });
                    }

                },
                error: function() {
                    return validate();
                }
            });
        });

        $(".units").click(function(e) {
            e.preventDefault();
            var units = $(this).data("id");
            var quantity = $(this).parents("tr").find("td.quantity").text();
            var import_price = $(this).parents("tr").find("td.import_price").text();
            var price = $(this).parents("tr").find("td.price").text();
            var image="{!! asset('images/"+$(this).parents("tr").find("td.image_product").data("image")+"')!!}";
            $("#units").val(units);
            $("#quantity").val(quantity);
            $("#import_price").val(import_price);
            $("#price").val(price);
            $(".image_choose").attr('src',image);
            $(".btn-update").prop("disabled",true);
            $(".btn-delete").prop("disabled",true);
            $(this).parents("tr").find(".btn-update").prop("disabled",false);
            $(this).parents("tr").find(".btn-delete").prop("disabled",false);
            
            

        });

        $(".btn-update").click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var product_id = $(".product").data("id");
            var url = $(".product_update").data("url");
            var units = $("#units").val();
            var quantity = $("#quantity").val();
            var import_price = $("#import_price").val();
            var price = $("#price").val();
            var fileValueAfterChange = $("#image").val();
            fileValueAfterChange = fileValueAfterChange.substring(fileValueAfterChange.lastIndexOf("\\") + 1, fileValueAfterChange.length);
            $.ajax({
                type: 'get',
                url: url,
                data: {
                    id: id,
                    product_id: product_id,
                    units: units,
                    quantity: quantity,
                    import_price: import_price,
                    price: price,
                    image: fileValueAfterChange
                },
                success: function(data) {
                    if (data["message"]) {
                        swal("", "Đơn vị tính bị trùng hoặc số lượng phải nhỏ hơn số lượng nhập.", "info")
                    } else {
                        swal("", "Sửa thành công.", "success").then(function(e) {
                            window.location = "";
                        });

                    }

                },
                error: function() {
                    return validate_update();
                }
            })
        })

        $(".btn-delete").click(function(e)
        {
            e.preventDefault();
            var id = $(this).data("id");
            var url = $(".product_delete").data("url");
            var product_id = $(".product").data("id");
            alert(url);
            $.ajax({
                type: 'get',
                url: url,
                data: {
                    id: id,
                    product_id:product_id
                },
                success: function(data) {

                    swal("", "Xóa thành công.", "success").then(function(e)
                    {
                        window.location="";
                    })

                },
                error: function() {
                    alert('lỗi')
                }
            })
        });

        function validate()
        {
            if(document.products.quantity.value=="")
            {
                alert("Số lượng không được để trống.");
                return;
            }
            if(!/^\d*$/.exec(document.products.quantity.value))
            {
                alert("Số lượng phải là số.");
                return;
            }
            if(document.products.import_price.value=="")
            {
                alert("Giá nhập không được để trống.");
                return;
            }
            if(!/^\d*$/.exec(document.products.import_price.value))
            {
                alert("Giá nhập lượng phải là số.");
                return;
            }
            if(document.products.price.value=="")
            {
                alert("Giá bán không được để trống.");
                return;
            }
            if(!/^\d*$/.exec(document.products.price.value))
            {
                alert("Giá bán lượng phải là số.");
                return;
            }
            if(document.products.image.value=="")
            {
                alert("Ảnh không được để trống.");
                return;
            }
        }
        function validate_update()
        {
            if(document.products.quantity.value=="")
            {
                alert("Số lượng không được để trống.");
                return;
            }
            if(!/^\d*$/.exec(document.products.quantity.value))
            {
                alert("Số lượng phải là số.");
                return;
            }
            if(document.products.import_price.value=="")
            {
                alert("Giá nhập không được để trống.");
                return;
            }
            if(!/^\d*$/.exec(document.products.import_price.value))
            {
                alert("Giá nhập lượng phải là số.");
                return;
            }
            if(document.products.price.value=="")
            {
                alert("Giá bán không được để trống.");
                return;
            }
            if(!/^\d*$/.exec(document.products.price.value))
            {
                alert("Giá bán lượng phải là số.");
                return;
            }
        }
    });
</script>