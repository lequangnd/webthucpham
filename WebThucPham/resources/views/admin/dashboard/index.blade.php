@extends('admin.layouts.master')
@section('content')
<div id="content-wrapper" class="d-flex flex-column day" data-url="{{route('day')}}">
    <div id="content">
        <!-- Container Fluid-->
        <div class="container-fluid month" id="container-wrapper " data-url="{{route('month')}}">
            <div class="d-sm-flex align-items-center justify-content-between mb-4 year" data-url="{{route('year')}}">

                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">
                            <label for="start">Chọn ngày:</label>
                            <input type="date" id="date" name="date">
                        </a>
                        <select name="pets" id="select_date">
                            <option value="">--Thống kê theo--</option>
                            <option value="1">Ngày</option>
                            <option value="2">Tháng</option>
                            <option value="3">Năm</option>
                        </select>
                    </li>
                </ol>
            </div>

            <div class="row mb-3">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Tổng doanh thu</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 total">
                                        <?php

                                        use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

                                        $total = 0;
                                        foreach ($order as $o) {
                                            $total += $o->total_money;
                                        }
                                        echo $total;
                                        ?>
                                    </div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Annual) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Tổng số hóa đơn</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 order">{{count($order)}}</div>
                                    <div class="mt-2 mb-0 text-muted text-xs">

                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-shopping-cart fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- New User Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Tổng số khách hàng</div>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800 user">{{count($user)}}</div>
                                    <div class="mt-2 mb-0 text-muted text-xs">

                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Tổng số đánh giá sản phẩm</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 comments">{{count($comments)}}</div>
                                    <div class="mt-2 mb-0 text-muted text-xs">

                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div id="myfirstchart" style="height: 250px;"></div>
                </div>
                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div id="firstchart" style="height: 250px;"></div>
                </div>
            </div>
            <!---Container Fluid-->
        </div>
    </div>
</div>
@endsection
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#select_date").change(function(e) {
            e.preventDefault();
            var id = $(this).val();
            var date = new Date($("#date").val());
            if (id == 1) {
                var url = $(".day").data("url");
                var day = $("#date").val();
                $.ajax({
                    type: 'get',
                    url: url,
                    data: {
                        data: day
                    },
                    success: function(data) {
                        $(".order").text(data["order"]);
                        $(".total").text(data["total"]);
                        $(".user").text(data["user"]);
                        $(".comments").text(data["comments"]);

                    },
                    error: function() {
                        return validate();
                    }
                });
            }
            if (id == 2) {
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                var url = $(".month").data("url");
                $.ajax({
                    type: 'get',
                    url: url,
                    data: {
                        month: month,
                        year: year
                    },
                    success: function(data) {
                        $(".order").text(data["order"]);
                        $(".total").text(data["total"]);
                        $(".user").text(data["user"]);
                        $(".comments").text(data["comments"]);


                    },
                    error: function() {
                        return validate();
                    }
                });
            }
            if (id == 3) {
                var year = date.getFullYear();
                var url = $(".year").data("url");
                $.ajax({
                    type: 'get',
                    url: url,
                    data: {
                        year: year
                    },
                    success: function(data) {
                        $(".order").text(data["order"]);
                        $(".total").text(data["total"]);
                        $(".user").text(data["user"]);
                        $(".comments").text(data["comments"]);


                    },
                    error: function() {
                        return validate();
                    }
                });
            }

        });

        new Morris.Bar({
            // ID of the element in which to draw the chart.
            element: 'myfirstchart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: <?php echo $order; ?>,
            // The name of the data record attribute that contains x-values.
            xkey: 'order_date',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Tổng tiền']
        });

        new Morris.Donut({
            // ID of the element in which to draw the chart.
            element: 'firstchart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: <?php echo $donut; ?>,
            // The name of the data record attribute that contains x-values.
            xkey: 'lable',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Tổng tiền']
        });
    });
</script>