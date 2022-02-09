@extends("layouts.master")
@section("do-du-lieu")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="page-breadcrumb" style="margin-top: -20px; margin-left:-20px">
    <div class="row">
        <div class="col-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-3" style="background: #EEF5F9;">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" title="Dashboard">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('booking.index') }}" title="Booking Management">Booking</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Change status</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
</div>
<div class="col-md-12 mt-3">
    <div class="panel panel-primary" style="border-color: green;">
        <div class="panel-body">
            <form method="POST" action="{{ route('booking.update', ['booking' => $record->id]) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-5 mr-5" style="background: white">
                        <p class="font-weight-bold mt-3">Thông tin khách hàng</p>
                        <hr>
                        <div class="row pl-3 pt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="font-weight-bold">Họ , tên đệm</p>
                                    <h6 class="color-black">{{ isset($record->first_name) ? $record->first_name:'' }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="font-weight-bold">Tên</p>
                                    <h6 class="color-black">{{ isset($record->last_name) ? $record->last_name:'' }}</h6>
                                </div>
                            </div>
                        </div>

                        <div class="row pl-3 pt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="font-weight-bold">Email</p>
                                    <h6 class="color-black">{{ isset($record->email) ? $record->email:'' }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="font-weight-bold">Số điện thoại</p>
                                    <h6 class="color-black">{{ isset($record->phone) ? $record->phone:'' }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row pl-3 pt-3" >
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p class="font-weight-bold">Địa chỉ</p>
                                    <h6 class="color-black">{{ isset($record->address) ? $record->address:'' }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row pl-3 pt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="font-weight-bold">Thành phố</p>
                                    <h6 class="color-black">{{ isset($record->city) ? $record->city:'' }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="font-weight-bold">Mã số</p>
                                    <h6 class="color-black">{{ isset($record->provide) ? $record->provide:'' }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row pl-3 pt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="font-weight-bold">Thành phố</p>
                                    <h6 class="color-black">{{ isset($record->country) ? $record->country:'' }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="font-weight-bold">Code đặc biệt</p>
                                    <h6 class="color-black">{{ isset($record->code) ? $record->code:'' }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row pl-3 pt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p class="font-weight-bold">Yêu cầu đặc biệt</p>
                                    @if ($record->note == '')
                                        <h6 class="color-black">Don't have special requirement</h6>
                                    @else
                                        <p class="color-black">{{ isset($record->note) ? $record->note:'' }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6" style="background: white">
                        <p class="font-weight-bold mt-3">Thông tin chuyến du lịch</p>
                        <hr>
                        @if (isset($tourBooking))
                        <div class="row pl-3 pt-3" >
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p class="font-weight-bold">Tên chuyến du lịch</p>
                                    <h6 class="color-black">{{ $tourBooking->title }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row pl-3 pt-3" >
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="font-weight-bold" style="font-size:12px">Điểm đến</p>
                                    <h6 class="font-weight-normal" style="font-size:14px">{{ $tourBooking->destinations->title }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="font-weight-bold" style="font-size:12px">Loại hình tham quan</p>
                                    <h6 class="font-weight-normal" style="font-size:14px">{{ $tourBooking->types->title }}</h6>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row pl-3 pt-3" >
                            <div class="col-md-4">
                                <div class="form-group">
                                    <p class="font-weight-bold">SỐ người</p>
                                    <h6 >{{ isset($record->people) ? $record->people:'' }}</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <p class="font-weight-bold">Giá cả</p>
                                    <h6 >$ {{ isset($record->price) ? $record->price:'' }}</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <p class="font-weight-bold">Tổng tiền </p>
                                    <h6 >$ {{ $record->people * $record->price }}.00</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row pl-3 pt-3" >
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="font-weight-bold">Trạng thái</p>
                                        @if ($record->status == 1)
                                        <select name="status" class="form-control w-50">
                                            <option value="1" selected> News </option>
                                            <option value="2"> Comfirmed </option>
                                            <option value="3"> Completed </option>
                                            <option value="4"> Cancel </option>
                                        </select>
                                        @elseif ($record->status == 2)
                                        <select name="status" class="form-control w-50">
                                            <option value="2" selected> Comfirmed </option>
                                            <option value="3"> Completed </option>
                                        </select>
                                        @elseif ($record->status == 3)
                                            <h6 class="color-black">Completed</h6>
                                        @else
                                            <h6 class="color-black">Cancel</h6>
                                        @endif

                                </div>
                            </div>
                            <div class="col-md-6 pl-3">
                                <div class="form-group">
                                    <p class="font-weight-bold">Phương thức thanh toán</p>
                                    <h6 class="color-black">
                                        @if ($record->statuspayment == 1)
                                            <span>Credit Card</span>
                                        @elseif ($record->statuspayment == 2)
                                            <span>Paypal</span>
                                        @else
                                            <span>Trả bằng tiền mặt</span>
                                        @endif
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="row pl-3 pt-3" >
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="font-weight-bold">TNgày khởi hành</p>
                                    <h6 >{{ date('d/m/Y', strtotime($record->start_at)) }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="font-weight-bold">Thời gian đặt</p>
                                    <h6 class="color-black">{{ date('m/d/Y H:i:s', strtotime($record->created_at)) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5" >

                    <div class="col-md-10 text-center">
                        <div class="form-group">
                            @if ($record->status == 1 || $record->status == 2)
                                <button type="submit" class="btn btn-primary px-5">Sửa trạng thái</button>
                            @else
                                <button type="submit" class="btn btn-primary px-5 d-none">Đồng ý</button>
                            @endif

                        </div>
                    </div>
                </div>
            </form>

                <style>
                    h6{color: black; font-weight: normal}
                    .h5{color: black}
                </style>

        </div>
    </div>
</div>
@endsection
