<style>
    .modern-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        padding: 30px 0;
    }

    .pagination-item {
        min-width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s ease;
        border: 2px solid #e0e0e0;
        background: white;
        color: #666;
    }

    .pagination-item:hover {
        border-color: #667eea;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
    }

    .pagination-item.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: transparent;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }

    .pagination-item.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        pointer-events: none;
    }

    .pagination-nav {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        text-decoration: none;
        font-size: 16px;
        transition: all 0.3s ease;
        border: 2px solid #667eea;
        background: white;
        color: #667eea;
    }

    .pagination-nav:hover:not(.disabled) {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .pagination-dots {
        color: #999;
        font-weight: 600;
        padding: 0 10px;
        font-size: 18px;
    }
</style>

<!-- {{-- Kiểm tra nếu có dữ liệu thì mới hiển thị --}} -->
@if ($paginator->total() > 0)

<!-- {{-- Chỉ hiển thị thanh phân trang (Next/Prev) nếu có nhiều hơn 1 trang --}} -->
@if ($paginator->hasPages())
<div class="modern-pagination">
    {{-- Previous Button --}}
    @if ($paginator->onFirstPage())
    <span class="pagination-nav disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
        <i class="fas fa-chevron-left"></i>
    </span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}" class="pagination-nav" rel="prev" aria-label="@lang('pagination.previous')">
        <i class="fas fa-chevron-left"></i>
    </a>
    @endif

    <!-- {{-- Pagination Elements --}} -->
    @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
    <span class="pagination-dots disabled" aria-disabled="true">{{ $element }}</span>
    @endif

    <!-- {{-- Array Of Links --}} -->
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <span class="pagination-item active" aria-current="page">{{ $page }}</span>
    @else
    <a href="{{ $url }}" class="pagination-item">{{ $page }}</a>
    @endif
    @endforeach
    @endif
    @endforeach

    <!-- {{-- Next Button --}} -->
    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" class="pagination-nav" rel="next" aria-label="@lang('pagination.next')">
        <i class="fas fa-chevron-right"></i>
    </a>
    @else
    <span class="pagination-nav disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
        <i class="fas fa-chevron-right"></i>
    </span>
    @endif
</div>
@endif
@else
<!-- {{-- MESSAGE: Thông báo khi không tìm thấy dữ liệu --}} -->
<div class="alert alert-warning text-center mt-3" role="alert">
    <i class="fas fa-exclamation-triangle me-2"></i>
    Không tìm thấy dữ liệu nào phù hợp.
</div>
@endif