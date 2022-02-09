@extends("layouts.master")
@section("do-du-lieu")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

<div class="page-breadcrumb history mb-4">
    <div class="row">
        <div class="col-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" title="Dashboard">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tour.index') }}" title="Tour Management">Tour</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tour.itinerary', ['tour_id' => $tour_id]) }}" title="Itinerary">Itinerary</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Place</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row" style="background: white">
    <div class="col-5">
        <form style="display: block" id="myForm" method="POST" onsubmit="return checkFormPlaceItinerary(this);" action="{{ route('place.store') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @csrf
                <input type="hidden" value="{{ $info->id }}" name="itinerary_id">
            <!-- rows -->
            <div class="row mt-1">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Địa điểm <strong>*</strong></label>
                        <input type="text"  value="{{ old('location') }}" class="form-control w-100 @error('location') is-invalid @enderror" name="location"">
                        @error('location')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Thời gian <strong>*</strong></label>
                        <input type="number" value="{{ old('duration') }}" class="form-control w-100 @error('duration') is-invalid @enderror" name="duration"">
                        @error('duration')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- rows -->
            <div class="row" >
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <textarea name="note" class="form-control w-100 @error('note') is-invalid @enderror" cols="30" rows="">{{ old('note') }}</textarea>
                        @error('note')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- rows -->
            <!-- rows -->
            <div class="row" >
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Miêu tả <strong>*</strong></label>
                        <textarea name="description" class="form-control w-100 @error('description') is-invalid @enderror" cols="30" rows="6">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                        <button type="submit" id="submitPlace" name="myButton2" class="btn btn-primary px-5">Save</button>
                </div>
            </div>
            <!-- end rows -->
        </form>
        <form style="display: none" id="myFormUpdate" method="POST" onsubmit="return checkFormPlaceItinerary(this);">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @method('PUT')
            @csrf
                <input type="hidden" value="{{ $info->id }}" name="itinerary_id">
            <!-- rows -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Địa điểm <strong>*</strong></label>
                        <input type="text" id="location" value="" class="form-control w-100 @error('location_update') is-invalid @enderror" name="location_update">
                        @error('location_update')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Thời gian <strong>*</strong></label>
                        <input type="number" id="duration" value="" class="form-control w-100 @error('duration') is-invalid @enderror" name="duration"">
                        @error('duration')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- rows -->
            <div class="row" >
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <textarea name="note" id="note" class="form-control w-100 @error('note') is-invalid @enderror" cols="30" rows="4">{{ old('note') }}</textarea>
                        @error('note')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- rows -->
            <!-- rows -->
            <div class="row" >
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Miêu tả <strong>*</strong></label>
                        <textarea name="description_update" id="description" class="form-control w-100 @error('description_update') is-invalid @enderror" cols="30" rows="6">{{ old('description') }}</textarea>
                        @error('description_update')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                        <button type="submit" id="submitPlace" name="myButton2" class="btn btn-primary px-5">Update</button>
                </div>
            </div>
            <!-- end rows -->
        </form>
        <script type="text/javascript">
            function checkFormPlaceItinerary(form)
            {
              form.myButton2.disabled = true;
              form.myButton2.value = "Please wait...";
              return true;
            }
            function resetForm(form)
            {
              form.myButton2.disabled = false;
              form.myButton2.value = "Submit";
            }
        </script>
    </div>
    <div class="col-7 mt-2">
    <table  id="example" class="table table-striped table-bordered data-table" style="background: white;">
            <thead>
                <tr class="text-center align-middle">
                    <th>STT</th>
                    <th>Địa điểm</th>
                    <th class="w-50">Miêu tả</th>
                    <th>Lựa chọn</th>
                </tr>
            </thead>
            <tbody class="text-center">
            </tbody>
    </table>
    </div>
    <input type="hidden" id="form1" value="{{ $tour_id }}">
    <input type="hidden" id="form2" value="{{ $itinerary_id }}">
</div>
@push('scripts')
    <script>
        var tour = document.getElementById("form1").value;
        var itinerary = document.getElementById("form2").value;
        $(function() {
            $('#example').DataTable({
                searching: false,
                processing: true,
                serverSide: false,

                ajax: {
                url : 'place/list',
                type: 'get',
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'align-middle'},
                    { data: 'location', name: 'location',  class: 'align-middle', orderable: false, searchable: false },
                    { data: 'description', name: 'description', class: 'align-middle', orderable: false },
                    {data: 'action', name: 'action', class: 'align-middle', orderable: false, searchable: false},
                ]
            });
        });

        $('body').on('click', '.btn-delete', function () {
            var table = $('#example').DataTable();
            Swal.fire({
                html: "<b style='color:dark; margin-left:40px'>Bạn có muốn xóa dữ liệu?</b>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý'
                }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).data('id');

                        $.ajax({
                        url: "{!! url('admin/tour/itinerary/place' ) !!}"+"/"+ id,
                        type:'POST',
                        dataType:'json',
                        data:{
                            "_token": "{{ csrf_token() }}",
                            _method: 'delete'
                            },

                        success: function() {
                            toastr.success("Xóa dữ liệu thành công.");
                            $('#example').DataTable().ajax.reload();
                        }
                    })
                }
            })
        })

        $('body').on('click', '.btn-edit', function () {
                $('#myForm').css('display', 'none');
                $('#validate_title').css('display', 'none');
                $('#validate_image').css('display', 'none');
                $('#myFormUpdate').css('display', 'block');
                var id = $(this).data('id');
                $.ajax({
                url: "{!! url('admin/tour/itinerary/place' ) !!}"+"/"+ id + "/edit",
                type: 'GET',
                success: function(data){
                    var action = '{{ URL::route('place.store') }}/'+ data.place.id;
                    $('#location').val(data.place.location);
                    $('#duration').val(data.place.duration);
                    $('#note').html(data.place.note);
                    $('#description').html(data.place.description);
                    $('#myFormUpdate').attr('action', action);
                }
            });
            });


    </script>
@endpush
@endsection
