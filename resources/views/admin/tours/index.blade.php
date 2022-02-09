@extends("layouts.master")
@section("do-du-lieu")

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

<div class="page-breadcrumb" style="margin-top: -20px; margin-left:-20px">
    <div class="row" >
        <div class="col-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background: #EEF5F9">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" title="Dashboard">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chuyến du lịch</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="mt-3 px-3 pb-3" style="background: white">
    <div class="text-right"><a href="{{ url('admin/tour/create') }}" class="btn btn-primary mt-4 mb-5" ><i class="fa fa-plus mr-1"></i> Thêm mới</a></div>

<div class="row mb-2">
    <div class="col-md-3">
        <div class="form-group">
            <label>Tìm kiếm</label>
            <input type="text"  class="form-control" id="form1" placeholder="Search...">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Điểm đến</label>
            <select class="form-control w-100" id="destination" style="padding: 5px 25px">
                <option value="all">All</option>
                @foreach ($destination as $rows)
                    <option value="{{ $rows->id }}">{{ $rows->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Loại hình tham quan</label>
            <select class="form-control w-100" id="type" style="padding: 5px 25px">
                <option value="all">All</option>
                @foreach ($type as $rows)
                    <option value="{{ $rows->id }}">{{ $rows->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Trạng thái</label>
            <select class="form-control w-100" id="status" style="padding: 5px 25px">
                <option value="all">Tất cả</option>
                <option value="1">Hoạt động</option>
                <option value="0">Không họat động</option>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Nổi bật</label>
            <select class="form-control w-100" id="priority" style="padding: 5px 25px">
                <option value="all">Tất cả</option>
                <option value="1">Hấp dẫn</option>
                <option value="0">Không hấp dẫn</option>
            </select>
        </div>
    </div>

</div>


    <table  id="example" class="table table-striped table-bordered data-table">
        <thead>
            <tr class="text-center">
                <th>STT</th>
                <th>Hình ảnh</th>
                <th style="width:18%">Tiêu đề</th>
                <th>Giá tiền (VND)</th>
                <th>Thời gian</th>
                <th>Trạng thái</th>
                <th>Nổi bật</th>
                <th style="width:15%">Xem thêm</th>
                <th>Lựa chọn</th>
            </tr>
        </thead>
        <tbody class="text-center align-middle">
        </tbody>
    </table>
</div>

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
                    url: '{{ route('tour.list') }}',
                    data : function(d) {
                        d.filter_search = $('#form1').val(),
                        d.destination = $('#destination').val(),
                        d.type = $('#type').val(),
                        d.status = $('#status').val(),
                        d.priority = $('#priority').val()
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'align-middle'},
                    { data: 'photo', name: 'photo', class: 'align-middle', orderable: false },
                    { data: 'title', name: 'title', class: 'align-middle', orderable: false },
                    { data: 'price', name: 'price', class: 'align-middle', orderable: false },
                    { data: 'duration', name: 'duration', class: 'align-middle', orderable: false },
                    { data: 'status', name: 'status', class: 'align-middle', orderable: false },
                    { data: 'priority', name: 'priority', class: 'align-middle', orderable: false },
                    {data: 'more', name: 'more',  class: 'align-middle', orderable: false, searchable: false},
                    {data: 'action', name: 'action',  class: 'align-middle', orderable: false, searchable: false},
                ]
            });
            $('#form1').on('keyup', function () {
                datatable.draw();
            });
            $('#status').on('change', function () {
                datatable.draw();
            });
            $('#destination').on('change', function () {
                datatable.draw();
            });
            $('#type').on('change', function () {
                datatable.draw();
            });
            $('#priority').on('change', function () {
                datatable.draw();
            });
        });

        $('body').on('click', '.btn-delete', function () {
            var table = $('#example').DataTable();
            Swal.fire({
                html: "<b class='text-dark'>Bạn có chắc muốn xóa dữ liệu?</b>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý'
                }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).data('id');
                    let url2 = '{{ route('tour.destroy', ':id') }}';
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
                            console.log(res);
                            if (res == 1) {
                                toastr.success("Xóa dữ liệu thành công.");
                                $('#example').DataTable().ajax.reload();
                            } else {
                                toastr.error("Xóa dữ liệu thất bại.");
                            }

                        }
                    })
                }
            });
        });


        $(document).on('change', '.switch-status', function() {
            var status = $(this).prop('checked') == true ? 0 : 1;
            var id = $(this).data('id');
            $.ajax({
                    url: "tour/" + id +"/change-status/" + status,
                    type: 'GET',
                    success: function(data){
                        console.log(data);
                        toastr.success("Thay đổi trạng thái thành công.");
                        $('#example').DataTable().ajax.reload();
                    }
            });
        });

        $(document).on('change', '.switch-attractive', function() {
            var attractive = $(this).prop('checked') == true ? 0 : 1;
            var id = $(this).data('id');
            $.ajax({
                    url: "tour/" + id + "/change-attractive/" + attractive,
                    type: 'GET',
                    success: function(data){
                        console.log(data);
                        toastr.success("Thay đổi điểm nổi bật thành công.");
                        $('#example').DataTable().ajax.reload();
                    }
            });
        });
        </script>
@endsection
