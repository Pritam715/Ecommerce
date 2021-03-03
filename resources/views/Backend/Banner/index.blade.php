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
          Banner Lists
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Tables</a></li>
          <li class="active">Banner Lists</li>
        </ol>
      </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>Add Banner</button></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body"  style="overflow:scroll;">
              <table id="example1" class="table table-bordered table-striped" style="text-align: center">
                <thead>
                <tr>
                  <th>SN</th>
                  <th>Banner Image</th>
                  <th>Category</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Offer</th>
                  <th>Link</th>
                  <th>Status</th>
                  <th>Action</th>
                
                
                </tr>
                </thead>
                <tbody>
                 
                    @foreach($banner as $b)
                    <tr>
                     <td>{{$loop->index+1}}</td>
                     <td> <img src="{{asset('Images/Banner/'.$b->banner_image) }}" alt="" style="width:100px; height:100px" data-toggle="modal" data-target="#exampleModal"></td>
                     <td>{{$b->category->category}}</td>
                     <td>{{$b->title}}</td>
                     <td>{!! str_limit(strip_tags($b->description),20,'...'); !!}</td>
                     <td>{{$b->offer_id}}</td>
                     <td>{{$b->link}}</td>
                     <td>
                       
                      <input type="checkbox" class="bannerstatus btn btn-success" rel="{{$b->id}}" data-toggle="toggle"
                      data-on="Published" data-off="Not Published" data-onstyle="success" data-offstyle="danger"
                      @if($b->status == 1) checked @endif>
                    

                     </td>
    
                     <td>
                       
                       <div class="row">
                        <a href="#"> <button type="button" style="margin-top:10px;" 
                        data-id="{{$b->id}}" data-category_id="{{$b->category_id}}" data-title="{{$b->title}}"  data-description="{{$b->description}}" data-offer="{{$b->offer_id}}" data-link="{{$b->link}}"
                          
                        data-toggle="modal" data-target="#exampleModaledit" class="btn btn-add btn-sm" title="Edit Product" ><i class="fa fa-pencil"></i></button></a>
                        <button type="button" onclick="deleteArticle({{$b->id}});" style="margin-top:10px;margin-left:5px" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2" title="Delete Product"><i class="fa fa-trash-o"></i> </button>
                    
                      </div>
            
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
                      <h4 class="modal-title" id="exampleModalLabel">Add Banner</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                       <form action="{{route('banners.store')}}" method="post" enctype="multipart/form-data">
                         @csrf
                         <div class="row">

                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category:</label>
                                    <select class="form-control" name="category_id">
                                      <option value="">---Select---</option>
                                      @foreach($category as $c)
                                      <option value="{{$c->id}}">{{$c->category}}</option>
                                      @endforeach
                                    </select>
                                 </div>


                                 <div class="form-group">
                                  <label>Title:</label>
                                  <input type="text" class="form-control"  name="title" placeholder="Enter Banner Title">
                               </div>


                               <div class="form-group">
                                <label>Description:</label>
                                <textarea class="form-control" rows="6" name="description">Description</textarea>
                             </div>
                             </div>

                    
                         
                             <div class="col-md-6">
                              <div class="form-group">
                                  <label>Offer:</label>
                                  <select class="form-control" name="offer_id">
                                    <option value="">---Select---</option>
                             
                                  </select>
                               </div>

                               <div class="form-group">
                                <label>Link:</label>
                                <select class="form-control" name="link">
                                  <option value="">---Select---</option>
                              
                                </select>
                             </div>

                             <div class="form-group">
                              <label>Product Image:</label>
                              <input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)" required>
                            </div>

                            <div class="form-group">
                              <p><img id="output" width="100"></p>
                            </div>

                             </div>
                         </div>
                       
                          <div class="form-group">
                           <button type="submit" class="btn btn-primary">Submit</button>
                         </div>

                       </form>
                    </div>
            
                  </div>
                </div>
              </div>


<!--  EditModal -->
<div class="modal fade" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Edit Banner </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="editForm" enctype="multipart/form-data">
         {{ csrf_field() }}
          {{method_field('put')}}
   
          <div class="row">

            <div class="col-md-6">
               <div class="form-group">
                   <label>Category:</label>
                   <select class="form-control" name="category_id" id="category_id">
                     <option value="">---Select---</option>
                     @foreach($category as $c)
                     <option value="{{$c->id}}">{{$c->category}}</option>
                     @endforeach
                   </select>
                </div>


                <div class="form-group">
                 <label>Title:</label>
                 <input type="text" class="form-control"  name="title" id="title" placeholder="Enter Banner Title">
              </div>


              <div class="form-group">
               <label>Description:</label>
               <textarea class="form-control" rows="6" name="description" id="description">Description</textarea>
            </div>
            </div>

   
        
            <div class="col-md-6">
             <div class="form-group">
                 <label>Offer:</label>
                 <select class="form-control" name="offer_id" id="offer_id">
                   <option value="">---Select---</option>
            
                 </select>
              </div>

              <div class="form-group">
               <label>Link:</label>
               <select class="form-control" name="link" id="link">
                 <option value="">---Select---</option>
             
               </select>
            </div>

            <div class="form-group">
             <label>Banner Image:</label>
             <input type="file" accept="image/*" name="image" onchange="loadFile(event)">
           </div>

            <div class="form-group">
                <p><img id="output1" width="100"></p>
             </div>

            </div>
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
  var loadFile=function(event)
  {
      var image=document.getElementById('output');
      image.src=URL.createObjectURL(event.target.files[0]);
  };
  var loadFile=function(event)
  {
      var image=document.getElementById('output1');
      image.src=URL.createObjectURL(event.target.files[0]);
  };


</script>



<script>
    $(document).ready(function(){
      $("#example1").DataTable();

    })
</script>
<script src="{{asset('Backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('Backend/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<script type="text/javascript">
  function deleteArticle(id)
  {
    if(confirm('Are You Sure you want to delete'))
    {
      window.location.href='{{URL('banners/delete')}}/'+ id;
    }
  }
</script>

<script>
  $('#exampleModaledit').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 
var id = button.data('id') 
var category = button.data('category_id')
var title=button.data('title')
var description=button.data('description')
var offer=button.data('offer')
var link=button.data('link') 
var modal = $(this)

modal.find('.modal-body #id').val(id);
modal.find('.modal-body #category_id').val(category);
modal.find('.modal-body #title').val(title);
modal.find('.modal-body #description').val(description);
modal.find('.modal-body #offer').val(offer);
modal.find('.modal-body #link').val(link);
modal.find('.modal-body #editForm').prop('action',`{{url('banners/update/${id}')}}`);
})
 </script>








<!--Update Status--->
<script>
  $(document).ready( function () {
          $('#example1').DataTable();
             
             
          $(".bannerstatus").change(function(){
                     var id = $(this).attr('rel');
                     if($(this).prop("checked")==true){
                        $.ajax({
                           headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                           },
                           type : 'post',
                           url : 'update-banner-status',
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
                           url : 'update-banner-status',
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

@endpush