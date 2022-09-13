@extends('layouts.admin')
@section('content')
<section class="content">
            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size:1.5em;">SEARCH ORDER</h2>
                        </div>
                        <div class="body">
                            <form name="myForm" id="myForm">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input name="mobile" type="text" class="mobile form-control">
                                                <label class="form-label">Mobile</label>
                                            </div>
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
                            <h2 style="font-size:2em;">ORDER</h2>
                        </div>
                        <div class="body">
                        @include('partials.flash-message')
                            <div class="table-responsive">
                                <table id="order_table" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead >
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Product</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody >
                                        <?php $i=1;?>
                                        @foreach($order as $value)
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                           

                                            <td>{{date('d-m-Y',strtotime($value->created_at))}}</td>
                                            <td>{{ucwords(strtolower($value->detail->name))}}</td>
                                            <td>{{$value->detail->mobile}}</td>
                                            <td>{{ucwords(strtolower($value->detail->address))}}({{$value->detail->pincode}})</td>
                                            <td>{{ucwords(strtolower($value->detail->city))}}</td>
                                            <td>{{ucwords(strtolower($value->detail->state))}}</td>
                                            <td>{{ucwords(strtolower($value->product->name))}}({{$value->product->sku}})</td>
                                            <td>₹ {{$value->total_amount}}</td>
                                            <td>
                                                @if($value->status=="pending")
                                                <style> .btn-default{display:none;} </style>
                                                <select name="status" class="order btn bg-blue waves-float waves-effect">
                                                @elseif($value->status=="dispatched")
                                                <style> .btn-default{display:none;} </style>
                                                <select name="status" class="order btn bg-orange waves-float waves-effect">
                                                @elseif($value->status=="delivered")
                                                <style> .btn-default{display:none;} </style>
                                                <select name="status" class="order btn bg-green waves-float waves-effect">
                                                @else
                                                <style> .btn-default{display:none;} </style>
                                                <select name="status" class="order btn bg-red waves-float waves-effect">
                                                @endif
                                                    <option value="{{$value->id}}|pending" <?php if($value->status=="pending"){ echo "selected";}else if($value->status=="delivered"){ echo "disabled";}else if($value->status=="cancelled"){ echo "disabled";}?>>Pending</option>

                                                    <option value="{{$value->id}}|dispatched" <?php if($value->status=="dispatched"){ echo "selected";}else if($value->status=="delivered"){ echo "disabled";}else if($value->status=="cancelled"){ echo "disabled";}?>>Dispatched</option>

                                                    <option value="{{$value->id}}|delivered" <?php if($value->status=="delivered"){ echo "selected";}else if($value->status=="cancelled"){ echo "disabled";}?>>Delivered</option>

                                                    <option value="{{$value->id}}|cancelled" <?php if($value->status=="cancelled"){ echo "selected";}?> disabled>Cancelled</option>
                                                </select>
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
<!------Order status update------>
<script>
    $(document).ready(function() {
        $(".order").change(function(){
            var value = $(this).val();
            const split = value.split("|");
            var id = split[0];
            var status = split[1];
            var token = "{{ csrf_token()}}";
            $.ajax({
            type:'POST',
            url:"{{url('admin/order/orderstatus')}}",
            data:{'id':id,'status':status,'_token':token},
                success:function(data){
                    if(data.isreload==1){
                        location.reload();
                }
            
            }
            });
       });
    });
</script>
<!------Order search------>
<script>
    $(document).ready(function() {
        $(".search").click(function(){
            $.ajax({
                type:'post',
                url:"{{url('admin/order/search')}}",
                data:$("#myForm input").serialize(),
                success:function(data){
                    $('#order_table').html(data.html); 
                }
            });
      });
    });
</script>

@endsection('content')
