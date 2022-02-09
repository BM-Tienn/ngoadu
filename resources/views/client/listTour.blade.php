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

   <link rel="stylesheet" href="{{ asset('client/owl-carousel/owl.carousel.min.css') }}">
   <link rel="stylesheet" href="{{ asset('client/owl-carousel/owl.theme.default.min.css') }}">

   <link rel="stylesheet" type="text/css" href="{{ asset('css/menu/custom.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('css/menu/responsive.css') }}">
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
                            <!-- <li><a href="#" title="Login page">Login</a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="header-responsive mobile">
                    <div class="logo_responsive">
                        <a href="{{ url('home')}}" title="Home page"><img src="{{ asset('client/image/Group 349.png') }}" alt="logo of website"></a>
                    </div>
                    <div class="header-responsive-title"><i class="fa fa-bars fa-2x"></i></div>
                    <ul class="menu-mobile">
                        <li><a href="{{ url('home') }}" title="Home page">Trang chủ</a></li>
                        <li><a href="#" title="About page">Giới thiệu</a></li>
                        <li><a class="active" href="{{ url('list-tour') }}" title="List tour page">Chuyến du lịch</a></li>
                        <!-- <li><a href="#" title="Hotel page">Hotels</a></li> -->
                        <li><a href="{{ url('contact') }}" title="Contact page">Phản hồi</a></li>
                        <!-- <li><a href="#" title="Login page">Login</a></li> -->
                    </ul>
                </div>
                <div class="content row content-header-mb">
                    <div class="welcome col-xl-7 col-lg-12 col-md-12 col-sm-12">
                        <h6>Tìm kiếm hàng trăm chuyến tham quan và hơn thế nữa</h6>
                        <p>Chuyến du lịch hấp dẫn</p>
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
                            <h1>Chuyến du lịch hấp dẫn và những trải nghiệm thú vị</h1>
                        </div>
                    <div class="button col-xl-6 col-lg-12 col-md-12-col-sm-12">
                        <div class="filter">Filter <i class="fa fa-times mt-1 ml-3"></i></div>
                        <ul>

                            <div class="title"><span>FILTER BY</span> <span class="clear" id="clear" onclick="clear()">CLEAR</span></div>
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
                                    <input id="rangeMin" type="range" max="100" min="0" step="1" value="0">
                                    <input id="rangeMax" type="range" max="100" min="0" step="1" value="100">
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
                            <div class="type"><h5>Type of Tours</h5>
                                @if (isset($type))
                                    @foreach ($type as $item)
                                        <input type="checkbox" id="{{ $item->id}}" name="type" value="{{ $item->id}}">
                                        <label for="{{ $item->id}}"> {{ $item->title}}</label><br>
                                    @endforeach
                                @endif
                            </div>
                            <input type="submit" id="filter" class="apply" value="Filter">


                        </ul>
                    </div>
                    </div>
                </div>

                <div class="main-content row">
                    @include('client.filterTour')
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
                <div class="menu col-xl-1 col-lg-2 col-md-3 col-sm-12">
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
                <div class="infor col-xl-3 col-lg-4 col-md-12 col-sm-12">
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

        let min = 0;
        let max = 100;
        const calcLeftPosition = value => (100 / (100-0) *  (value-0));
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
            $('#maxPrice').val(newValue * 20);
            $('#line').css({
                'left': calcLeftPosition(min) + '%',
                'right': (100 - calcLeftPosition(newValue)) + '%'
            });
        });

        $('#clear').click(function(){
            $('#filter')[0].reset();
         });
  </script>
  <script>
    $('#filter').on('click', function() {
        a();


    });

            $(document).on('click' ,'.a-paginate',function(e){
                e.preventDefault();
                a($(this).data('page'));

            })

            function a(page = 1){
                var min = $('#min').text();
                var minPrice=min.replace('$ ', '');

                var max = $('#max').text();
                var maxPrice=max.replace('$ ', '');
                var duration = [], type = [];
                $('input[name="duration"]:checked').each(function() {
                    duration.push($(this).val());
                });

                $('input[name="type"]:checked').each(function() {
                    type.push($(this).val());
                });
                $.ajax({
                url: 'list-tour',
                type: 'GET',
                data: {
                    type: type,
                    duration: duration,
                    min: minPrice,
                    max: maxPrice,
                    page : page
                },
                success: function(response){
                    console.log(response);
                    $('.main-content').html(response.view)
                }
            });
            }




</script>
</body>
</html>
