
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
                            <h2 style="font-size: 2em;">EDIT PRODUCT</h2>
                        </div>
                        <div class="body">
                        @include('partials.flash-message')
                            <form id="form_validation" method="POST" action="{{url('admin/product/edit/'.$product->id)}}" enctype="multipart/form-data">
                            @csrf 

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" value="{{ucwords(strtolower($product->name))}}" required>
                                        <label class="form-label">Name</label>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <style> .btn-default{display:none;} </style>
                                    <label style="color: gray;">Choose Category:</label>
                                    <select name="category_id" required>
                                        <option>Choose Category</option>
                                        @foreach($value as $category)
                                        <option value="{{$category->id}}"<?php if($category->id==$product->category_id){ echo "selected";} ?>>{{ucwords(strtolower($category->name))}}</option>
                                        @endforeach
                                    </select>
                                </div> 

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="price" value="{{$product->price}}" required >
                                        <label class="form-label">Price</label>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="delivery_charges" value="{{$product->delivery_charges}}"  required>
                                        <label class="form-label">Delivery Charges</label>
                                    </div>
                                </div>

                                <div class="form-group form-float">   
                                <label class="form-label">Colors</label>
                                    <div class="demo-checkbox">
                                        <?php $i=1; ?>
                                        @foreach($color as $colors)
                                        <input name="color[]" type="checkbox" id="{{$i}}" class="filled-in chk-col-{{$colors->name}}" value="{{$colors->name}}" />
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
                                        <input name="size[]" type="checkbox" id="{{$j}}" class="filled-in chk-col-black" value="{{$sizes->name}}" />
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
                                        <input type="file" class="form-control" name="image" <?php if($product->image==null){ echo "required";} ?>>
                                    </div>
                                    <div>
                                        <img src="{{url('public/product_img',$product->image)}}" style="background:black;" width="20%">
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div style="color: gray;">
                                        <label class="form-label">Images</label>
                                    </div>
                                    <div class="form-line">
                                        <input type="file" class="form-control" name="images[]" <?php if($product->image==null){ echo "required";} ?> multiple>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="short_discription" cols="30" rows="1" class="form-control no-resize"required>{{ucwords(strtolower($product->short_discription))}}</textarea>
                                        <label class="form-label">Short Discription</label>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="discription" cols="30" rows="3" class="form-control no-resize"required>{{ucwords(strtolower($product->discription))}}</textarea>
                                        <label class="form-label">Discription</label>
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
        <div class="container-fluid">
            <!-- Image Gallery -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size: 1.5em;">PRODUCT GALLERY</h2>
                        </div>
                        <div class="body">
                            <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                @foreach($images as $image)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <a title="delete" class="delete" data-id="{{$image->id}}" style="color:red; cursor:pointer; font-size:1.25em;" ><i class="fa-solid fa-trash-can"></i></a>
                                    <img class="img-responsive thumbnail" src="{{url('public/product_images',$image->images)}}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



<script src="{{ asset('admin/js/jquery-3.6.0.min.js') }}"></script>
<!--------Product images delete--------->
<script>
    $(document).ready(function() {
        $(".delete").click(function(){
            var id = $(this).data('id');
            var token = "{{ csrf_token()}}";
            $.ajax({
            type:'POST',
            url:"{{url('admin/product/delete_img')}}",
            data:{'id':id,'_token':token},
                success:function(data){
                    if(data.isreload==1){
                        location.reload();
                }
            
            }
            });
       });
    });
</script>


 @endsection('content')
