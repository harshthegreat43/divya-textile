@extends('layouts.admin')
@section('content')

<section class="content">


            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size:2em;">EMAIL</h2>
                        </div>
                        <div class="body">
                        @include('partials.flash-message')
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead >
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Title</th>
                                            <th>Subject</th>
                                            <th>From</th>
                                            <th>Content</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody >
                                        <?php $i=1;?>
                                        @foreach($email as $value)
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>{{ucwords(strtolower($value->title))}}</td>
                                            <td>{{ucwords(strtolower($value->subject))}}</td>
                                            <td>{{$value->from_email}}</td>
                                            <td>{{ucwords(strtolower($value->content))}}</td>
                                            <td>{{date('d-m-Y',strtotime($value->created_at))}}</td>
                                            <td>   
                                            @if($value->status=='N')
                                            <a title="not active" href="email/status/{{$value->id}}/Y" style="color:red; font-size:1.25em;"><i class="fa-solid fa-circle-xmark"></i></a>
                                            @else
                                            <a title="active" href="email/status/{{$value->id}}/N" style="color:limegreen; font-size:1.25em;"><i class="fa-solid fa-circle-check"></i></a>
                                            @endif 
                                            <a title="delete" href="email/delete/{{$value->id}}" style="color:red; font-size:1.25em;" onClick="javascript: return confirm('Are you sure do you want to delete this email')"><i class="fa-solid fa-trash-can"></i></a>
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
