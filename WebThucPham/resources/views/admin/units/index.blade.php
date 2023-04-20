@extends('admin.layouts.master')
@section('content')
<div class="container-fluid units" id="container-wrapper " data-url="{{route('add-units')}}">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 update-units" data-url="{{route('update-units')}}">
        <h1 class="h3 mb-0 text-gray-800 delete-units" data-url="{{route('delete-units')}}">Danh mục sản phẩm</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
        </ol>
    </div>

    <div class="row">
        <form action="" id="units" name="units">
            <div class="form-group">
                <label for="exampleInputEmail1">Đơn vị tính</label>
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
                                <th >Tên đơn vị tính</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($units as $u)
                            <tr>
                                <td class="name" style="cursor:pointer;">{{$u->name}}</td>
                                <td><button disabled data-id="{{$u->id}}"  class="btn btn-sm btn-primary btn-update">Sửa</button>
                                    <button disabled data-id="{{$u->id}}" class="btn btn-sm btn-danger btn-delete">Xóa</button>
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
        $("#units").submit(function(e)
        {
            e.preventDefault();
            var name=$("#name").val();
            var url=$(".units").data("url");
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
            var url=$(".update-units").data("url");
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
            var url=$(".delete-units").data("url");
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
            if(document.units.name.value=="")
            {
                alert("Tên đơn vị tính không được để trống.");
                return;
            }
        }
        function validate_update()
        {
            if(document.units.name.value=="")
            {
                alert("Tên đơn vị tính không được để trống.");
                return;
            }
        }

    });
</script>