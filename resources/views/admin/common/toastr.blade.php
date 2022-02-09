<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
        case 'info':
        toastr.options.positionClass = 'toast-top-right';
        toastr.info("{{ Session::get('message') }}");
        toastr.options.timeOut = 4000;
        break;
    
        case 'warning':
        toastr.options.positionClass = 'toast-top-right';
        toastr.options.timeOut = 4000;
        toastr.warning("{{ Session::get('message') }}");
        break;
    
        case 'success':
        toastr.options.positionClass = 'toast-top-right';
        toastr.options.timeOut = 4000;
        toastr.success("{{ Session::get('message') }}");
        break;
    
        case 'error':
        toastr.options.positionClass = 'toast-top-right';
        toastr.options.timeOut = 4000;
        toastr.error("{{ Session::get('message') }}");
        break;
        }
    @endif
</script>