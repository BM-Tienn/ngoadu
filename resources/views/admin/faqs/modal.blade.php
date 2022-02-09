<div class="modal fade" id="showFormCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id="faqsStore" method="POST">
                <input type="hidden" name="tour_id" id="tour_id" value="">
                <!-- rows -->
                <!-- rows -->
                <div class="row pl-3 pt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <p class="font-weight-bold">Câu hỏi</p>
                            <input type="text" id="question-store" name="question" value="{{ old('question') }}" class="form-control w-100 form-control-lg @error('question') is-invalid @enderror" required style="color:black;font-size:13px">
                            <div class="err-question-name mt-1 text-danger"></div>
                        </div>
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row pl-3 pt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <p class="font-weight-bold">Trả lời</p>
                            <textarea name="answer" id="answer-store" class="form-control w-100 @error('answer') is-invalid @enderror" rows="7">{{ old('answer') }}</textarea>
                            <div class="err-answer-name mt-1 text-danger"></div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary btn-save px-3">Lưu</button>
            <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Đóng</button>
        </div>
    </form>
    </div>
</div>
</div>
<div class="modal fade" id="showFormUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sửa câu hỏi thường gặp</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="faqsUpdate">
                    <input type="hidden" name="tour_id" id="tour-id" value="">
                    <input type="hidden" name="id" id="faqs-id" value="">
                    <!-- rows -->
                    <!-- rows -->
                    <div class="row pl-3 pt-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p class="font-weight-bold">Câu hỏi</p>
                                <input type="text" name="question" id="question_update" value="" class="form-control w-100 form-control-lg @error('question') is-invalid @enderror" required style="color:black; font-size:13px"">
                                <div class="error-question-name mt-1 text-danger"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end rows -->
                    <!-- rows -->
                    <div class="row pl-3 pt-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p class="font-weight-bold">Trả lời</p>
                                <textarea id="answer_update" name="answer" class="form-control w-100 @error('answer') is-invalid @enderror" rows="7" id="answer"></textarea>
                                <div class="error-answer-name mt-1 text-danger"></div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="myButton" class="btn btn-primary px-3 btn-update">Lưu</button>
                <button type="button" class="btn btn-secondary close-form-update" data-dismiss="modal">Đóng</button>
            </div>
        </form>
      </div>
    </div>
</div>

<script type="text/javascript">

    function checkForm(form)
    {
        form.myButton.disabled = true;
        form.myButton.value = "Please wait...";
        return true;
    }

    function resetForm(form)
    {
        form.myButton.disabled = false;
        form.myButton.value = "Submit";
    }

    function myFunction() {
    var x = document.getElementById("password");
    var z = document.getElementById("confirm_password");
    if (x.type === "password") {
        x.type = "text";
        z.type = 'text';
    } else {
        x.type = "password";
        z.type = "password";
        }
    }
</script>
