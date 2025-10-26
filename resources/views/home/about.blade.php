@extends('layout.default')

@section('title', 'Về Chúng Tôi - ShoesVN')

@section('content')
<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">Về ShoesVN</h1>
        <p class="lead">Hành trình mang đến những đôi giày chất lượng nhất</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title text-start">Câu Chuyện Của Chúng Tôi</h2>
                <p class="lead">ShoesVN được thành lập với sứ mệnh mang đến cho người tiêu dùng Việt Nam những đôi giày chất lượng cao với giá cả hợp lý.</p>
                <p>Với hơn 10 năm kinh nghiệm trong ngành giày dép, chúng tôi hiểu rõ nhu cầu và mong muốn của khách hàng. Mỗi sản phẩm tại ShoesVN đều được lựa chọn kỹ lưỡng, đảm bảo chất lượng và phong cách phù hợp với thị trường Việt Nam.</p>
                <p>Chúng tôi không chỉ bán giày, mà còn mang đến trải nghiệm mua sắm tuyệt vời và dịch vụ chăm sóc khách hàng tận tâm.</p>
            </div>
            <div class="col-lg-6">
                <img src="https://via.placeholder.com/600x400/3498db/ffffff?text=ShoesVN+Store" class="img-fluid rounded" alt="Cửa hàng ShoesVN">
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title">Giá Trị Cốt Lõi</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="value-card text-center">
                    <div class="value-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h4>Chất Lượng</h4>
                    <p>Cam kết cung cấp sản phẩm chính hãng với chất lượng tốt nhất</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="value-card text-center">
                    <div class="value-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h4>Giá Tốt</h4>
                    <p>Giá cả cạnh tranh với nhiều chương trình khuyến mãi hấp dẫn</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="value-card text-center">
                    <div class="value-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4>Hỗ Trợ 24/7</h4>
                    <p>Đội ngũ chăm sóc khách hàng luôn sẵn sàng hỗ trợ</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="section-title">Đội Ngũ Của Chúng Tôi</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="team-card text-center">
                    <img src="https://via.placeholder.com/300x300/3498db/ffffff?text=CEO" class="rounded-circle mb-3" alt="CEO" width="200" height="200">
                    <h4>Nguyễn Văn A</h4>
                    <p class="text-primary">CEO & Founder</p>
                    <p>Với 15 năm kinh nghiệm trong ngành thời trang và bán lẻ</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="team-card text-center">
                    <img src="https://via.placeholder.com/300x300/e74c3c/ffffff?text=Manager" class="rounded-circle mb-3" alt="Manager" width="200" height="200">
                    <h4>Trần Thị B</h4>
                    <p class="text-primary">Quản Lý Kinh Doanh</p>
                    <p>Chuyên gia về phát triển sản phẩm và chiến lược thị trường</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="team-card text-center">
                    <img src="https://via.placeholder.com/300x300/2ecc71/ffffff?text=Designer" class="rounded-circle mb-3" alt="Designer" width="200" height="200">
                    <h4>Lê Văn C</h4>
                    <p class="text-primary">Trưởng Phòng Thiết Kế</p>
                    <p>Nhà thiết kế giày với nhiều giải thưởng quốc tế</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title">Thành Tựu</h2>
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <div class="stat-card">
                    <h2 class="display-4 text-primary">10K+</h2>
                    <p>Khách Hàng Hài Lòng</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="stat-card">
                    <h2 class="display-4 text-primary">50+</h2>
                    <p>Thương Hiệu Đối Tác</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="stat-card">
                    <h2 class="display-4 text-primary">100K+</h2>
                    <p>Sản Phẩm Đã Bán</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="stat-card">
                    <h2 class="display-4 text-primary">5</h2>
                    <p>Năm Kinh Nghiệm</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .value-card {
        padding: 30px 20px;
        border-radius: 10px;
        transition: transform 0.3s;
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        height: 100%;
    }
    
    .value-card:hover {
        transform: translateY(-5px);
    }
    
    .value-icon {
        width: 80px;
        height: 80px;
        background: #e74c3c;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: white;
        font-size: 2rem;
    }
    
    .team-card {
        padding: 30px 20px;
        border-radius: 10px;
        transition: transform 0.3s;
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        height: 100%;
    }
    
    .team-card:hover {
        transform: translateY(-5px);
    }
    
    .stat-card {
        padding: 30px 20px;
        border-radius: 10px;
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
</style>
@endpush
