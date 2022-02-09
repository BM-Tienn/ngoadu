<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>NgaoduVietnam</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('client/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/owl-carousel/owl.theme.default.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('client/css/index.css') }}">

</head>
<body>
    <!-- header -->
        <div class="header">
            <div class="container-fluid">
                <div class="feature row">
                    <div class="logo col-xl-4 col-lg-2 col-md-2 col-sm-4 ">
                        <a href="{{ url('list-tour') }}" title="Home page"><img src="{{ asset('client/image/Group 349.png') }}" alt="logo of website"></a>
                    </div>
                    <div class="menu col-xl-8 col-lg-10 col-md-10 col-sm-8 d-flex justify-content-end">
                        <ul class="mr-3">
                            <li><a class="active" href="{{ url('home') }}" title="Home page">Trang chủ</a></li>
                            <li><a href="#" title="About page">Giới thiệu</a></li>
                            <li><a href="{{ url('list-tour') }}" title="List tour page">Chuyến du lịch</a></li>
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
                    <div class="header-responsive-title">
                        <i class="fa fa-bars fa-2x"></i>
                    </div>
                    <ul>
                        <li><a class="active" href="{{ url('home') }}" title="Home page">Trang chủ</a></li>
                        <li><a href="#" title="About page">Giới thiệu</a></li>
                        <li><a href="{{ url('list-tour') }}" title="List tour page">Chuyến du lịch</a></li>
                        <!-- <li><a href="#" title="Hotel page">Hotels</a></li> -->
                        <li><a href="{{ url('contact') }}" title="Contact page">Phản hồi</a></li>
                        <!-- <li><a href="#" title="Login page">Login</a></li> -->
                    </ul>
                </div>
                <div class="content row">
                    <div class="welcome col-xl-7 col-lg-12 col-md-12 col-sm-12">
                        <h6>Chào mừng đến với NgaoduVietnam</h6>
                        <p>Nơi hoàn hảo cho những câu chuyện của bạn</p>
                    </div>
                    <div class="fill-information col-xl-5 col-lg-12 col-md-12 col-sm-12">
                        <form method="post" action="{{ route('homepage.search') }}">
                            @method('GET')
                        <div class="box">
                            <h5>Khám phá Việt Nam tươi đẹp</h5>
                            <input type="text" class="icon-search" id="tour" name="name-tour" placeholder="Tên chuyến du lịch">
                            <input type="text" class="icon-address" id="destination" name="destination-tour" placeholder="Quatlam Beach, Giaothuy, Namdinh">
                            <div class="d-flex" style="background: white; height:64px">
                                <img src="{{ asset('client/image/type.png') }}" width="17px" height="17px" class="mt-4 ml-3 mr-3">

                            <select name="type_tour" class="js-example-basic-single mb-3 w-100" id="type">
                                    <option  value="all" selected>Loại hình tham quan</option>
                                @foreach ($type as $item)
                                    <option  value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            </div>
                            <input type="text" class="icon-time mt-3" id="datepicker" name="time-tour" placeholder="Thời gian chuyến đi">
                            <input class="submit" type="submit" value="Tìm kiếm">
                        </div>
                        </form>
                        <div class="parameter-responsive">
                            <div class="active">
                                <span class="dot">&bull;</span><span class="text-feature" >Nổi bật</span>
                            </div>
                            <ul>
                                <li><strong>{{ $countTour }}+</strong> chuyến tham quan</li>
                                <li><strong>{{ $countDestination }}+</strong> điểm đến</li>
                                <li><strong>{{ $countType }}+</strong> loại hình tham quan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="parameter">
                    <div class="active">
                            <span class="dot" style="margin-left:10px">&bull;</span><span class="text-feature" >Nổi bật</span>
                    </div>
                    <ul>
                        <li><strong>{{ $countTour }}+</strong> chuyến tham quan</li>
                        <li><strong>{{ $countDestination }}+</strong> điểm đến</li>
                        <li><strong>{{ $countType }}+</strong> loại hình tham quan</li>
                    </ul>
            </div>
        </div>
    <!-- /header -->
    <!-- content -->
    <div class="content">
        <div class="introduce">
            <div class="container-fluid">
                <div class="row">
                    <div class="image-introduce col-xl-6 col-lg-12 col-md-12 col-sm-12">
                        <img class="image1" src="{{ asset('client/image/Rectangle 18.png') }}" alt="desert image">
                        <img class="image2" src="{{ asset('client/image/Rectangle 19.png') }}" alt="mountain image">
                    </div>

                    <div class="text-introduce col-xl-6 col-lg-12 col-md-12 col-sm-12">
                        <p class="title">Cùng <strong>NgaoduVietnam</strong>, đắm chìm trong không gian hùng vĩ và những nét văn hóa đặc sắc</p>
                        <div class="main">
                            <div class="stated"><img src="{{ asset('client/image/quote.png') }}" alt="stated"></div>
                            <p class="description pl-2 pr-2"><b>Di Tích :</b> Tính đến năm 2020, Việt Nam có hơn 41.000 di tích,
                                thắng cảnh trong đó có hơn 4.000 di tích được xếp hạng di tích quốc gia và hơn 9.000 di tích được xếp hạng cấp tỉnh.
                                Mật độ và số lượng di tích nhiều nhất ở 11 tỉnh vùng đồng bằng sông Hồng với tỷ lệ chiếm khoảng 56% di tích của Việt Nam.
                                <br><b>Danh thắng :</b> Hiện nay Việt Nam có 33 vườn quốc gia gồm Ba Bể, Bái Tử Long, Hoàng Liên,
                                Tam Đảo, Xuân Sơn, Ba Vì, Cát Bà, Cúc Phương, Xuân Thủy, Bạch Mã, Bến En, Phong Nha-Kẻ Bàng,
                                Pù Mát, Vũ Quang, Bidoup Núi Bà, Chư Mom Ray, Chư Yang Sin, Kon Ka Kinh, Yok Đôn, Côn Đảo, Lò Gò-Xa Mát,
                                Mũi Cà Mau, Núi Chúa, Phú Quốc, Phước Bình, Tràm Chim, U Minh Hạ, U Minh Thượng, Tà Đùng.
                                <br><b>Văn hóa :</b> Việt Nam có 54 dân tộc anh em, mỗi dân tộc đều có những nét đặc trưng về văn hoá, phong tục tập quán và lối sống riêng.
                                Ngành du lịch và các địa phương đã nỗ lực xây dựng được một số điểm du lịch độc đáo, như du lịch cộng đồng Sa Pa,
                                du lịch Bản Lát ở Mai Châu…
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="discover">
            <div class="container-fluid">
                <div class="row">
                    <div class="title_name col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <h1 class="m-0 p-0">Khám phá những điểm đến hấp dẫn</h1>
                    </div>
                    <div class="button col-xl-8 col-lg-6 col-md-6 col-sm-12 align-self-end justify-content-end p-0">
                    <a href="{{ url('list-tour') }}" title="#" class="view-all">Xem tất cả</a>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <div class="carousel-wrap">
                    <div id="owl-carousel1" class="owl-carousel owl-theme">
                        @foreach ($destination as $rows)
                            <div class="item">
                            <img src="{{ asset('upload/destination/'. $rows->image) }}" />
                            <div class="information">
                                <h6 class="location"><a href="{{ url('list-tour/'.$rows->slug) }}">{{ $rows->title }}</a></h6>

                                <h6 class="experiences">{{ $rows->tours->count() }} chuyến đi</h6>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="attractive">
            <div class="container-fluid">
                <div class="row">
                    <div class="title_name col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <h1 class="m-0 p-0">Chuyến du lịch hấp dẫn và những trải nghiệm thú vị</h1>
                    </div>
                    <div class="button col-xl-8 col-lg-6 col-md-6 col-sm-12 align-self-end justify-content-end p-0">
                        <a href="{{ url('list-tour') }}" title="list-tour page" class="view-all">Xem tất cả</a>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <div class="carousel-wrap">
                    <div id="owl-carousel2" class="owl-carousel owl-theme">
                        @foreach ($attractiveTour as $key => $attractive)
                        <div class="item">
                                 <div>
                                <img class="image" src="{{ asset('upload/tour/'. $attractive->photo) }}" alt="{{ $attractive->title }}" />
                                <img class="tick" src="{{ asset('client/image/shape (2).png') }}" alt="icon tick">
                                <div class="star"><img src="{{ asset('client/image/Star 1.png') }}"> 4.5</div>
                            </div>
                            <div class="information">
                                <div class="location"><img src="{{ asset('client/image/shape.png') }}">{{ $attractive->destinations->title }}</div>
                                <h3 class="name"><a href="{{ url('tour/'.$attractive->duration.'-'.$attractive->slug) }}" alt="list-tour page">{{ $attractive->title }}</a></h3>
                                @if ($attractive->duration > 2 )
                                <div class="time"><span><img src="{{ asset('client/image/time.png') }}" alt="icon-time"> {{ $attractive->duration }} ngày -  {{ number_format(($attractive->duration)-1) }} đêm</span> <span class="price">từ <strong>{{ $attractive->price }}VND</strong></span></div>
                                @elseif ($attractive->duration == 2)
                                 <div class="time"><span><img src="{{ asset('client/image/time.png') }}" alt="icon-time"> 2 ngày - 1 đêm </span> <span class="price">from <strong>${{ $attractive->price }}</strong></span></div>
                                @else
                                <div class="time"><span><img src="{{ asset('client/image/time.png') }}" alt="icon-time"> Trong ngày </span> <span class="price">from <strong>${{ $attractive->price }}</strong></span></div>
                                 @endif
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="attractive">
            <div class="container-fluid">
                <div class="row">
                    <div class="title_name col-xl-6 col-lg-6 col-md-8 col-sm-12">
                        <h1 class="m-0 p-0">Trải nghiệm những nét đẹp văn hóa truyền thống của Việt Nam</h1>
                    </div>
                    <div class="button col-xl-6 col-lg-6 col-md-4 col-sm-12 align-self-end justify-content-end p-0">
                        <a href="{{ url('list-tour') }}"><div class="view-all">Xem tất cả</div></a>
                    </div>
                </div>
            </div>
            <div class="main-content" >
                <div class="carousel-wrap">
                    <div id="owl-carousel3" class="owl-carousel owl-theme">
                        @foreach ($newTour as $newTour)
                            <div class="item">
                            <div>
                                <img class="image" src="{{ asset('upload/tour/'. $newTour->photo) }}" alt="{{ $newTour->title}}" />
                                <img class="tick" src="{{ asset('client/image/shape (2).png') }}" alt="icon tick">
                                <div class="star"><img src="{{ asset('client/image/Star 1.png') }}"> 4.5</div>
                            </div>
                            <div class="information">
                                <div class="location"><img src="{{ asset('client/image/shape.png') }}">{{ $newTour->destinations->title}}</div>
                                <h3 class="name"><a href="{{ url('tour/'.$newTour->duration.'-'.$newTour->slug) }}" alt="list-tour page">{{ $newTour->title}}</a></h3>
                                @if ($newTour->duration > 2 )
                                <div class="time"><span><img src="{{ asset('client/image/time.png') }}" alt="icon-time"> {{ $newTour->duration }} ngày -  {{ number_format(($newTour->duration)-1) }} đêm</span> <span class="price">từ <strong>{{ $newTour->price }} VND</strong></span></div>
                                @elseif ($newTour->duration == 2)
                                 <div class="time"><span><img src="{{ asset('client/image/time.png') }}" alt="icon-time"> 2 days - 1 night </span> <span class="price">from <strong>${{ $newTour->price }}</strong></span></div>
                                @else
                                <div class="time"><span><img src="{{ asset('client/image/time.png') }}" alt="icon-time"> During the day </span> <span class="price">from <strong>${{ $newTour->price }}</strong></span></div>
                                 @endif
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="support container-fluid" style="padding-left: 10%; padding-right:10%">
            <div class="row">
                <div class="message col-xl-6 col-lg-6 col-md-5 col-sm-12">
                        <p>Để lại email cho chúng tôi, để nhận<strong> những ưu đãi mới nhất</strong></p>
                </div>
                <div class="form col-xl-6 col-lg-6 col-md-7 col-sm-12 d-flex justify-content-end" style="padding-right:33px">
                    <form action="#">
                        <input id="email" type="text" class="icon-message" name="email" placeholder="example@gmail.com">
                        <input class="send" type="submit" value="Gửi">
                    </form>
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
                  <div class="menu col-xl-2 col-lg-3 col-md-3 col-sm-12">
                    <ul>
                        <li><a  href="#" title="#">Trang chủ</a></li>
                        <li><a href="#" title="#">Giới thiệu</a></li>
                        <li><a href="#" title="#">Chuyến du lịch</a></li>
                        <!-- <li><a href="#" title="#"></a></li> -->
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
                        <li class="location"><img src="{{ asset('client/image/location-1.png') }}"> Ecolife Capitol, 58 ToHuu, Hanoi, VietNam</li>
                        <li class="phone"><img src="{{ asset('client/image/mail.png') }}"> (+84) 91 132 6368</li>
                    </ul>
                  </div>
              </div>
          </div>
             <div class="copyright">Bản quyền © We.travel. Đã đăng ký Bản quyền</div>

     </div>
    <!-- /footer  -->

    <!-- javascript -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('client/owl-carousel/owl.carousel.js') }}" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

    <script>
        $('#type').select2();
        $(function() {
            $( "#datepicker").datepicker();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".header-responsive-title").click(function(){
                $(".header-responsive ul").slideToggle();
            });

        });

        $('#owl-carousel1').owlCarousel({
                loop:true,
                responsiveClass:true,
                margin: 10,
                navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
                responsive: {
                    200: {
                        items: 1,
                        nav: false,
                    },

                    600: {
                        items: 2,
                        nav: false,
                    },
                    1000: {
                        items: 3,
                        nav:true,
                        loop:false
                    },
                    1200: {
                        items: 4,
                        nav:true,
                        loop:false
                    }

                }
            });
            $('#owl-carousel2').owlCarousel({
                    loop:true,
                    responsiveClass:true,
                    margin: 10,
                    navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
                    responsive: {
                        200: {
                        items: 1,
                        nav: false,
                    },

                        600: {
                            items: 2,
                            nav: false,
                        },
                        1000: {
                            items: 3,
                            nav:true,
                            loop:false
                        },
                        1200: {
                            items: 3,
                            nav:true,
                            loop:false
                        }
                    }
                });

                $('#owl-carousel3').owlCarousel({
                    loop:true,
                    responsiveClass:true,
                    margin: 10,
                    navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
                    responsive: {
                        200: {
                        items: 1,
                        nav: false,
                    },
                        600: {
                            items: 2,
                            nav: false,
                        },
                        1000: {
                            items: 3,
                            nav:true,
                            loop:false
                        },
                        1200: {
                            items: 3,
                            nav:true,
                            loop:false
                        }
                    }
                });
    </script>
</body>
<style>
    .select2-selection.select2-selection--single{border: none; padding-top: 15px;border-radius: 0px;}
    /* .select2-selection__arrow b{padding-top:18px} */
    /* select2 select2-container select2-container--default select2-container--below select2-container--focus */
    .select2-selection__arrow{margin-top:15px}
</style>
</html>
