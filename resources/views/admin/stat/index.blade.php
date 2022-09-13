@extends('layouts.admin')
@section('content')

<?php //dd($result); ?>
<section class="content">


            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-size:2em;">STATIC</h2>
                            <ul class="header-dropdown m-r--5">
                                <a href="{{url('admin/stat/add')}}"><button type="button" class="btn btn-primary">ADD</button></a>
                            </ul>
                        </div>
                        <div class="body">
                        @include('partials.flash-message')
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead >
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Name</th>
                                            <th>Created</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody >
                                        <?php $i=1;?>
                                        @foreach($result as $value)
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>{{ucwords(strtolower($value->name))}}</td>
                                            <td>{{date('d-m-Y',strtotime($value->created_at))}}</td>
                                            <td>
                                            @if($value->status=='N')
                                            <a title="inactive" href="stat/status/{{$value->id}}/Y" style="color:red; font-size:1.25em;"><i class="fa-solid fa-circle-xmark"></i></a>
                                            @else
                                            <a title="active" href="stat/status/{{$value->id}}/N" style="color:limegreen; font-size:1.25em;"><i class="fa-solid fa-circle-check"></i></a>
                                            @endif 
                                            </td>
                                            <td>
                                            <a title="delete" href="stat/delete/{{$value->id}}" style="color:red; font-size:1.25em;" onClick="javascript: return confirm('Are you sure do you want to delete this stat')"><i class="fa-solid fa-trash-can"></i></a>
                                            <a title="edit" href="stat/edit/{{$value->id}}" style="color:blue; font-size:1.25em;"><i class="fa-solid fa-pen-to-square"></i></a>
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
