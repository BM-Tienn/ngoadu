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
                        <li class="breadcrumb-item"><a href="{{ route('tour.index') }}" title="Tour Management">Chuyến du lịch</a></li>
                        @if (isset($record))
                            <li class="breadcrumb-item active" aria-current="page">Sửa </li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
                        @endif

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="mt-4 py-3" style="background: white">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
            @if (isset($record))
                <form method="POST"  enctype="multipart/form-data" action="{{ route('tour.update', ['tour' => $record->id]) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @csrf
                @method('PUT')
                <div class="row mt-3" >
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tiêu đề  <strong>*</strong></label>
                            <input type="text" value="{{ isset($record->title) ? $record->title:'' }}" class="form-control @error('title') is-invalid @enderror" name="title">
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-1" >
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Slug *</label>
                            <input type="text" value="{{ isset($record->slug) ? $record->slug:'' }}" class="form-control" disabled>
                        </div>
                    </div>
                </div>

                <div class="row mt-3" >
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Điểm đến</label>
                            <select class="form-control w-75" name="destination_id" style="padding: 5px 25px">
                                @foreach ($destination as $destination)
                                    <option @if(isset($record->destination_id) && $record->destination_id == $destination->id) selected @endif value="{{ $destination->id }}" >{{ $destination->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Loại hình tham quan</label>
                            <select class="form-control w-75" name="type_id" style="padding: 5px 25px">
                                @foreach ($type as $type)
                                    <option @if(isset($record->type_id) && $record->type_id == $type->id) selected @endif value="{{ $type->id }}" >{{ $type->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select class="form-control w-75" name="status" style="padding: 5px 25px">
                                @if ($record->status == 1)
                                <option selected value="1">Active</option>
                                <option value="0">Inactive</option>
                                @else
                                <option value="1">Active</option>
                                <option selected value="0">Inactive</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nổi bật</label>
                            <select class="form-control w-75" name="priority" style="padding: 5px 25px">
                                @if ($record->priority == 1)
                                <option selected value="1">Hấp đẫn</option>
                                <option value="0">Không hấp dẫn</option>
                                @else
                                <option value="1">Hấp dẫn</option>
                                <option selected value="0">Không hấp dẫn</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-1" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Giá tiền</label>
                            <input type="number" value="{{ isset($record->price) ? $record->price:'' }}" class="form-control w-75 @error('price') is-invalid @enderror" name="price"">
                            @error('price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Thời gian (Day)</label>
                            <input type="number" value="{{ isset($record->duration) ? $record->duration:'' }}" class="form-control w-75 @error('duration') is-invalid @enderror" name="duration"">
                            @error('duration')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-1" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ảnh 360</label>
                            <input type="text" id="image360" value="{{ isset($record->image_360) ? $record->image_360:'' }}" class="form-control w-75 @error('image_360') is-invalid @enderror" name="image_360">
                            @error('image_360')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Video</label>
                            <input type="text" id="video" value="{{ isset($record->video) ? $record->video:'' }}" class="form-control w-75 @error('video') is-invalid @enderror" name="video"">
                            @error('video')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row mt-1" >
                        <div class="col-md-6">
                            <iframe id="i360" class="d-none" height="0" width="0" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <iframe id="v1" class="d-none" height="0" width="0"></iframe>
                            </div>
                        </div>
                    </div>
                <div class="row mt-1" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Vị trí</label>
                            <input type="text" id="map" value="{{ isset($record->map) ? $record->map:'' }}" class="form-control w-75 @error('map') is-invalid @enderror" name="map"">
                            @error('map')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hình ảnh</label><br>
                            <input type="file" class="w-75 @error('photo') is-invalid @enderror" name="photo""><br>
                            @error('photo')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-1" >
                    <div class="col-md-6">
                        <iframe id="map1" class="d-none" height="0" width="0"></iframe>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <img src="{{ asset('upload/tour/'.$record->photo) }}" width="200" style="object-fit: cover">
                        </div>
                    </div>
                </div>
                <div class="row mt-1" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tổng quát</label>
                            <textarea name="overview">{{ isset($record->overview) ? $record->overview:'' }}</textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace("overview");
                            </script>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Lộ trình</label>
                            <textarea name="include">{{ isset($record->include) ? $record->include:'' }}</textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace("include");
                            </script>
                            @error('include')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-1" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Khỏi hành</label>
                            <textarea name="depature">{{ isset($record->depature) ? $record->depature:'' }}</textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace("depature");
                            </script>
                            @error('depature')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Thêm Vào</label>
                            <textarea name="addtional">{{ isset($record->addtional) ? $record->addtional:'' }}</textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace("addtional");
                            </script>
                            @error('addtional')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3" >
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tiêu đề Meta <strong>*</strong></label>
                            <input type="text" value="{{ isset($record->meta_title) ? $record->meta_title:'' }}" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title">
                            @error('meta_title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-1" >
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tiêu đề điểm đến Meta <strong>*</strong></label><br>
                            <textarea class="form-control w-100" record="7"  name="meta_description">{!! isset($record->meta_description) ? $record->meta_description:'' !!}</textarea>
                            @error('meta_description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3" >
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary px-5">Lưu</button>
                        </div>
                    </div>
                </div>
            </form>
            @else
                <form method="POST" onsubmit="return checkForm(this);"  enctype="multipart/form-data" action="{{ route('tour.store') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @csrf
                <div class="row mt-3" >
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tiêu đề <strong>*</strong></label>
                            <input type="text"  value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" name="title">
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-1" >
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Điểm đến </label>
                            <select class="form-control w-75" name="destination_id" style="padding: 5px 25px">
                                    <option value="0" >Tất cả</option>
                                @foreach ($destination as $rows)
                                    <option @if(old('destination_id') == $rows->id) {{'selected'}} @endif value="{{ $rows->id }}">{{ $rows->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Loại hình tham quan</label>
                            <select class="form-control w-75" name="type_id" style="padding: 5px 25px">
                                    <option value="0" >Tất cả</option>
                                @foreach ($type as $rows)
                                    <option value="{{ $rows->id }}" @if(old('type_id') == $rows->id) {{'selected'}} @endif>{{ $rows->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select class="form-control w-75" name="status" style="padding: 5px 25px">
                                <option value="1" @if (old('status') == "1") {{ 'selected' }} @endif >Active</option>
                                <option value="0" @if (old('status') == "0") {{ 'selected' }} @endif>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sự nổi bật</label>
                            <select class="form-control w-75" name="priority" style="padding: 5px 25px">
                                <option value="1" @if (old('priority') == "1") {{ 'selected' }} @endif>Hấp dẫn</option>
                                <option value="0" @if (old('priority') == "0") {{ 'selected' }} @endif>Không hấp dẫn</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-1" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Giá cả <strong>*</strong></label>
                            <input type="number"  value="{{ old('price') }}" class="form-control w-75 @error('price') is-invalid @enderror" name="price"">
                            @error('price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Thời gian <strong>*</strong></label>
                            <input type="number" value="{{ old('duration') }}" class="form-control w-75 @error('duration') is-invalid @enderror" name="duration"">
                            @error('duration')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-1" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hình ảnh <strong>*</strong></label><br>
                            <input type="file" class="w-75 @error('photo') is-invalid @enderror" name="photo" onchange="loadImage(event)"><br>
                                <img class="mt-3" id="output" width="100px"/>
                                <script>
                                    var loadImage = function(event) {
                                        var output = document.getElementById('output');
                                        output.src = URL.createObjectURL(event.target.files[0]);
                                        output.onload = function() {
                                        URL.revokeObjectURL(image.src) // free memory
                                        }
                                    };
                                </script>
                            @error('photo')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-3" >
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Meta title <strong>*</strong></label>
                            <input type="text" value="{{ old('meta_title') }}" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title">
                            @error('meta_title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-1" >
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Meta description  <strong>*</strong></label><br>
                            <textarea class="w-100" rows="7" name="meta_description">{!! old('meta_description') !!}</textarea>
                            @error('meta_description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                </div>
                <div class="row mt-5" >
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <button type="submit" name="myButton" class="btn btn-primary px-5">Lưu</button>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    function checkForm(form)
                    {
                      //
                      // check form input values
                      //

                      form.myButton.disabled = true;
                      form.myButton.value = "Please wait...";
                      return true;
                    }

                    function resetForm(form)
                    {
                      form.myButton.disabled = false;
                      form.myButton.value = "Submit";
                    }
                  </script>
            </form>
            @endif
            </div>
        </div>
    </div>
</div>
<style>
    strong{color: red};
</style>
<script>
    $(document).ready(function(){
        var map = document.getElementById('map').value;
        if (map.length > 0) {
            $("#map1").attr('class', 'd-block');
            $("#map1").css({'height': '150px', 'width': '200px' })
        }
        var image = document.getElementById('image360').value;
        if (image.length > 0) {
            $("#i360").attr('class', 'd-block');
            $("#i360").css({'height': '150px', 'width': '200px' })
        }
        var text = document.getElementById('video').value;
        if (text.length > 0) {
            $("#v1").attr('class', 'd-block');
            $("#v1").css({'height': '150px', 'width': '200px' })
        }
            $("#map1").attr('src', map);
            $("#i360").attr('src', image);
            var src = "https://www.youtube.com/embed/" + text;
            $("#v1").attr('src', src);

        $("#map").on('change', function(){
            var map = document.getElementById('map').value;
            $("#map1").attr('src', map);
            $("#map1").attr('class', 'd-block');
            $("#map1").css({'height': '150px', 'width': '200px' })
      });

        $("#image360").on('change', function(){
            var image = document.getElementById('image360').value;
            $("#i360").attr('src', image);
            $("#i360").attr('class', 'd-block');
            $("#i360").css({'height': '150px', 'width': '200px' })
      });

      $("#video").on('change', function(){
        var text = document.getElementById('video').value;
            var src = "https://www.youtube.com/embed/" + text;
            $("#v1").attr('src', src);
            $("#v1").attr('class', 'd-block');
            $("#v1").css({'height': '150px', 'width': '200px' })

      });
    });
</script>
@endsection
