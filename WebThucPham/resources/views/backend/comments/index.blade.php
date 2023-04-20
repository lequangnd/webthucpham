@extends('backend.layouts.master')
@section('content')
<div class="container comments" data-url="{{route('add-comments',['id'=>$details_order->products_id])}}">
<form action="" id="#submitComments" >
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Example textarea</label>
        <textarea class="form-control" id="name" rows="3"></textarea>
    </div>
    <button class="btn btn-primary btn-comments">Đánh giá</button>
</form>
</div>

@endsection
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function()
    {
    $(".btn-comments").click(function(e) {
        e.preventDefault();
        var name = $("#name").val();
        var url = $(".comments").data("url");
        $.ajax({
            type: 'get',
            url: url,
            data: {
                name: name,
            },
            success: function(data) {
                swal("", "Đánh giá thành công.", "success").then(function() {
                    window.location = "";
                });
            },
            error: function() {
                alert("lỗi");
            }
        });
    });
});
</script>