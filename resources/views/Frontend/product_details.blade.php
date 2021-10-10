@extends('Frontend.partials.master')
@include('Frontend.partials.header')
@include('Frontend.partials.footer')

@push('css')

<link rel="stylesheet" href="{{asset('Frontend/css/custom.css')}}"/>
@endpush()

@section('content')
<section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container"><a data-lens-image="{{asset('Images/Product/'.$details->product_image)}}" class="simpleLens-lens-image"><img src="{{asset('Images/Product/'.$details->product_image)}}" width="100%" class="simpleLens-big-image"></a></div>
                      </div>
                     
                      <div class="simpleLens-thumbnails-container">
                        <a data-big-image="{{asset('Images/Product/'.$details->product_image)}}" data-lens-image="{{asset('Images/Product/'.$details->product_image)}}" class="simpleLens-thumbnail-wrapper" href="#">
                          <img src="{{asset('Images/Product/'.$details->product_image)}}"/>
                        </a>   
                        @foreach($images as $img)
                         
                          <a data-big-image="{{asset('Images/Product/'.$img->image)}}" data-lens-image="{{asset('Images/Product/'.$img->image)}}" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="{{asset('Images/Product/'.$img->image)}}"/>
                          </a>                                    
                          @endforeach
                      </div>
                
                    </div>
                  </div>
                </div>
           
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <form  method="post" enctype="multipart/form-data" >
                   {{csrf_field()}}
                  <div class="aa-product-view-content">
                    <h3>{{$details->product_name}}</h3>
                    <input type="hidden" class="form-control"  value="{{$details->id}}" name="product_id" id="product_id">
                    <input type="hidden" class="form-control"  value="{{$details->product_name}}" name="product_name" id="product_name">
                    <input type="hidden" class="form-control"  value="{{$details->product_code}}" name="product_code" id="product_code">
                    <input type="hidden" class="form-control"  value="{{$details->product_price}}" name="product_price" id="product_price">
                    <input type="hidden" class="form-control"  value="{{$details->product_image}}" name="product_image" id="product_image">
                    <input type="hidden" class="form-control"   name="product_price" id="price">
                    <div class="aa-price-block">
                      <span class="aa-product-view-price" id="price">{{$details->product_price}}</span>
                      <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                    </div>
                    <p style="padding:20px;background-color:rgb(241, 236, 236)">{{$details->short_description}}</p>


                    <!--color-->
                    <p>Select Color:  <span  style="color:red;margin-left:10px" id="colorboxid_error_msg"></span></p>
                    <div class="aa-color-tag">
                      
                      @foreach($attributes->unique('color') as $attr)
                    
                     <label><input type="radio" id="colorboxid" class="color" value="{{$attr->color}}" name="color"><span style="background-color:{{$attr->color}}"></span></label>
                
                      @endforeach()                 
                    </div>
                     <!--size-->
                    <p>Available Size: <span  style="color:red;margin-left:10px" id="checkboxid_error_msg"></span></p>
                    <div class="aa-prod-view-size">
                      <label  id="size"></label>
                     
                    <!-- <label><input type="radio"  value="S" name="size"><span>S</span></label>
                     <label><input type="radio"   value="M"name="size"><span>M</span></label>
                     <label><input type="radio"   value="L"name="size"><span>L</span></label>
                     <label><input type="radio"   value="XL" name="size"><span>XL</span></label>
                     <label><input type="radio"   value="XXL" name="size"><span>XXL</span></label>-->
                    </div>
               
                    <div class="aa-prod-quantity">
                     
                        <select  name="quantity" id="quantity">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      <p class="aa-prod-category">
                        Category: <a href="#">Polo T-Shirt</a>
                      </p>
                    </div>
                    <div class="aa-prod-view-bottom">
                     <button type="button" name="cart" value="cart" class="aa-add-to-cart-btn cart">Add To Cart</button>
                     <button type="button" name="wishlist" value="wishlist" class="aa-add-to-cart-btn wishlist">Add To WishList</button>
                    </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Description</a></li>
                <li><a href="#review" data-toggle="tab">Reviews</a></li>                
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  <span>{!! $details->long_description !!}</span>
                </div>
                <div class="tab-pane fade " id="review">
                 <div class="aa-product-review-area">
                   <h4>2 Reviews for T-Shirt</h4> 
                   <ul class="aa-review-nav">
                     <li>
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                            </a>
                          </div>
                          <div class="media-body">
                            <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                            <div class="aa-product-rating">
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star-o"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                            </a>
                          </div>
                          <div class="media-body">
                            <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                            <div class="aa-product-rating">
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star-o"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                          </div>
                        </div>
                      </li>
                   </ul>
                   <h4>Add a review</h4>
                   <div class="aa-your-rating">
                     <p>Your Rating</p>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                   </div>
                   <!-- review form -->
                   <form action="" class="aa-review-form">
                      <div class="form-group">
                        <label for="message">Your Review</label>
                        <textarea class="form-control" rows="3" id="message"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name">
                      </div>  
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="example@gmail.com">
                      </div>

                      <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                   </form>
                 </div>
                </div>            
              </div>
            </div>
            <!-- Related product -->
            <div class="aa-product-related-item">
              <h3>Related Products</h3>
              <ul class="aa-product-catg aa-related-item-slider">
                <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="img/man/polo-shirt-2.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                     <figcaption>
                      <h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
                      <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                    </figcaption>
                  </figure>                     
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
                  </div>
                  <!-- product badge -->
                  <span class="aa-badge aa-sale" href="#">SALE!</span>
                </li>
                 <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="img/women/girl-2.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                    <figcaption>
                      <h4 class="aa-product-title"><a href="#">Lorem ipsum doller</a></h4>
                      <span class="aa-product-price">$45.50</span>
                    </figcaption>
                  </figure>                      
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                  </div>
                  <!-- product badge -->
                   <span class="aa-badge aa-sold-out" href="#">Sold Out!</span>
                </li>
                <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="img/man/t-shirt-1.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                  </figure>
                  <figcaption>
                    <h4 class="aa-product-title"><a href="#">T-Shirt</a></h4>
                    <span class="aa-product-price">$45.50</span>
                  </figcaption>
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                  </div>
                  <!-- product badge -->
                   <span class="aa-badge aa-hot" href="#">HOT!</span>
                </li>
                <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="img/women/girl-3.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                     <figcaption>
                      <h4 class="aa-product-title"><a href="#">Lorem ipsum doller</a></h4>
                      <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                    </figcaption>
                  </figure>                     
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                  </div>
                </li>
                <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="img/man/polo-shirt-1.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                    <figcaption>
                      <h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
                      <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                    </figcaption>
                  </figure>                      
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                  </div>
                </li>
                <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="img/women/girl-4.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                    <figcaption>
                      <h4 class="aa-product-title"><a href="#">Lorem ipsum doller</a></h4>
                      <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                    </figcaption>
                  </figure>                     
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                  </div>
                  <!-- product badge -->
                  <span class="aa-badge aa-sold-out" href="#">Sold Out!</span>
                </li>    
                <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="img/man/polo-shirt-4.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                     <figcaption>
                      <h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
                      <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                    </figcaption>
                  </figure>                     
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                  </div>
                  <!-- product badge -->
                  <span class="aa-badge aa-hot" href="#">HOT!</span>
                </li> 
                <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="img/women/girl-1.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                     <figcaption>
                      <h4 class="aa-product-title"><a href="#">This is Title</a></h4>
                      <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                    </figcaption>
                  </figure>                     
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
                  </div>
                  <!-- product badge -->
                  <span class="aa-badge aa-sale" href="#">SALE!</span>
                </li>                                                                                   
              </ul>
              <!-- quick view modal -->                  
              {{-- <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">                      
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <div class="row">
                        <!-- Modal view slider -->
                        <div class="col-md-6 col-sm-6 col-xs-12">                              
                          <div class="aa-product-view-slider">                                
                            <div class="simpleLens-gallery-container" id="demo-1">
                              <div class="simpleLens-container">
                                  <div class="simpleLens-big-image-container">
                                      <a class="simpleLens-lens-image" data-lens-image="img/view-slider/large/polo-shirt-1.png">
                                          <img src="img/view-slider/medium/polo-shirt-1.png" class="simpleLens-big-image">
                                      </a>
                                  </div>
                              </div>
                              <div class="simpleLens-thumbnails-container">
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-1.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-1.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-1.png">
                                  </a>                                    
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-3.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-3.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-3.png">
                                  </a>

                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-4.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-4.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-4.png">
                                  </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal view content -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-content">
                            <h3>T-Shirt</h3>
                            <div class="aa-price-block">
                              <span class="aa-product-view-price">$34.99</span>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae repudiandae quod nulla porro quidem, itaque quis quaerat!</p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">
                              <a href="#">S</a>
                              <a href="#">M</a>
                              <a href="#">L</a>
                              <a href="#">XL</a>
                            </div>
                            <div class="aa-prod-quantity">
                              <form action="">
                                <select name="" id="">
                                  <option value="0" selected="1">1</option>
                                  <option value="1">2</option>
                                  <option value="2">3</option>
                                  <option value="3">4</option>
                                  <option value="4">5</option>
                                  <option value="5">6</option>
                                </select>
                              </form>
                              <p class="aa-prod-category">
                                Category: <a href="#">Polo T-Shirt</a>
                              </p>
                            </div>
                            <div class="aa-prod-view-bottom">
                              <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <a href="#" class="aa-add-to-cart-btn">View Details</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                        
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div> --}}
              <!-- / quick view modal -->   
            </div>  
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection


@push('js')


<script>

$(document).ready(function(){

$('.color').on('change',function(){
      // console.log("hmm its change");
      
      var color=$('input[name="color"]:checked').val();
      //console.log(color);
      var op=" ";
      // var div=$(this).parent();
      $.ajax({
          headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type : 'get',
          url : '{!!URL::to('size')!!}',
        //  url :  '{{url('size/','')}}/'+color+'',
         data : {color:color},
          dataType: 'json',
          success:function(data){
        
            //  console.log(data);
             $('#size').find('label').remove();


             
             for(var i=0;i<data.length;i++){
              //$("#price").html("Product Price: "+ data[i].price);
              $("#price").html(data[i].price);
              op+='<label><input type="radio" id="checkboxid"  value="'+data[i].size+'" name="size"><span>'+data[i].size+'</span></label> <label><input type="hidden" id="latestproduct_price"  value="'+data[i].price+'" name="price"></label> <label><input type="hidden" id="sku"  value="'+data[i].sku+'" name="sku"></label>';
         
                }
                $('#size').append(op);
               

          },error:function(){
             alert("Error");
          }
       });
 
});
});   


</script>

{{-- Add to Cart --}}

<script type="text/javascript"> 
  $(document).ready(function() {
      $('.cart').click(function(){
        
   
            if (!($('#checkboxid').is(':checked'))) {
                    $('#checkboxid_error_msg').html("(Please select the size)");
                    setTimeout(function() { $("#checkboxid_error_msg").fadeOut('slow'); }, 2000);
             
            }
            if (!($('#colorboxid').is(':checked'))) {
                    $('#colorboxid_error_msg').html("(Please select the color)");
                    setTimeout(function() { $("#colorboxid_error_msg").fadeOut('slow'); }, 2000);
             
            }
        var product_id = $('#product_id').val();
        var product_name = $('#product_name').val();
        var price=$('#product_price').val();
        var latestprice=$('#latestproduct_price').val();
        var sku=$('#sku').val();
        var product_code=$('#product_code').val();
        var size = $('input[name="size"]:checked').val();
        var color = $('input[name="color"]:checked').val();
        var quantity=$('#quantity').val();
        var product_image=$('#product_image').val();
        // console.log(sku);
        // console.log(image);
      //  console.log(size);
      //  console.log(color);
      //   console.log(quantity);
         $.ajax({
          headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type : 'POST',
          url : '{!!URL::to('cart')!!}',
        //  url :  '{{url('size/','')}}/'+color+'',
         data : {
           color:color,
           size:size,
           price:price,
           latestprice:latestprice,
           quantity:quantity,
           product_id:product_id,
           product_name:product_name,
           product_code:product_code,
           product_image:product_image,
           sku:sku,
           },
          dataType: 'json',
          success:function(data){
            //  console.log(data);

            if (data) {
                   window.location.href="{!!URL::to('view-cart')!!}";
               }
     
          },error:function(){
             alert("Error");
          }
       });
      }); 
  }); 

</script>
{{-- 
Add To Wish List --}}
<script type="text/javascript"> 
  $(document).ready(function() {
      $('.wishlist').click(function(){
        
   
            if (!($('#checkboxid').is(':checked'))) {
                    $('#checkboxid_error_msg').html("(Please select the size)");
                    setTimeout(function() { $("#checkboxid_error_msg").fadeOut('slow'); }, 2000);
             
            }
            if (!($('#colorboxid').is(':checked'))) {
                    $('#colorboxid_error_msg').html("(Please select the color)");
                    setTimeout(function() { $("#colorboxid_error_msg").fadeOut('slow'); }, 2000);
             
            }
        var product_id = $('#product_id').val();
        var product_name = $('#product_name').val();
        var price=$('#product_price').val();
        var latestprice=$('#latestproduct_price').val();
        var product_code=$('#product_code').val();
        var size = $('input[name="size"]:checked').val();
        var color = $('input[name="color"]:checked').val();
        var quantity=$('#quantity').val();
        var product_image=$('#product_image').val();
      //   console.log(latestprice);
      //  console.log(size);
      //  console.log(color);
      //   console.log(quantity);
         $.ajax({
          headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type : 'POST',
          url : '{!!URL::to('wishlist')!!}',
        //  url :  '{{url('size/','')}}/'+color+'',
         data : {
           color:color,
           size:size,
           price:price,
           latestprice:latestprice,
           quantity:quantity,
           product_id:product_id,
           product_name:product_name,
           product_code:product_code,
           product_image:product_image,
           },
          dataType: 'json',
          success:function(data){
            //  console.log(data);
              if (data=='login') {
                   window.location.href="{!!URL::to('login-register')!!}";
               }
               else{
                window.location.href="{!!URL::to('view-cart')!!}";
               }
          
           
     
          },error:function(){
            //  alert("Error");
         
     
          }
       });
      }); 
  }); 

</script>
@endpush()