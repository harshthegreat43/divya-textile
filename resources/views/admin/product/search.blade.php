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
                                            <a title="not active" href="product/status/{{$value->id}}/Y" style="color:red; font-size:1.25em;"><i class="fa-solid fa-circle-xmark"></i></a>
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