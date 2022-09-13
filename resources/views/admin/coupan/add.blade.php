
@extends('layouts.admin')
@section('content')

<?php //dd($category);?>

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
                            <h2 style="font-size: 2em;">ADD COUPAN</h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" action="{{url('admin/coupan/add')}}" enctype="multipart/form-data">
                             @csrf
                                <div class="form-group form-float">
                                    <style> .btn-default{display:none;} </style>
                                    <select name = "category_id">           
                                    <option selected="selected">Choose Category</option>                             
                                        @foreach($category as $item)
                                        <option id = "category_id" value = "{{$item->id}}">{{ucwords(strtolower($item->name))}}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="coupan_code"  required>
                                        <label class="form-label">Coupan Code</label>
                                    </div>
                                </div>
                                <label class="form-label">Type:</label>
                                <div class="form-group form-float">
                                    <input type="radio" class="with-gap radio-col-red" id="percent" name="discount_type" value="%">
                                    <label for="percent">Percent</label>
                                    <input type="radio" class="with-gap radio-col-red" id="fixed" name="discount_type" value="fixed" checked>
                                    <label for="fixed">Fixed</label>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number"  class="form-control" name="min_amount"  required>
                                        <label class="form-label">Min Amount</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="discount" >
                                        <label class="form-label" id="discount">Discount</label>
                                        <label class="form-label" id="discount_percent">Discount Percent</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="description"  required>
                                        <label class="form-label">Description</label>
                                    </div>
                                </div>
                                <div class="form-group form-float col-6">
                                        <input type="date"class="form-control" name="start_date" style="width:20%;"  required>
                                        <label class="form-label">Start Date</label>
                                </div>
                                <div class="form-group form-float col-6">
                                        <input type="date" class="form-control " name="end_date" style="width:20%;"  required>
                                        <label class="form-label">End Date</label>
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


    <script src="{{ asset('admin/js/jquery-3.6.0.min.js') }}"></script> 
    <script>
        $(document).ready(function () {
            $("input[name=discount_type]").change(function(){

                if($("#fixed").is(':checked')){
                    $("#discount_percent").hide();
                    $("#discount").show();
                }else{
                    $("#discount_percent").show();
                    $("#discount").hide();
                }
            });
        });
    </script>
    


 @endsection('content')
