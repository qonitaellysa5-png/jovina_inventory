@if ($paginator->hasPages())
  <nav class="pager" role="navigation">
    @if ($paginator->onFirstPage())
      <span class="pg-btn disabled">&lt;</span>
    @else
      <a class="pg-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a>
    @endif

    @php
      $current = $paginator->currentPage();
      $last = $paginator->lastPage();
      $start = max(1, $current - 1);
      $end = min($last, $current + 1);
      if ($current <= 2) { $start = 1; $end = min($last, 3); }
      if ($current >= $last - 1) { $end = $last; $start = max(1, $last - 2); }
    @endphp

    @if ($start > 1)
      <a class="pg-num" href="{{ $paginator->url(1) }}">1</a>
      @if ($start > 2) <span class="pg-ellipsis">…</span> @endif
    @endif

    @for ($page = $start; $page <= $end; $page++)
      @if ($page == $current)
        <span class="pg-num active">{{ $page }}</span>
      @else
        <a class="pg-num" href="{{ $paginator->url($page) }}">{{ $page }}</a>
      @endif
    @endfor

    @if ($end < $last)
      @if ($end < $last - 1) <span class="pg-ellipsis">…</span> @endif
      <a class="pg-num" href="{{ $paginator->url($last) }}">{{ $last }}</a>
    @endif

    @if ($paginator->hasMorePages())
      <a class="pg-btn" href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;</a>
    @else
      <span class="pg-btn disabled">&gt;</span>
    @endif
  </nav>
@endif
