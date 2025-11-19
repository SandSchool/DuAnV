@extends("layout.default")
@section("content")
<div class="text-center">
    <div class="py-5"></div>
    <h1>ĐẶT HÀNG THÀNH CÔNG</h1>
    <p><b>Cảm ơn bạn đã đặt hàng</b></p>
    <p>
        Một email xác nhận đã được gửi tới {{ auth()->guard("cus")->user()->EMAIL }}. <br>
        Vui lòng kiểm tra email của bạn và hoàn tất xác nhận đơn hàng.
    </p>
    <a href="#" class="btn btn-warning">Xem đơn đặt hàng</a>
    <div class="py-5"></div>
</div>
@endsection