@extends('customer.layout.master')
@section('title', 'New Password')
@section ('bottom-js')
	
@endsection
@section ('auth')
 		<div class="admin-sidebar-secondary">
            <div class="admin-sidebar-secondary-inner">
                <div class="admin-sidebar-secondary-inner-top">
                    <h1>New Password</h1>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form method="post" action="{{route('customer.reset', $locale)}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="token" value="{{ $token }}">


                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="E-mail" required value="{{ $email or old('email') }}">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required value="1234567">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmed Password" required value="1234567">
                        </div>
                        <!-- /.form-group -->

                        <button type="submit" class="btn btn-xl pull-right"> <i class="fa fa-user-plus"></i> Reset</button>
                    </form>
                </div>
                <!-- /.admin-sidebar-secondary-inner-top -->

                <div class="admin-sidebar-secondary-inner-bottom">
                    @include('customer.auth.footer', ['locale'=>$locale, 'page'=>'register'])
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