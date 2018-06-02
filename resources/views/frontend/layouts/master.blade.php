<!doctype html>
<html class="no-js" lang="en">

    <!-- Mirrored from techlinqs.com/html/bookstore-0.2/bookstore-ltr/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Feb 2018 15:56:52 GMT -->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="author" content=""/>
        
            <!-- Title Of Site -->
            <title>@yield('title')</title>
            
        <!-- StyleSheets -->
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/bootstrap/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/animate.css')}}">
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/icomoon.css')}}">
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/main.css')}}">
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/color-1.css')}}">
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/style.css')}}">
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/responsive.css')}}">
        <link rel="stylesheet" href="{{ asset ('public/frontend/css/transition.css')}}">

        <!-- Online Lib -->
        <link rel="stylesheet" href="{{ asset ('public/frontend/../../../../www.atlasestateagents.co.uk/css/tether.min.css')}}">
        <script src="{{ asset ('public/frontend/../../../../www.atlasestateagents.co.uk/javascript/tether.min.js')}}"></script>

        <!-- Switcher CSS -->
        <link href="{{ asset ('public/frontend/switcher/switcher.css')}}" rel="stylesheet" type="text/css"/> 
        <link rel="stylesheet" id="skins" href="{{ asset ('public/frontend/css/default.css')}}" type="text/css" media="all">

        <!-- FontsOnline -->
        <link href='https://fonts.googleapis.com/css?family=Merriweather:300,300italic,400italic,400,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic,900italic,900,100italic,100' rel='stylesheet' type='text/css'>

        <!-- JavaScripts -->
        <script src="{{ asset ('public/frontend/js/vendor/modernizr.js')}}"></script>
    </head>
<body>
    <!-- Wrapper -->
<div class="wrapper push-wrapper">

    <!-- Header -->
    <header id="header">
        
        <!-- Top Bar -->
        <div class="topbar">
            <div class="container">
                
                <!-- Online Option -->
                <div class="online-option">
                    <ul>
                        <li><a href="#">online store</a></li>
                        <li><a href="#">Payment</a></li>
                        <li><a href="#">shipping</a></li>
                        <li><a href="#">Return</a></li>
                    </ul>
                </div>
                <!-- Online Option -->

                <!-- Social Icons -->
                <div class="social-icons pull-right">
                    <ul>
                        <li>
                            <a href="#">
                                <img src="{{ asset ('public/frontend/images/khmer.png')}}">
                            </a>
                        </li>   
                        <li>
                            <a href="#"> 
                                <img src="{{ asset ('public/frontend/images/english.png')}}">
                            </a>
                        </li>   
                    </ul>
                </div>
                <!-- Social Icons -->

                <!-- Cart Option -->
                <div class="cart-option">
                    <ul>
                        <!-- <li class="add-cart"><a href="#"><i class="fa fa-shopping-bag"></i><span>3</span></a></li>
                        <li><a href="#"><i class="fa fa-heart-o"></i>wish List 0 items</a></li> -->
                        <li><a href="#" data-toggle="modal" data-target="#login-modal"><i class="fa fa-user"></i>Login / Register</a></li>
                    </ul>
                </div>
                <!-- Cart Option -->

            </div>
        </div>
        <!-- Top Bar -->

        <!-- Nav -->
        <nav class="nav-holder style-1">
            <div class="container">
                <div class="mega-dropdown-wrapper">

                    <!-- Logo -->
                    <div class="logo">
                        <a href="index-2.html"><img src="{{ asset ('public/frontend/images/logo-1.png')}}" alt=""></a>
                    </div>
                    <!-- Logo -->

                    <!-- Search bar -->
                    <div class="search-bar">
                        <a href="#"><i class="fa fa-search"></i></a>
                    </div>
                    <!-- Search bar -->

                    <!-- Responsive Button -->
                    <div class="responsive-btn">
                        <a href="#menu" class="menu-link circle-btn"><i class="fa fa-bars"></i></a>
                    </div>
                    <!-- Responsive Button -->

                    <!-- Navigation -->
                    <div class="navigation">
                        <ul>
                            
                            <li><a href="contact.html"><i class="fa fa-home"></i>Home</a></li>
                            <li><a href="contact.html"><i class="fa fa-home"></i>About Us</a></li>
                            <li><a href="contact.html"><i class="fa fa-shopping-bag"></i>Product</a></li>
                            <li><a href="contact.html"><i class="fa fa-bullhorn"></i>Promotion</a></li>
                            <li><a href="contact.html"><i class="fa fa-pencil"></i>News</a></li>
                            <li><a href="contact.html"><i class="fa fa-fax"></i>Contact Us</a></li>
                        </ul>
                    </div>
                    <!-- Navigation -->

                </div>
            </div>
        </nav>
        <!-- Nav -->

        <!--BANNER-->
        <div id="main-slider" class="main-slider">

            <!-- Item -->
            <div class="item">
                <img src="{{ asset ('public/frontend/images/banner/bg-1-1.jpg')}}" alt="">
            </div>
            <!-- Item -->

            <!-- Item -->
            <div class="item">
                <img src="{{ asset ('public/frontend/images/banner/bg-2.jpg')}}" alt="">
                
            </div>
            <!-- Item -->

        </div>
        <!--BANNER-->

    </header>
   
<!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>
    <!-- Main Content -->
    <!-- Footer -->
    <footer id="footer"> 

        <!-- Footer columns -->
        <div class="footer-columns">
            <div class="container">

                <!-- Columns Row -->
                <div class="row">
                    
                    <!-- Footer Column -->
                    <div class="col-lg-12 col-sm-12" style="text-align: center;">
                        <div class="footer-column logo-column">
                            <a href="index-1.html"><img src="{{ asset ('public/frontend/images/logo-2.png')}}" alt=""></a>
                            <p>Find out how to prepare your book for an editor with these 4 writing tips! The editing process can be a wonderful opportunity for writers.</p>
                            <ul class="address-list">
                                <li><i class="fa fa-home"></i>888 South Avenue Street, New York City.</li>
                                <li><i class="fa fa-phone"></i>00+123-456-789</li>
                                <li><i class="fa fa-envelope"></i>contact@onlinbookshops.com</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Column -->

                    
                        

                </div>
                <!-- Columns Row -->

            </div>
        </div>
        <!-- Footer columns -->
        
        <!-- Sub Footer -->
        <div class="sub-foorer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <p>Copyright <i class="fa fa-copyright"></i> 2017-2018 <span class="theme-color"> Khemarareaksmey Book Center</span> All Rights Reserved.</p>
                    </div>
                    <div class="col-sm-6">
                        <a class="back-top" href="#">Back to Top<i class="fa fa-caret-up"></i></a>
                        <ul class="cards-list">
                            <li><img src="{{ asset ('public/frontend/images/cards/img-01.jpg')}}" alt=""></li>
                            <li><img src="{{ asset ('public/frontend/images/cards/img-02.jpg')}}" alt=""></li>
                            <li><img src="{{ asset ('public/frontend/images/cards/img-03.jpg')}}" alt=""></li>
                            <li><img src="{{ asset ('public/frontend/images/cards/img-04.jpg')}}" alt=""></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sub Footer -->

    </footer>
    <!-- Footer -->

</div>
<!-- Wrapper -->

<!-- Slide Menu -->
<nav id="menu" class="responive-nav">
    <a class="r-nav-logo" href="index-2.html"><img src="{{ asset ('public/frontend/images/logo-1.png')}}" alt=""></a>
    <ul class="respoinve-nav-list">
        <li>
            <a class="triple-eff" data-toggle="collapse" href="#list-1"><i class="pull-right fa fa-angle-down"></i>Home</a>
            <ul class="collapse" id="list-1">
                <li><a href="index-2.html">home 1</a></li>
                <li><a href="index-3.html">home 2</a></li>
            </ul>
        </li>
        <li>
            <a class="triple-eff" data-toggle="collapse" href="#list-2"><i class="pull-right fa fa-angle-down"></i>Shop</a>
            <ul class="collapse" id="list-2">
                <li><a href="shop.html">shop</a></li>
                <li><a href="shop-detail.html">shop Detail</a></li>
            </ul>
        </li>
        <li>
            <a class="triple-eff" data-toggle="collapse" href="#list-3"><i class="pull-right fa fa-angle-down"></i>Blog</a>
            <ul class="collapse" id="list-3">
                <li><a href="blog-all-views.html">blog all views</a></li>
                <li><a href="blog-larg.html">blog Larg</a></li>
                <li><a href="blog-list.html">blog List</a></li>
                <li><a href="blog-grid.html">blog Grid</a></li>
                <li><a href="blog-detail.html">blog detail</a></li>
            </ul>
        </li>
        <li>
            <a class="triple-eff" data-toggle="collapse" href="#list-4"><i class="pull-right fa fa-angle-down"></i>Pages</a>
            <ul class="collapse" id="list-4">
                <li><a href="about.html">about</a></li>
                <li><a href="gallery.html">gallery</a></li>
                <li><a href="event-list.html">event list</a></li>
                <li><a href="event-detail.html">event detail</a></li>
                <li><a href="book-list.html">blog list</a></li>
                <li><a href="book-detail.html">book detail</a></li>
                <li><a href="404.html">404</a></li>
            </ul>
        </li>
        <li>
            <a class="triple-eff" data-toggle="collapse" href="#list-5"><i class="pull-right fa fa-angle-down"></i>author</a>
            <ul class="collapse" id="list-5">
                <li><a href="author.html">author</a></li>
                <li><a href="author-detail.html">author detail</a></li>
            </ul>
        </li>
        <li><a href="contact.html">Contact</a></li>                       
    </ul>
</nav>
<!-- Slide Menu -->

<!-- View Pages -->
<div class="modal fade open-book-view" id="open-book-view" role="dialog">
    <div class="position-center-center" role="document">
        <div class="modal-content">
            <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div id="magazine">
                <div style="background-image:url(images/pages/01.jpg);"></div>
                <div style="background-image:url(images/pages/02.jpg);"></div>
                <div style="background-image:url(images/pages/03.jpg);"></div>
                <div style="background-image:url(images/pages/04.jpg);"></div>
                <div style="background-image:url(images/pages/04.jpg);"></div>
                <div style="background-image:url(images/pages/05.jpg);"></div>
                <div style="background-image:url(images/pages/05.jpg);"></div>
                <div style="background-image:url(images/pages/06.jpg);"></div>
            </div>
        </div>
    </div>
</div>
<!-- View Pages -->

<!-- Login Modal -->
<div class="modal fade login-modal" id="login-modal" role="dialog">
    <div class="position-center-center" role="document">
        <div class="modal-content">
            <strong>Register</strong>
            <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="social-options">
                <ul>
                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i>Register with facebook</a></li>
                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i>Register with twitter</a></li>
                    <li><a class="google" href="#"><i class="fa fa-google-plus"></i>Register with gmail+</a></li>
                </ul>
            </div>
            <form class="sending-form">
                <div class="form-group">
                    <input class="form-control" required="required" placeholder="Full name">
                    <i class="fa fa-user"></i>
                </div>
                <div class="form-group">
                    <input class="form-control" required="required" placeholder="Email Address">
                    <i class="fa fa-user"></i>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" required="required" placeholder="Password">
                    <i class="fa fa-user"></i>
                </div>
                <p class="terms">You agree to the hldy.hr <a href="#">Terms &amp; Conditions</a></p>
                <button class="btn-1 shadow-0 full-width">Register account</button>
            </form>
        </div>
    </div>
</div>
<!-- Login Modal -->

<!-- Quick View -->
<div class="modal fade quick-view" id="quick-view" role="dialog">
    <div class="position-center-center" role="document">
        <div class="modal-content">
            <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="single-product-detail">
                <div class="row">

                    <!-- Product Thumnbnail -->
                    <div class="col-sm-5">
                        <div class="product-thumnbnail">
                            <img src="images/qiuck-view/img-01.jpg" alt="">
                        </div>
                    </div>
                    <!-- Product Thumnbnail -->

                    <!-- Product Detail -->
                    <div class="col-sm-7">
                        <div class="single-product-detail">
                            <span class="availability">Availability :<strong>Stock<i class="fa fa-check-circle"></i></strong></span>
                            <h3>Land the Earth Beach</h3>
                            <ul class="rating-stars">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star-half-o"></i></li>
                                <li>1 customer review</li>
                            </ul>
                            <div class="prics"><del class="was">$32.00</del><span class="now">$30.99</span></div>
                            <h4>Overview</h4>
                            <p>With this highly anticipated new novel, the author of the bestselling Life of Pi returns to the storytelling power and luminous wisdom of his master novel. The High Mountains of Portugal.</p>
                            <div class="quantity-box">
                                <label>Qty :</label>
                                <div class="sp-quantity">
                                    <div class="sp-minus fff"><a class="ddd" data-multi="-1">-</a></div>
                                    <div class="sp-input">
                                      <input type="text" class="quntity-input" value="1" />
                                    </div>
                                    <div class="sp-plus fff"><a class="ddd" data-multi="1">+</a></div>
                                </div>
                            </div>
                            <ul class="btn-list">
                                <li><a class="btn-1 sm shadow-0 " href="#">add to cart</a></li>
                                <li><a class="btn-1 sm shadow-0 blank" href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a class="btn-1 sm shadow-0 blank" href="#"><i class="fa fa-repeat"></i></a></li>
                                <li><a class="btn-1 sm shadow-0 blank" href="#"><i class="fa fa-share-alt"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Product Detail -->

                </div>
            </div>
            <!-- Single Product Detail -->

        </div>
    </div>
</div>
<!-- Quick View -->


<!-- Java Script -->
<script src="{{ asset ('public/frontend/js/vendor/jquery.js')}}"></script>        
<script src="{{ asset ('public/frontend/js/vendor/bootstrap.min.js')}}"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="{{ asset ('public/frontend/js/gmap3.min.js')}}"></script>                 
<script src="{{ asset ('public/frontend/js/datepicker.js')}}"></script>                    
<script src="{{ asset ('public/frontend/js/contact-form.js')}}"></script>                  
<script src="{{ asset ('public/frontend/js/bigslide.js')}}"></script>                          
<script src="{{ asset ('public/frontend/js/3d-book-showcase.js')}}"></script>                  
<script src="{{ asset ('public/frontend/js/turn.js')}}"></script>                          
<script src="{{ asset ('public/frontend/js/jquery-ui.js')}}"></script>                             
<script src="{{ asset ('public/frontend/js/mcustom-scrollbar.js')}}"></script>                 
<script src="{{ asset ('public/frontend/js/timeliner.js')}}"></script>                 
<script src="{{ asset ('public/frontend/js/parallax.js')}}"></script>               
<script src="{{ asset ('public/frontend/js/countdown.js')}}"></script> 
<script src="{{ asset ('public/frontend/js/countTo.js')}}"></script>       
<script src="{{ asset ('public/frontend/js/owl-carousel.js')}}"></script>  
<script src="{{ asset ('public/frontend/js/bxslider.js')}}"></script>  
<script src="{{ asset ('public/frontend/js/appear.js')}}"></script>                
<script src="{{ asset ('public/frontend/js/sticky.js')}}"></script>                    
<script src="{{ asset ('public/frontend/js/prettyPhoto.js')}}"></script>           
<script src="{{ asset ('public/frontend/js/isotope.pkgd.js')}}"></script>                   
<script src="{{ asset ('public/frontend/js/wow-min.js')}}"></script>           
<script src="{{ asset ('public/frontend/js/classie.js')}}"></script>                   
<script src="{{ asset ('public/frontend/js/main.js')}}"></script>      

<!-- Switcher JS -->
<script type="text/javascript" src="{{ asset ('public/frontend/switcher/cookie.js')}}"></script>
<script type="text/javascript" src="{{ asset ('public/frontend/switcher/colorswitcher.js')}}"></script>
<!-- Switcher JS -->
@yield('appbottomjs')
@yield('property-js')

   
  
</body>
</html>