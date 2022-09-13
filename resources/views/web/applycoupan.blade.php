
<table class="example3">
        <tr>
        <td width="30%">Product :</td><td>{{$product->name}}</td>
        </tr>

        <tr>
        <td width="30%">Price :</td><td>₹ {{$product->price}}</td>
        </tr>

        <tr>
        <td width="30%">Quantity :</td><td>{{$quantity}}</td>
        </tr>

        <tr>
        <td width="30%">Discount :</td><td>₹ {{$discounted_amount}}</td>
        </tr>

        <tr>
        <td width="30%">Total Price :</td><td>₹ {{$total_price}}</td>
        </tr>

        <tr>
        <td width="30%">Delivery Charges :</td><td>₹ {{$delivery}}</td>
        </tr>

        </table>
      