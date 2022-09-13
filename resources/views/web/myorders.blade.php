@extends('weblayouts.myorder')
@section('content')
@include('webpartials.flash-message')
<section>
    <hgroup class="heading mt-4 mb-4">
        <h2>MY ORDERS</h2>
    </hgroup>
    <div class="container-fluid mt-4">
        <div class="d-flex mb-2">
        STATUS : <div class="ms-2 me-2 p-2 rounded-3" style="background:#cfe2ff;">PENDING</div><div class="ms-2 me-2 p-2 rounded-3" style="background:#fff3cd;">DISPATCHED</div><div class="ms-2 me-2 p-2 rounded-3" style="background:#d1e7dd;">DELIVERED</div><div class="ms-2 me-2 p-2 rounded-3" style="background:#f8d7da;">CANCELLED</div>
        </div>
        <table id="example" class="table table-hover shadow-sm mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>Sr.No.</th>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Amount</th>
                        <th>Order Placed</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody >
                    <?php $i=1;?>
                    @foreach($result as $order)
                    @if($order->status=="pending")
                    <tr class="table-primary">
                    @elseif($order->status=="dispatched")
                    <tr class="table-warning">
                    @elseif($order->status=="delivered")
                    <tr class="table-success">
                    @elseif($order->status=="cancelled")
                    <tr class="table-danger">
                    @else
                    <tr>
                    @endif
                        <td><?php echo $i; ?></td>
                        <td>{{ucwords(strtolower($order->product->name))}}({{$order->product->sku}})</td>
                        <td> <img src="{{url('public/product_img',$order->product->image)}}" style="background:black;" height="50" width="50"></td>
                        <td>{{$order->total_amount}}</td>
                        <td>{{date('d-m-Y',strtotime($order->created_at))}}</td>
                        <td>{{$order->detail->mobile}}</td>
                        <td>{{ucwords(strtolower($order->detail->name))}}<br>{{ucwords(strtolower($order->detail->address))}},{{ucwords(strtolower($order->detail->city))}},{{ucwords(strtolower($order->detail->state))}}({{$order->detail->pincode}})</td>
                        @if($order->status=="pending")
                        <td><button type="button" value="{{$order->id}}|cancelled" class="btn btn-outline-danger btn-sm status">Cancel</button></td>
                        @elseif($order->status=="dispatched")
                        <td><button type="button" value="{{$order->id}}|cancelled" class="btn btn-outline-danger btn-sm status">Cancel</button></td>
                        @elseif($order->status=="delivered")
                        <td class="text-success">Delivered<br>{{date('d-m-Y',strtotime($order->updated_at))}}</td>
                        @elseif($order->status=="cancelled")
                        <td class="text-danger">Cancelled<br>{{date('d-m-Y',strtotime($order->updated_at))}}</td>
                        @else
                        <tr>
                        @endif
                    </tr>
                    <?php $i++;?>
                    @endforeach
                </tbody>
        </table>
    </div>
</section>



<script src="{{ asset('web/js/jquery-3.6.0.min.js') }}"></script>
<!------Order status update------>
<script>
    $(document).ready(function() {
        $(".status").click(function(){
            if(confirm("ARE YOU SURE WANT TO CANCEL THIS ORDER!!")){
                var value = $(this).val();
                const split = value.split("|");
                var id = split[0];
                var status = split[1];
                var token = "{{ csrf_token()}}";
                $.ajax({
                type:'POST',
                url:"{{url('myorders/orderstatus')}}",
                data:{'id':id,'status':status,'_token':token},
                    success:function(data){
                        if(data.isreload==1){
                            location.reload();
                    }
                
                }
                });
            }
       });
    });
</script>
@endsection('content')