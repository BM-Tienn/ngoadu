@if ($paginator->hasPages())
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6 col-lg-0 col-md-0 col-sm-0">&nbsp;</div>
        <div class="showing col-xl-3 col-lg-6 col-md-12 col-sm-12">Showing   &nbsp;  {{$paginator->currentPage()}}/ {{ ceil(($paginator->total())/($paginator->perPage())) }}</div>
        <div class="pagination col-xl-3 col-lg-6 col-md-12 col-sm-12">
            <ul class="">
                <div class="pagination-right d-flex">
                    @if ($paginator->onFirstPage())
                    <div class="btn-pagination btn-pagination-arrow d-none">
                    
                    </div>
                @else
                    {{-- <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a></li> --}}
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <div class="btn-pagination btn-pagination-arrow">
                        <img src=" {{ URL::asset('/image/vector.png') }}" width="20px" height="20px">
                    </div>
                    </a>
                @endif
        
                @foreach ($elements as $element)
                    
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                {{-- <li class="active my-active"><span>{{ $page }}</span></li> --}}
                                <div class="btn-pagination btn-pagination-num active text-dark">
                                {{-- {{ $page }} --}}
                                <a class="a-paginate" data-page="{{$page}}">{{ $page }}</a>
                                </div>
                            @else
                                {{-- <li><a href="{{ $url }}">{{ $page }}</a></li> --}}
                                <div class="btn-pagination btn-pagination-num">
                                    <a class="a-paginate" data-page="{{$page}}" href="{{ $url }}">{{ $page }}</a>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    @endforeach
        
                    @if ($paginator->hasMorePages())
                    
                    <a href="{{$paginator->nextPageUrl()}}" rel="next">
                    <div class="btn-pagination btn-pagination-arrow ">
                        <img style='transform: rotate(180deg);' src=" {{ URL::asset('client/image/vector.png') }}" alt="">
                    </div>
                    </a>
                    @else 
                    <div class="btn-pagination btn-pagination-arrow d-none">
                        <img style='transform: rotate(180deg);' src=" {{ URL::asset('client/image/vector.png') }}" alt="">
                    </div>
                    @endif
        
                </div>
            </ul>
        </div>
    </div>
</div>


@endif