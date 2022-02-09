<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="#">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>List Tour</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('client/css/list-tour.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

   <link rel="stylesheet" href="{{ asset('client/owl-carousel/owl.carousel.min.css') }}">
   <link rel="stylesheet" href="{{ asset('client/owl-carousel/owl.theme.default.min.css') }}">

</head>
<body>
    <!-- header -->
        <div class="header">
            <div class="container-fluid">
                <div class="feature row">
                    <div class="logo col-xl-4 col-lg-2 col-md-2 col-sm-4 ">
                        <a href="{{ url('home')}}" title="Home page"><img src="{{ asset('client/image/Group 349.png') }}" alt="logo of website"></a>
                    </div>

                    <div class="menu col-xl-8 col-lg-10 col-md-10 col-sm-8 d-flex justify-content-end">
                        <ul>
                            <li><a href="{{ url('home') }}" title="Home page">Trang chủ</a></li>
                            <li><a href="#" title="About page">Giới thiệu</a></li>
                            <li><a class="active" href="{{ url('list-tour') }}" title="List tour page">Chuyến du lịch</a></li>
                            <!-- <li><a href="#" title="Hotel page">Hotels</a></li> -->
                            <li><a href="{{ url('contact') }}" title="Contact page">Phản hồi</a></li>
                        </ul>
                    </div>
                </div>
                <div class="header-responsive">
                    <div class="logo_responsive">
                        <a href="{{ url('home')}}" title="Home page"><img src="{{ asset('client/image/Group 349.png') }}" alt="logo of website"></a>
                    </div>
                    <div class="header-responsive-title"><i class="fa fa-bars fa-2x"></i></div>
                    <ul>
                        <li><a href="{{ url('home') }}" title="Home page">Trang chủ</a></li>
                        <li><a href="#" title="About page">Giới thiệu</a></li>
                        <li><a class="active" href="{{ url('list-tour') }}" title="List tour page">Chuyến du lịch</a></li>
                        <!-- <li><a href="#" title="Hotel page">Hotels</a></li> -->
                        <li><a href="{{ url('contact') }}" title="Contact page">Phản hồi</a></li>
                    </ul>

                </div>
                <div class="content row">
                    <div class="welcome col-xl-7 col-lg-12 col-md-12 col-sm-12">
                        <h6>Tìm kiếm hàng trăm chuyến tham quan và hơn thế nữa</h6>
                        <p>Tìm kiếm theo tour, điểm đến, loại tour</p>
                    </div>
                </div>

            </div>
        </div>
    <!-- /header -->

        <!-- content -->
        <div class="content">
                <div class="attractive">
                <div class="container-fluid">
                    <div class="row">
                        <div class="title_name col-xl-6 col-lg-12 col-md-12-col-sm-12">
                            <h1>Tìm kiếm theo tour, điểm đến, loại tour</h1>
                        </div>
                    <div class="button col-xl-6 col-lg-12 col-md-12-col-sm-12">
                        <div class="filter">Filter <i class="fa fa-times mt-1 ml-3"></i></div>
                        <ul>
                            <form action="#" id="filter">
                             <div class="title"><span>Lọc</span> <span class="clear" id="clear" onclick="clear()">Xóa</span></div>
                            <!-- <div class="budget"><h5>Budget :</h5>
                                <div class="display">
                                    <span id="min">$ 0</span>
                                    <span id="max">$ 2000</span>
                                  </div>
                                <div class="range-slide">
                                    <div class="slide">
                                      <div class="line" id="line"></div>
                                      <span class="thumb" id="thumbMin"></span>
                                      <span class="thumb" id="thumbMax"></span>
                                    </div>
                                    <input id="rangeMin" type="range" max="100" min="10" step="5" value="0">
                                    <input id="rangeMax" type="range" max="100" min="10" step="5" value="100">
                                  </div>
                            </div> -->
                            <hr>
                            <div class="ducation"><h5>Thời gian</h5>
                                <input type="checkbox" id="vehicle1" name="vehicle1" value="threedays">
                                <label for="vehicle1"> 0 - 3 ngày</label><br>
                                <input type="checkbox" id="vehicle2" name="vehicle2" value="fivedays">
                                <label for="vehicle2"> 3 - 5 ngày</label><br>
                                <input type="checkbox" id="vehicle3" name="vehicle3" value="severdays">
                                <label for="vehicle3"> 5 - 7 ngày</label><br>
                                <input type="checkbox" id="vehicle4" name="vehicle4" value="overoneweek">
                                <label for="vehicle4"> Lớn hơn 1 tuần </label><br><br>
                            </div>

                            <hr>
                            <div class="type"><h5>Loại hình tham quan</h5>
                                @if (isset($type))
                                    @foreach ($type as $item)
                                        <input type="checkbox" id="{{ $item->id}}" name="type" value="{{ $item->id}}">
                                        <label for="{{ $item->id}}"> {{ $item->title}}</label><br>
                                    @endforeach
                                @endif
                            </div>
                            <input type="submit" class="apply" value="Filter">
                        </form>
                        </ul>
                    </div>
                    </div>
                </div>
                <div class="main-content row">
                        @foreach ($search as $rows)
                             <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <div class="item">
                                    <div>
                                        <img class="image" src="{{ asset('upload/tour/'. $rows->photo) }}" alt="image tour" />
                                        <img class="tick" src="{{ asset('client/image/shape (2).png') }}" alt="icon tick">
                                        <div class="star"><img src="{{ asset('client/image/Star 1.png') }}"> 4.5</div>
                                    </div>
                                    <div class="information">
                                        <div class="location"><img src="{{ asset('client/image/shape.png') }}">{{ $rows->destination_name }}</div>
                                        <h3 class="name"><a href="{{ url('tour/'.$rows->duration.'-'.$rows->slug) }}" alt="list-tour page">{{ $rows->title }}</a></h3>
                                        @if ($rows->duration > 2 )
                                        <div class="time"><span><img src="{{ asset('client/image/time.png') }}" alt="icon-time"> {{ $rows->duration }} ngày -  {{ number_format(($rows->duration)-1) }} đêm</span> <span class="price">từ <strong>{{ $rows->price }} VND</strong></span></div>
                                        @elseif ($rows->duration == 2)
                                        <div class="time"><span><img src="{{ asset('client/image/time.png') }}" alt="icon-time"> 2 ngày - 1 đêm</span> <span class="price">từ <strong>{{ $rows->price }} VND</strong></span></div>
                                        @else
                                        <div class="time"><span><img src="{{ asset('client/image/time.png') }}" alt="icon-time"> Trong ngày </span> <span class="price">từ <strong>{{ $rows->price }} VND</strong></span></div>
                                        @endif
                                    </div>
                                </div>
                         </div>
                        @endforeach
                </div>
                </div>
                {{-- <ul class="pagination" style="font-weight: bold;">
                    <li>{{ $listTour->render() }}</li>
                   </ul> --}}
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-0 col-md-0 col-sm-0">&nbsp;</div>
                        <div class="showing col-xl-3 col-lg-6 col-md-12 col-sm-12 mb-5">Trang &nbsp;  1 / 2</div>
                        <div class="pagination col-xl-3 col-lg-6 col-md-12 col-sm-12">
                            <ul class="">
                                <li>{{ $search->render() }}</li>
                            </ul>
                        </div>
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
                    <div class="link-network"><img src="{{ asset('client/image/facebook.png') }}"> <img src="{{ asset('client/image/Group 292 (1).png') }}"> <img src="{{ asset('client/image/brandico_twitter-bird (1).png') }}"></div>
                </div>
                <div class="menu col-xl-2 col-lg-2 col-md-3 col-sm-12">
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
                        <li class="location"><img src="{{ asset('client/image/location-1.png') }}"> 58 ToHuu, Hanoi, VietNam</li>
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
  <script>

        $(document).ready(function(){
            $(".header-responsive-title").click(function(){
                $(".header-responsive ul").slideToggle();
            });
        });
        $( "#target" ).click(function() {
        alert( "Handler for .click() called." );
        });

      $(document).ready(function(){
            $(".filter").click(function(){
                $(".button ul").slideToggle();
            });
        });

        let min = 10;
        let max = 100;
        const calcLeftPosition = value => (100 / (100 - 10) *  (value - 10));
        $('#rangeMin').on('input', function(e) {
            const newValue = parseInt(e.target.value);
            if (newValue > max) return;
            min = newValue;
            $('#thumbMin').css('left', calcLeftPosition(newValue) + '%');
            $('#min').html('$ ' + newValue * 20);
            $('#line').css({
                'left': calcLeftPosition(newValue) + '%',
                'right': (100 - calcLeftPosition(max)) + '%'
            });
        });

        $('#rangeMax').on('input', function(e) {
            const newValue = parseInt(e.target.value);
            if (newValue < min) return;
            max = newValue;
            $('#thumbMax').css('left', calcLeftPosition(newValue) + '%');
            $('#max').html('$ ' + newValue * 20);
            $('#line').css({
                'left': calcLeftPosition(min) + '%',
                'right': (100 - calcLeftPosition(newValue)) + '%'
            });
        });

        $('#clear').click(function(){
            $('#filter')[0].reset();
         });
  </script>
</body>
</html>
