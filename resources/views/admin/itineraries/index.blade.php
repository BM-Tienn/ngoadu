@extends("layouts.master")
@section("do-du-lieu")
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">


<div class="page-breadcrumb mb-4" style="margin-top: -20px; margin-left:-20px">
    <div class="row">
        <div class="col-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background: #EEF5F9">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/tour') }}">Chuyến du lịch</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lộ trình</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3 p-3 pt-2 pb-5" style="background: white">
    <div class="col-4">
    <form id="myForm" onsubmit="return checkForm(this);" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @csrf
            <input type="hidden" value="{{ $info->id }}" id="tour_id" name="tour_id">
            <div class="row">
                <div class="col-12">
                    <div class="row mt-3" >
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tiêu đề <strong>*</strong></label>
                                <input type="text" value="{{ old('title') }}" class="form-control w-100" id="title" name="title">
                                <div class="err-title mt-1 text-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- rows -->
        <div class="row mt-2">
            <div class="col-md-12">
                    <input type="button" name="myButton" class="btn btn-primary mr-2 btn-save" value="Lưu">
            </div>
            <script type="text/javascript">
                function checkForm(form)
                {
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
        </div>
        <!-- end rows -->
    </form>
    <form style="display: none" id="myFormUpdate" method="POST" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @csrf
        @method('PUT')
        <input type="hidden" id="id" value="">
        <div class="row">
            <div class="col-12">
                <div class="row mt-3" >
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tiêu đề <strong>*</strong></label>
                            <input type="text" id="title_update" value="" class="form-control w-100">
                            <div class="error-title mt-1 text-danger"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <!-- rows -->
        <div class="row mt-2">
            <div class="col-md-12">
                <input type="button" class="btn btn-primary mr-2 btn-update" value="Update">
            </div>
        </div>
        <!-- end rows -->
    </form>
    </div>

    <div class="col-8">
        <table  id="example" class="table table-striped table-bordered data-table" style="background: white;">

            <thead>
                <tr class="text-center align-middle">
                    <th>STT</th>
                    <th>Lộ trình</th>
                    <th>Điểm đến</th>
                    <th>Lựa chọn</th>
                </tr>
            </thead>
            <tbody class="text-center">
            </tbody>
        </table>
    </div>
</div>
    <input type="hidden" id="form1" value="{{ $tour_id }}">
    @push('scripts')
        <script>
        var text = document.getElementById("form1").value;
        $(function() {
            $('#example').DataTable({
                searching: false,
                processing: true,
                serverSide: false,
                ajax: {
                url : 'itinerary/list',
                type: 'get',
            },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'align-middle'},
                    { data: 'title', name: 'title', orderable: false, searchable: false },
                    { data: 'place', name: 'place', class: 'align-middle', orderable: false },
                    {data: 'action', name: 'action',  class: 'align-middle', orderable: false, searchable: false},
                ]
            });
        });
        $('body').on('click', '.btn-delete', function () {
            var table = $('#example').DataTable();
            Swal.fire({
                html: "<b class='text-dark'>Are you sure to delete this data?</b>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).data('id');

                        $.ajax({
                        url: "{!! url('admin/tour/itinerary' ) !!}"+"/"+ id,
                        type:'POST',
                        dataType:'json',
                        data:{
                            "_token": "{{ csrf_token() }}",
                            _method: 'delete'
                            },
                        success: function(res) {
                            if (res == 1) {
                                toastr.success("Xóa dữ liệu thành công!");
                                $('#example').DataTable().ajax.reload();
                            } else {
                                toastr.error("Xóa dữ leieuj thất bại.");
                            }

                        }
                    })
                }
            })
        });

        $('.btn-save').click(function(e) {
            $('.err-title').css('display', 'block');
            e.preventDefault()
            var title = $('#title').val();
            var tour_id = $('#tour_id').val();
            var flag = true;
            if(title.length == 0) {
                flag = false;
                $('.err-title').html('{{ __('validation.required', ['attribute' => 'title']) }}');
            } else if (title.length > 100) {
                flag = false;
                $('.err-title').html('{{ __('validation.max.string', ['attribute' => 'title', 'max' => 100]) }}');
            } else {
                $('.err-title').html('')
            }

            if(flag == true) {
                $.ajax({
                    url: "{{ route('itinerary.store') }}",
                    type: 'POST',
                    datatype:"json",
                    data: {
                        title: title,
                        tour_id: tour_id,
                        _token: '{!! csrf_token() !!}'
                    },
                    success: function(res) {
                        if (res == 1) {
                            toastr.success("Lưu dữ liệu thành công.");
                            $("#myForm")[0].reset();
                            $('#example').DataTable().ajax.reload();
                        } else if ( res == 2) {
                            $('.err-title').html('{{ __('validation.unique', ['attribute' => 'title']) }}');
                        } else {
                            toastr.error("Lưu dữ liệu thất bại.");
                        }
                    },
                });
            }
        });

        $('.btn-update').click(function(e) {
            $('.error-title').css('display', 'block');
            e.preventDefault()
            var title = $('#title_update').val();
            var tour_id = $('#id').val();
            var flag = true;
            if(title.length == 0) {
                flag = false;
                $('.error-title').html('{{ __('validation.required', ['attribute' => 'title']) }}');
            } else if (title.length > 100) {
                flag = false;
                $('.error-title').html('{{ __('validation.max.string', ['attribute' => 'title', 'max' => 100]) }}');
            } else {
                $('.error-title').html('')
            }

            if(flag == true) {
                let url2 = "{{ route('itinerary.update', ':id') }}";
                url2 = url2.replace(':id', tour_id);
                $.ajax({
                    url: url2,
                    type: 'PUT',
                    datatype:"json",
                    data: {
                        title: title,
                        _token: '{!! csrf_token() !!}'
                    },
                    success: function(res) {
                        if (res == 1) {
                            toastr.success("Sửa dư liệu thành công.");
                            $("#myFormUpdate")[0].reset();
                            $('#example').DataTable().ajax.reload();
                            $('#myForm').css('display', 'block');
                            $('.error-title').css('display', 'block');
                            $('.err-title').css('display', 'none');
                            $('#myFormUpdate').css('display', 'none');
                        } else if ( res == 2) {
                            $('.error-title').html('{{ __('validation.unique', ['attribute' => 'title']) }}');
                        } else {
                            toastr.error("Sửa dữ liệu thất bại.");
                        }
                    },
                });
            }
        });

        $('body').on('click', '.btn-edit', function () {
            $('#myForm').css('display', 'none');
            $('#message_title').css('display', 'none');
            $('#myFormUpdate').css('display', 'block');

            var id = $(this).data('id');
            $.ajax({
            url: "{!! url('admin/tour/itinerary' ) !!}"+"/"+ id + "/edit",
            type: 'GET',
                success: function(data){
                    $('#title_update').val(data.itinerary.title);
                    $('#id').val(data.itinerary.id);
                }
            });
        });
    </script>
    @endpush
    @endsection
