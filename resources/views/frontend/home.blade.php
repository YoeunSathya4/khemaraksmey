@extends('frontend/layouts.master')

@section('title', 'Pink Home Delivery')
@section('home', 'active')

@section ('appbottomjs')
@endsection

@section ('content')
    
        <!-- Upcoming Release -->
        <section class="upcoming-release">

            <!-- Heading -->
            <div class="container-fluid p-0">
                <div class="release-heading pull-right h-white">
                    <h5>New and Upcoming Release</h5>
                </div>
            </div>
            <!-- Heading -->

            <!-- Upcoming Release Slider -->
            <div class="upcoming-slider">
                <div class="container">

                    <!-- Release Book Detail -->
                    <div class="release-book-detail h-white p-white">
                        <div class="release-book-slider">
                            <div class="item">
                                <div class="detail">
                                    <h5><a href="book-detail.html">Summer Festival</a></h5>
                                    <p>A masterpiece. This is the best book I everyone interested in business. Lorem ipsum. dolor sit amet, consectetur adipisicing.</p>
                                    <span>$25.<sup>00</sup></span>
                                    <i class="fa fa-angle-double-right"></i>
                                </div>
                                <div class="detail-img">
                                    <img src="{{ asset ('public/frontend/images/upcoming-release/img-01.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="detail">
                                    <h5><a href="book-detail.html">Ramdan Kareem</a></h5>
                                    <p>A masterpiece. This is the best book I everyone interested in business. Lorem ipsum. dolor sit amet, consectetur adipisicing.</p>
                                    <span>$25.<sup>00</sup></span>
                                    <i class="fa fa-angle-double-right"></i>
                                </div>
                                <div class="detail-img">
                                    <img src="{{ asset ('public/frontend/images/upcoming-release/img-02.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="detail">
                                    <h5><a href="book-detail.html">Rcok Fastival</a></h5>
                                    <p>A masterpiece. This is the best book I everyone interested in business. Lorem ipsum. dolor sit amet, consectetur adipisicing.</p>
                                    <span>$25.<sup>00</sup></span>
                                    <i class="fa fa-angle-double-right"></i>
                                </div>
                                <div class="detail-img">
                                    <img src="{{ asset ('public/frontend/images/upcoming-release/img-03.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="detail">
                                    <h5><a href="book-detail.html">Cover Design</a></h5>
                                    <p>A masterpiece. This is the best book I everyone interested in business. Lorem ipsum. dolor sit amet, consectetur adipisicing.</p>
                                    <span>$25.<sup>00</sup></span>
                                    <i class="fa fa-angle-double-right"></i>
                                </div>
                                <div class="detail-img">
                                    <img src="{{ asset ('public/frontend/images/upcoming-release/img-04.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="detail">
                                    <h5><a href="book-detail.html">Festa Junnia</a></h5>
                                    <p>A masterpiece. This is the best book I everyone interested in business. Lorem ipsum. dolor sit amet, consectetur adipisicing.</p>
                                    <span>$25.<sup>00</sup></span>
                                    <i class="fa fa-angle-double-right"></i>
                                </div>
                                <div class="detail-img">
                                    <img src="{{ asset ('public/frontend/images/upcoming-release/img-05.jpg')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Release Book Detail -->

                    <!-- Thumbs -->
                    <div class="release-thumb-holder">
                        <ul id="release-thumb" class="release-thumb">
                            <li>
                                <a data-slide-index="0" href="#">
                                    <span>Summer</span>
                                    <img src="{{ asset ('public/frontend/images/upcoming-release/thumb/img-01.jpg')}}" alt="">
                                    <img class="b-shadow" src="{{ asset ('public/frontend/images/upcoming-release/b-shadow.png')}}" alt="">
                                    <span data-toggle="modal" data-target="#quick-view" class="plus-icon">+</span>
                                </a>
                            </li>
                            <li>
                                <a data-slide-index="1" href="#" class="active">
                                    <span>Ramdan</span>
                                    <img src="{{ asset ('public/frontend/images/upcoming-release/thumb/img-02.jpg')}}" alt="">
                                    <img class="b-shadow" src="{{ asset ('public/frontend/images/upcoming-release/b-shadow.png')}}" alt="">
                                    <span data-toggle="modal" data-target="#quick-view" class="plus-icon">+</span>
                                </a>
                            </li>
                            <li> 
                                <a data-slide-index="2" href="#">
                                    <span>Rcok</span>
                                    <img src="{{ asset ('public/frontend/images/upcoming-release/thumb/img-03.jpg')}}" alt="">
                                    <img class="b-shadow" src="{{ asset ('public/frontend/images/upcoming-release/b-shadow.png')}}" alt="">
                                    <span data-toggle="modal" data-target="#quick-view" class="plus-icon">+</span>
                                </a>
                            </li>
                            <li>
                                <a data-slide-index="3" href="#">
                                    <span>Cover</span>
                                    <img src="{{ asset ('public/frontend/images/upcoming-release/thumb/img-04.jpg')}}" alt="">
                                    <img class="b-shadow" src="{{ asset ('public/frontend/images/upcoming-release/b-shadow.png')}}" alt="">
                                    <span data-toggle="modal" data-target="#quick-view" class="plus-icon">+</span>
                                </a>
                            </li>
                            <li>
                                <a data-slide-index="4" href="#">
                                    <span>Festa</span>
                                    <img src="{{ asset ('public/frontend/images/upcoming-release/thumb/img-05.jpg')}}" alt="">
                                    <img class="b-shadow" src="{{ asset ('public/frontend/images/upcoming-release/b-shadow.png')}}" alt="">
                                    <span data-toggle="modal" data-target="#quick-view" class="plus-icon">+</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Thumbs -->

                </div>
            </div>
            <!-- Upcoming Release Slider -->

        </section>
        <!-- Upcoming Release -->

        <!-- Best Seller Products -->
<!-- Book Collections -->
        <section class="book-collection">
            <div class="container">
                <div class="row">
                            <div class="collection">

                                <!-- Secondary heading -->
                                <div class="sec-heading">
                                    <h3>Shop <span class="theme-color">Books</span> Collection</h3>
                                </div>
                                <!-- Secondary heading -->

                                <!-- Collection Content -->
                                <div class="collection-content">
                                    <ul>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css" src="{{ asset ('public/frontend/images/products-collection/img-01.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Ramadan Kareem</a></h6>
                                                <span>Richard Matherson</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-02.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Mars Club</a></h6>
                                                <span>Eden Lepucki</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-03.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Festa Junnai</a></h6>
                                                <span>George R.R. Martin</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-04.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Beer Fsstivak</a></h6>
                                                <span>Micheal Circhton</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-05.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Rock Festival</a></h6>
                                                <span>Richard Matherson</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-06.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Summer Festival</a></h6>
                                                <span>Edgar Rice Burroghs</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-07.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Festa JUnnai</a></h6>
                                                <span>Max Brooks</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-08.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Summer Festival</a></h6>
                                                <span>J.R.R. Tolkien</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-09.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">New Year Collection</a></h6>
                                                <span>Henry Rollins</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="s-product">
                                                <div class="s-product-img">
                                                    <img class="product-css"  src="{{ asset ('public/frontend/images/products-collection/img-10.jpg')}}" alt="">
                                                    <div class="s-product-hover">
                                                        <div class="position-center-x">
                                                            <a href="#" class="plus-icon"><i class="fa fa-shopping-cart"></i></span>
                                                            <a class="btn-1 sm shadow-0" data-toggle="modal" data-target="#quick-view" href="#">Quick view</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6><a href="book-detail.html">Happy Halloween</a></h6>
                                                <span>Lily King</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Collection Content -->


                            </div>

                    
                    <!-- Book Collections Tabs -->

                </div>
            </div>
        </section>
        <!-- Book Collections --> 

        <!-- Add Banners -->
        <section class="add-banners-holder tc-padding-bottom">
            <div class="container">
                <div class="row">

                    <!-- Banner -->
                    <div class="col-lg-6 col-sm-12">
                        <div class="add-banner add-banner-1">
                            <div class="z-inedex-2 p-relative">
                                <h3>Celebrate the Book Authors</h3>
                                <p>How to Write a Book Review Request to Bloggers, a guide for authors</p>
                                <hr>
                                <strong class="font-merriweather">Buy Now 280.99 <sup>$</sup></strong>
                            </div>
                            <img class="adds-book" src="{{ asset ('public/frontend/images/add-banners/add-books/img-01.png')}}" alt="">
                        </div>
                    </div>
                    <!-- Banner -->

                    <!-- Banner -->
                    <div class="col-lg-6 col-sm-12">
                        <div class="add-banner add-banner-2">
                            <div class="z-inedex-2 p-relative">
                                <strong>Look Books 2016</strong>
                                <h3>Up to 20% off</h3>
                                <hr>
                                <p>of advance enternce exam Books</p>
                            </div>
                            <img class="adds-book" src="{{ asset ('public/frontend/images/add-banners/add-books/img-02.png')}}" alt="">
                        </div>
                    </div>
                    <!-- Banner -->

                </div>
            </div>
        </section>
        <!-- Add Banners -->

    
      
@endsection