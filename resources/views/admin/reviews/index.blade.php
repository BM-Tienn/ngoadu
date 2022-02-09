@extends("layouts.master")
@section("do-du-lieu")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

<div class="page-breadcrumb" style="margin-top: -20px; margin-left:-20px">
    <div class="row">
        <div class="col-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background: #EEF5F9">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tour.index') }}">Chuyến du lịch</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Đánh giá</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="mt-3 p-3 pt-2" style="background: white">
        <div class="row mt-3 mb-3" >
        <div class="col-md-2">
            <div class="form-group">
                <label>Status</label>
                <select class="form-control w-100" id="status" style="padding: 5px 25px">
                    <option value="all">All</option>
                    <option value="0">Public</option>
                    <option value="1">Block</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Star</label>
                <select class="form-control w-100" id="star" style="padding: 5px 25px">
                    <option value="all">All</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>
    </div>


    <table  id="example" class="table table-striped table-bordered data-table mt-5" style="background: white;">
        <thead>
            <tr class="text-center align-middle">
                <th>STT</th>
                <th>Đánh giá</th>
                <th>Thời gian</th>
                <th>Trạng thái</th>
                <th>Lựa chọn</th>
            </tr>
        </thead>
        <tbody class="text-center">

        </tbody>
    </table>
</div>
@include('admin.reviews.modal')
    <input type="hidden" value="{{ $tour_id }}" id="form1">
<script>
    var tour_id = document.getElementById("form1").value;
    $(document).ready(function () {
            var datatable = $('#example').DataTable({
                responsive : true,
                processing : true,
                serverSide : true,
                stateSave: false,
                searching: false,
                ajax: {
                    method: "GET",
                    url: 'review/list',
                    data : function(d) {
                        d.star = $('#star').val(),
                        d.status = $('#status').val()
                    }
                },
            columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'align-middle'},
                    
                    { data: 'star', name: 'star', class: 'align-middle', orderable: false },
                    { 'data': 'time', class: 'align-middle', orderable: false, searchable: false},
                    { 'data': 'status', class: 'align-middle', orderable: false, searchable: false},
                    {data: 'action', name: 'action',  class: 'align-middle', orderable: false, searchable: false},
            ]
        });
            $('#star').on('change', function () {
                datatable.draw();
            });
            $('#status').on('change', function () {
                datatable.draw();
            });
    });

        $('body').on('click', '.btn-status', function () {
                var table = $('#example').DataTable();
                var text = document.getElementById("form1").value;
                var id = $(this).data('id');
                var status = $(this).data('status');
                $.ajax({
                type: 'GET',
                url: 'change-status/' + id +'/' + status,
                success: function(res){
                    if(res == 1) {
                        toastr.success('Change status successful')
                        $('#example').DataTable().ajax.reload();
                    }
                    else {
                        toastr.error('Errror.!');
                    }
                }
            });
        });

        $(document).on('click', '.btn-show-detail', function () {
            let href = $(this).data('href');
            $.ajax({
                type: 'GET',
                url: href,
                success: function(res){
                    console.log(res.data);
                    $('#showReviewDetail').modal('show');
                    $('#tour_title').html(res.data.title);
                    $('#star_review').html(res.data.star);
                    $('#assessor').html(res.data.assessor);
                    if (res.data.status == 0) {
                        $('#status_review').html('PUBLIC');
                        $('#status_review').attr('class', 'btn btn-primary');
                    } else {
                        $('#status_review').html("PRIVATE");
                        $('#status_review').attr('class', 'btn btn-secondary');
                    }
                    var date  = new Date(res.data.created_at);
                    $('#created_at').html(date.toLocaleDateString());
                    $('#comment').html(res.data.content);
                }
            });
        });

        $(document).on('change', '.switch-status', function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var id = $(this).data('id');
        $.ajax({
                url: "review/change-status/"+ id + "/" + status,
                type: 'GET',
                success: function(data){
                    toastr.success("Change status successfully.");
                }
        });
    });

</script>
@endsection
