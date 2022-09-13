@extends('weblayouts.web')
@section('content')
<?php //print_r($product); die;?> 
   <div id="inner_slider">
                <img src="{{asset('web/images/products.jpg')}}" alt="slider">
            </div>

            <div class="categoryPage">
                <section id="products">
                    <hgroup class="heading">
                        <h2>Products</h2>
                    </hgroup>

                    <div class="container">
                        <div class="row">
                        @foreach($product as $products)
                            <div class="col-md-3">
                                <div class="productTile">
                                    <a href="{{url('detail/'.$products->id)}}">
                                        <div class="imgContainer">
                                            <img src="{{url('public/product_img',$products->image)}}" alt="productImage" class="img-fluid" />
                                        </div>
                                        <div class="productDetail">
                                            <h4>{{ucwords(strtolower($products->name))}}<p>({{$products->sku}})</p></h4>
                                            <p>{{ucwords(strtolower($products->short_discription))}}</p>
                                            <div class="product-price d-flex">
                                                <h4>₹ {{$products->price}}/-</h4>
                                                <p class="themeButton">Details</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                           
                            
                        </div>
                    </div>
                </section>
            </div>

            @endsection('content')
