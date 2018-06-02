@extends('customer.layout.master')
@section('title', 'Forgot Password')
@section ('bottom-js')
	
@endsection
@section ('auth')
 		<div class="admin-sidebar-secondary">
            <div class="admin-sidebar-secondary-inner">
                <div class="admin-sidebar-secondary-inner-top">
                    <h1>Forgot Password</h1>
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
                    <form method="post" action="{{route('customer.make-forgot-password-code', $locale)}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Enter Your E-mail" required value="">
                        </div>
                        <button type="submit" class="btn btn-xl pull-right"> <i class="fa fa-envelope"></i> Get Reset Link</button>
                    </form>
                </div>
                <!-- /.admin-sidebar-secondary-inner-top -->

                <div class="admin-sidebar-secondary-inner-bottom">
                    @include('customer.auth.footer', ['locale'=>$locale, 'page'=>'forgot-password'])
                    <!-- /.admin-landing-content-footer -->
                </div>
                <!-- /.admin-sidebar-secondary-inner-bottom -->
            </div>
            <!-- /.admin-sidebar-secondary-inner -->
        </div>
@endsection

@section ('landing')
<div class="admin-landing-image-source"></div>
<div class="admin-landing-image-cover"></div>
@endsection