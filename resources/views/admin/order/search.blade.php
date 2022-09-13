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
                                            <td>{{$value->mobile}}</td>
                                            <td>{{ucwords(strtolower($value->address))}}({{$value->pincode}})</td>
                                            <td>{{ucwords(strtolower($value->detail->city))}}</td>
                                            <td>{{ucwords(strtolower($value->detail->state))}}</td>
                                            <td>{{ucwords(strtolower($value->product->name))}}({{$value->product->sku}})</td>
                                            <td>₹ {{$value->amount}}</td>
                                            <td>
                                               @if($value->status=="pending")
                                               <style> .btn-default{display:none;} </style>
                                                <select name="status" class="order btn bg-blue waves-float waves-effect">
                                                    <option value="{{$value->id}}|pending" <?php if($value->status=="pending"){ echo "selected";};?>>Pending</option>

                                                    <option value="{{$value->id}}|dispatched" <?php if($value->status=="dispatched"){ echo "selected";};?>>Dispatched</option>

                                                    <option value="{{$value->id}}|delivered" <?php if($value->status=="delivered"){ echo "selected";};?>>Delivered</option>

                                                    <option value="{{$value->id}}|cancelled" <?php if($value->status=="cancelled"){ echo "selected";};?>>Cancelled</option>
                                                </select>
                                                @elseif($value->status=="dispatched")
                                                <style> .btn-default{display:none;} </style>
                                                <select name="status" class="order btn bg-orange waves-float waves-effect">
                                                    <option value="{{$value->id}}|pending" <?php if($value->status=="pending"){ echo "selected";};?>>Pending</option>

                                                    <option value="{{$value->id}}|dispatched" <?php if($value->status=="dispatched"){ echo "selected";};?>>Dispatched</option>

                                                    <option value="{{$value->id}}|delivered" <?php if($value->status=="delivered"){ echo "selected";};?>>Delivered</option>

                                                    <option value="{{$value->id}}|cancelled" <?php if($value->status=="cancelled"){ echo "selected";};?>>Cancelled</option>
                                                </select> 
                                                @elseif($value->status=="delivered")
                                                <style> .btn-default{display:none;} </style>
                                                <select name="status" class="order btn bg-green waves-float waves-effect">
                                                    <option value="{{$value->id}}|pending" <?php if($value->status=="pending"){ echo "selected";};?>>Pending</option>

                                                    <option value="{{$value->id}}|dispatched" <?php if($value->status=="dispatched"){ echo "selected";};?>>Dispatched</option>

                                                    <option value="{{$value->id}}|delivered" <?php if($value->status=="delivered"){ echo "selected";};?>>Delivered</option>

                                                    <option value="{{$value->id}}|cancelled" <?php if($value->status=="cancelled"){ echo "selected";};?>>Cancelled</option>
                                                </select>
                                                @else
                                                <style> .btn-default{display:none;} </style>
                                                <select name="status" class="order btn bg-red waves-float waves-effect">
                                                    <option value="{{$value->id}}|pending" <?php if($value->status=="pending"){ echo "selected";};?>>Pending</option>

                                                    <option value="{{$value->id}}|dispatched" <?php if($value->status=="dispatched"){ echo "selected";};?>>Dispatched</option>

                                                    <option value="{{$value->id}}|delivered" <?php if($value->status=="delivered"){ echo "selected";};?>>Delivered</option>

                                                    <option value="{{$value->id}}|cancelled" <?php if($value->status=="cancelled"){ echo "selected";};?>>Cancelled</option>
                                                </select>
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $i++;?>
                                     @endforeach
                                    </tbody>                           
</table>