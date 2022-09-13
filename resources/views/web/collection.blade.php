@extends('weblayouts.web')
@section('content')


<div id="inner_slider">
                <img src="{{ asset('web/images/category_banner.jpg')}}" alt="slider">
            </div>
            <div class="categoryPage">
                <section id="products">
                    <hgroup class="heading">
                        <h2>Our Collection</h2>
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
                    </div>
                </section>
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
