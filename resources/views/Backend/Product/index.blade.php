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
          Product Lists
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Tables</a></li>
          <li class="active">Product List</li>
        </ol>
      </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><a href="{{route('product.add')}}"><button class="btn btn-primary"><i class="fa fa-plus"></i>Add Products</button></a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body"  style="overflow:scroll;">
              <table id="example1" class="table table-bordered table-striped" style="text-align: center">
                <thead>
                <tr>
                  <th>SN</th>
                  <th>Product Image</th>
                  <th>Category</th>
                  <th>Sub Cattegory</th>
                  <th>Sub SubCategory</th>
                  <th>Product Name</th>
                  <th>Product Code</th>
                  <th>Status</th>
                  <th>Featured</th>
                  <th>Action</th>
                
                </tr>
                </thead>
                <tbody>
                 
                    @foreach($products as $p)
                    <tr>
                     <td>{{$loop->index+1}}</td>
                     <td> <img src="{{asset('Images/Product/'.$p->product_image) }}" alt="" style="width:100px; height:100px" data-toggle="modal" data-target="#exampleModal"></td>
                     <td>{{$p->category->category}}</td>
                     <td>{{$p->subcategory->sub_category}}</td>
                     <td>{{$p->subsubcategory->sub_subcategory}}</td>
                     <td>{{$p->product_name}}</td>
                     <td>{{$p->product_code}}</td>
                     <td>
                       
                      <input type="checkbox" class="productstatus btn btn-success" rel="{{$p->id}}" data-toggle="toggle"
                      data-on="Published" data-off="Not Published" data-onstyle="success" data-offstyle="danger"
                      @if($p->status == 1) checked @endif>
                    

                     </td>
                     <td>
                       
                      <input type="checkbox" class="featured btn btn-success"  rel="{{$p->id}}" data-toggle="toggle"
                      data-on="Featured" data-off="Not Featured" data-onstyle="success" data-offstyle="danger"
                      @if($p->featured == 1) checked @endif>
                    

                     </td>
                     <td>
                       <div class="row">
                        <a href="{{route('product-image',$p->id)}}"> <button type="button" style="margin-top:10px;" class="btn btn-primary btn-sm" title="Add Images" ><i class="fa fa-image"></i></button></a>
                        <a href="{{route('product-attributes',$p->id)}}"> <button type="button" style="margin-top:10px;" class="btn btn-warning btn-sm" title="Add Atributes"><i class="fa fa-list"></i></button></a>
  
                       </div>
                       <div class="row">
                        <a href="{{route('product.edit',$p->id)}}"> <button type="button" style="margin-top:10px;" class="btn btn-add btn-sm" title="Edit Product" ><i class="fa fa-pencil"></i></button></a>
                        <button type="button" onclick="deleteArticle({{$p->id}});" style="margin-top:10px;margin-left:5px" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2" title="Delete Product"><i class="fa fa-trash-o"></i> </button>
                    
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

     

            
@endsection
@push('js')

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
      window.location.href='{{URL('product/delete')}}/'+ id;
    }
  }
</script>


<!--Update Status--->
<script>
  $(document).ready( function () {
          $('#example1').DataTable();
             
             
          $(".productstatus").change(function(){
                     var id = $(this).attr('rel');
                     if($(this).prop("checked")==true){
                        $.ajax({
                           headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                           },
                           type : 'post',
                           url : 'update-product-status',
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
                           url : 'update-product-status',
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
<!----Update Feeatured--->


<script>
  $(document).ready( function () {
          $('#example1').DataTable();
             
             
          $(".featured").change(function(){
                     var id = $(this).attr('rel');
                     if($(this).prop("checked")==true){
                        $.ajax({
                           headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                           },
                           type : 'post',
                           url : 'update-featured-status',
                           data : {feature:'1',id:id},
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
                           url : 'update-featured-status',
                           data : {feature:'0',id:id},
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