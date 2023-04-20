<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
    * { font-family: DejaVu Sans !important; }
  </style>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
<div class="card">
  <div class="card-body">
    <div class="container mb-5 mt-3">

      <div class="container">
        <div class="col-md-12">
          <div class="text-center">
            <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
            <p class="pt-0">Organi-Thực phẩm</p>
          </div>

        </div>


        <div class="row">
          <div class="col-xl-8">
            <ul class="list-unstyled">
              <li class="text-muted">Họ tên: <span style="color:#5d9fc5 ;">{{$order->username}}</span></li>
              <li class="text-muted">SDT: <span style="color:#5d9fc5 ;">{{$order->phone}}</span></li>
              <li class="text-muted">Địa chỉ: <span style="color:#5d9fc5 ;">{{$order->address}}</span></li>
            </ul>
          </div>
        </div>

        <div class="row my-2 mx-1 justify-content-center">
          <table class="table table-striped table-borderless">
            <thead style="background-color:#84B0CA ;" class="text-white">
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Sản phẩm</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Giá</th>
                <th scope="col">Tổng tiền</th>
              </tr>
            </thead>
            <tbody>
            @foreach($details as $d)
              <tr>
                <th scope="row">{{$loop->index +1}}</th>
                <td>{{$d->products->name}}</td>
                <td>{{$d->quantity}}</td>
                <td>{{$d->price}}</td>
                <td>{{$d->quantity * $d->price}}</td>
              </tr>
              @endforeach

          </table>
        </div>
        <div class="row">
          <div class="col-xl-3">
            <p class="text-black float-start"><span class="text-black me-3"> Tổng tiền: </span><span
                style="font-size: 25px;">{{$order->total_money}}</span></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-xl-10">
            <p>Cảm ơn bạn đã mua hàng</p>
          </div>  
        </div>

      </div>
    </div>
  </div>
</div>
</body>

</html>