@extends("layout.default")
@section("main")
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url({{ asset('public/images') }}/heading-pages-01.jpg);">
    <h2 class="l-text2 t-center">
        Cart
    </h2>
</section>

<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">
        <!-- Cart item -->
        <div class="container-table-cart pos-relative">
            <div class="wrap-table-shopping-cart bgwhite">
                <table class="table-shopping-cart">
                    <tr class="table-head">
                        <th class="column-1"></th>
                        <th class="column-2">Product</th>
                        <th class="column-3">Price</th>
                        <th class="column-4 p-l-70">Quantity</th>
                        <th class="column-5">Total</th>
                    </tr>
                    @php $sub_total = 0; @endphp
                    @if(session("cart"))
                    @foreach(session("cart") as $product)
                    <tr class="table-row">
                        <input type="hidden" value="{{ $product["MASP"] }}">
                        <td class="column-1">
                            <div class="cart-img-product b-rad-4 o-f-hidden">
                                <img src="{{ $product['HINHANH'] }}" alt="{{ $product['TENSP'] }}">
                            </div>
                        </td>
                        <td class="column-2">{{ $product['TENSP'] }}</td>
                        <td class="column-3">{{ number_format($product['GIA']) }}&#8363;</td>
                        <td class="column-4">
                            <div class="flex-w bo5 of-hidden w-size17">
                                <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                    <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                </button>

                                <input class="size8 m-text18 t-center num-product" type="number" name="num-product1" value="{{ $product['QTY'] }}">

                                <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                    <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                        </td>
                        <td class="column-5">{{ number_format($product["QTY"]*$product["GIA"]) }}&#8363;</td>
                    </tr>
                    @php $sub_total += $product["QTY"]*$product["GIA"]; @endphp
                    @endforeach
                    @endif
                </table>
            </div>
        </div>

        <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
            <div class="flex-w flex-m w-full-sm">
                <div class="size11 bo4 m-r-10">
                    <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="coupon-code" placeholder="Coupon Code">
                </div>

                <div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
                    <!-- Button -->
                    <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                        Apply coupon
                    </button>
                </div>
            </div>

            <div class="size10 trans-0-4 m-t-10 m-b-10">
                <!-- Button -->
                <button id="btnUpdateCart" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                    Update Cart
                </button>
            </div>
        </div>

        <!-- Total -->
        <form action="{{ route("cart.pay") }}" method="post">

            @csrf
            <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
                <h5 class="m-text20 p-b-24">
                    Cart Totals
                </h5>

                <!--  -->
                <div class="flex-w flex-sb-m p-b-12">
                    <span class="s-text18 w-size19 w-full-sm">
                        Subtotal:
                    </span>

                    <span id="spnSubTotal" class="m-text21 w-size20 w-full-sm">
                        {{ number_format($sub_total) }}&#8363;
                    </span>
                </div>

                <!--  -->
                <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Shipping:
                    </span>

                    <div class="w-size20 w-full-sm">
                        <p class="s-text8 p-b-23">
                            There are no shipping methods available. Please double check your address, or contact us if you need any help.
                        </p>

                        <span class="s-text19">
                            Calculate Shipping
                        </span>

                        <div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
                            <select class="selection-2" name="transport_method">
                                <option>Chọn phương thức vận chuyển...</option>
                                <option value="ghn">Giao hàng nhanh (nhận hàng trong 24h)</option>
                                <option value="ghtc">Giao hàng tiêu chuẩn (nhận hàng từ 3-5 ngày)</option>
                            </select>
                        </div>

                        {{-- <div class="size13 bo4 m-b-12">--}}
                        {{-- <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="state" placeholder="State /  country">--}}
                        {{-- </div>--}}

                        {{-- <div class="size13 bo4 m-b-22">--}}
                        {{-- <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="postcode" placeholder="Postcode / Zip">--}}
                        {{-- </div>--}}

                        <div class="size14 trans-0-4 m-b-10">
                            <p id="pUpdateTotals" class="my-2"></p>
                            <!-- Button -->
                            <a id="btnUpdateTotals" class="text-white flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                Update Totals
                            </a>
                        </div>
                    </div>
                </div>

                <!--  -->
                <div class="flex-w flex-sb-m p-t-26 p-b-30">
                    <span class="m-text22 w-size19 w-full-sm">
                        Total:
                    </span>

                    <span id="spnTotal" class="m-text21 w-size20 w-full-sm">
                        $39.00
                    </span>
                </div>

                <div class="size15 trans-0-4">
                    <!-- Button -->
                    <button type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                        Proceed to Checkout
                    </button>
                    <div class="m-t-20">
                        <h5 class="m-text20 p-b-10">Thông tin nhận hàng</h5>

                        <div class="bo4 of-hidden size13 m-b-12">
                            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="fullname" placeholder="Họ tên người nhận" required>
                        </div>

                        <div class="bo4 of-hidden size13 m-b-12">
                            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="phone" placeholder="Số điện thoại" required>
                        </div>

                        <div class="bo4 of-hidden size13 m-b-22">
                            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="address" placeholder="Địa chỉ giao hàng" required>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection