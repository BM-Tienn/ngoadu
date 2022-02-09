<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>Booking</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('client/css/checkout.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
</head>
<body>

    @if(Session::has("booking") != null)
    <!-- content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="title">
                    <h1>Đăng ký đặt chỗ</h1>
                </div>
            </div>
            <div class="row">
                <div class="import-information col-xl-7 col-lg-7 col-md-12 col-sm-12">

                    <form method="POST" onsubmit="return validateBooking();" action="{{ route('booking.complete') }}"  >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @csrf
                    <hr>
                    <h2>Thông tin chi tiết về khách du lịch</h2>
                    <h6>Thông tin chúng tôi cần để xác nhận chuyến tham quan hoặc hoạt động của bạn</h6>
                    <h3>Khách du lịch chính (Người lớn)</h3>
                   <div class="mt-3" id="error_message"></div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="firstname">
                                <Label>Họ, đệm*</Label><br>
                                <input type="text" id="first_name" class="form-control w-100 @error('first_name') is-invalid @enderror" name="first_name" placeholder="First Name">
                                    @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="lastname">
                                <Label>Tên *</Label><br>
                                <input type="text" id="last_name" class="form-control w-100 @error('last_name') is-invalid @enderror" name="last_name" placeholder="Last Name">
                                    @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="email">
                                <Label>Email *</Label><br>
                                <input type="email" id="email" class="form-control w-100 @error('email') is-invalid @enderror" name="email" placeholder="example@gmail.com">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="phone">
                                <Label>Số điện thoại *</Label><br>
                                <input type="text" id="phone" class="form-control w-100 @error('phone') is-invalid @enderror" name="phone" placeholder="Phone Number">
                                    @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>

                    </div>


                    <h3>Địa chỉ nhà</h3>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="address">
                                <Label>Địa chỉ của bạn</Label><br>
                                <input type="text" id="address" class="form-control w-100 @error('address') is-invalid @enderror" name="address" placeholder="Địa chỉ của bạn">
                                    @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="city">
                                <Label>Thành phố</Label><br>
                                <input type="text" id="city" class="form-control w-100 @error('city') is-invalid @enderror" name="city" placeholder="Thành phố của bạn">
                                    @error('city')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="provide">
                                <Label>Bang / Tỉnh / Vùng</Label><br>
                                <input type="text" id="provide" class="form-control w-100 @error('provide') is-invalid @enderror" name="provide" placeholder="Bang / Tỉnh / Vùng">
                                    @error('provide')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="code">
                                <Label>Mã Zip / Mã Bưu điện</Label><br>
                                <input type="text" id="code" class="form-control w-100 @error('code') is-invalid @enderror" name="code" placeholder="Mã Zip / Mã Bưu điện">
                                    @error('code')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="country">
                                <Label>Quốc gia</Label><br>
                                <input type="text" id="country" class="form-control w-100 @error('country') is-invalid @enderror" name="country" placeholder="Quốc gia">
                                    @error('country')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="requirement">
                                <Label>Yêu cầu đặc biệt</Label><br>
                                <textarea name="note" id="note" class="form-control w-100 @error('note') is-invalid @enderror" placeholder="Yêu cầu đặc biệt"></textarea>
                                    @error('note')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>

                    </div>
                    <hr>
                    <h3>Menthod thanh toán</h3>
                    <h6>Thanh toán an toàn — chúng tôi sử dụng mã hóa SSL để giữ an toàn cho dữ liệu của bạn</h6>
                    <div class="checked mt-5">
                    <input type="checkbox" id="credit" name="vehicle1" value="credit">
                    <label for="credit"> Credit Card</label><img class="ml-2" src="{{ asset('client/image/image 16.png') }}"><br>
                    <input type="checkbox" id="paypal" name="vehicle2" value="paypal">
                    <label for="paypal"> Paypal</label><img class="ml-5" src="{{ asset('client/image/image 17.png') }}"><br>
                    <input type="checkbox" id="cash" name="vehicle3" value="cash">
                    <label for="cash">Thanh toán tiền mặt</label><br>
                    </div>
                    <div class="privacy">
                        <ul>
                            <li>Bạn sẽ bị tính tổng số tiền sau khi đơn đặt hàng của bạn được xác nhận</li>
                            <li>Nếu xác nhận không được nhận ngay lập tức, ủy quyền cho tổng số tiền sẽ được giữ cho đến khi đặt phòng của bạn được xác nhận</li>
                            <li>Bạn có thể hủy miễn phí tối đa 24 giờ trước ngày trải nghiệm, theo giờ địa phương. Bằng cách nhấp vào 'Thanh toán bằng PayPal', bạn xác nhận rằng bạn đã đọc và bị ràng buộc bởi Ojimah's </li>
                            <li>Điều khoản sử dụng khách hàng, Chính sách quyền riêng tư, cùng với các quy tắc & quy định của nhà điều hành tour du lịch (xem danh sách để biết thêm chi tiết).</li>
                        </ul>

                    </div>
                    <input class="complete" type="submit" value="Complete Booking">
                </form>
                </div>

                @foreach(Session::get("booking") as $booking)
                                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                                <div class="cost">
                                    <form id="booking-now" method="POST" onsubmit="return addCart();" action="{{ route('booking.change') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @csrf
                                    <input type="hidden" name="tour_id" value="{{ $booking['id'] }}">
                                    <input type="hidden" value="{{ $booking['price'] }}" id="price">
                                    <div class="tour-name">{{ $booking['title'] }}</div>
                                    <div class="location"><img src="{{ asset('client/image/shape.png') }}">{{ $booking['destination'] }}</div>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <div class="duration">
                                                <input type="hidden" value="{{ $booking['duration'] }}" id="duration">
                                                <Label>Thời gian:</Label><br>
                                                @if ($booking['duration'] > 2 )
                                                <h6>{{ $booking['duration'] }} ngày - {{ number_format(($booking['duration'])-1) }} đêm</h6>
                                                @elseif ($booking['duration'] == 2)
                                                <h6>2 ngày - 1 đêm</h6>
                                                @else
                                                <h6>Trong ngày</h6>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <div class="type">
                                                <Label>Loại hình tham quan:</Label><br>
                                                <h6>{{ $booking['type'] }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <input id="datepicker" onchange="myFunction();" class="icon-time" type="text" name="start_at" value="{{ $booking['start_at'] }}">
                                    <input class="icon-quantity" type="text" id="quantity" name="people" value="{{ $booking['quantity'] }}">
                                    <div class="row">
                                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                                            <input type="text" name="code" placeholder="Promo Code">
                                        </div>
                                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                                            <input class="apply" onclick="changeBooking();" type="submit" value="Apply">
                                        </div>
                                    </div>
                                    </form>
                                </div>

                                <div class="total">
                                        <span class="text-total">Tổng tiền</span>
                                        <span class="total-price" id="total">{{ ($booking['price']) * ($booking['quantity'])  }} VND</span>
                                </div>
                            </div>
                @endforeach


                <script>
                    $( function() {
                      $( "#datepicker" ).datepicker();
                    });
                </script>
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
                        $(document).ready(function () {
                            var start = document.getElementById('datepicker').value;
                            var duration = document.getElementById('duration').value;
                            var days = Number(duration);
                            var date = new Date(start);
                            var finish = new Date(new Date(date).setDate(new Date(date).getDate() + (days-1)));
                            var finish_at = (finish.getMonth()+1) + '/' + finish.getDate() + '/' + finish.getFullYear();
                            document.getElementById('datepicker').value = start + ' - ' + finish_at;
                        });

                        $("#quantity").keyup(function(){
                            var quantity = document.getElementById('quantity').value;
                            var price = document.getElementById('price').value
                            $("#total").html("<strong> $ " + price*quantity + ".00</strong>");
                        });

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
    <!-- /content -->

    @else
        <img src="{{ asset('client/404.png') }}" width="100%">
    @endif
    <script src="{{ asset('client/js/validate.js') }}"></script>
</body>
</html>
