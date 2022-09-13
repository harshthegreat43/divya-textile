
@extends('layouts.admin')
@section('content')
<?php 

$value = Session::get('user');

?>  
    <section class="content">
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                        @include('partials.flash-message')
                        @if ($errors->any())
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>	
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        <h2 style="font-size: 2em;">PROFILE</h2>
                           
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" action="{{Route('update-profile')}}">
                            @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" value="{{ucwords(strtolower($value->name))}}" required>
                                        <label class="form-label">Name</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="email" value="{{$value->email}}" required readonly>
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mobile" value="{{$value->mobile}}" required>
                                        <label class="form-label">Mobile</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="min_amt" value="{{$value->min_amt}}" required>
                                        <label class="form-label">Free Delivery At</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="fb_url" cols="30" rows="3" class="form-control no-resize">{{$value->fb_url}}</textarea>
                                        <label class="form-label">Facebook</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="twitter_url" cols="30" rows="3" class="form-control no-resize">{{$value->twitter_url}}</textarea>
                                        <label class="form-label">Twitter</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="insta_url" cols="30" rows="3" class="form-control no-resize">{{$value->insta_url}}</textarea>
                                        <label class="form-label">Instagram</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="google_url" cols="30" rows="3" class="form-control no-resize">{{$value->google_url}}</textarea>
                                        <label class="form-label">Google</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="linkedin_url" cols="30" rows="3" class="form-control no-resize">{{$value->linkedin_url}}</textarea>
                                        <label class="form-label">LinkedIn</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="address" cols="30" rows="3" class="form-control no-resize"required>{{ucwords(strtolower($value->address))}}</textarea>
                                        <label class="form-label">Address</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="checkbox" name="checkbox">
                                    <label for="checkbox">I have read and accept the terms</label>
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">UPDATE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
        </div>
    </section>


 @endsection('content')
