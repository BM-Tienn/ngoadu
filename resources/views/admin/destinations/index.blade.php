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
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" title="Dashboard">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Điểm đến</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4" style="background: white">
    <div class="col-4">
        <form id="myForm" onsubmit="return checkForm(this);" method="POST" enctype="multipart/form-data" action="{{ route('destination.store') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @csrf
                <div class="row">
                    <div class="col-11">
                        <div class="row mt-3" >
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tiêu đề <b style="color: red">*</b></label>
                                    <input type="text" value="{{ old('title') }}" class="form-control w-100 @error('title') is-invalid @enderror" aria-autocomplete="off" name="title">
                                    @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Trạng thái <b style="color: red">*</b></label>
                                    <select class="form-control w-50 js-example-basic-single" name="status">
                                        <option value="1" @if (old('status') == "1") {{ 'selected' }} @endif>Hoạt động</option>
                                        <option value="0" @if (old('status') == "0") {{ 'selected' }} @endif>Không hoạt động</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1" >
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Hình ảnh <b style="color: red">*</b></label>
                                        <input type="file" class="w-100 py-1 @error('image') is-invalid @enderror" name="image" onchange="loadImage(event)" style="color: black">
                                        <img class="mt-3" id="output" width="150px"/>
                                        <script>
                                        var loadImage = function(event) {
                                            var output = document.getElementById('output');
                                            output.src = URL.createObjectURL(event.target.files[0]);
                                            output.onload = function() {
                                            URL.revokeObjectURL(image.src) // free memory
                                            }
                                        };
                                        </script>
                                        @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- rows -->
            <div class="row mt-2">
                <div class="col-md-12">
                        <input type="submit" name="myButton" class="btn btn-primary mr-2" value="Lưu">
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
            </div>
            <!-- end rows -->
        </form>
        <form style="display: none" id="myFormUpdate" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-11">
                        <div class="row mt-3" >
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tiêu đề<b style="color: red">*</b></label>
                                    <input type="text" id="title" value="{{ isset($rows->title) ? $rows->title:'' }}" class="form-control w-100 @error('title_update') is-invalid @enderror" name="title_update">
                                    @error('title_update')
                                    <div class="text-danger" id="validate_title">{{ $message }}</div>
                                    @enderror
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
                        <div class="row mt-1" >
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Hình Ảnh <b style="color: red">*</b></label>
                                        <input type="file" id="image" class="w-100 py-1 @error('image') is-invalid @enderror" name="image" onchange="loadFile(event)">
                                        <img class="mt-3" id="outputImage" width="150px"/>
                                        <script>
                                        var loadFile = function(event) {
                                            var output = document.getElementById('outputImage');
                                            output.src = URL.createObjectURL(event.target.files[0]);
                                            output.onload = function() {
                                            URL.revokeObjectURL(output.src) // free memory
                                            }
                                        };
                                        </script>
                                        @error('image')
                                        <div class="text-danger"  id="validate_image">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- rows -->
            <div class="row mt-2">
                <div class="col-md-12">
                        <input type="submit" class="btn btn-primary mr-2" value="Lưu">
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
                    <select class="form-control w-100 js-example-basic-single" id="filterActive">
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
                    <th>Hình ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Trạng thái</th>
                    <th>Lựa chọn</th>
                </tr>
            </thead>
            <tbody class="text-center">
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            var datatable = $('#example').DataTable({
                responsive : true,
                processing : true,
                serverSide : true,
                stateSave: false,
                searching: false,
                ajax: {
                    method: "GET",
                    url: '{{ route('destination.datatable') }}',
                    data : function(d) {
                        d.filter_search = $('#form1').val(),
                        d.status = $('#filterActive').val()
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'align-middle'},
                    { data: 'image', name: 'image', orderable: false, searchable: false },
                    { data: 'title', name: 'title', class: 'align-middle', orderable: false },
                    { 'data': 'status', class: 'align-middle', orderable: false, searchable: false},
                    {data: 'action', name: 'action',  class: 'align-middle', orderable: false, searchable: false},
                ]
            });
            $('#form1').on('keyup', function () {
                datatable.draw();
            });
            $('#filterActive').on('change', function () {
                datatable.draw();
            });
        });

        $('body').on('click', '.btn-edit', function () {
                $('#myForm').css('display', 'none');
                $('#validate_title').css('display', 'none');
                $('#validate_image').css('display', 'none');
                $('#myFormUpdate').css('display', 'block');
                var id = $(this).data('id');
                let url2 = '{{ route('destination.edit', ':id') }}';
                    url2 = url2.replace(':id', id);
                $.ajax({
                url: url2,
                type: 'GET',
                success: function(data){
                    var src = '{{ URL::asset('/upload/destination') }}'+'/'+ data.destination.image;
                    var action = '{{ URL::route('destination.store') }}/'+ data.destination.id;
                    $('#title').val(data.destination.title);

                    $('#outputImage').attr('src', src);
                    $('#myFormUpdate').attr('action', action);
                    console.log(data.destination.status);
                    if (data.destination.status == 1) {
                        $('#active').attr('selected',true);
                        $('#inactive').attr('selected', false);
                    } else {
                        $('#inactive').attr('selected', true);
                        $('#active').attr('selected', false);
                    }
                }
            });
        });

        $('body').on('click', '.btn-delete', function () {
            var table = $('#example').DataTable();
            Swal.fire({
                html: "<b class='text-dark'>Bạn có muốn xóa dữ liệu?</b>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý'
                }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).data('id');
                    let url2 = '{{ route('destination.destroy', ':id') }}';
                    url2 = url2.replace(':id', id);
                        $.ajax({
                        url: url2,
                        type:'POST',
                        dataType:'json',
                        data:{
                            "_token": "{{ csrf_token() }}",
                            _method: 'delete'
                            },

                        success: function(res) {
                            if (res == 1) {
                                toastr.success("Xóa dữ liệu thành công.");
                                $('#example').DataTable().ajax.reload();
                                $('#myForm').css('display', 'block');
                                $('#myFormUpdate').css('display', 'none');
                            } else {
                                toastr.error("Không thể xóa dữ liệu.");
                            }
                        },
                    })
                }
            })
        })

        $(document).on('change', '.switch-status', function() {
            var status = $(this).prop('checked') == true ? 0 : 1;
            var id = $(this).data('id');
            $.ajax({
                    url: "destination/" + id + "/change-status/" + status,
                    type: 'GET',
                    success: function(data){
                        toastr.success("Thay đổi trạng thái thành công.");
                        $('#example').DataTable().ajax.reload();
                    }
            });
        });
    </script>
@endpush
@endsection
