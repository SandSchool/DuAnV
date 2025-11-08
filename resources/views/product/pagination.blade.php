<!-- kiem tra xem co du items de phan trang khong -->
<!-- tra ve true neu co nhieu trang -->
<!-- tra ve false neu tat ca cac item nam tren 1 trang don -->
@if($paginator->hasPages())
@foreach($elements as $element) <!-- duyet qua tung trang -->
@foreach($element as $page => $url) <!-- duyet qua trang hien tai -->
<a href="{{ $url }}" class="
                item-pagination flex-c-m trans-0-4
                @if($page == $paginator->currentPage()) active-pagination @endif">
    {{ $page }}
</a>
@endforeach
@endforeach
@endif