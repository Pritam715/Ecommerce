@extends('Backend.partials.master')
@include('Backend.partials.Header')
@include('Backend.partials.sidebar')
@include('Backend.partials.footer')


@section('content')


<div class="content-wrapper">

    <section class="content-header">
        <h1>
          EDIT PRODUCT
        </h1>

      </section>
    
    <!-- Main content -->
    <section class="content">

      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Products</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
           <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Under Category:</label>
                    <select class="form-control " style="width: 100%;" id="categories" value="{{$product->category_id}}" name="category_id">
                      <option selected="selected">--Select--</option>
                      @foreach($category as $cat)
                      <option value="{{$cat->id}}"  @if($cat->id == $product->category_id) selected @endif>{{$cat->category}}</option>
                 
                      @endforeach
                    </select>
                  </div>
              <div class="form-group">
                <label>Under Sub SubCategory:</label>
                <select class="form-control " style="width: 100%;" id="subsubcategories" value="{{$product->sub_subcategory_id}}"name="subsubcategory_id" >
                  <option value="" selected="selected">--Select--</option>
               
                </select>
              </div>
              <div class="form-group">
                <label>Product Name:</label>
                <input type="text" class="form-control" name="product_name" placeholder="Product Name" value="{{$product->product_name}}" required>
              </div>
              <div class="form-group">
                <label>Product Price:</label>
                <input type="text" class="form-control" name="product_price" placeholder="Product Price" value="{{$product->product_price}}" required>
              </div>
              <div class="form-group">
                <label>Offer Price:</label>
                <input type="text" class="form-control" name="offer_price" value="{{$product->offer_price}}" placeholder="Offer Price">
              </div>
              <div class="form-group">
                <label>Short Description:</label>
                <textarea class="form-control" rows="5" name="short_description"  required>{{$product->short_description}}</textarea> 
              </div>
              

              
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Under SubCategory:</label>
                    <select class="form-control " style="width: 100%;" id="subcategories" name="subcategory_id" value="{{$product->subcategory_id}}" >
                      <option value="" selected="selected">--Select--</option>
                     
                    </select>
                  </div>
                <div class="form-group">
                    <label>Brand:</label>
                    <select class="form-control " style="width: 100%;" name="product_brand" value="{{$product->product_brand}}"required>
                      <option selected="selected">--Select--</option>
                      @foreach($brand as $b)
                        <option value="{{$b->id}}"  @if($b->id == $product->product_brand) selected @endif>{{$b->brand_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Product Code:</label>
                    <input type="text" class="form-control" name="product_code" placeholder="Product Code" value="{{$product->product_code}}"required>
                  </div>
                  <div class="form-group">
                    <label>Product Image:</label>
                    <input type="file" accept="image/*" name="image" id="file" value="{{$product->product_image}}" onchange="loadFile(event)" >
                  </div>
                  <br>
                  <div class="form-group">
                    <label>Offer Category:</label>
                    <select class="form-control " name="offer_id">
                      <option selected="true" disabled>--Select--</option>
                      @foreach($offer as $o)
                      <option value="{{$o->slug}}" {{$product->offer_id==$o->slug ? 'selected' : ''}} >{{$o->title}}</option>
                      @endforeach
                   
                    </select>
                  </div>
                  <div class="form-group">
                    @if($product->product_image)
                    <p><img id="output" src="{{asset('Images/Product/'.$product->product_image) }}" height="100px" width="100px"></p>
                     @else
                      <p><img id="output" width="100"></p>
                   @endif
                  </div>
             
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <div class="row">
               <div class="col-md-12">
                      <div class="form-group">
                          <label>Description:</label>
                        <textarea class="form-control" id="editor" name="description" class="editor" rows="15" required>{{$product->long_description }}</textarea>
                      </div>
                      <div class="col-md-3"  style="margin-top:20px;">
                        <div class="form-group">
                            <label>
                              <input type="hidden" name="status" value="0">
                              <input type="checkbox" value="1" name="status" @if($product->status==1) checked @endif>
                               Publish
                            </label>
                        </div>  

                      </div>
                      <div class="col-md-3"  style="margin-top:20px;">
                        <div class="form-group">
                          <label>
                            <input type="hidden" name="featured" value="0">
                            <input type="checkbox" value="1" name="featured" @if($product->featured==1) checked @endif>
                              Featured
                          </label>
                        </div>
                     </div>   

               </div>
          
             
          </div>
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

              

            
@endsection


@push('js')

<script>
  var loadFile=function(event)
  {
      var image=document.getElementById('output');
      image.src=URL.createObjectURL(event.target.files[0]);
  };

</script>
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>

  //    CKEDITOR.plugins.addExternal( 'prism', '/ckeditor/plugins/prism/', 'plugin.js' );
  //     CKEDITOR.plugins.addExternal( 'codesnippet', '/myplugins/codesnippet/','plugin.js' );
  //    CKEDITOR.plugins.addExternal( 'widget', '/myplugins/widget/', 'plugin.js' );
  //    CKEDITOR.plugins.addExternal( 'lineutils', '/myplugins/lineutils/', 'plugin.js' );
    CKEDITOR.replace('editor', {
          filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
        // extraPlugins: 'codesnippet'
         
         
         });	
  </script> 




<script>

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
         $('#subcategories').find('option').remove();

         op+='<option value="0" selected disabled>Select</option>';
         for(var i=0;i<data.length;i++){
          op+='<option value="'+data[i].id+'" >'+data[i].sub_category+'</option>';
         
          }
          $('#subcategories').append(op);


      },
      error:function(){
      
      }
     });
});
});    

///sub_subcategory


$(document).ready(function(){

$('#subcategories').on('change',function(){
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
      url:'{!!URL::to('findsubsubcategory')!!}',
      data:{'id':id},
      success:function(data){
         //console.log('success');
      
         // console.log(data);
      
         // console.log(data.length);
         $('#subsubcategories').find('option').remove();

         op+='<option value="0" selected disabled>Select</option>';
         for(var i=0;i<data.length;i++){
          op+='<option value="'+data[i].id+'">'+data[i].sub_subcategory+'</option>';

          }
          $('#subsubcategories').append(op);


      },
      error:function(){
      
      }
     });
});
});    

</script>

@endpush()