
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
                            <h2 style="font-size: 2em;">EDIT VIDEO</h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" action="{{url('admin/video/edit/'.$video->id)}}" enctype="multipart/form-data">
                            @csrf 

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" value="{{ucwords(strtolower($video->name))}}" required>
                                        <label class="form-label">Name</label>
                                    </div>
                                </div>
                                <div class="form-group form-float"> 
                                    <div class="form-line">
                                        <textarea name="video_link" type="text" cols="30" rows="3" class="form-control no-resize"<?php if($video->video_link==null){ echo "required";} ?>></textarea>
                                        <label class="form-label">Url</label>
                                    </div>
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


 @endsection('content')
