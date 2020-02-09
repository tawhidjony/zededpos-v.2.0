    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="{{asset('assets/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('https://code.jquery.com/jquery-migrate-1.4.1.js')}}"></script>

    <!-- Popper.JS -->
    <script src="{{asset('assets/new-theme/js/popper.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{asset('assets/new-theme/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/new-theme/js/main.js')}}"></script>
    <script src="{{asset('assets/new-theme/js/gijgo.min.js')}}"></script>


    <!-- waves effect js -->
    <script src="{{asset('js/waves.js')}}"></script>
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
    <!--notification js -->
    <script src="{{asset('assets/notifications/js/lobibox.min.js')}}"></script>
    <script src="{{asset('assets/notifications/js/notifications.min.js')}}"></script>
    <script src="{{asset('assets/notifications/js/notification-custom-script.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/js/adminlte.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('assets/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.js')}}"></script>
 
    <script src="{{asset('js/select2.min.js')}}"></script>

@stack('js')

<script>
    

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    @if (Session::has('message'))
    var type = "{{Session::get('alert-type','success')}}"
    var message = "{{Session::get('message')}}";
    notification(type, message);

    @endif
    function notification(type, message) {
        if (type == "success")
            image = 'fa fa-check-circle';
        else if (type == "error")
            image = 'fa fa-times-circle';
        else
            image = 'fa fa-info-circle';
        Lobibox.notify(type, {
            pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
            icon: image,
            sound: false,
            position: 'top right',
            showClass: 'zoomIn',
            hideClass: 'zoomOut',
            size: 'mini',
            rounded: true,
            width: 250,
            height: 'auto',
            delay: 2000,
            msg: message,

        });
    };

    function deleteWithSweetAlert(event, form) {
        event.preventDefault(); // prevent form submit
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                } else {
                }
            });
    };


 
</script>