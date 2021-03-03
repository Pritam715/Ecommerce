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
           Sub SubCategory
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Tables</a></li>
          <li class="active">Sub SubCategory</li>
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
                  <th>Category</th>
                  <th>Sub Category</th>
                  <th>Sub SubCategory</th>
                  <th>Status</th>
                  <th>Action</th>
                
                </tr>
                </thead>
                <tbody>
                   @foreach($sub_subcategory as $cat)
                       <tr>
                          <td>{{$loop->index +1 }}</td>
                          <td>{{$cat->category->category}}</td>
                          <td>{{$cat->subcategory->sub_category}}</td>
                          <td>{{$cat->sub_subcategory}}</td>
                          <td>

                            <input type="checkbox" class="subsubcategorystatus btn btn-success" rel="{{$cat->id}}" data-toggle="toggle"
                            data-on="Enabled" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                            @if($cat->status == 1) checked @endif>
                           <div id="myElem" style="display:none;" class="alert alert-success">Status Enabled</div>


                          </td>
                          <td>
                              <a href="#" data-category="{{$cat->category_id}}" data-subcategory="{{$cat->sub_category_id}}" data-sub_subcategory="{{$cat->sub_subcategory}}" data-id="{{$cat->id}}" data-toggle="modal" data-target="#exampleModaledit"><i class="fa fa-edit"></i></a>
                              &nbsp &nbsp
                              <a href="{{route('sub_subcategory.delete',$cat->id)}}"><i class="fa fa-trash" style="color:red"></i></a>
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
                       <h4 class="modal-title" id="exampleModalLabel">Sub SubCategory</h4>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     </div>
                     <div class="modal-body">
                        <form action="{{route('sub_subcategory.store')}}" method="post">
                          @csrf
                                  <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" name="category_id" id="categories" >
                                   <option value="0" disabled="true" selected="true">-Select-</option>
                                     @foreach($category as $c)
                                        <option value="{{$c->id}}">{{$c->category}}</option>
                                     @endforeach
                                   </select>
                                 </div>
                                       
                                 <div class="form-group">
                                    <label> Sub Category</label>
                                    <select class="form-control" name="sub_category_id" id="subcategory">
                                        <option value="0" disabled="true" selected="true">--Wating--</option>
                                    </select>
                                 </div>


                                           
                                 <div class="form-group">
                                    <label> Sub SubCategory</label>
                                    <input type="text" class="form-control" id="sub_subcategory" name="sub_subcategory" placeholder="Enter Sub SubCategory" />
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
                      <h4 class="modal-title" id="exampleModalLabel">Edit Main Category</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="" method="post" id="editForm">
                       {{ csrf_field() }}
                        {{method_field('put')}}

                                <div class="form-group">
                                  <input type="hidden" class="form-control" id="id" name="id">
                                </div>

                                     <div class="form-group">
                                       <label>Category</label>
                                       <select class="form-control" name="category_id" id="editcategories" >
                                      <option value="0" disabled="true" selected="true">-Select-</option>
                                        @foreach($category as $c)
                                           <option value="{{$c->id}}">{{$c->category}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                          
                                    <div class="form-group">
                                       <label> Sub Category &nbsp &nbsp<span style="color:red">(Select Category First)</span></label>
                                       <select class="form-control" name="sub_category_id" id="editsubcategory" required>
                                           <option value="0" disabled="true" selected="true">--Wating--</option>
                                       </select>
                                    </div>
              
              
                                              
                                    <div class="form-group">
                                       <label> Sub SubCategory</label>
                                       <input type="text" class="form-control" id="editsub_subcategory" name="sub_subcategory" placeholder="Enter Sub SubCategory" />
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
var id = button.data('id') 
var category = button.data('category')
var subcategory= button.data('subcategory');
var sub_subcategory= button.data('sub_subcategory'); 
var modal = $(this)

modal.find('.modal-body #id').val(id);
modal.find('.modal-body #editcategories').val(category);
modal.find('.modal-body #editsubcategory').val(subcategory);
modal.find('.modal-body #editsub_subcategory').val(sub_subcategory);
modal.find('.modal-body #editForm').prop('action',`{{url('sub_subcategory/update/${id}')}}`);
})
 </script>
<script>

//Edit Modal///
$(document).ready(function(){

          $('#editcategories').on('change',function(){
                // console.log("hmm its change");
                
                var id=$(this).val();
              //  console.log(id);
                // var div=$(this).parent();
                
                var op=" ";
                
                $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                type:'get',
                url:'{!!URL::to('findsubcategory')!!}',
                data:{'id':id},
                success:function(data){
                   // console.log('success');
                
                   // console.log(data);
                
                   // console.log(data.length);
                   $('#editsubcategory').find('option').remove();

                   op+='<option value="0" selected disabled>Select</option>';
                   for(var i=0;i<data.length;i++){
                    op+='<option value="'+data[i].id+'">'+data[i].sub_category+'</option>';
                   
                    }
                    $('#editsubcategory').append(op);
      

                },
                error:function(){
                
                }
               });
        });
});    


// Modal
$(document).ready(function(){

$('#categories').on('change',function(){
      // console.log("hmm its change");
      
      var id=$(this).val();
    //  console.log(id);
      // var div=$(this).parent();
      
      var op=" ";
      
      $.ajax({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
      type:'get',
      url:'{!!URL::to('findsubcategory')!!}',
      data:{'id':id},
      success:function(data){
         // console.log('success');
      
         // console.log(data);
      
         // console.log(data.length);
         $('#subcategory').find('option').remove();

         op+='<option value="0" selected disabled>Select</option>';
         for(var i=0;i<data.length;i++){
          op+='<option value="'+data[i].id+'">'+data[i].sub_category+'</option>';
         
          }
          $('#subcategory').append(op);


      },
      error:function(){
      
      }
     });
});
});    


</script>


<script>


      $(document).ready( function () {
              $('#example1').DataTable();
                 
                 
              $(".subsubcategorystatus").change(function(){
                         var id = $(this).attr('rel');
                         if($(this).prop("checked")==true){
                            $.ajax({
                               headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                               },
                               type : 'post',
                               url : 'update-sub_subcategory-status',
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
                               url : 'update-sub_subcategory-status',
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