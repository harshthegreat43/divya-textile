
@extends('layouts.admin')
@section('content')
<?php // dd($result); ?>
   
 <section class="content">
  <!-- Inline Layout | With Floating Label -->
                     
           <!-- Exportable Table -->
           <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size:2em;">COUPAN DETAILS</h2>
                            <ul class="header-dropdown m-r--5">
                                <a href="{{url('admin/coupan/add')}}"><button type="button" class="btn btn-primary">ADD</button></a>
                            </ul>
                        </div>
                        <div class="body">
                        @include('partials.flash-message')
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" style = "width:100%" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>Sr</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Coupan Code</th>
                                            <th>Description</th>
                                            <th>Min Amount</th>
                                            <th>Discount</th>
                                            <th>Type</th>
                                            <th>Category</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                    
                                      <?php $count = 1; ?>
                                    @foreach($result as $value)
                                        <tr>    
                                            <td>{{$count}}</td>
                                            <td>{{date('d-m-Y',strtotime($value->startdate))}}</td>
                                            <td>{{date('d-m-Y',strtotime($value->enddate))}}</td>
                                            <td>{{$value->coupan_code}}</td>
                                            <td>{{$value->description}}</td>
                                            <td>{{$value->min_amount}}</td>
                                            <td>{{$value->discount}}</td>
                                            <td>{{$value->type}}</td>
                                            <td>{{$value->category}}</td>
                                            <td>{{date('d-m-Y',strtotime($value->created_at))}}</td>
                                            <td> 
                                            @if($value->status=='N')
                                            <a title="inactive" href="coupan/status/{{$value->id}}/Y" style="color:red; font-size:1.25em;"><i class="fa-solid fa-circle-xmark"></i></a>
                                            @else
                                            <a title="active" href="coupan/status/{{$value->id}}/N" style="color:limegreen; font-size:1.25em;"><i class="fa-solid fa-circle-check"></i></a>
                                            @endif 
                                            <a title="delete" href="coupan/delete/{{$value->id}}" style="color:red; font-size:1.25em;" onClick="javascript: return confirm('Are you sure do you want to delete this coupan')"><i class="fa-solid fa-trash-can"></i></a>
                                            <a title="edit" href="coupan/edit/{{$value->id}}" style="color:blue; font-size:1.25em;"><i class="fa-solid fa-pen-to-square"></i></a>
                                            </td>
                                            <?php $count++; ?>
                                        </tr>
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

    <style>
        button.btn.dropdown-toggle.btn-default{
        display:none;
        

    }
        
    select#status{

        background:#dc143c;
        color: #fff;
    }


    </style>

  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
<script>
    $(document).ready(function() {
        $(".search").click(function(){
        $.ajax({
        type:'post',
        url:"{{url('admin/order/search')}}",
        data:$("#myForm input").serialize(),
        success:function(data){
            $('#datatable').html(data.html); 
           }
    });
      });
    });
    </script>

<script>
    $(document).ready(function() {
    
        $(".order").change(function(){
            var val = $(this).val();
          //  alert(val)
            var orderid = $(this).find(':selected').data('id');
            var status = $(this).find(':selected').data('status');
            //alert(orderid);
            var token = "{{ csrf_token()}}";
        $.ajax({
        type:'post',
        url:"{{url('admin/order/orderstatus')}}",
        data:{'orderid':orderid,'status':status,'_token':token},
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

