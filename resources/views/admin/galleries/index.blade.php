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
                        <li class="breadcrumb-item"><a href="{{ route('tour.index') }}" title="Tour Management">Tour</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Gallery</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<form method="POST" onsubmit="return checkForm(this);" enctype="multipart/form-data" action="{{ route('gallery.store', ['tour_id' => $tour_id] ) }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @csrf
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="form-group">
                <label>Album ảnh</label>
                <input type="file" id="file-input" class="w-100 p-1 @error('images') is-invalid @enderror" name="images[]" multiple>
                @error('images')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-3 mt-3">
            <div class="form-group pt-3">
                <button type="submit" name="myButton" class="btn btn-primary px-3">Save</button>
            </div>
        </div>
    </div>

</form>
<div id="preview"></div>
            <div class="row mt-5">
                <table id="example" class="table table-striped table-bordered data-table">
                    <tbody>
                    </tbody>
                </table>
                @foreach ($data as $rows)
                <div class="col-3 mt-3" id="image-{{$rows->id}}">
                    <img src="{{ asset('upload/tour/gallery/'. $rows->image) }}" width="100%" height="250px" style="position: relative; object-fit: cover">
                    <div style="position: absolute; bottom: 10px; right:30px; z-index:99" >
                        <i style="cursor: pointer" class="fa fa-trash-alt btn-delete album text-white" data-href="{{ route('gallery.destroy',['gallery'=>$rows->id]) }}" data-album-id="{{ $rows->id }}"></i>
                    </div>
                </div>
                @endforeach
            </div>
    <script>
        $(document).ready(function(){
            $(document).on('click', '.btn-delete', function(e) {
                console.log('clickbtn');
                e.preventDefault();

                var me = $(this),
                    url = me.data('href')

                swal.fire({
                    text: 'Do you want delete it?',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: url,
                            type:'POST',
                            dataType:'json',
                            data:{
                                "_token": "{{ csrf_token() }}",
                                _method: 'delete'
                                },
                            success: function (result) {
                                if(result > 0) {
                                    $('#image-'+result).remove();
                                    toastr.success('Delete data successful')

                                } else {
                                    toastr.error('Delate data fail.')
                                }
                            },
                        });
                    }
                });
            });
        });
    </script>
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

        function previewImages() {
        var preview = document.querySelector('#preview');
            if (this.files) {
            [].forEach.call(this.files, readAndPreview);
            }

            function readAndPreview(file) {
                if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                    return alert(file.name + " is not an image");
                }
            var reader = new FileReader();
            reader.addEventListener("load", function() {
                var image = new Image();
                image.height = 80;
                image.width = 80;
                image.title  = file.name;
                image.src    = this.result;
                preview.appendChild(image);
            });
            reader.readAsDataURL(file);
            }
        }
            document.querySelector('#file-input').addEventListener("change", previewImages);
      </script>
      <style>
          #preview img{margin-right:15px; object-fit: cover}
      </style>
   @endsection
