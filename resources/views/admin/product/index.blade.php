@extends('layouts.admin')
@section('content')

<section class="content">
            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size:1.5em;">SEARCH PRODUCT</h2>
                        </div>
                        <div class="body">
                            <form name="myForm" id="myForm">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
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
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                        <button class="btn bg-blue btn-circle waves-circle waves-float waves-effect search" type="button"><i class="material-icons">search</i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Inline Layout | With Floating Label -->


            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size:2em;">PRODUCT</h2>
                            <ul class="header-dropdown m-r--5">
                                <a href="{{url('admin/product/add')}}"><button type="button" class="btn btn-primary">ADD</button></a>
                            </ul>
                        </div>
                        <div class="body">
                        @include('partials.flash-message')
                            <div class="table-responsive">
                                <table id="product_table" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead >
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Delivery Charges</th>
                                            <th>Short Discription</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody >
                                        <?php $i=1;?>
                                        @foreach($result as $value)
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>{{ucwords(strtolower($value->name))}}</td>
                                            <td> <img src="{{url('public/product_img',$value->image)}}" style="background:black;" height="35" width="35"></td>
                                            <td>{{ucwords(strtolower($value->category->name))}}</td>
                                            <td>₹ {{$value->price}}</td>
                                            <td>₹ {{$value->delivery_charges}}</td>
                                            <td>{{ucwords(strtolower($value->short_discription))}}</td>
                                            <td>{{date('d-m-Y',strtotime($value->created_at))}}</td>
                                            <td> 
                                            @if($value->status=='N')
                                            <a title="inactive" href="product/status/{{$value->id}}/Y" style="color:red; font-size:1.25em;"><i class="fa-solid fa-circle-xmark"></i></a>
                                            @else
                                            <a title="active" href="product/status/{{$value->id}}/N" style="color:limegreen; font-size:1.25em;"><i class="fa-solid fa-circle-check"></i></a>
                                            @endif
                                            <a title="delete" href="product/delete/{{$value->id}}" style="color:red; font-size:1.25em;" onClick="javascript: return confirm('Are you sure do you want to delete this product')"><i class="fa-solid fa-trash-can"></i></a>
                                            <a title="edit" href="product/edit/{{$value->id}}" style="color:blue; font-size:1.25em;"><i class="fa-solid fa-pen-to-square"></i></a>
                                            </td>
                                        </tr>
                                        <?php $i++;?>
                                     @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
    </section>


 
<script src="{{ asset('admin/js/jquery-3.6.0.min.js') }}"></script>   
<!------Order search------>
<script>
    $(document).ready(function() {
        $(".search").click(function(){
            $.ajax({
                type:'post',
                url:"{{url('admin/product/search')}}",
                data:$("#myForm").serialize(),
                success:function(data){
                    $('#product_table').html(data.html); 
                }
            });
      });
    });
</script>

@endsection('content')
