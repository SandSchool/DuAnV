@extends("layout.admin")
@section("main")
<div class="wrapper ">
    @include("admin.sidebar") <div class="main-panel">
        @include("admin.navbar") <div class="content">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">a
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-box-2 text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Đã Bán</p>
                                        <p class="card-title">{{ number_format($products_sold) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats"><i class="fa fa-refresh"></i> Tổng sản phẩm bán ra</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-money-coins text-success"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Doanh Thu</p>
                                        <p class="card-title">{{ number_format($revenue, 0, ',', '.') }} đ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats"><i class="fa fa-calendar-o"></i> Tổng tiền thu về</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-vector text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Đơn Hàng</p>
                                        <p class="card-title">{{ $total_orders }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats"><i class="fa fa-clock-o"></i> Tổng số đơn hàng</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-single-02 text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Khách Hàng</p>
                                        <p class="card-title">{{ number_format($customers) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats"><i class="fa fa-refresh"></i> Số người đăng ký</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Doanh thu 7 ngày qua</h5>
                        <p class="card-category">Biểu đồ xu hướng doanh số</p>
                    </div>
                    <div class="card-body ">
                        <canvas id="revenueChart" width="400" height="100"></canvas>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-history"></i> Cập nhật tự động
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include("admin.footer")
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // QUAN TRỌNG: Gọi đúng ID mới là 'revenueChart'
        var ctx = document.getElementById('revenueChart').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($list_date), // Ngày
                datasets: [{
                    label: "Doanh thu",
                    borderColor: "#ef8157", // Màu cam
                    backgroundColor: "rgba(239, 129, 87, 0.1)",
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4, // Làm mượt đường cong
                    data: @json($list_money) // Tiền
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.raw.toLocaleString('vi-VN') + ' đ';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [2, 2] // Lưới nét đứt cho đẹp
                        },
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('vi-VN') + ' đ';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endsection