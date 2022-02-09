@extends("layouts.master")
@section("do-du-lieu")

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

<div class="page-breadcrumb" style="margin-top: -20px; margin-left:-20px">
    <div class="row">
        <div class="col-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}" title="Dashboard">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Loại hình tham quan</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
</div>


<div class="row mt-4 pb-3" style="background: white">
    <div class="col-4">
        <form id="myForm" onsubmit="return checkForm(this);" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @csrf
            <div class="row">
                <div class="col-11">
                    <div class="row mt-3" >
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tiêu đề<b style="color: red">*</b></label>
                                <input type="text" value="{{ old('title') }}" id="type_title" class="form-control w-100 @error('title') is-invalid @enderror" name="title">
                                <div class="err-title mt-1 text-danger"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Trạng thái <b style="color: red">*</b></label>
                                <select class="form-control w-50" id="type_status" name="status">
                                    <option value="1" @if (old('status') == "1") {{ 'selected' }} @endif>Hoạt động</option>
                                    <option value="0" @if (old('status') == "0") {{ 'selected' }} @endif>không hoạt động</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <!-- rows -->
        <div class="row mt-2">
            <div class="col-md-12">
                    <button name="myButton" class="btn btn-primary btn-save mr-2">Lưu</button>
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
    <form style="display: none" id="myFormUpdate" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @csrf
        @method('PUT')
        <input type="hidden" id="id" value="">
        <div class="row">
            <div class="col-11">
                <div class="row mt-3" >
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tiêu đề <b style="color: red">*</b></label>
                            <input type="text" id="title" value="{{ isset($rows->title) ? $rows->title:'' }}" class="form-control w-100">
                            <div class="error-title mt-1 text-danger"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Trạng thái <b style="color: red">*</b></label>
                            <select class="form-control w-50" id="status" name="status">
                                <option id="active" value="1">Hoạt động</option>
                                <option id="inactive" value="0">Không hoạt động</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- rows -->
    <div class="row mt-2">
        <div class="col-md-12">
                <button class="btn btn-primary btn-update mr-2">Sửa</button>
        </div>
        <script>
            function reset() {
              document.getElementById("myForm").reset();
            }
        </script>
    </div>
    <!-- end rows -->
</form>
    </div>
    <div class="col-8">
        <div class="row mt-3 mb-3" >
            <div class="col-md-4">
                <div class="form-group">
                    <label>Tìm Kiếm</label>
                    <input type="search" id="form1" class="form-control" placeholder="search..." />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Trạng thái</label>
                    <select class="form-control w-100" id="filterActive">
                        <option value="all">Tất cả</option>
                        <option value="1">Hoạt động</option>
                        <option value="0">Không hoạt động</option>
                    </select>
                </div>
            </div>

        </div>
        <table  id="example" class="table table-striped table-bordered data-table" style="background: white;">
            <thead>
                <tr class="text-center align-middle">
                    <th>STT</th>
                    <th>Tiêu đề</th>
                    <th>Trạng thái</th>
                    <th>Tùy chọn</th>
                </tr>
            </thead>
            <tbody class="text-center">
            </tbody>
        </table>
    </div>
</div>

    <script>
        $(function() {
            $(document).ready(function () {
            var datatable = $('#example').DataTable({
                responsive : true,
                processing : true,
                serverSide : true,
                stateSave: false,
                searching: false,
                ajax: {
                    method: "GET",
                    url: '{{ route('type.list') }}',
                    data : function(d) {
                        d.filter_search = $('#form1').val(),
                        d.status = $('#filterActive').val()
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'align-middle' },
                    { data: 'title', name: 'title', class: 'align-middle' },
                    { 'data': 'status', class: 'align-middle'},
                    {data: 'action', name: 'action', class: 'align-middle', orderable: false, searchable: false},
                ]
            });
            $('#form1').on('keyup', function () {
                datatable.draw();
            });
            $('#filterActive').on('change', function () {
                datatable.draw();
            });
        });

            $('body').on('click', '.btn-delete', function () {
            var table = $('#example').DataTable();
            Swal.fire({

                html: "<b class='text-dark'>Bạn có chắc muốn xóa dữ liệu ?</b>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).data('id');
                        let url3 = '{{ route('type-of-tour.destroy', ':id') }}';
                        url3 = url3.replace(':id', id);
                            $.ajax({
                            url: url3,
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
                                    $('.error-title').css('display', 'block');
                                    $('#myForm').css('display', 'block');
                                    $('#myFormUpdate').css('display', 'none');
                                } else {
                                    toastr.error("Xóa dữ liệu thất bại.");
                                }
                            }
                        })
                    }
                    })
                });
            });

            $('.btn-save').click(function(e) {
            $('.err-title').css('display', 'block');
            e.preventDefault()
            var title = $('#type_title').val();
            var status = $('#type_status').val();
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
                    url: "{{ route('type-of-tour.store') }}",
                    type: 'POST',
                    datatype:"json",
                    data: {
                        title: title,
                        status: status,
                        _token: '{!! csrf_token() !!}'
                    },
                    success: function(res) {
                        if (res == 1) {
                            toastr.success("Lưu trữ dữ liệu thành công.");
                            $("#myForm")[0].reset();
                            $('#example').DataTable().ajax.reload();
                        } else if ( res == 2) {
                            $('.err-title').html('{{ __('validation.unique', ['attribute' => 'title']) }}');
                        } else {
                            toastr.error("Lưu trữ dữ liệu thất bại.");
                        }
                    },
                });
            }
        });


            $('body').on('click', '.btn-edit', function () {
                $('#myForm').css('display', 'none');
                $('.err-title').css('display', 'none');
                $('.error-title').css('display', 'none');
                $('#myFormUpdate').css('display', 'block');

                var id = $(this).data('id');
                let url2 = '{{ route('type-of-tour.edit', ':id') }}';
                    url2 = url2.replace(':id', id);
                    $.ajax({
                    url: url2,
                    type: 'GET',
                    success: function(data) {
                        $('#id').val(data.type.id);
                        $('#title').val(data.type.title);
                        if (data.type.status == 1) {
                            $('#active').attr('selected',true);
                            $('#inactive').attr('selected', false);
                        } else {
                            $('#inactive').attr('selected', true);
                            $('#active').attr('selected', false);
                        }
                    }
                });
            });

            $('.btn-update').click(function(e) {
            $('.error-title').css('display', 'block');
            e.preventDefault()
            var title = $('#title').val();
            var status = $('#status').val();
            var id = $('#id').val();
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
                let url2 = "{{ route('type-of-tour.update', ':id') }}";
                url2 = url2.replace(':id', id);
                $.ajax({
                    url: url2,
                    type: 'PUT',
                    datatype:"json",
                    data: {
                        title: title,
                        status: status,
                        _token: '{!! csrf_token() !!}'
                    },
                    success: function(res) {
                        if (res == 1) {
                            toastr.success("Sửa dữ liệu thành công.");
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

            $(document).on('change', '.switch-status', function() {
            var status = $(this).prop('checked') == true ? 0 : 1;
            var id = $(this).data('id');
            $.ajax({
                    url: "type-of-tour/" + id + "/change-status/" + status,
                    type: 'GET',
                    success: function(data){
                        toastr.success("Đổi trạng thái thành công.");
                    }
            });
        });
        </script>
@endsection
