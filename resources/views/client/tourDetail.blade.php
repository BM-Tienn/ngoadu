<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="#">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
<title>{{ $detail->title }}</title>

<link rel="stylesheet" type="text/css" href="{{ asset('client/css/tour-detail.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('client/owl-carousel/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/owl-carousel/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
<body>

<!-- header -->
<div class="header">
<div class="container-fluid">
<div class="feature row">
<div class="logo col-xl-4 col-lg-2 col-md-2 col-sm-4">
    <a href="{{ url('home') }}" title="Home page"><img src="{{ asset('client/image/Group 349 (1).png') }}" alt="logo of website"></a></div>

<div class="menu col-xl-8 col-lg-10 col-md-10 col-sm-8 d-flex justify-content-end">
    <ul>
        <li><a href="{{ url('home') }}" title="Home page">Trang chủ</a></li>
        <li><a href="#" title="About page">About</a></li>
        <li><a class="active" href="{{ url('list-tour') }}" title="List tour page">Chuyến du lịch</a></li>
        <!-- <li><a href="#" title="Hotel page">Hotels</a></li> -->
        <li><a href="{{ url('contact') }}" title="Contact page">Phản hồi</a></li>
        <!-- <li><a href="#" title="Login page">Login</a></li> -->
    </ul>
</div>
</div>
<div class="header-responsive">
            <div class="logo_responsive">
                <img src="{{ asset('client/image/Group 349.png') }}">
            </div>
            <div class="header-responsive-title"><i class="fa fa-bars fa-2x"></i></div>
            <ul>
                <li><a href="{{ url('home') }}" title="Home page">Trang chủ</a></li>
                <li><a href="#" title="About page">About</a></li>
                <li><a class="active" href="{{ url('list-tour') }}" title="List tour page">Chuyến du lịch</a></li>
                <!-- <li><a href="#" title="Hotel page">Hotels</a></li> -->
                <li><a href="{{ url('contact') }}" title="Contact page">Phản hồi</a></li>
                <!-- <li><a href="#" title="Login page">Login</a></li> -->
            </ul>
        </div>
</div>
</div>
<!-- /header -->
<hr class="border border-light">

<!-- content -->
<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-12">
    <ul class="breadcrumb">
        <li><a href="#">Trang chủ</a></li>
        <li><a href="#">Chuyến du lịch</a></li>
        <li><a href="#">Thông tin chuyến du lịch</a></li>
      </ul>
  </div>
  @if (isset($detail))
        <div class="information-tour col-xl-7 col-md-12">
            <h3>{{ $detail->title}}</h3>
            <div class="location"><img src="{{ asset('client/image/shape.png') }}">{{ $detail->destinations->title }}</div><br>
                <div>
                    <div class="star float-left">
                        <img src="{{ asset('client/image/Star 1.png') }}">
                        @if ($rating == 0)

                        @endif{{ $rating }}
                    </div>
                    <h6>{{ $count }} reviews</h6>
                </div>
        </div>
    </div>
    <div class="tour row">
        <div class="col-xl-7">
           <div class="mySlides">
                 <img class="w-100" src="{{ asset('upload/tour/'.$detail->photo) }}" alt="pagoda" >
           </div>

            @foreach ($gallery as $item)
                <div class="mySlides">
                    <img class="w-100" src="{{ asset('upload/tour/gallery/'.$item->image) }}">
                </div>
            @endforeach

             <!-- Next and previous buttons -->
             <a class="prev" onclick="plusSlides(-1)"><img src="{{ asset('client/image/Vector (4).png') }}" alt="icon "></a>
             <a class="next" onclick="plusSlides(1)"><img src="{{ asset('client/image/Vector (5).png') }}" alt="icon next"></a>
             <img class="tick-tour" src="{{ asset('client/image/shape (1).png') }}" alt="icon tick">

             <!-- Image text -->
             <!-- Thumbnail images -->
             <div class="row">
                <div class="column col-3">
                    <img class="demo cursor w-100" src="{{ asset('upload/tour/'.$detail->photo) }}"  onclick="currentSlide(1)" alt="The Woods">
                </div>
                  @foreach ($gallery as $item )
                    <div class="column col-3">
                          <img class="demo cursor w-100" src="{{ asset('upload/tour/gallery/'.$item->image) }}"  onclick="currentSlide($i++)" alt="The Woods">
                    </div>
                  @endforeach
             </div>
                   @if (session()->get('tabId') === 'tab2')
                      <ul class="nav nav-item text-right mt-5" role="tablist" >
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#description">Sự miêu tả</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#additional">Thông tin bổ sung</a>
                        </li>
                          <li class="nav-item">
                        <a class='nav-link active' data-toggle="tab" href="#review">reviews ({{ $count }})</a>
                        </li>
                      </ul>
                   @else
                      <ul class="nav nav-item text-right mt-5" role="tablist" >
                        <li class="nav-item">
                          <a class="nav-link active" data-toggle="tab" href="#description">Sự miêu tả</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#additional">Thông tin bổ sung</a>
                        </li>
                          <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#review">reviews ({{ $count }})</a>
                        </li>
                      </ul>
                   @endif

               <hr>

                     <!-- Tab panes -->
                     <div class="tab-content">
                       @if (session()->has('tabId'))
                          <div id="description" class="container tab-pane fade m-1 p-0"><br>
                       @else
                          <div id="description" class="container tab-pane active m-1 p-0"><br>
                       @endif

                         <h5>Tổng quát</h5>
                         <p>{!! $detail->overview !!}</p>
                         <hr>
                         <h5>Bao gồm những gì</h5>
                         <p>{!! $detail->include !!}</p>
                       <hr>
                       <h5>Khởi hành & Trở về</h5>
                       <p>{!! $detail->depature !!}</p>
                       <hr>
                       <h5>Lịch trình tour du lịch</h5>

                       <div id="accordion">
                          @foreach ($itineraries as $item)
                            <div class="card">
                             <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapse{{ $item->id }}" aria-expanded="true" aria-controls="collapseOne">
                                <h5 class="mb-0">
                                    <span>{{ $item->title }} ({{ $item->placeItineraries->count() }} điểm dừng)</span>
                                  <i  class="fa fa-chevron-down fa-1x"></i>
                                </h5>
                             </div>
                             {{-- {{ $itinerary->id }} --}}
                             @foreach ($item->placeItineraries as $place)
                                <div id="collapse{{ $place->itinerary_id }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                  <div class="card-body">
                                    <div class="active">
                                        <div class="location"><img src="{{ asset('client/image/map-pin.png') }}">{{ $place->location }}</div>
                                          <div class="active-main">
                                            <p>{{ $place->description }}</p>
                                            @if ($place->duration != '')
                                              <div class="time"><span>Thời lượng:</span> {{ $place->duration }} phút</div>
                                              <div class="ticker mb-2" >{{ $place->note }}</div>
                                            @else
                                            @endif
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              @endforeach
                           </div>
                          @endforeach
                         </div>

                       @if ($detail->map != '')
                           <h5 class="mt-5">Vị trí</h5>
                           <iframe class="mt-5" src="{{ $detail->map }}" width="100%" height="500px" allowfullscreen="" loading="lazy"></iframe>
                       @elseif ($detail->map == '')
                          <h5 class="mt-5"></h5>
                        @endif
                               <!-- /content -->
                        @if ($detail->image_360 != '' && $detail->video != '')
                            <h5 class="mt-5">360° Panoramic Images and Videos</h5>
                        @elseif ($detail->image_360 != '' && $detail->video == '')
                            <h5 class="mt-5">360° Panoramic Images</h5>
                        @elseif ($detail->image_360 == '' && $detail->video != '')
                            <h5 class="mt-5">Video</h5>
                        @else
                            <h5 class="mt-5"></h5>
                        @endif
                       @if ($detail->image_360 != '')
                          <iframe class="mt-1" src="{{ $rows->image_360 }}" width="100%" height="400" allowfullscreen="" loading="lazy"></iframe>
                        @endif
                        @if ($detail->video != '')
                            <iframe class="mt-5 mb-2" src="{{ url('https://www.youtube.com/embed/'.$rows->video) }}" title="YouTube video player" width="100%" height="400px" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @endif      <!-- /content -->
                       </div>

                       <div id="additional" class="container tab-pane fade m-1 p-0"><br>
                         <p>{!! $detail->addtional !!}</p>
                         <h5>Câu hỏi thường gặp</h5>

                         <div id="accordion">
                           @foreach ($faqs as $item)
                               <div class="card">
                               <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapse{{ $item->id }}" aria-expanded="true" aria-controls="collapseOne">
                                 <h5 class="mb-0">
                                     <span><img src="{{ asset('client/image/help-circle.png') }}">{{ $item->question }}
                                     </span>
                                   <i  class="fa fa-chevron-down fa-1x"></i>
                                 </h5>
                               </div>

                               <div id="collapse{{ $item->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                 <div class="card-body">
                                         <div class="active">
                                             <div class="active-main">
                                               <p>{!! $item->answer !!}</p>
                                             </div>

                                         </div>
                                 </div>
                               </div>
                             </div>
                           @endforeach
                           </div>
                       </div>
                       @if (session()->has('tabId'))
                          <div id="review" class="container tab-pane active m-1 p-0"><br>
                       @else
                          <div id="review" class="container tab-pane fade m-1 p-0"><br>
                       @endif

                         <div class="rating row">
                           <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 text-center">
                             <div class="rating-block">

                               <h2 class="bold"> {{ $rating }} / 5</h2>
                                 <div class="star">
                                  @for ($i = 0; $i < round($rating); $i++)
                                    <i class="fa fa-star fa-2x active" aria-hidden="true"></i>
                                  @endfor
                                  @for ($i = 0; $i < (5 - (round($rating))); $i++)
                                  <i class="fa fa-star fa-2x" aria-hidden="true"></i>
                                  @endfor
                               </div>
                               <p>Dựa trên <strong>{{ $count }} nhận xét</strong></p>
                             </div>
                           </div>
                           <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                             <ul>

                              <li>
                                <div class="ratingreview">
                                  <div class="pull-left d-flex"><span class="float-left">5 <i class="fa fa-star fa-1x"></i></span>
                                      <div class="progress ml-2">
                                          @foreach ($listReviewByStar as $item)
                                          @if ($item->star == 5)
                                          <span class="progress-bar bg-success progress-bar-success" role="progressbar" aria-valuenow="42" aria-valuemin="0" style="width: {{ number_format((($item->where('tour_id',$detail->id)->where('star', 5)->count())/$count)*100) }}%"></span>
                                      </div>
                                           <div class="float-right ml-2">{{ $item->where('tour_id',$detail->id)->where('star', 5)->count() }} nhận xét</div>
                                            @endif
                                            @endforeach
                                  </div>
                                </div>
                              </li>

                              <li>
                                <div class="ratingreview">
                                  <div class="pull-left d-flex"><span class="float-left">4 <i class="fa fa-star fa-1x"></i></span>
                                      <div class="progress ml-2">
                                          @foreach ($listReviewByStar as $item)
                                          @if ($item->star == 4)
                                          <span class="progress-bar bg-success progress-bar-success" role="progressbar" aria-valuenow="42" aria-valuemin="0" style="width: {{ number_format((($item->where('tour_id',$detail->id)->where('star', 4)->count())/$count)*100) }}%"></span>
                                      </div>
                                           <div class="float-right ml-2">{{ $item->where('tour_id',$detail->id)->where('star', 4)->count() }} nhận xét</div>
                                            @endif
                                            @endforeach
                                  </div>
                                </div>
                              </li>

                              <li>
                                <div class="ratingreview">
                                  <div class="pull-left d-flex"><span class="float-left">3 <i class="fa fa-star fa-1x"></i></span>
                                      <div class="progress ml-2">
                                          @foreach ($listReviewByStar as $item)
                                          @if ($item->star == 3)
                                          <span class="progress-bar bg-success progress-bar-success" role="progressbar" aria-valuenow="42" aria-valuemin="0" style="width: {{ number_format((($item->where('tour_id',$detail->id)->where('star', 3)->count())/$count)*100) }}%"></span>
                                      </div>
                                           <div class="float-right ml-2">{{ $item->where('tour_id',$detail->id)->where('star', 3)->count() }} nhận xét</div>
                                            @endif
                                            @endforeach
                                  </div>
                                </div>
                              </li>
                              <li>
                                <div class="ratingreview">
                                  <div class="pull-left d-flex"><span class="float-left">2 <i class="fa fa-star fa-1x"></i></span>
                                      <div class="progress ml-2">
                                          @foreach ($listReviewByStar as $item)
                                          @if ($item->star == 2)
                                          <span class="progress-bar bg-success progress-bar-success" role="progressbar" aria-valuenow="42" aria-valuemin="0" style="width: {{ number_format((($item->where('tour_id',$detail->id)->where('star', 2)->count())/$count)*100) }}%"></span>
                                      </div>
                                           <div class="float-right ml-2">{{ $item->where('tour_id',$detail->id)->where('star', 2)->count() }} nhận xét</div>
                                            @endif
                                            @endforeach
                                  </div>
                                </div>
                              </li>

                              <li>
                                <div class="ratingreview">
                                  <div class="pull-left d-flex"><span class="float-left">1 <i class="fa fa-star fa-1x"></i></span>
                                      <div class="progress ml-2">
                                          @foreach ($listReviewByStar as $item)
                                          @if ($item->star == 1)
                                          <span class="progress-bar bg-success progress-bar-success" role="progressbar" aria-valuenow="42" aria-valuemin="0" style="width: {{ number_format((($item->where('tour_id',$detail->id)->where('star', 1)->count())/$count)*100) }}%"></span>
                                      </div>
                                           <div class="float-right ml-2">{{ $item->where('tour_id',$detail->id)->where('star', 1)->count() }} nhận xét</div>
                                            @endif
                                            @endforeach
                                  </div>
                                </div>
                              </li>

                             </ul>

                           </div>
                         </div>
                         <hr>
                         <div class="form-review">
                           <img src="{{ asset('client/image/Vector (3).png') }}">
                           <div class="form">
                                 <form method="POST" enctype="multipart/form-data" action="{{ route('client.review.store', ['duration' => $duration, 'slug' => $slug]) }}">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  @csrf
                                  <input type="hidden" name="tabId" value="tab2">
                                   <textarea name="content" id="content_rating" placeholder="Type anything"></textarea>
                                   <div class="container">
                                     <div class="row">
                                       <div class="starrating risingstar d-flex justify-content-end flex-row-reverse col-xl-6 col-lg-6 col-md-12-col-sm-12">
                                         <input type="radio" id="star5" name="star" value="5" /><label for="star5" title="5 star"></label>
                                         <input type="radio" id="star4" name="star" value="4" /><label for="star4" title="4 star"></label>
                                         <input type="radio" id="star3" name="star" value="3" /><label for="star3" title="3 star"></label>
                                         <input type="radio" id="star2" name="star" value="2" /><label for="star2" title="2 star"></label>
                                         <input type="radio" id="star1" name="star" value="1" /><label for="star1" title="1 star"></label>
                                     </div>

                                   <div class="button-upload col-xl-6 col-lg-6 col-md-12-col-sm-12">
                                     <input class="upload" type="submit" value="Đánh giá">
                                   </div>
                                    @error('star')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                   </div>
                                 </div>
                                 </form>
                           </div>
                         </div>
                         <hr>
                         @foreach ($review as $item)

                              <div class="review-user">
                              <img src="{{ asset('client/image/Ellipse 28.png') }}">
                              <div class="star">
                                @for ($i = 0; $i < $item->star; $i++)
                                    <i class="fa fa-star active" aria-hidden="true"></i>
                                @endfor
                                @for ($i = 0; $i < (5-($item->star)); $i++)
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                @endfor
                            </div>
                            <h6>
                              @if ($item->star == 1)
                                  Bad
                              @elseif ($item->star == 2)
                                  medium
                              @elseif ($item->star == 3)
                                  Good
                              @elseif ($item->star == 4)
                                  Excellent
                              @else
                                  The best experience ever!
                              @endif
                            </h6>
                            <div><span>{{ $item->assessor }}</span><span class="dot">&bull;</span><span>{{ date(' m/Y', strtotime($item->updated_at)) }}</span></div>
                              <p>{{ $item->content }}</p>
                            </div>
                            <hr>
                         @endforeach


                         <div class="row">
                           <div class="paginate col-12">
                             {{ $review->render() }}
                           </div>
                         </div>
                     </div>
               </div>
             </div>
                     <div class="col-xl-5">
                       <div class="cost">
                         <form id="booking-now" method="POST" onsubmit="return addCart();" action="{{ route('booking.now') }}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          @csrf
                           <input type="hidden" name="tour_id" value="{{ $detail->id }}">
                           <div class="tour-name">{{ $detail->title }}</div>
                           <hr>
                             <div class="row">
                                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                   <input type="hidden" value="{{ $detail->duration }}" id="duration">
                                     <div class="duration">
                                         <Label>Khoảng thời gian:</Label><br>
                                         @if ($detail->duration > 2 )
                                         <h6>{{ $detail->duration }} ngày - {{ number_format(($detail->duration)-1) }} đêm</h6>
                                         @elseif ($detail->duration == 2)
                                         <h6>2 ngày - 1 đêm</h6>
                                         @else
                                         <h6>Trong ngày</h6>
                                         @endif

                                     </div>
                                 </div>
                                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                     <div class="type">
                                         <Label>Loại tour:</Label><br>
                                         <h6>{{ $type->title }}</h6>
                                     </div>
                                 </div>
                             </div>
                             <input id="datepicker" onchange="myFunction();" class="icon-time" type="text" name="start_at" value="vui lòng chọn ngày">
                             <input class="icon-quantity" type="text" id="quantity" name="quantity" placeholder="Số người">
                             <input type="hidden" id="price" value="{{ $detail->price }}">
                             <div class="total-price mt-5">
                               <span class="float-left">Tổng tiền</span><span class="price" id="total"><strong>{{ $detail->price }} VND</strong></span>
                           </div>
                           <input type="submit" class="apply" value="Đặt vé">
                          </form>

                           <script >
                            function addCart() {
                              var quantity = document.getElementById('quantity').value;
                              var start_at = document.getElementById('datepicker').value;
                              var start = start_at.slice(0, 10);
                              var date = new Date(start);
                              var today = new Date();
                              if (date <= today) {
                                  if (quantity.length == 0) {
                                    swal("Notification", "Must be greater than current date & Can't be left blank!!!");
                                  } else {
                                    swal("Notification", "Must be greater than current date!");
                                  }
                              } else {
                                if (quantity.length == 0) {
                                    swal("Notification", "Can't be left blank!!!");
                                } else {
                                  $('#booking-now').submit();
                                }
                              }
                            }
                          </script>
                          <script>
                            function myFunction() {
                                var start = document.getElementById('datepicker').value;
                                var duration = document.getElementById('duration').value;
                                var days = Number(duration);
                                var date = new Date(start);
                                var finish = new Date(new Date(date).setDate(new Date(date).getDate() + (days-1)));
                                var finish_at = (finish.getMonth()+1) + '/' + finish.getDate() + '/' + finish.getFullYear();
                                document.getElementById('datepicker').value = start + ' - ' + finish_at;
                            }
                          </script>
                       </div>
                     </div>
             </div>
  @endif
<div class="related-tour row">
  <div class="title col-12">Các chuyến tham quan liên quan</div>
      @foreach ($related as $item)
          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
            <div class="item">
              <div>
                  <img class="image" src="{{ asset('upload/tour/'.$item->photo) }}" alt="image tour" />
                  <img class="tick" src="{{ asset('client/image/shape (2).png') }}" alt="icon tick">
                  <div class="star"><img src="{{ asset('client/image/Star 1.png') }}"> 4.5</div>
              </div>
              <div class="information">
                  <div class="location"><img src="{{ asset('client/image/shape.png') }}">{{ $item->destinations->title}}</div>
                  <h3 class="name"><a href="{{ url('tour/'.$item->duration.'-'.$item->slug) }}" alt="list-tour page">{{ $item->title}}</a></h3>
                  @if ($item->duration > 2 )
                  <div class="time"><span><img src="{{ asset('client/image/time.png') }}" alt="icon-time"> {{ $item->duration }} ngày -  {{ number_format(($item->duration)-1) }} đêm</span> <span class="price">từ <strong>{{ $item->price }} VND</strong></span></div>
                  @elseif ($item->duration == 2)
                  <div class="time"><span><img src="{{ asset('client/image/time.png') }}" alt="icon-time"> 2 ngày - 1 đêm </span> <span class="price">từ <strong>{{ $item->price }} VND</strong></span></div>
                  @else
                  <div class="time"><span><img src="{{ asset('client/image/time.png') }}" alt="icon-time"> Trong ngày </span> <span class="price">từ <strong>{{ $item->price }} VND</strong></span></div>
                  @endif
                </div>
          </div>
          </div>
      @endforeach
  </div>
</div>


</div>
<!-- /content -->
     <!-- footer -->
     <div class="footer">
      <div class="container-fluid">
          <div class="row">
              <div class="logo col-xl-5 col-lg-2 col-md-4 col-sm-12">
                <img src="{{ asset('client/image/Group 349.png') }}">
                <div class="pt-5"><img src="{{ asset('client/image/facebook.png') }}"> <img src="{{ asset('client/image/Group 292 (1).png') }}"> <img src="{{ asset('client/image/brandico_twitter-bird (1).png') }}"></div>
              </div>
              <div class="menu col-xl-2 col-lg-4 col-md-3 col-sm-12">
                <ul>
                    <li><a  href="#" title="#">Trang chủ</a></li>
                    <li><a href="#" title="#">Giới thiệu</a></li>
                    <li><a href="#" title="#">Chuyến du lịch</a></li>
                    <li><a href="#" title="#">Phản hồi</a></li>
                </ul>
              </div>
              <div class="privacy col-xl-3 col-lg-4 col-md-5 col-sm-12">
                <ul>
                    <li><a href="#">ĐỐI TÁC VỚI CHÚNG TÔI</a></li>
                    <li><a href="#">ĐIỀU KHOẢN VÀ ĐIỀU KIỆN</a></li>
                    <li><a href="#">CHÍNH SÁCH BẢO MẬT</a></li>
                    <li><a href="#">CHÍNH SÁCH KHÁCH</a></li>
                </ul>
              </div>
              <div class="infor col-xl-2 col-lg-4 col-md-12 col-sm-12">
                <ul>
                    <li class="location"><img src="{{ asset('client/image/location-1.png') }}">58 ToHuu, Hanoi, VietNam</li>
                    <li class="phone"><img src="{{ asset('client/image/mail.png') }}"> (+84) 91 132 6368</li>
                </ul>
              </div>
          </div>
      </div>
      <div class="copyright">Bản quyền © We.travel. Đã đăng ký Bản quyền</div>
 </div>
<!-- /footer  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('client/owl-carousel/owl.carousel.js') }}" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script>
  $(document).ready(function(){
    $("#quantity").keyup(function(){
      var quantity = document.getElementById('quantity').value;
      var price = document.getElementById('price').value
      $("#total").html("<strong>" + price*quantity + " VND</strong>");
    });
  });
  </script>
<script>
   $(document).ready(function(){
          $(".header-responsive-title").click(function(){
              $(".header-responsive ul").slideToggle();
          });
      });

  $( function() {
    $( "#datepicker" ).datepicker();
  });

    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
    showSlides(slideIndex += n);
    }

    function currentSlide(n) {
    showSlides(slideIndex = n);
    }

    function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    var captionText = document.getElementById("caption");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
        }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    // captionText.innerHTML = dots[slideIndex-1].alt;
    }
</script>
<style>
  .content > .container-fluid > .tour .tab-content ul li {
    font-family: DM;
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 30px;
    color: #4F4F4F;
    margin-right: 15px;
}
.page-link {
    position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #dee2e6;
}

.pagination .active .page-link{background-color: black;}
.pagination li > span{padding: 13px 18px;}
.pagination a{
    font-family: Apercu Pro;
font-style: normal;
font-weight: bold;
font-size: 16px;
line-height: 120%;
color: #4F4F52;
padding: 13px 18px;
}
.pagination .page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #000000;
    border-color: #000000;
}
.swal-button-container button{background: rgb(17, 134, 17)};
</style>


</body>
</html
