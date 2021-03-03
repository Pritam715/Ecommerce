@extends('Backend.partials.master')
@include('Backend.partials.Header')
@include('Backend.partials.sidebar')
@include('Backend.partials.footer')


@section('content')







<div class="content-wrapper">

    <section class="content-header">
        <h1>
          Product Image
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Tables</a></li>
          <li class="active">Product Image</li>
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
                    <th>Product Image</th>
                    <th>Action</th>
                  
                  </tr>
                  </thead>
                  <tbody>
                     @if($product_image)
                      @foreach($product_image as $image)
                      <tr>
                        <td>{{$loop->index+1}}</td>
                        <td><img src="{{asset('Images/Product/'.$image->image) }}" alt="" style="width:100px; height:100px;padding:10px"></td>
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
                       <form action="{{route('product-image',$products->id)}}" method="post" enctype="multipart/form-data">
                         @csrf
                                <div class="form-group">
                                 <input type="hidden" class="form-control"  value="{{$products->id}}" name="product_id">
                              </div>
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