<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>Contact</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('client/css/contact.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

    <!-- header -->
        <div class="header">
            <div class="container-fluid">
                <div class="feature row">
                    <div class="logo col-xl-4 col-lg-2 col-md-2 col-sm-4">
                        <a href="{{ url('home') }}" title="Home page"><img src="{{ asset('client/image/Group 349.png') }}" alt="logo of website"></a></div>

                    <div class="menu col-xl-8 col-lg-10 col-md-10 col-sm-8 d-flex justify-content-end">
                        <ul>
                            <li><a  href="{{ url('home') }}" title="Home page">Trang chủ</a></li>
                            <li><a href="#" title="About page">Giới thiệu</a></li>
                            <li><a href="{{ url('list-tour') }}" title="List tour page">Chuyến du lịch</a></li>
                            <!-- <li><a href="#" title="Hotel page">Hotels</a></li> -->
                            <li><a  class="active" href="{{ url('contact') }}" title="Contact page">Phản hồi</a></li>
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
                                    <li><a class="active" href="{{ url('home') }}" title="Home page">Trang chủ</a></li>
                                    <li><a href="#" title="About page">Giới thiệu</a></li>
                                    <li><a href="{{ url('list-tour') }}" title="List tour page">Chuyến du lịch</a></li>
                                    <!-- <li><a href="#" title="Hotel page">Hotels</a></li> -->
                                    <li><a class="active" href="{{ url('contact') }}" title="Contact page">Phản hồi</a></li>
                                    <!-- <li><a href="#" title="Login page">Login</a></li> -->
                                </ul>
                            </div>
                <div class="content row">
                    <div class="welcome col-xl-7 col-lg-12 col-md-12 col-sm-12">
                        <p>Contact us</p>
                    </div>
                </div>

            </div>



        </div>
    <!-- /header -->
        <!-- content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <ul class="breadcrumb">
                            <li><a href="#">Trang chủ</a></li>
                            <li><a href="#">Phản hồi</a></li>
                          </ul>
                      </div>
                </div>
                <div class="main row" style="margin-top: 24px; height: auto;">
                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                        <h2>Chúng tôi rất muốn nghe từ bạn</h2>
                        <h6>Gửi tin nhắn cho chúng tôi và chúng tôi sẽ trả lời sớm nhất có thể</h6>
                        <div class="mt-3" id="error_message"></div>
                        <form method="POST" action="{{ url('contact/store') }}" onsubmit="validateContact();" >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @csrf
                            <input type="text" id="name" name="name" placeholder="Tên của bạn"><br>
                            <input type="email" id="email" name="email" placeholder="Email của bạn"><br>
                            <input type="text" id="phone" name="phone" placeholder="Số điện thoại của bạn"><br>
                            <textarea name="message" id="message" placeholder="Tin nhắn"></textarea><br>
                            <div class="d-flex flex-row-reverse"><input class="send" type="submit" value="Gửi"></div>

                        </form>

                    </div>
                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12" style="padding-left: 3%;">
                        <img src="{{ asset('client/image/Rectangle 18.png') }}" width="85%" height="524px">
                        <div class="out-office">
                            <h3>Our Office</h3>
                            <ul>
                                <li><img src="{{ asset('client/image/Group 54.png') }}" style="padding-bottom: 20px;">
                                <h6>Address</h6>
                                <p>27 Old Gloucester Street, London, WC1N 3AX</p>
                                </li>
                                <li><img src="{{ asset('client/image/Group 55.png') }}" style="padding-bottom: 20px;">
                                    <h6>Phone Number</h6>
                                    <p>+84 (0)20 33998400 </p></li>
                                <li><img src="{{ asset('client/image/Group 56.png') }}" style="padding-bottom: 20px;">
                                    <h6>Email Us</h6>
                                    <p>info@ngaoduvietnam.com</p></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <iframe style="margin-top: 100px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.8703469092825!2d105.79155841533183!3d20.99783369420833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab1167edbae7%3A0xa0790fee2a2a9c1b!2sAdamo%20Digital%20-%20Leading%20Vietnam%20Software%20Outsourcing%20Company!5e0!3m2!1svi!2s!4v1637059724822!5m2!1svi!2s" width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy"></iframe>        <!-- /content -->

        </div>
        <!-- /content -->
           <!-- footer -->
           <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="logo col-xl-5 col-lg-2 col-md-4 col-sm-12">
                      <img src="{{ asset('client/image/Group 349.png') }}">
                      <div style="padding-top: 50px;"><img src="{{ asset('client/image/facebook.png') }}"> <img src="{{ asset('client/image/Group 292 (1).png') }}"> <img src="{{ asset('client/image/brandico_twitter-bird (1).png') }}"></div>
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
                        <li class="location"><img src="{{ asset('client/image/location-1.png') }}">Ecolife Capitol, 58 ToHuu, Hanoi, VietNam</li>
                        <li class="phone"><img src="{{ asset('client/image/mail.png') }}"> (+84) 91 132 6368</li>
                    </ul>
                  </div>
              </div>
          </div>
             <div class="copyright">Bản quyền © We.travel. Đã đăng ký Bản quyền</div>

       </div>
      <!-- /footer  -->
{{-- script --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('client/js/validate.js') }}"></script>
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }

    $(document).ready(function(){
            $(".header-responsive-title").click(function(){
                $(".header-responsive ul").slideToggle();
            });
        });
</script>
</body>
</html>
