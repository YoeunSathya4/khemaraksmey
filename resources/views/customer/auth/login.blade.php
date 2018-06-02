@extends('customer.layout.master')
@section('title', 'Customer Login')
@section ('bottom-js')
	
@endsection
@section ('auth')
 		<div class="admin-sidebar-secondary">
            <div class="admin-sidebar-secondary-inner">
                <div class="admin-sidebar-secondary-inner-top">
                    <h1>Customer Log In</h1>
                    @if ($errors->has('email'))
                        <div style="margin: 0 auto">
                            <div class="alert alert-danger alert-no-border alert-close alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ $errors->first('email') }}
                            </div>  
                        </div>
                    @endif
                    <form method="post" action="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="E-mail" required value="">
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required value="">
                        </div>
                        <!-- /.form-group -->

                        <button type="submit" class="btn btn-xl pull-right"><i class="fa fa-sign-in"></i> Login</button>
                    </form>
                </div>
                <!-- /.admin-sidebar-secondary-inner-top -->

                <div class="admin-sidebar-secondary-inner-bottom">

                    @include('customer.auth.footer', ['page'=>'login'])
                    <!-- /.admin-landing-content-footer -->
                </div>
                <!-- /.admin-sidebar-secondary-inner-bottom -->
            </div>
            <!-- /.admin-sidebar-secondary-inner -->
        </div>
        @if(Auth::guard('customer')->user())
        <script type="text/JavaScript">
        window.location.replace('{{ route('customer.profile',$locale) }}');
        </script>
         @endif
@endsection

@section ('landing')
<div class="admin-landing-image-source"></div>
<div class="admin-landing-image-cover"></div>
@endsection