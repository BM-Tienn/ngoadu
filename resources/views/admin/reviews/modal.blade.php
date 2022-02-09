<div class="modal fade" id="showReviewDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Đánh giá chuyến du lịch</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 mr-5 pb-3" style="background: white">
                    <div class="row mt-3 pl-3 pt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p class="font-weight-bold">Chuyến du lịch</p>
                                <h6 class="color-black font-weight-normal" id="tour_title"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 pl-3 pt-3">
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <p class="font-weight-bold">Assessor</p>
                                <h6 class="color-black font-weight-normal" id="assessor"></h6>
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="font-weight-bold">Đánh giá</p>
                                <h6 class="color-black font-weight-normal"><strong id="star_review"></strong> <i class="fa fa-star" style="color: green"></i></h6>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 pl-3 pt-3" >
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="font-weight-bold">Trạng thái</p>
                                <button id="status_review"></button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="font-weight-bold">Thời gian</p>
                                <h6 class="color-black font-weight-normal" id="created_at"></h6>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 pl-3 pt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p class="font-weight-bold">Bình luận</p>
                                <p class="h6 font-weight-normal color-black" id="comment"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                h6{color: black}
                .h6{color: black}
                .modal-content{width: 150%; margin-left: -15%}

            </style>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>
