

@extends('layouts.admin')
@section('content')

<?php //DD($gallery); die; ?>

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
                            <h2 style="font-size: 2em;">EDIT COUPAN</h2>
                        </div>
                        <div class="body">
                            <form enctype='multipart/form-data' id="form_validation" method="POST" action="{{ url('admin/coupan/edit/'.$data->id) }}">
                            @csrf
                            <div class="form-group form-float">
                                    <select name = "category_id">       
                                    <option selected="selected">Choose Category</option>                             
                                    @foreach($category as $item)
                                        <option id = "category_id" value = "{{$item->id}}"<?php if($data->category==$item->name){ echo 'selected';}?>>{{ucwords(strtolower($item->name))}}</option>
                                    @endforeach     
                                    </select>
                                </div>


                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="coupan_code" value = "{{ $data->coupan_code }}"  required>
                                        <label class="form-label">Coupan Code</label>
                                    </div>
                                </div>
                                <label class="form-label">Type:</label>
                                <div class="form-group form-float">
                                    <input type="radio" class="with-gap radio-col-red" id="percent" name="discount_type" value="%" <?php if($data->type=='%'){ echo 'checked';} ?>>
                                    <label for="percent" value = "{{ $data->type }}" >Percent</label>
                                    
                                    <input type="radio" class="with-gap radio-col-red" id="fixed" name="discount_type" value="fixed" <?php if($data->type=='fixed'){ echo 'checked';} ?>>
                                     <label for="fixed" value = "{{ $data->type }}" >Fixed</label>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number"  class="form-control" name="min_amount"  value = "{{ $data->min_amount }}"  required>
                                        <label class="form-label">Min Amount</label>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="discount" value = "{{ $data->discount }}" >
                                        <label class="form-label" id="discount_percent">Discount Percent</label>
                                        <label class="form-label" id="discount">Discount</label>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="description"  value = "{{ ucwords(strtolower($data->description)) }}"  required>
                                        <label class="form-label">Description</label>
                                    </div>
                                </div>


                                <div class="form-group form-float ">
                                        <input type="date"class="form-control" name="start_date" value = "{{date('Y-m-d',strtotime($data->startdate))}}" style="width:20%;" required>
                                        <label class="form-label">Start Date</label>
                                </div>

                                <div class="form-group form-float ">
                                        <input type="date" class="form-control" name="end_date" value = "{{date('Y-m-d',strtotime($data->enddate))}}" style="width:20%;" required>
                                        <label class="form-label">End Date</label>
                                </div>                                                           

                                <button class="btn btn-primary waves-effect" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
        </div>



    </section>

    <style>
        button.btn.dropdown-toggle.btn-default{
        display:none;
        

    }
      </style>

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
