@extends('customer.layout.master')
@section('title', 'Register')
@section ('bottom-js')
	
@endsection
@section ('auth')
 		<div class="admin-sidebar-secondary">
            <div class="admin-sidebar-secondary-inner">
                <div class="admin-sidebar-secondary-inner-top">
                    <h1>Register as Mentor</h1>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form method="post" action="{{route('customer.register',$locale)}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">



                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Please Enter Full Name" required value="Yoeun Sathya">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number. E.g 0965415794" required value="0965415794">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="E-mail" required value="yoeunsathya4@gmail.com">
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required value="123456">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmed Password" required value="123456">
                        </div>
                        <!-- /.form-group -->

                        <button type="submit" class="btn btn-xl pull-right"> <i class="fa fa-user-plus"></i> Register</button>
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