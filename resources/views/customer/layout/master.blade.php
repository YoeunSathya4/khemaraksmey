<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,300,500,700&amp;subset=latin,latin-ext">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Montserrat:400,700">

    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/people/assets/libraries/Font-Awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/people/assets/libraries/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/people/assets/libraries/bootstrap-fileinput/css/fileinput.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/people/assets/libraries/nvd3/nv.d3.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/people/assets/libraries/OwlCarousel/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/people/assets/css/realsite-admin.css')}}">
    @yield('tab-css')
    <link href="{{ asset ('public/frontend/sweet-alert/sweetalert.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <title>@yield('title')</title>
    
</head>

<body class="@yield('classOpen')">
    
    @yield('landing')

    <div class="admin-wrapper">
        
        @yield('menu')
        
        <!-- /.admin-navigation -->

        <div class="admin-content">
            <div class="admin-content-image-text">
                <h1>Welcome to PinkHomeDelivery</h1>
                <h2>Please enter your e-mail and password to login.</h2>
            </div>
            <!-- /.admin-content-image-text -->

            @yield('app')
            
            <!-- /.admin-content-inner -->
        </div>
        <!-- /.admin-content -->

        @yield('auth')
        <!-- /.admin-sidebar-secondary -->
    </div>
    <!-- /.admin-landing-wrapper -->

    <script type="text/javascript" src="{{ asset('public/frontend/people/assets/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/people/assets/libraries/jquery-transit/jquery.transit.js')}}"></script>

    <script type="text/javascript" src="{{ asset('public/frontend/people/assets/libraries/bootstrap/assets/javascripts/bootstrap/transition.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/people/assets/libraries/bootstrap/assets/javascripts/bootstrap/dropdown.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/people/assets/libraries/bootstrap/assets/javascripts/bootstrap/collapse.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/people/assets/libraries/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/people/assets/libraries/bootstrap-fileinput/js/fileinput.min.js')}}"></script>

    <script type="text/javascript" src="{{ asset('public/frontend/people/assets/libraries/autosize/jquery.autosize.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/people/assets/libraries/isotope/dist/isotope.pkgd.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/people/assets/libraries/OwlCarousel/owl-carousel/owl.carousel.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/people/assets/libraries/jquery.scrollTo/jquery.scrollTo.min.js')}}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  
    <script type="text/javascript" src="{{ asset('public/frontend/people/assets/libraries/nvd3/lib/d3.v3.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/people/assets/libraries/nvd3/nv.d3.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/people/assets/libraries/nvd3/examples/stream_layers.js')}}"></script>

    <script type="text/javascript" src="{{ asset('public/frontend/people/assets/js/realsite-admin.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/sweet-alert/sweetalert.js')}}"></script>
    @yield('bottom-js')
    <script type="text/javascript">
        function deleteConfirm(url, redirect){
            swal({
                                    title: "Are you sure you want to delete?",
                                    text: "",
                                    type: "warning",
                                    showCancelButton: true,
                                    cancelButtonClass: "btn-default",
                                    confirmButtonClass: "btn-warning",
                                    confirmButtonText: "Yes!",
                                    closeOnConfirm: false
                                },
                                function(){
                                    // swal({
                                    //  title: "Deleted!",
                                    //  text: "Data has been deleted.",
                                    //  type: "success",
                                    //  confirmButtonClass: "btn-success"
                                    // });
                                    //alert('deleted');

                                    $.ajax({
                                    url: url,
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    type: 'DELETE',
                                    data: {},
                                    success: function( response ) {
                                        if ( response.status === 'success' ) {
                                            window.location.replace(redirect);
                                            //toastr.success( response.msg );
                                            // setInterval(function() {
                                            //     window.location(redirect);
                                            // }, 5900);
                                        }
                                    },
                                    error: function( response ) {
                                        if ( response.status === 422 ) {
                                            toastr.error('Cannot delete the category');
                                        }
                                    }
                                });
            });
        }   
    </script>
    @if(Session::has('msg'))
    <script type="text/JavaScript">
        toastr.success("{!!Session::get('msg')!!}");
    </script>
    @endif
</body>

</html>