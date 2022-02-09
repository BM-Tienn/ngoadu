<div class="modal fade" id="showFormCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
         
        </div>
        <div class="modal-body">
        <form id="userCreate">
           <!-- rows -->
           <div class="row mt-1 pl-3 pt-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <p class="font-weight-bold">Name</p>
                        <input type="text" id="name_store" value="{{ old('name') }}" name="name" class="form-control w-100 form-control-lg @error('name') is-invalid @enderror" style="color:black;font-size:15px">
                        <div class="err-name mt-1 text-danger"></div>
                    </div>
                </div>
           </div>

            <div class="row pl-3 pt-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <p class="font-weight-bold">Email</p>
                        <input type="emal" id="email_store" value="{{ old('email') }}" name="email" class="form-control w-100 form-control-lg @error('email') is-invalid @enderror" style="color:black;font-size:15px;">
                        <div class="err-email mt-1 text-danger"></div>
                    </div>
                </div>
            </div>
        <!-- end rows -->
         <!-- rows -->
            <div class="row mt-1 pl-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <p class="font-weight-bold">Role</p>
                        <select name="role" id="role_store" style="padding: 7px 40px; border:1px solid black; border-radius:5px">
                            <option value="0" @if (old('role') == "0") {{ 'selected' }} @endif>Employee</option>
                            <option value="1" @if (old('role') == "1") {{ 'selected' }} @endif>Manage</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button name="myButton" class="btn btn-primary btn-save px-3">Save</button>
          <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
        </div>
    </form>
      </div>
    </div>
</div>
<div class="modal fade" id="showFormUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
        </div>
        <div class="modal-body">
            <form method="POST" id="formUserUpdate">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @csrf  
                @method('PUT')
           <!-- rows -->
           <div class="row mt-1 pl-3 pt-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <p class="font-weight-bold">Name</p>
                        <input type="text" id="user_name" value="" name="name" class="form-control w-100 form-control-lg @error('name') is-invalid @enderror" required style="color:black;font-size:15px">
                        <div class="error-name mt-1 text-danger"></div>
                    </div>
                </div>
           </div>

            <div class="row pl-3 pt-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <p class="font-weight-bold">Email</p>
                        <input type="emal" id="user_email" value="" name="email" class="form-control w-100 form-control-lg @error('email') is-invalid @enderror" disabled style="color:black;font-size:15px;">
                    </div>
                </div>
            </div>

        <!-- end rows -->
         <!-- rows -->
            <div class="row mt-1 pl-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <p class="font-weight-bold">Role</p>
                        <select name="role" id="role_update" style="padding: 7px 40px; border:1px solid black; border-radius:5px">
                                <option value="0" id="employee">Employee</option>
                                <option value="1" id="manage">Manage</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" id="id" value="">
        </div>
        <div class="modal-footer">
            <button name="myButton" class="btn btn-primary btn-update px-3">Update</button>
          <button type="button" class="btn btn-secondary close-form-update" data-dismiss="modal">Close</button>
        </div>
    </form>
      </div>
    </div>
</div>
