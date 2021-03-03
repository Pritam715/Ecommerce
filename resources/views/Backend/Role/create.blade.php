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
          ADD ROLE
        </h1>

      </section>
    
    <!-- Main content -->
    <section class="content">

      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add Role</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
           <form action="{{route('roles.store')}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Role Name:</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Role Name" >
                  </div> 
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group mt-5">
                    <strong>Permission:</strong>
                    <br/>
                 
                    @foreach($permission_categories as $group)
                    <div class="col-md-4" style="margin-top:20px;">
                        <Strong style="color:#3c8dbc">{{$group->name}}</Strong>
                
                        @foreach($group->permissions as $value)
                        <div >
                            <input type="checkbox" class="form-check-input" name="permission[]"  value="{{ $value->id }}">
                            <label>{{$value->name}}</label>
                         <br/>
                        </div>
                    
                       
                        @endforeach
        
                    </div>
               
                    @endforeach
                </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        
          <div class="row"  style="margin-top:20px;">
              <div class="col-md-6">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>

              </div>
          </div>
        
          
        </form>

        </div>
        <!-- /.box-body -->
       
      </div>

    </section>
</div>


</div>
@endsection()