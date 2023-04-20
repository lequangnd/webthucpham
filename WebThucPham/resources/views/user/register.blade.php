<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{asset('admin/img/logo/a.jpg')}}" rel="icon">
  <title>RuangAdmin - Dashboard</title>
  <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('admin/css/ruang-admin.min.css')}}" rel="stylesheet">
</head>

<body class="bg-gradient-login">
  <!-- Register Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Đăng ký</h1>
                  </div>
                  <form method="post" action="{{route('add-register')}}" name="submit_register" onsubmit="return validate()">
                    @csrf
                    <div class="form-group">
                      <label>Tên</label>
                      <input type="name" name="name" class="form-control" id="exampleInputFirstName" placeholder="Tên">
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label>Mật khẩu</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label>Số điện thoại</label>
                      <input type="text"  name="phone" class="form-control" id="exampleInputFirstName" placeholder="Số điện thoại">
                    </div>
                    <div class="form-group">
                      <label>Địa chỉ</label>
                      <input type="text" name="address" class="form-control" id="exampleInputFirstName" placeholder="Địa chỉ">
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <hr>
                    <a href="index.html" class="btn btn-google btn-block">
                      <i class="fab fa-google fa-fw"></i> Register with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                    </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="login.html">Already have an account?</a>
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Register Content -->
  <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="{{asset('admin/js/ruang-admin.min.js')}}"></script>
  <script src="{{asset('admin/vendor/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('admin/s/demo/chart-area-demo.js')}}"></script> 
  <script>
  function validate()
  {
    if(document.submit_register.name.value=="")
    {
      alert("Tên khách hàng không được để trống");
      return false;
    }
    if(document.submit_register.email.value=="")
    {
      alert("Email không được để trống");
      return false;
    }
    if(document.submit_register.password.value=="")
    {
      alert("Mật khẩu không được để trống");
      return false;
    }
    if(!/^-?\d*$/.exec(document.submit_register.password.value) || document.submit_register.password.value.length>8)
    {
      alert("Mật khẩu phải là số và không quá 8 ký tự");
      return false;
    }
    if(document.submit_register.phone.value=="")
    {
      alert("Số điện thoại không được để trống");
      return false;
    }
    if(!/^-?\d*$/.exec(document.submit_register.phone.value) || document.submit_register.phone.value.length>10)
    {
      alert("Số điện thoại phải là số và không quá 10 ký tự");
      return false;
    }
    if(document.submit_register.address.value=="")
    {
      alert("Địa chỉ không được để trống");
      return false;
    }
  }
</script>
</body>

</html>