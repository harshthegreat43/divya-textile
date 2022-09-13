
@extends('layouts.admin')
@section('content')
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
                            <h2 style="font-size: 2em;">ADD STATE</h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" action="{{Route('add_state')}}" enctype="multipart/form-data">
                            @csrf 
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" required>
                                        <label class="form-label">Name</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <style> .btn-default{display:none;} </style>
                                    <label style="color: gray;">Choose State:</label>
                                    <select name="state" required>
                                        <option selected>Choose State</option>
                                        @foreach($state as $states)
                                        <option value="{{$states->id}}">{{ucwords(strtolower($states->name))}}</option>
                                        @endforeach
                                    </select>
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
