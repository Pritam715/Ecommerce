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
          Advertisement Image
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Tables</a></li>
          <li class="active">Advertisement Image</li>
        </ol>
      </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
  
            <div class="box">
              <div class="box-header">
                <h3 class="box-title"><a href=""><button class="btn btn-primary"><i class="fa fa-arrow-left"></i> &nbsp View Products</button></a></h3>
                <h3 class="box-title"><button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>Add Images</button></h3>
              </div>
              <!-- /.box-header -->
             <section class="content">
                <div class="row">
                  <div class="col-xs-12">
          
                    <div class="box">
                     
                      <!-- /.box-header -->
                      <div class="box-body"  style="overflow:scroll;">
                        <table id="example1" class="table table-bordered table-striped" style="text-align: center">
                          <thead>
                          <tr>
                            <th>SN</th>
                            <th>Advertisment Image</th>
                            <th>Status</th>
                            <th>Action</th>
                          
                          </tr>
                          </thead>
                          <tbody>
                             @if($advertisement)
                              @foreach($advertisement as $image)
                              <tr>
                                <td>{{$loop->index+1}}</td>
                                <td><img src="{{asset('Images/Advertisement/'.$image->image) }}" alt="" style="width:100px; height:100px;padding:10px"></td>
                                <td>
                       
                                    <input type="checkbox" class="advertisement btn btn-success" rel="{{$image->id}}" data-toggle="toggle"
                                    data-on="Enabled" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                                    @if($image->status == 1) checked  @endif>
                                   <div id="myElem" style="display:none;" class="alert alert-success">Status Enabled</div>
              
                                   </td>
                               
                                <td> <button type="button" onclick="deleteImage({{$image->id}});" style="margin-top:10px;margin-left:5px" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2" title="Delete Product"><i class="fa fa-trash-o"></i> </button></td>
                              </tr>
                              @endforeach
        
                              @else
                              <td>Image is not inserted</td>
                              @endif
                         
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
        
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>


    



              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLabel">Add Images</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                       <form action="{{route('advertisement.store')}}" method="post" enctype="multipart/form-data">
                         @csrf
                             
                                 <div class="form-group">
                                    <label>Image:</label>
                                    <input type="file" class="form-control"  multiple="multiple" name="image[]">
                                 </div>

                       
                          <div class="form-group">
                           <button type="submit" class="btn btn-primary">Submit</button>
                         </div>

                       </form>
                    </div>
            
                  </div>
                </div>
              </div>

















 
</div>







@endsection



@push('js')
<script src="{{asset('Backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('Backend/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<script>
    $(document).ready( function () {
            $('#example1').DataTable();
               
               
            $(".advertisement").change(function(){
                       var id = $(this).attr('rel');
                       if($(this).prop("checked")==true){
                          $.ajax({
                             headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             },
                             type : 'post',
                             url : 'update-advertisement-status',
                             data : {status:'1',id:id},
                             success:function(data){
                                $("#message_success").show();
                                setTimeout(function() { $("#message_success").fadeOut('slow'); }, 2000);
                             },error:function(){
                                alert("Error");
                             }
                          });
             
                       }else{
                         $.ajax({
                             headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             },
                             type : 'post',
                             url : 'update-advertisement-status',
                             data : {status:'0',id:id},
                             success:function(resp){
                                $("#message_error").show();
                                setTimeout(function() { $("#message_error").fadeOut('slow'); }, 2000);
                             },error:function(){
                                alert("Error");
                             }
                          });
                       }
                });
  
    });          
  
  
  
  
  
  </script>
<script type="text/javascript">
  function deleteImage(id)
  {
    if(confirm('Are You Sure you want to delete'))
    {
      window.location.href='{{URL('delete/images')}}/'+ id;
    }
  }
</script>

@endpush