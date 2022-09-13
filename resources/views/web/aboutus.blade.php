@extends('weblayouts.web')
@section('content')


<div id="inner_slider">
                <img src="{{ asset('web/images/aboutBanner.jpg')}}" alt="slider">
            </div>

            <section id="aboutUs">
                <div class="container">
                    <div class="row align-items-center">
                        <div class=" col-md-6">
                            <img src="{{ asset('web/images/aboutImage.jpg')}}" alt="about" class="img-fluid" />
                        </div>
                        <div class="col-md-6">
                            <h3>
                                About Divya Textile
                            </h3>

                            <p>Welcome to Divya Textile. We are the home of world-famous"Jaipuri Printed" Textile Goods. Here we manufacture and produce a number of textile products like Dress Material, Suits, Sarees, Bedcovers and more for our customers.</p>
                            <p>Our company was founded in the year 2010 and after that we are producing quality products continuously. As our journey is entering into the third decade of production we are removing all restrictions on production and ready
                                to maximize our productivity to serve you better.</p>

                        </div>
                    </div>

                </div>
            </section>

            <div class="callToAction">
                <div class="container">
                    <div class="actionContainer">
                        <div class="d-flex justify-content-between position-relative">
                            <p>Want to buy Something</p>
                            <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_lhoTPE.json" background="transparent" speed="1" class="callIcon" loop autoplay></lottie-player>
                            <a href="#">Just Call Us! +91 7791812516</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="steps">
                <div class="container">
                    <hgroup class="heading">
                        <h2>Our Work Process</h2>
                    </hgroup>
                    <img src="{{ asset('web/images/steps.jpg')}}" alt="" class="img-fluid" />
                </div>
            </div>

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
                                            <span>Free delivery over ₹ {{$free_delivery}}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

@endsection('content')