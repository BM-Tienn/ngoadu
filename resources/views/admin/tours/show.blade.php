<!-- load file layout chung -->
@extends("layouts.master")
@section("do-du-lieu")
<script type="text/javascript" src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>

<div class="page-breadcrumb" style="margin-top: -20px; margin-left:-20px">
    <div class="row" >
        <div class="col-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background: #EEF5F9">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" title="Dashboard">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tour.index') }}" title="Tour Management">CHuyến du lịch</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 mt-5">
    <div class="panel panel-primary p-3" style="margin-left:-10px; background: white">
        <div class="panel-body">
                <h5 style="color: #3e683e; font-weight:bold">Thông tin chuyến du lịch </h5>
                <hr>
                <div class="row mt-4" >
                    <div class="col-md-12">
                        <div class="form-group">
                            <p class="font-weight-bold">Tiêu đề</p>
                            <h6 class="color-black">{{ isset($record->title) ? $record->title:'' }}</h6>
                        </div>
                    </div>
                </div>

                <div class="row mt-1" >
                    <div class="col-md-12">
                        <div class="form-group">
                            <p class="font-weight-bold">Slug</p>
                            <h6 class="color-black">{{ isset($record->slug) ? $record->slug:'' }}</h6>
                        </div>
                    </div>
                </div>

                <div class="row mt-3" >
                    <div class="col-md-3">
                        <div class="form-group">
                            <p class="font-weight-bold">Điểm đến</p>
                            @if ($record->destination_id == 0)
                                <h6 >Tất cả</h6>
                            @else
                                <h6 >{{ isset($record->destinations->title) ? $record->destinations->title:'' }}</h6>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <p class="font-weight-bold">Loại hình tham quan</p>
                            @if ($record->type_id == 0)
                                <h6 >Tất cả</h6>
                            @else
                                <h6 >{{ isset($record->types->title) ? $record->types->title:'' }}</h6>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <p class="font-weight-bold">Trạng thái</p>
                            @if ($record->status == 1)
                                <h6 >Hoạt động</h6>
                            @else
                                <h6 >Không hoạt động</h6>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <p class="font-weight-bold">Điểm nổi bật</p>
                            @if ($record->priority == 1)
                                <h6 >Hấp đãn</h6>
                            @else
                                <h6 >Không hấp đãn</h6>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-4" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <p class="font-weight-bold">Giá tiền</p>
                            <h6 >$ {{ isset($record->price) ? $record->price:'' }}</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <p class="font-weight-bold">Thời gian (Ngày)</p>
                            <h6 >{{ isset($record->duration) ? $record->duration:'' }}</h6>
                        </div>
                    </div>
                </div>

                <h5 class="mt-5" style="color: #3e683e; font-weight:bold">Đa phương tiện của chuyến tham quan</h5>
                <hr>
                <div class="row mt-2" >
                    <div class="col-3">
                        <div class="form-group">
                            <p class="font-weight-bold">Ảnh 360</p>
                            @if ($record->image_360 != '')
                                <iframe src="{{ isset($record->image_360) ? $record->image_360:'' }}" width="80%" height="250px" allowfullscreen="" loading="lazy"></iframe>
                            @else
                                ( the value is empty )
                            @endif

                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <p class="font-weight-bold">Vị trí</p>
                            @if ($record->map != '')
                                <iframe src="{{ isset($record->map) ? $record->map:'' }}" width="80%" height="250px" allowfullscreen="" loading="lazy"></iframe>
                            @else
                                ( the value is empty )
                            @endif

                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <p class="font-weight-bold">Video</p>
                            @if ($record->video != '')
                                <iframe src="{{ url('https://www.youtube.com/embed/'.$record->video) }}" width="80%" height="250px"></iframe>
                            @else
                                ( the value is empty )
                            @endif

                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <p class="font-weight-bold">Hình ảnh</p>
                            <img src="{{ asset('upload/tour/'.$record->photo) }}" style="width:80%; height:250px; object-fit: cover">
                        </div>
                    </div>
                </div>
                <h5 class="mt-5" style="color: #3e683e; font-weight:bold">Thông tin khác</h5>
                <hr>
                <div class="row" >
                    <div class="col-md-6">
                        <div class="form-group" style="color: black">
                            <p class="font-weight-bold">Tổng quát</p>
                            <p class="h6 pr-5">{!! isset($record->overview) ? $record->overview:'( the value is empty )' !!}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="color: black">
                            <p class="font-weight-bold">Lộ trình</p>
                            <p class="h6 pr-5">{!! isset($record->include) ? $record->include:'( the value is empty )' !!}</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-5" >
                    <div class="col-md-6">
                        <div class="form-group" style="color: black">
                            <p class="font-weight-bold">Sự khởi hành</p>
                            <p class="h6 pr-5">{!! isset($record->depature) ? $record->depature:'( the value is empty )' !!}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="color: black">
                            <p class="font-weight-bold">Thêm thông tin</p>
                            <p class="h6 pr-5">{!! isset($record->addtional) ? $record->addtional:'( the value is empty )' !!}</p>
                        </div>
                    </div>
                </div>
                <h5 class="mt-5" style="color: #3e683e; font-weight:bold">SEO</h5>
                <hr>
                <div class="row mt-3" >
                    <div class="col-md-12">
                        <div class="form-group" >
                            <p class="font-weight-bold">Meta_title</p>
                            <h6 >{{ isset($record->meta_title) ? $record->meta_title:'' }}</h6>
                        </div>
                    </div>
                </div>
                <div class="row mt-2" >
                    <div class="col-md-12">
                        <div class="form-group" style="color: black">
                            <p class="font-weight-bold" style="color: #black">Meta_description</p>
                            <p class="h6 pr-5">{!! isset($record->meta_description) ? $record->meta_description:'' !!}</p>
                        </div>
                    </div>
                </div>
                <style>
                    h6{color: black; font-weight: normal;}
                    .h6{color: black; font-weight: normal; font-size: 15px}
                </style>
        </div>
    </div>
</div>
@endsection
