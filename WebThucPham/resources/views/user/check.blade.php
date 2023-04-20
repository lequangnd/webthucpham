<div style="width:600px; margin: 0 auto;">
    <div style="text-align: center">
    <h2>Xin chào {{$user->name}}</h2>
    <p>Vui lòng click vào nút kich hoạt để lấy lại mật khẩu</p>
    <p><a href="{{route('password',['id'=>$user->id,'token'=>$user->remember_token])}}"> Kích hoạt</a></p>
    </div>
</div>