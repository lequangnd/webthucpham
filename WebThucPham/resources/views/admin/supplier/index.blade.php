@extends('admin.layouts.master')
@section('content')
<div class="container-fluid supplier" id="container-wrapper " data-url="{{route('add-supplier')}}">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 update-supplier" data-url="{{route('update-supplier')}}">
        <h1 class="h3 mb-0 text-gray-800 delete-supplier" data-url="{{route('delete-supplier')}}">Danh mục sản phẩm</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
        </ol>
    </div>

    <div class="row">
        <form action="" id="supplier" name="suppliers">
            <div class="form-group">
                <label for="exampleInputEmail1">Tên danh mục</label>
                <input type="text" name="name" id="name" class="form-control" aria-describedby="emailHelp">
                <button class="btn btn-sm btn-primary">Thêm</button>
            </div>
        </form>
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th >Tên danh mục</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($supplier as $c)
                            <tr>
                                <td class="name" style="cursor:pointer;">{{$c->name}}</td>
                                <td><button disabled data-id="{{$c->id}}"  class="btn btn-sm btn-primary btn-update">Sửa</button>
                                    <button disabled data-id="{{$c->id}}" class="btn btn-sm btn-danger btn-delete">Xóa</button>
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
@endsection
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#supplier").submit(function(e)
        {
            e.preventDefault();
            var name=$("#name").val();
            var url=$(".supplier").data("url");
            $.ajax({
                type:'get',
                url:url,
                data:{name:name},
                success:function(data)
                {
                    swal("", "Thêm thành công", "success").then(function()
                    {
                        window.location="";
                    });
                },
                error:function()
                {
                   return validate();
                }
            })
        });

        $(".btn-update").click(function(e)
        {
            e.preventDefault();
            var id=$(this).data("id");
            var name=$("#name").val();
            var url=$(".update-supplier").data("url");
            $.ajax({
                type:'get',
                url:url,
                data:{id:id,name:name},
                success:function(data)
                {
                    swal("", "Sửa thành công", "success").then(function()
                    {
                        window.location="";
                    });
                },
                error:function()
                {
                   return validate_update();
                }
            })
        });

        $(".btn-delete").click(function(e)
        {
            e.preventDefault();
            var id=$(this).data("id");
            var url=$(".delete-supplier").data("url");
            $.ajax({
                type:'get',
                url:url,
                data:{id:id},
                success:function(data)
                {
                    swal("", "Sửa thành công", "success").then(function()
                    {
                        window.location="";
                    });
                },
                error:function()
                {
                    alert("lỗi");
                }
            })
        });

        $(".name").click(function(e)
        {
            e.preventDefault();
            $("button").prop("disabled",true);
            var name=$(this).text();
            $("#name").val(name);
            $(this).parent("tr").find(".btn-update").prop("disabled",false);
            $(this).parent("tr").find(".btn-delete").prop("disabled",false);
        });

        function validate()
        {
            if(document.suppliers.name.value=="")
            {
                alert("Tên nhà cung cấp không được để trống.");
                return;
            }
        }
        function validate_update()
        {
            if(document.suppliers.name.value=="")
            {
                alert("Tên nhà cung cấp không được để trống.");
                return;
            }
        }

    });
</script>