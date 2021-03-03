@extends('Backend.partials.master')
@include('Backend.partials.Header')
@include('Backend.partials.sidebar')
@include('Backend.partials.footer')


@push('css')
<link rel="stylesheet" href="{{url('Backend/plugins/datatables/dataTables.bootstrap.css')}}">
@endpush()

@section('content')

<div class="content-wrapper">

  
    <section class="content-header">
        <h1>
         Role Management
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Tables</a></li>
          <li class="active">Role Management</li>
        </ol>
      </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div id="message_success" style="display:none;" class="alert alert-success">Status Enabled</div>
          <div id="message_error" style="display:none;" class="alert alert-danger">Status Disabled</div>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> <a href="{{route('roles.create')}}"><button class="btn btn-primary"><i class="fa fa-plus"></i>Add Role</button></a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SN</th>
                  <th>Name</th>
                  <th>Action</th>
                
                </tr>
                </thead>
                <tbody>
                   @foreach($roles as $r)
                       <tr>
                          <td>{{$loop->index +1 }}</td>
                          <td>{{$r->name}}</td>
                          <td>
                            @can('role-edit')
                            <a href="{{route('roles.edit',$r->id)}}"  ><i class="fa fa-edit"></i></a>
                           
                              &nbsp &nbsp
                              
                              <a href="{{route('roles.delete',$r->id)}}"><i class="fa fa-trash" style="color:red"></i></a>
                              @endcan()
                            </td> 
                       </tr>

                   @endforeach
               
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</div>


@endsection()