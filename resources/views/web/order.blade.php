@extends('weblayouts.web')
@section('content')
            <div class="categoryPage">
                <section id="products">
                    <hgroup class="heading">
                        <h2>Place Order</h2>
                    </hgroup>
                    <div class="container mt-5">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-block">	
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
            @include('webpartials.flash-message')
        <form method="post" action="{{url('saveorder')}}">
            <!-- CROSS Site Request Forgery Protection -->
            @csrf
            <div class="row">
            <input type="hidden" name="product_id" value="{{$product->id}}" required hidden>
            <input type="hidden" name="customer_id" value="{{$customer_id}}" required hidden>

            <div class="col-md-6"><div class="form-group">
            <label>Name</label>    
            <input type="text" class="form-control" placeholder="Enter Your Name" name="name" id="name" required>
            </div></div>
            <div class="col-md-6"><div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Enter Your Email"  name="email" id="email" required>
            </div></div>
            <div class="col-md-6"> <div class="form-group">
                <label>State</label>
                <select name="state" class="state form-control" required>
                    <option value="" selected>Select State</option>
                    @foreach($state as $states)
                    <option value="{{$states->id}}">{{ucwords(strtolower($states->name))}}</option>
                    @endforeach
                </select>
            </div></div>
            <div class="col-md-6">
                 <div class="form-group">
                <label>City</label>
                <select name="city" id="show_cities" class=" form-control" required>
                    <option value="">Select City</option>
                </select>
            </div></div>
            <div class="col-md-6"><div class="form-group">
                <label>Pincode</label>
                <input type="text" class="form-control" placeholder="Enter Your Pincode"  name="pincode" required>
            </div></div>
            <div class="col-md-6"><div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control" placeholder="Enter Your Mobile"  name="mobile" id="mobile" required>
            </div></div>
            <div class="col-md-12"><div class="form-group">
                <label>Address</label>
                <textarea class="form-control" placeholder="Enter Your Address"  name="address" rows="3" required></textarea>
            </div></div>
            <div class="col-md-6"> <div class="form-group">
            <label >Coupan</label>
            
                <select class='coupan form-control' name = "coupan_code">
                <option class="data" data-product ="{{$product->id}}" value="0"  data-id = "" selected>Select Coupan</option>
                @foreach ($coupan as $value)
                    <option class="data" data-product ="{{$product->id}}" data-id ='{{$value->id}}' value ='{{$value->id}}'>{{$value->coupan_code}} ({{ucwords(strtolower($value->description))}} over ₹ {{$value->min_amount}})</option>
                  @endforeach
                  </select>
            </div></div>

            <div class="col-md-6"><div class="form-group">
            <label>Quantity</label>    
            <select name="quantity" id="quantity" class=" form-control" required>
                <option value='1' selected>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
                <option value='5'>5</option>
            </select>

            </div></div>

            <div></div><div></div>
 
        <div class="col-md-6">
            <div class="form-group" id="caldata">
        <table >
        <tr>
        <td width="20%">Product :</td><td>{{$product->name}}</td>
        </tr>

        <tr>
        <td width="20%">Price :</td><td>₹ {{$product->price}}</td>
        </tr>

        <tr>
        <td width="20%">Quantity :</td><td>1</td>
        </tr>

        <tr>
        <td width="20%">Discount :</td><td>0</td>
        </tr>

        <tr>
        <td width="20%">Total Price :</td><td>₹ {{$product->price}}</td>
        </tr>

        <tr>
        <td width="30%">Delivery Charges :</td><td>₹ {{$delivery}}</td>
        </tr>

        </table>
        </div>
        </div>


        <div class="col-md-12"><br><input type="submit" name="send" value="Submit" class="btn btn-dark btn-block"></div>
        </div>
            
         </form>
    </div>







</section></div>
         
             

           

            <section id="supter-box">
                <div class="container">
                    <div class="row d-flex justify-content-between g-0">
                        <div class="col-md-3 box-contant">
                            <div class="info">
                                <ul>
                                    <li class="d-flex align-items-center">
                                        <i class="fa-regular fa-star"></i>
                                        <div>
                                            <h6>Unique Products</h6>
                                            <span>We are manufacture own</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-3 box-contant">
                            <div class="info">
                                <ul>
                                    <li class="d-flex align-items-center">
                                        <i class="fa-solid fa-phone"></i>
                                        <div>
                                            <h6>100% Satisfaction</h6>
                                            <span>Your Satisfaction is our duty</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-3 box-contant">
                            <div class="info">
                                <ul>
                                    <li class="d-flex align-items-center">
                                        <i class="fa-solid fa-truck"></i>
                                        <div>
                                            <h6>Fast delivery</h6>
                                            <span>Free delivery over ₹ {{$free_delivery}}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <style>
  
form {
    border: 1px solid #a52a2a;
   margin-bottom:50px;
    padding: 40px 50px 45px;
}
.form-control:focus {
    border-color: #000;
    box-shadow: none;
}
label {
    font-weight: 600;
}
.error {
    color: red;
    font-weight: 400;
    display: block;
    padding: 6px 0;
    font-size: 14px;
}
.form-control.error {
    border-color: red;
    padding: .375rem .75rem;
}
</style>


<script src="{{ asset('admin/js/jquery-3.6.0.min.js') }}"></script>

<input type="hidden" class="couponid" value="0" />
<script>
    $(document).ready(function() {
       
        $(".coupan").change(function(){
           
            //var coupan_id = $('.data').data('id');
            var coupan_id = $(this).find(':selected').data('id');
           // alert(coupan_id)
            $('.couponid').val(coupan_id);
            var product_id = $('.data').data('product');
            var quantity =  $('#quantity').val();
        //    alert(quantity)
            var token = "{{ csrf_token()}}";
         ///   alert(product_id);
        $.ajax({
        type:'POST',
        url:"{{url('applycoupan')}}",
        data:{'coupan_id':coupan_id,'product_id':product_id,'quantity':quantity,'_token':token},
        success:function(data){
           // alert(data.html)
            $('#caldata').html(data.html);  
        }
    });
      });
    });

</script>

<script>
        

    $(document).ready(function() {

        $('#quantity').change(function(){
            // var coupan_id = $('.data').find('selected').val();
             var coupan_id = $('.couponid').val();
            // alert(coupan_id)
                var product_id = $('.data').data('product');
                var quantity =  $('#quantity').find(':selected').val();
             //   alert(quantity);
                var token = "{{ csrf_token()}}";

            $.ajax({
            type:'POST',
            url:"{{url('applycoupan')}}",
            data:{'coupan_id':coupan_id,'product_id':product_id,'quantity':quantity,'_token':token},
            success:function(data){
            // alert(data.html)
                $('#caldata').html(data.html);  
            }
    });


        });
    });



    </script>


@endsection('content')

