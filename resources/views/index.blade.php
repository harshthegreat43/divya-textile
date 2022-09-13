@extends('weblayouts.web')
@section('content')
            <section id="slider">
                <div class="owl-carousel owl-theme owl-loaded sliderCarousel">
                    <div class="owl-stage-outer">
                        <div class="owl-stage">
                            @foreach($slider as $value)
                            <div class="owl-item"><img src="{{url('public/slider_img',$value->image)}}" alt="slider" class="img-fluid" /></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- <img src="./images/saree banner.jpg" alt="slider" class="img-fluid" /> -->
            </section>

            <section id="supter-box">
                <div class="container">
                    <div class="row d-flex justify-content-between g-0">
                        <div class="col-md-3 box-contant">
                            <div class="info">
                                <ul>
                                    <li class="d-flex align-items-center">
                                        <i class="fa-regular fa-star"></i>
                                        <div>
                                            <h6>Unique Products</h6>
                                            <span>We are manufacture own</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-3 box-contant">
                            <div class="info">
                                <ul>
                                    <li class="d-flex align-items-center">
                                        <i class="fa-solid fa-phone"></i>
                                        <div>
                                            <h6>100% Satisfaction</h6>
                                            <span>Your Satisfaction is our duty</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-3 box-contant">
                            <div class="info">
                                <ul>
                                    <li class="d-flex align-items-center">
                                        <i class="fa-solid fa-truck"></i>
                                        <!-- <i class="fa-regular fa-truck"></i> -->
                                        <div>
                                            <h6>Fast delivery</h6>
                                            <span>Delivery in a Glimpse</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="products">
                <hgroup class="heading">
                    <h2>Trending Collection</h2>
                </hgroup>

                <div class="container">
                    <div class="row">
                        @foreach($category as $value)
                        <div class="col-md-3">
                            <div class="productTile">
                                <a href="{{url('product',$value->id)}}">
                                    <img src="{{url('public/category_img',$value->image)}}" alt="productImage" class="img-fluid" />
                                    <div class="overlay">
                                        <div class="text">View All</div>
                                    </div>
                                    <div class="productDetail">
                                        <h4>{{ucwords(strtolower($value->name))}} <span class="pro-no">({{$value->product()->count()}})</span></h4>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <a href="{{url('collection')}}" class="themeButton hvr-icon-wobble-horizontal">
                        View All Collection <i class="fa fa-arrow-right hvr-icon"></i>
                    </a>
                </div>
            </section>

            <section id="aboutUs">
                <div class="container">
                    <div class="row align-items-center">
                        <div class=" col-md-6">
                            <img src="{{asset('web/images/aboutImage.jpg')}}" alt="about" class="img-fluid" />
                        </div>
                        <div class="col-md-6">
                            <h3>
                                About Divya Textile
                            </h3>

                            <p>Welcome to Divya Textile. We are the home of world-famous"Jaipuri Printed" Textile Goods. Here we manufacture and produce a number of textile products like Dress Material, Suits, Sarees, Bedcovers and more for our customers.</p>
                            <p>Our company was founded in the year 2010 and after that we are producing quality products continuously. As our journey is entering into the third decade of production we are removing all restrictions on production and ready
                                to maximize our productivity to serve you better.</p>
                            <a href="{{url('aboutus')}}" class="themeButton hvr-icon-wobble-horizontal">
                                    Read More <i class="fa fa-arrow-right hvr-icon"></i>
                                </a>
                        </div>
                    </div>

                </div>
            </section>

            <section id="productionVideo">
                <div class="container">

                    <hgroup class="heading">
                        <h2>Manufacturing Process</h2>
                    </hgroup>
                    <div class="row">
                        @foreach($video as $value)
                        <div class="col-4">
                            <div class="ratio ratio-16x9">
                                <iframe src="{{$value->video_link}}" allowfullscreen></iframe>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>


@endsection('content')