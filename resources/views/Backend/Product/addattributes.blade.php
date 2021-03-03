@extends('Backend.partials.master')
@include('Backend.partials.Header')
@include('Backend.partials.sidebar')
@include('Backend.partials.footer')

@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
@endpush()

@section('content')


<div class="content-wrapper">
 <section class="content-header">
    <h1>
      Product Attributes
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
      <li class="active">Product Attributes</li>
    </ol>
  </section>

<!-- Main content -->
<section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><a href=""><button class="btn btn-primary"><i class="fa fa-arrow-left"></i> &nbsp View Products</button></a></h3>
            <h3 class="box-title"><button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>Add Color</button></h3>
            <h3 class="box-title"><button class="btn btn-primary" data-toggle="modal" data-target="#AttributesModal"><i class="fa fa-plus"></i>Add Attributes</button></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-6" style="padding:20px 10px 20px 50px;font-size:15px">
                 <table>
                    <tr>
                       <td>Name :&nbsp &nbsp</td>
                       <td style="color:red; padding:2px; border-radius:10px ">{{$products->product_name}}</td>
                    </tr>
                    <tr>
                      <td>Code :&nbsp &nbsp</td>
                      <td  style="color:black; padding:2px;border-radius:10px ">{{$products->product_code}}</td>
                   </tr>
                   <tr>
                    <td> Price :&nbsp &nbsp</td>
                    <td  style="color:green; padding:2px; border-radius:10px ">{{$products->product_price}}</td>
                 </tr>
                 <tr>
                  <td> Brand :&nbsp &nbsp</td>
                  <td  style="color:blue; padding:2px; border-radius:10px ">{{$products->brand->brand_name}}</td>
                 </tr>
                 </table>
              </div>
              <div class="col-md-6" style="padding:20px 10px 20px 50px;font-size:15px">
                 <table>
                    <tr>
                      <td>Image:</td>
                     
                    </tr>
                    <tr>
                      <td><img src="{{asset('Images/Product/'.$products->product_image) }}" alt="" style="width:100px; height:100px;padding:10px"></td>
                    </tr>
                 
                 </table>
              </div>
                
                
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>

  <!--Color--->
  
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
         
          <!-- /.box-header -->
          <div class="box-body"  style="overflow:scroll;">
            <form action="{{url('editattribute/'.$products->id)}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
            <table id="example1" class="table table-bordered table-striped" >
              <thead>
                <tr class="info">
                  <th>SN</th>
                  <th>Color</th>
                  <th>SKU</th>
                  <th>Size</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Action</th>
               </tr>
              </thead>
              <tbody>
                @foreach($product_attributes as $attribute)
                <tr>
                <td style="display:none;"><input type="hidden" name="attr[]" value="{{$attribute->id}}">{{$attribute->id}}</td>
                <td>{{$loop->index+1}}</td>
                <td style="background-color:{{$attribute->color}}" class="color"><input type="text" name="color[]" class="colorpicker" value="{{$attribute->color}}" id="myInput" style="text-align:center;"> </td>
                <td><input type="text" name="sku[]" value="{{$attribute->sku}}" style="text-align:center;"> </td>
                   <td><input type="text" name="size[]" value="{{$attribute->size}}" style="text-align:center;"> </td>
                   <td><input type="text" name="price[]" value="{{$attribute->price}}" style="text-align:center;"> </td>
                   <td><input type="text" name="stock[]" value="{{$attribute->stock}}" style="text-align:center;"> </td>
                   <td class="center">
                      <div class="btn-group">
                            <input type="submit" value="update" class="btn btn-primary" style="height:30px;padding-top:4px;">
                            <a href="{{url('/deleteattribute/'.$attribute->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> </a>
                      </div>
                   </td>
                </tr>
                 @endforeach
             
              </tbody>
              <tfoot>
              
              </tfoot>
            </table>
          </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>



   <!--Color Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Add Color</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <form action="{{route('product-color',$products->id)}}" method="post" >
             @csrf
                    <div class="form-group">
                     <input type="hidden" class="form-control"  value="{{$products->id}}" name="product_id">
                  </div>
                     <div class="form-group">
                        <label>Available Color:</label>
                        <input type="text" class="form-control colorpicker"  multiple="multiple" name="color">
                     </div>

           
              <div class="form-group">
               <button type="submit" class="btn btn-primary">Submit</button>
             </div>

           </form>
        </div>

      </div>
    </div>
  </div>


  <!--Size And Price Modal-->

   <div class="modal fade" id="AttributesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Add Color</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <form action="{{route('product-attributes',$products->id)}}" method="post" >
             @csrf
                    <div class="form-group">
                     <input type="hidden" class="form-control"  value="{{$products->id}}" name="product_id">
                    </div>
                    <div class="form-group">
                      <label>Available Color:</label>
                      <input type="text" class="form-control colorpicker"  multiple="multiple" name="color">
                    </div>
                     <div class="form-group">
                      <div class="field_wrapper">
                        <div style="display:flex">
                            <input type="text" name="sku[]" id="sku" placeholder="SKU" class="form-control" style="width:120px; margin-right:5px" />
                            <input type="text" name="size[]" id="size" placeholder="SIZE" class="form-control" style="width:120px; margin-right:5px" />
                            <input type="text" name="price[]" id="price" placeholder="PRICE" class="form-control" style="width:120px;margin-right:5px" />
                            <input type="text" name="stock[]" id="stock" placeholder="STOCK" class="form-control"  style="width:120px;margin-right:5px" />&nbsp
                            <a href="javascript:void(0);" class="add_button" title="Add field" style="font-size:25px;"><i class="fa fa-plus"></i></a>
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





</div>

@endsection()

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
<script>
    $('.colorpicker').colorpicker();
</script>

<script>

$(document).ready(function(){
                  var maxField = 8; //Input fields increment limitation
                  var addButton = $('.add_button'); //Add button selector
                  var wrapper = $('.field_wrapper'); //Input field wrapper
                  var fieldHTML = '<div style="display:flex"> <input type="text" name="sku[]" id="sku" placeholder="SKU" class="form-control" style="width:120px;margin-right:5px;margin-top:10px"  /> <input type="text" name="size[]" id="size" placeholder="SIZE" class="form-control" style="width:120px;margin-right:5px;margin-top:10px"  /> <input type="text" name="price[]" id="price" placeholder="PRICE" class="form-control" style="width:120px;margin-right:5px;margin-top:10px"  />         <input type="text" name="stock[]" id="stock" placeholder="STOCK" class="form-control" style="width:120px;margin-right:5px;margin-top:10px"  />  &nbsp <a href="javascript:void(0);" class="remove_button" style="font-size:25px"><i class="fa fa-trash"></i></a></div>'; //New input field html 
                  var x = 1; //Initial field counter is 1
                  
                  //Once add button is clicked
                  $(addButton).click(function(){
                      //Check maximum number of input fields
                      if(x < maxField){ 
                          x++; //Increment field counter
                          $(wrapper).append(fieldHTML); //Add field html
                      }
                  });
                  
                  //Once remove button is clicked
                  $(wrapper).on('click', '.remove_button', function(e){
                      e.preventDefault();
                      $(this).parent('div').remove(); //Remove field html
                      x--; //Decrement field counter
                  });
              });
</script>
@endpush()