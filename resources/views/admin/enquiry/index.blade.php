@extends('layouts.admin')
@section('content')

<section class="content">


            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size:2em;">ENQUIRY</h2>
                        </div>
                        <div class="body">
                        @include('partials.flash-message')
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead >
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Product</th>
                                            <th>Message</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody >
                                        <?php $i=1;?>
                                        @foreach($enquiry as $value)
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>{{ucwords(strtolower($value->name))}}</td>
                                            <td>{{$value->email}}</td>
                                            <td>{{$value->mobile}}</td>
                                            <td>{{ucwords(strtolower($value->product))}}</td>
                                            <td>{{ucwords(strtolower($value->message))}}</td>
                                            <td>{{date('d-m-Y',strtotime($value->created_at))}}</td>
                                            <td> 
                                            <a title="delete" href="enquiry/delete/{{$value->id}}" style="color:red; font-size:1.25em;" onClick="javascript: return confirm('Are you sure do you want to delete this enquiry')"><i class="fa-solid fa-trash-can"></i></a>
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
        </div>
    </section>

@endsection('content')
