@extends('customer.layout.master')
@section ('classOpen', 'open') 

@section ('app')                
           <div class="admin-content-inner">
                <div class="admin-content-header">
                    <div class="admin-content-header-inner">
                        <div class="container-fluid">
                            <div class="admin-content-header-logo">
                                <a href="#"> PINKHOMEDELIVERY  </a>
                            </div>
                            <!-- /admin-content-header-logo -->

                            <div class="admin-content-header-menu">
                                <ul class="admin-content-header-menu-inner collapse">
                                    <li><a href="#">Documentation</a></li>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Support</a></li>
                                    <li><a href="{{ route('customer.logout',$locale) }}">Logout</a></li>
                                </ul>

                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".admin-content-header-menu-inner">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <!-- /.admin-content-header-menu  -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- /.admin-content-header-inner -->
                </div>
                <!-- /.admin-content-header -->

                <div class="admin-content-main">
                    <div class="admin-content-main-inner">
                        <div class="container-fluid">
                           @yield('content')
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- /.admin-content-main-inner -->
                </div>
                <!-- /.admin-content-main -->

                <div class="admin-content-footer">
                    <div class="admin-content-footer-inner">
                        <div class="container-fluid">
                            <div class="admin-content-footer-left">
                                &copy; 2018 PINKHOMEDELIVERY - Online Consulting Platform. All rights reserved.
                            </div>
                            <!-- /.admin-content-footer-left -->

                            <div class="admin-content-footer-right">
                                Supported by <a href="">PINKHOMEDELIVERY</a>
                            </div>
                            <!-- /.admin-content-footer-right -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- /.admin-content-footer-inner -->
                </div>
                <!-- /.admin-content-footer -->
            </div>

@endsection

@section ('menu')
       <div class="admin-navigation">               
            <div class="admin-navigation-inner">
                <nav>
                    <ul class="menu">
                        <li class="avatar">
                            <a href="#">
                                <img src="{{ asset(Auth::guard('customer')->user()->image) }}" alt="">

                                <span class="avatar-content">
                                <span class="avatar-title">{{Auth::guard('customer')->user()->name}}</span>
                                </span>
                                <!-- /.avatar-content -->
                            </a>
                        </li>

                        <li class="">
                            <a href="#"><strong><i class="fa fa-dashboard"></i></strong> <span>Dashboard</span></a>
                        </li>
                        <li class="@yield('active-manu-profile')">
                            <a href="{{ route('customer.profile',$locale) }}"><strong><i class="fa fa-user"></i></strong> <span>Profile</span></a>
                        </li>
                        <li class="@yield('active-manu-order')">
                            <a href="{{ route('customer.order',$locale) }}"><strong><i class="fa fa-user"></i></strong> <span>Oder</span></a>
                        </li>
                    </ul>
                </nav>

                <div class="projects">
                    <h2>Quick Links</h2>

                   
                </div>
                
            </div>
            <!-- /.admin-navigation-inner -->
        </div>
@endsection