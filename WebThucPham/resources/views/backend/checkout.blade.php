@extends('backend.layouts.master')
@section('content')
<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Billing Details</h4>
            <form action="{{route('order')}}" method="post" name="submit_checkout" onsubmit="return validate()">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Tên khách hàng<span>*</span></p>
                                    <input type="text" name="name" value="{{Auth::user()->name}}" class="text-dark">
                                </div>
                            </div>

                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ giao hàng<span>*</span></p>
                            <input type="text" name="address" value="{{Auth::user()->address}}" class="text-dark">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input type="text" name="phone" value="{{Auth::user()->phone}}" class="text-dark">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" name="email" value="{{Auth::user()->email}}" class="text-dark">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>
                            <ul>
                                @foreach($cart as $c)
                                <li>{{$c['name']}}
                                    (
                                    @foreach($units as $u)
                                    @if($c['units_id']==$u->id)
                                    {{$u->name}}
                                    @endif
                                    @endforeach
                                    )
                                    <span>{{$c['price'] * $c['quantity']}}</span>
                                </li>
                                @endforeach
                            </ul>
                            <?php
                            $total = 0;
                            foreach ($cart as $c) {
                                $total += $c['price'] * $c['quantity'];
                            }
                            ?>
                            <div class="checkout__order__total">Total <span>{{$total}}</span></div>
                            <button type="submit" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
<script>
    function validate()
    {
        if(document.submit_checkout.name.value=="")
        {
            alert("Tên khách hàng không được trống");
            return false;
        }
        if(document.submit_checkout.address.value=="")
        {
            alert("Địa chỉ giao hàng không được trống");
            return false;
        }
        if(document.submit_checkout.phone.value=="")
        {
            alert("Số điện thoại không được trống");
            return false;
        }
        if(document.submit_checkout.email.value=="")
        {
            alert("Địa chỉ Email không được trống");
            return false;
        }
        if(!/^-?\d*$/.exec(document.submit_checkout.phone.value) || document.submit_checkout.phone.value.length>10)
        {
            alert("Số điện thoai phải là số và không quá 10 ký tự.");
            return false;
        }
    }
</script>