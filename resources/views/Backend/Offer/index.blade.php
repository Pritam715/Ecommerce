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
           Offer Management
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Tables</a></li>
          <li class="active">Offer Management</li>
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
              <h3 class="box-title"><button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>Add</button></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SN</th>
                  <th>Title</th>
                  <th>Offer</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Action</th>
                
                </tr>
                </thead>
                <tbody>
                   @foreach($offers as $cat)
                       <tr>
                          <td>{{$loop->index +1 }}</td>
                          <td>{{$cat->title}}</td>
                          <td>{{$cat->offer}}</td>
                          <td>
                            @if(!empty($cat->image))
                            <img src="{{asset('Images/Offer/'.$cat->image) }}" alt="" style="width:100px; height:100px">
                            @endif
                           </td>
                          <td>

                            <input type="checkbox" class="offerstatus btn btn-success" rel="{{$cat->id}}" data-toggle="toggle"
                            data-on="Enabled" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                            @if($cat->status == 1) checked @endif>
                           <div id="myElem" style="display:none;" class="alert alert-success">Status Enabled</div>


                          </td>
                          <td>
                              <a href="#" data-title="{{$cat->title}}" data-offer="{{$cat->offer}}" datadata-image="{{$cat->image}}" data-id="{{$cat->id}}" data-toggle="modal" data-target="#exampleModaledit"><i class="fa fa-edit"></i></a>
                              &nbsp &nbsp
                              <a href="{{route('offer.delete',$cat->id)}}"><i class="fa fa-trash" style="color:red"></i></a>
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

              <!-- Modal -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                   <div class="modal-content">
                     <div class="modal-header">
                       <h4 class="modal-title" id="exampleModalLabel">Brand</h4>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     </div>
                     <div class="modal-body">
                        <form action="{{route('offer.store')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                                  <div class="form-group">
                                     <label>Title</label>
                                     <input type="text" class="form-control" id="title" name="title" placeholder="Enter Brand">
                                  </div>
                                  <div class="form-group">
                                    <label>Offer</label>
                                    <input type="text" class="form-control" id="offer" name="offer" placeholder="Enter Brand">
                                 </div>

                                  <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image" id="image" >
                                 </div>

                        
                           <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>

                        </form>
                     </div>
             
                   </div>
                 </div>
               </div>


               
              <!-- Edit Modal -->
              <div class="modal fade" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLabel">Edit Offer</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="" method="post" id="editForm" enctype="multipart/form-data">
                       {{ csrf_field() }}
                        {{method_field('put')}}
                 
                                 
                                 <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Brand">
                                 </div>
                                 <div class="form-group">
                                    <label>Offer</label>
                                    <input type="text" class="form-control" id="offer" name="offer" placeholder="Enter Offer">
                                 </div>

                                 <div class="form-group">
                                   <label>Image</label>
                                   <input type="file" class="form-control" name="image">
                                </div>

                       
                       
                          <div class="form-group">
                           <button type="submit" class="btn btn-primary">Submit</button>
                         </div>

                       </form>
                    </div>
            
                  </div>
                </div>
              </div>




@endsection
@push('js')

<script>
    $(document).ready(function(){
      $("#example1").DataTable();

    })
  </script>
<script src="{{asset('Backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('Backend/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<script>
  $('#exampleModaledit').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 
var id = button.data('id');
var title = button.data('title') ;
var offer = button.data('offer') ;

var modal = $(this);

modal.find('.modal-body #id').val(id);
modal.find('.modal-body #title').val(title);
modal.find('.modal-body #offer').val(offer);
modal.find('.modal-body #editForm').prop('action',`{{url('offer/update/${id}')}}`);
})
 </script>


<script>
      $(document).ready( function () {
              $('#example1').DataTable();
                 
                 
              $(".offerstatus").change(function(){
                         var id = $(this).attr('rel');
                         if($(this).prop("checked")==true){
                            $.ajax({
                               headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                               },
                               type : 'post',
                               url : 'update-offer-status',
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
                               url : 'update-offer-status',
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

@endpush()