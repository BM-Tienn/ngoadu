@extends("layouts.master")
@section("do-du-lieu")

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

<div class="page-breadcrumb mb-4" style="margin-top: -20px; margin-left:-20px">
    <div class="row">
        <div class="col-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background: #EEF5F9">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" title="Dashboard">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tour.index') }}" title="Tour Management">Chuyến du lịch</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Câu hỏi thường gặp</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="mt-2 p-3" style="background: white">
    <div class="text-right"><button class="btn btn-primary btn-faqs-user mb-2 mt-2 " ><i class="fa fa-plus mr-1"></i> Thêm mới</button></div><br>

            <table id="example" class="table table-striped table-bordered data-table" style="background: white;">
            <thead>
                <tr class="text-center">
                    <th>STT</th>
                    <th>Câu hỏi</th>
                    <th style="width:40%">Câu trả lời</th>
                    <th style="width:20%">Lựu chọn</th>
                </tr>
            </thead>
            <tbody class="text-center">
            </tbody>
        </table>
</div>
@include('admin.faqs.modal')

    <input type="hidden" value="{{ $tour_id }}" id="form1">
    <script>
        var text = document.getElementById("form1").value;
        $(function() {
            $('#example').DataTable({
                searching: false,
                processing: true,
                serverSide: false,
                ajax: {
                url : 'faqs/list',
                type: 'get',
            },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'align-middle'},
                    { data: 'question', name: 'question', orderable: false, searchable: false },
                    { data: 'answer', name: 'answer', class: 'align-middle', orderable: false },
                    {data: 'action', name: 'action',  class: 'align-middle', orderable: false, searchable: false},
                ]
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
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).data('id');
                        $.ajax({
                        url: "{!! url('admin/tour/faqs' ) !!}"+"/"+ id,
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
        });



        $(document).on('click', '.btn-faqs-user', function () {
            $('#showFormCreate').modal('show');
            var tour_id = document.getElementById('form1').value;
            $('#tour_id').val(tour_id);
        });

        $(document).on('click', function(event) {
            if (!event.target.closest("#showFormCreate")) {
                $('.err-question-name').html('');
                $('.err-answer-name').html('');
            }
        })

        $('.btn-save').click(function(e){
            e.preventDefault()
            var question = $('#question-store').val();
            var answer = $('#answer-store').val();
            var tour_id = $('#tour_id').val();
            var flag = true;
            if(question.length == 0){
                flag = false;
                $('.err-question-name').html('{{ __('validation.required', ['attribute' => 'question']) }}');
            } else if (question.length > 250)
            {
                flag = false;
                $('.err-question-name').html('{{ __('validation.max.string', ['attribute' => 'question', 'max' => 250]) }}');
            } else {
                $('.err-question-name').html('')
            }

            if(answer.length == 0){
                flag = false;
                $('.err-answer-name').html('{{ __('validation.required', ['attribute' => 'answer']) }}');
            } else if (answer.length > 500)
            {
                flag = false;
                $('.err-answer-name').html('{{ __('validation.max.string', ['attribute' => 'answer', 'max' => 500]) }}');
            } else{
                $('.err-answer-name').html('')
            }

            if(flag == true) {
                $.ajax({
                    url: "{{ route('faqs.store') }}",
                    type: 'POST',
                    datatype:"json",
                    data: {
                        question: question,
                        answer: answer,
                        tour_id: tour_id,

                        _token: '{!! csrf_token() !!}'
                    },
                    success: function(res) {
                        if (res == 1) {
                            $('#showFormCreate').modal('hide');
                            $("#faqsStore")[0].reset();
                            toastr.success("Lưu dữ liệu thành công.");
                            $('#example').DataTable().ajax.reload();
                        } else {
                            $('#showFormCreate').modal('show');
                            $('.err-question-name').html('{{ __('validation.unique', ['attribute' => 'question']) }}');
                        }
                    },
                });
            }
        });

        $(document).on('click', '.btn-edit', function () {
            $('#showFormUpdate').modal('show');
            let href = $(this).data('href');
            $.ajax({
                type: 'GET',
                url: href,
                success: function(res){
                    console.log(res.data);
                    $('#showFormUpdate').modal('show');
                    $('#tour-id').val(res.data.tour_id);
                    $('#question_update').val(res.data.question);
                    $('#answer_update').html(res.data.answer);
                    $('#faqs-id').val(res.data.id);

                }
            });
        });

        $('.btn-update').click(function(e){
            e.preventDefault()
            var question = $('#question_update').val();
            var answer = $('#answer_update').val();
            var tour_id = $('#tour_id').val();
            var id = $('#faqs-id').val();
            var flag = true;
            if(question.length == 0){
                flag = false;
                $('.error-question-name').html('{{ __('validation.required', ['attribute' => 'question']) }}');
            } else if (question.length > 250)
            {
                flag = false;
                $('.error-question-name').html('{{ __('validation.max.string', ['attribute' => 'question', 'max' => 250]) }}');
            } else{
                $('.error-question-name').html('')
            }

            if(answer.length == 0){
                flag = false;
                $('.error-answer-name').html('{{ __('validation.required', ['attribute' => 'answer']) }}');
            } else if (answer.length > 500)
            {
                flag = false;
                $('.error-answer-name').html('{{ __('validation.max.string', ['attribute' => 'answer', 'max' => 500]) }}');
            } else{
                $('.error-answer-name').html('')
            }

            if(flag == true) {
                let url2 = "{{ route('faqs.update', ':id') }}";
                let url3 = url2.replace(':id', id);
                $('#showFormUpdate').modal('hide');
                $.ajax({
                    url: url3,
                    type: 'PUT',
                    datatype:"json",
                    data: {
                        question: question,
                        answer: answer,
                        tour_id: tour_id,
                        _token: '{!! csrf_token() !!}',
                    },
                    success: function(res){
                        if (res == 1) {
                            toastr.success("Sửa dữ liệu thành công.");
                            $('#example').DataTable().ajax.reload();
                        } else {
                            toastr.error("Update data fail.");
                        }
                    },
                });
            }
        });

        $(document).on('click', function(event) {
            if (!event.target.closest("#showFormUpdate")) {
                $('.error-question-name').html('');
                $('.error-answer-name').html('');
            }
        })

        $('.btn-close').on('click', function() {
            $("#faqsStore")[0].reset();
            $('.err-question-name').html('');
            $('.err-answer-name').html('');
        });

        $('.close-form-update').on('click', function() {
            $("#faqsStore")[0].reset();
            $('.error-question-name').html('');
            $('.error-answer-name').html('');
        });
    </script>
    @endsection
