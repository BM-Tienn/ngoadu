@extends("layouts.master")
@section("do-du-lieu")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="page-breadcrumb" style="margin-top: -20px; margin-left:-20px">
    <div class="row">
        <div class="col-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background: #EEF5F9;">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" title="Dashboard">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Booking</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
</div>
<div class="mt-3 px-3 pt-2 pb-5" style="background: white">
    <div class="row mt-3 mb-3" >
        <div class="col-md-3">
            <div class="form-group">
                <label>Search</label>
                <input type="search" id="form1" class="form-control" placeholder="search..." />
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Status</label>
                <select class="form-control w-100" id="status" style="padding: 5px 25px">
                    <option value="all">Trạng thái</option>
                    <option value="1">Mới</option>
                    <option value="2">Comfirmed</option>
                    <option value="3">Completed</option>
                    <option value="4">Cancel</option>
                </select>
            </div>
        </div>
    </div>
    <table  id="example" class="table table-striped table-bordered data-table mt-5" style="background: white;">
        <thead>
            <tr class="text-center align-middle">
                <th>STT</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Tổng tiền</th>
                <th>Start_at</th>
                <th>Trạng thái</th>
                <th>Lựu chọn</th>
            </tr>
        </thead>
        <tbody class="text-center">

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
                ajax : {
                    method: "GET",
                    url: '{{ route('booking.list') }}',
                    data : function(d){
                        d.filter_search = $('#form1').val(),
                        d.status = $('#status').val()
                    }
                },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'align-middle'},
                { data: 'name', name: 'name', orderable: false, searchable: false },
                { data: 'email', name: 'email', class: 'align-middle', orderable: false },
                { data: 'phone', name: 'phone', class: 'align-middle', orderable: false },
                { 'data': 'total', class: 'align-middle', orderable: false, searchable: false},
                { 'data': 'start_at', class: 'align-middle', orderable: false, searchable: false},
                { 'data': 'status', class: 'align-middle', orderable: false, searchable: false},
                {data: 'action', name: 'action',  class: 'align-middle', orderable: false, searchable: false},
            ]
        });
        $('#status').on('change', function(){
                datatable.draw();
        });
        $('#form1').on('keyup', function(){
                datatable.draw();
        });
    });
</script>
@endsection
