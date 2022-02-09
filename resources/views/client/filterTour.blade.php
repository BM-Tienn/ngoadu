
       @foreach ($tour as $rows)
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <div class="item">
                    <div>
                        <img class="image" src="{{ asset('upload/tour/'. $rows->photo) }}" alt="image tour" />
                        <img class="tick" src="{{ asset('client/image/shape (2).png') }}" alt="icon tick">
                        <div class="star"><img src="{{ asset('client/image/Star 1.png') }}"> 4.5</div>
                    </div>
                    <div class="information">
                        <div class="location"><img src="{{ asset('client/image/shape.png') }}">{{ $rows->destinations->title }}</div>
                        <h3 class="name"><a href="{{ url('tour/'.$rows->duration.'-'.$rows->slug) }}" alt="list-tour page">{{ $rows->title }}</a></h3>
                        @if ($rows->duration > 2 )
                        <div class="time"><span><img src="{{ asset('client/image/time.png') }}" alt="icon-time"> {{ $rows->duration }} ngày  {{ number_format(($rows->duration)-1) }} nights</span> <span class="price">từ <strong>{{ $rows->price }} VND</strong></span></div>
                        @elseif ($rows->duration == 2)
                        <div class="time"><span><img src="{{ asset('client/image/time.png') }}" alt="icon-time"> 2 ngày 1 đêm </span> <span class="price">từ <strong>{{ $rows->price }} VND</strong></span></div>
                        @else
                        <div class="time"><span><img src="{{ asset('client/image/time.png') }}" alt="icon-time"> Trong ngày </span> <span class="price">từ <strong>{{ $rows->price }} VND</strong></span></div>
                        @endif
                    </div>
                </div>
                </div>
        @endforeach
        {{ $tour->withQueryString()->links('client.paginate') }}


