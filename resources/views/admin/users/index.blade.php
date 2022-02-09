@extends("layouts.master")
@section("do-du-lieu")

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="page-breadcrumb" style="margin-top: -20px; margin-left:-20px">
    <div class="row">
        <div class="col-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background: #EEF5F9;">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}" title="Dashboard">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User</li>
                    </ol>
                </nav>
            </div>
        </div>
        
    </div>
</div>
<div class="mt-3 px-3 pt-2 pb-5" style="background: white">
  <div class="row mt-3 mb-3">
    <div class="col-md-3">
        <div class="form-group">
            <label>Search</label>
            <input type="text" id="form1"  class="form-control" placeholder="search..." />
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Role</label>
            <select class="form-control w-100" id="role" style="padding: 5px 25px">
                <option value="all">All</option>
                <option value="0">Employee</option>
                <option value="1">Manage</option>
            </select>
        </div>
    </div>
    <div class="col-md-7 text-right">
        <div class="form-group pr-3 pt-4">
            <button type="button" class="btn btn-primary mt-4 btn-create-user"><i class="fa fa-plus mr-1"></i> Create user</button><br>

        </div>
    </div>
</div>
    <table  id="example" class="table table-striped table-bordered data-table" style="color:black">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
           
        </tbody>
    </table>
</div>
@include('admin.users.modal')
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
                    url: '{{ route('user.list') }}',
                    data : function(d) {
                        d.filter_search = $('#form1').val(),
                        d.role = $('#role').val()
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',  class: 'align-middle', orderable: false },
                    { data: 'name', name: 'name',  class: 'align-middle', orderable: false },
                    { data: 'email', name: 'email',  class: 'align-middle', orderable: false },
                    { data: 'role', name: 'role',  class: 'align-middle', orderable: false },
                    {data: 'action', name: 'action', class: 'align-middle', orderable: false, searchable: false},
                ]
            });
            $('#form1').on('keyup', function () {
                datatable.draw();
            });
            $('#role').on('change', function () {
                datatable.draw();
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
                        url: "{!! url('admin/user' ) !!}"+"/"+ id,
                        type:'POST',
                        dataType:'json',
                        data:{
                            "_token": "{{ csrf_token() }}",
                            _method: 'delete'
                        },

                        success: function(res) {
                            if (res == 1) {
                                toastr.success("Delete data successfully.");
                            } else {
                                toastr.error("You cannot delete your account.");
                            }
                            $('#example').DataTable().ajax.reload();
                        }
                    })
                }
                })
        });

        $(document).on('click', '.btn-create-user', function () {
            $('#showFormCreate').modal('show');
        });

        $(document).on('click', function(event) {
            if (!event.target.closest("#showFormCreate")) {
                $("#userCreate")[0].reset();
                $('.err-email').html('');
                $('.err-name').html('');
            }
        })

        $('.btn-save').click(function(e){
            e.preventDefault()
            var name = $('#name_store').val();
            var email = $('#email_store').val();
            var role = $('#role_store').val();
            var flag = true;
            if(name.length == 0){
                flag = false;
                $('.err-name').html('{{ __('validation.required', ['attribute' => 'name']) }}');
            } else if (name.length > 200) {
                flag = false;
                $('.err-name').html('{{ __('validation.max.string', ['attribute' => 'name', 'max' => 200]) }}');
            } else{
                $('.err-name').html('');
            }

            if (!validateEmail(email) || email.length < 10) {
                flag = false;
                $('.err-email').html('{{ __('validation.required', ['attribute' => 'email']) }}');
            } else if (email.length > 200) {
                flag = false;
                $('.err-email').html('{{ __('validation.max.string', ['attribute' => 'name', 'max' => 200]) }}');
            } else{
                $('.err-email').html('')
            }

            if(flag == true) {
                $.ajax({
                    url: "{{ route('user.store') }}",
                    method: 'POST',
                    datatype:"json",
                    data: {
                        name: name,
                        email: email,
                        role: role,
                        _token: '{!! csrf_token() !!}'
                    },
                    success: function(res){
                        if (res == 1) {
                            $('#showFormCreate').modal('hide');
                            $('#example').DataTable().ajax.reload();
                            $("#userCreate")[0].reset()
                            toastr.success("Store data successfully.");
                        } else {
                            $('#showFormCreate').modal('show');
                            $('.err-email').html('{{ __('validation.unique', ['attribute' => 'email']) }}');
                        }
                    },
                });
            }
        });

        $(document).on('click', '.btn-user-update', function () {
            let href = $(this).data('href');
            $.ajax({
                type: 'GET',
                url: href,
                success: function(res){
                    $('#showFormUpdate').modal('show');
                    $('#user_name').val(res.data.name);
                    $('#user_email').val(res.data.email);
                    $('#id').val(res.data.id);
                    if (res.data.role == 1) {
                        $('#manage').attr('selected','selected');
                    } else {
                        $('#employee').attr('selected','selected'); 
                    }


                }
            });
        });

        $(document).on('click', function(event) {
            if (!event.target.closest("#showFormUpdate")) {
                $('.error-name').html('');
            }
        })

        $('.btn-update').click(function(e){
            e.preventDefault()
            var name = $('#user_name').val();
            var role = $('#role_update').val();
            var id = $('#id').val();
            var flag = true;
            if(name.length == 0){
                flag = false;
                $('.error-name').html('{{ __('validation.required', ['attribute' => 'name']) }}');
            } else if (name.length > 200) {
                flag = false;
                $('.error-name').html('{{ __('validation.max.string', ['attribute' => 'name', 'max' => 200]) }}');
            } else{
                $('.error-name').html('');
            }

            if(flag == true){
                let url2 = "{{ route('user.update', ':id') }}";
                let url3 = url2.replace(':id', id);
                $('#showFormUpdate').modal('hide');
                $.ajax({
                    url: url3,
                    type: 'PUT',
                    datatype:"json",
                    data: {
                        name: name,
                        role: role,
                        _token: '{!! csrf_token() !!}',
                       
                    },
                    success: function(res){
                        console.log(res)
                        if (res == 1) {
                            toastr.success("Update data successfully.");
                            $('#example').DataTable().ajax.reload();
                        } else {
                            toastr.error("Update data fail.");
                        }
                    },
                });
            }
        });

        $('.btn-close').on('click', function() {
            $("#userCreate")[0].reset();
            $('.err-email').html('');
            $('.err-name').html('');
        });

        $('.close-form-update').on('click', function() {
            $('.error-name').html('');
        });

        function validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
        </script>
@endsection