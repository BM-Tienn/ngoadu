<div class="modal fade" id="showContactDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Tin nhắn</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 mr-5 pb-3" style="background: white">
                    <div class="row mt-3 pl-3 pt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="font-weight-bold">Tên</p>
                                <h6 class="color-black font-weight-normal" id="name_contact"></h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="font-weight-bold">Email</p>
                                <h6 class="color-black font-weight-normal" id="email_contact"></h6>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 pl-3 pt-3" >
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="font-weight-bold">Số điện thoại</p>
                                <h6 class="color-black font-weight-normal" id="phone_contact"></h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="font-weight-bold">Thời gían</p>
                                <h6 class="color-black font-weight-normal" id="created_at"></h6>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 pl-3 pt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p class="font-weight-bold">Tin nhắn</p>
                                <p class="h6 font-weight-normal color-black" id="message"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>
<style>
     h6{color: black}
    .h6{color: black}
    .modal-content{width: 150%; margin-left: -15%}
</style>
