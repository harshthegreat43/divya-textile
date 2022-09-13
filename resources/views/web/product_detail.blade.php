@extends('weblayouts.web')
@section('content')
<?php 

$value = Session::get('customer');

?>
            <div class="productDetail">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="productContainer">
                                <div id="js-gallery" class="gallery">
                                    <div class="gallery__hero">
                                        <img src="{{url('public/product_img',$product->image)}}">
                                    </div>
                                    <div class="gallery__thumbs d-flex">
                                        <a href="{{url('public/product_img',$product->image)}}" data-gallery="thumb" class="is-active">
                                            <img src="{{url('public/product_img',$product->image)}}">
                                        </a>
                                        @foreach($images as $image)
                                        <a href="{{url('public/product_images',$image->images)}}" data-gallery="thumb">
                                            <img src="{{url('public/product_images',$image->images)}}">
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="productTile">
                                <h1>{{ucwords(strtolower($product->name))}} ({{$product->sku}})</h1>
                                <div class="product-price d-flex">

                                    <h4>₹{{$product->price}}</h4>
                                </div>
                                
                                <div class="d-flex align-items-center">
                                    <?php if($value!=null){?>
                                        <a href="{{url('order/'.$product->id.'/'.$value->id)}}" class="themeButton m-0 ms-0 mt-2">Buy Now</a>
                                    <?php }else{?>
                                        <a href="{{url('signin')}}" class="themeButton m-0 ms-0 mt-2">Buy Now</a>
                                    <?php }?>
                                </div>
                                <section class="Quality_products">
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-md-6 box-contant">
                                            <div class="info">
                                                <ul>
                                                    <li class="d-flex align-items-center">
                                                        <i class="fa-regular fa-star"></i>
                                                        <div>
                                                            <h6>Top Quality Products </h6><span> All products are original</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6 box-contant">
                                            <div class="info">
                                                <ul>
                                                    <li class="d-flex align-items-center">
                                                        <i class="fa-solid fa-truck"></i>
                                                        <div>
                                                            <h6>Faster Delivery</h6><span>Free delivery over ₹ {{$free_delivery}}</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <h2>Description</h2>
                                <p>{{$product->discription}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section id="supter-box">
                <div class="container">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-3 box-contant">
                            <div class="info">
                                <ul>
                                    <li class="d-flex align-items-center">

                                        <i class="fa-regular fa-star"></i>
                                        <div>
                                            <h6>Top Quality Products </h6><span> All products are original</span>
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
                                            <h6>Faster Delivery</h6><span>Free on delivery over ₹ {{$free_delivery}}</span>
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
                                            <h6>9694401207</h6><span>Anytime support</span>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>




                    </div>
                </div>

            </section>

@endsection('content')