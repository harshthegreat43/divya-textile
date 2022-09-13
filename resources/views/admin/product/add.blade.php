
@extends('layouts.admin')
@section('content')
<?php $value = session()->get('category');?>

    <section class="content">
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>	
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                            <h2 style="font-size: 2em;">ADD PRODUCT</h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" action="{{url('admin/product/add')}}" enctype="multipart/form-data">
                            @csrf 
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" required>
                                        <label class="form-label">Name</label>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <style> .btn-default{display:none;} </style>
                                    <label style="color: gray;">Choose Category:</label>
                                    <select name="category_id" required>
                                        <option selected>Choose Category</option>
                                        @foreach($value as $category)
                                        <option value="{{$category->id}}">{{ucwords(strtolower($category->name))}}</option>
                                        @endforeach
                                    </select>
                                </div> 

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="price" required>
                                        <label class="form-label">Price</label>
                                    </div>
                                </div>
                                
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="delivery_charges" required>
                                        <label class="form-label">Delivery Charges</label>
                                    </div>
                                </div>

                                <div class="form-group form-float">   
                                <label class="form-label">Colors</label>
                                    <div class="demo-checkbox">
                                        <?php $i=1; ?>
                                        @foreach($color as $colors)
                                        <input name="color[]" type="checkbox" id="{{$i}}" class="filled-in chk-col-{{$colors->name}}" value="{{$colors->name}}" required/>
                                        <label for="{{$i}}">{{strtoupper($colors->name)}}</label>
                                        <?php $i++; ?>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group form-float">   
                                <label class="form-label">Sizes</label>
                                    <div class="demo-checkbox">
                                        <?php $j='a'; ?>
                                        @foreach($size as $sizes)
                                        <input name="size[]" type="checkbox" id="{{$j}}" class="filled-in chk-col-black" value="{{$sizes->name}}" required/>
                                        <label for="{{$j}}">{{strtoupper($sizes->name)}}</label>
                                        <?php $j++; ?>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div style="color: gray;">
                                        <label class="form-label">Featured Image</label>
                                    </div>
                                    <div class="form-line">
                                        <input type="file" class="form-control" name="image" required>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div style="color: gray;">
                                        <label class="form-label">Images</label>
                                    </div>
                                    <div class="form-line">
                                        <input type="file" class="form-control" name="images[]" multiple required>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="short_discription" cols="30" rows="1" class="form-control no-resize"required></textarea>
                                        <label class="form-label">Short Discription</label>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="discription" cols="30" rows="3" class="form-control no-resize"required></textarea>
                                        <label class="form-label">Discription</label>
                                    </div>
                                </div>

                                <button class="btn btn-primary waves-effect" type="submit">ADD</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
        </div>
    </section>


 @endsection('content')
