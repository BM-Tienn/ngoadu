@extends("layouts.master")
@section("do-du-lieu")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="page-breadcrumb" style="margin-top: -20px; margin-left:-20px">
    <div class="row">
        <div class="col-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background: #EEF5F9">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" title="Dashboard">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Phản hồi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="mt-5 px-3 pb-5 pt-3" style="background: white">
    <div class="row mt-3 mb-3" >
        <div class="col-md-3">
            <div class="form-group">
                <label>Tìm kiếm</label>
                <input type="search" id="form1" class="form-control" placeholder="search..." />
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Trạng thái</label>
                <select class="form-control w-100" id="status" name="status">
                    <option value="all">Tất cả</option>
                    <option value="0">New</option>
                    <option value="1">Read</option>
                </select>
            </div>
        </div>
    </div>

    <table  id="example" class="table table-striped table-bordered data-table" style="background: white;">
        <thead>
            <tr class="text-center align-middle">
                <th>STT</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Thời gian gửi</th>
                <th>Trạng thái</th>
                <th>Lựa chọn</th>
            </tr>
        </thead>
        <tbody class="text-center">
        </tbody>
    </table>
</div>
@include('admin.contacts.modal')
<script>
    $(document).on('click', '.btn-show-detail', function () {
        let href = $(this).data('href');
        $('#showContactDetail').modal('show')
    })
        $(function() {
            var datatable =  $('#example').DataTable({
                responsive : true,
                processing : true,
                serverSide : true,
                stateSave: false,
                searching: false,
                ajax : {
                    method: "GET",
                    url: '{{ route('contact.list') }}',
                    data : function(d){
                        d.status = $('#status').val(),
                        d.filter_search = $('#form1').val()
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'align-middle'},
                    { data: 'name', name: 'name', orderable: false, searchable: false },
                    { data: 'email', name: 'email', class: 'align-middle', orderable: false },
                    { 'data': 'phone', class: 'align-middle', orderable: false, searchable: false},
                    { 'data': 'created_at', class: 'align-middle', orderable: false, searchable: false},
                    { 'data': 'status', class: 'align-middle', orderable: false, searchable: false},
                    { 'data': 'action', class: 'align-middle', orderable: false, searchable: false},
                ]
            });

            $('#form1').on('keyup', function(){
			    datatable.draw();
            });
            $('#status').on('change', function(){
                datatable.draw();
            });
        });
        $(document).on('click', '.btn-show-detail', function () {
            let href = $(this).data('href');
            $.ajax({
                type: 'GET',
                url: href,
                success: function(res){
                    $('#showContactDetail').modal('show');
                    $('#name_contact').html(res.data.name);
                    $('#email_contact').html(res.data.email);
                    $('#phone_contact').html(res.data.phone);
                    var date  = new Date(res.data.created_at);
                    $('#created_at').html(date.toLocaleDateString());
                    $('#message').html(res.data.message);
                }
            });
        });
</script>
@endsection
