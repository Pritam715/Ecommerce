@extends('Frontend.partials.master')
@include('Frontend.partials.header')
@include('Frontend.partials.footer')



@section('content')


  <!-- Start slider -->
  <section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
            <!-- single slide item -->
            @foreach($Slider as $slide)
            <li>
              <div class="seq-model">
                <img data-seq src="{{asset('Images/Banner/'.$slide->banner_image)}}" width="100%" alt="Men slide img" />
              </div>
              <div class="seq-title">
               {{-- <span data-seq>Save Up to 75% Off</span>                 --}}
               <span data-seq></span> 
                <h2 data-seq>{{$slide->title}}</h2>                
                <p data-seq>{{$slide->description}}</p>
                <a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
              </div>
            </li>
     
    
            
            @endforeach
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
  <!-- / slider -->
  <!-- Start Promo section -->
  <section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
            <div class="row">
              <!-- promo left -->
              <div class="col-md-5 no-padding">                
                <div class="aa-promo-left">
                  
                  <div class="aa-promo-banner"> 
                    @foreach($latest_promo->take(1) as $key=>$pro) 
                    @if($key == 0)                  
                    <img src="{{asset('Images/Offer/'.$pro->image)}}" alt="img">                    
                    <div class="aa-prom-content">
                      <span>75% Off</span>
                      <h4><a href="#">For Women</a></h4>                      
                    </div>
                    @endif
                    @endforeach
                  </div>
                
                </div>
              </div>
              <!-- promo right -->
              <div class="col-md-7 no-padding">
                <div class="aa-promo-right">
                  @foreach($promo->take(5) as $key=>$pro)
                    @if($key > 0)      
                  <div class="aa-single-promo-right">
                    <div class="aa-promo-banner">                      
                      <img src="{{asset('Images/Offer/'.$pro->image)}}" alt="img">                      
                      <div class="aa-prom-content">
                        <span>Exclusive Item</span>
                        <h4><a href="#">For Men</a></h4>                        
                      </div>
                    </div>
                  </div>
                  @endif
                @endforeach()
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- / Promo section -->
  <!-- Products section -->
  <section id="aa-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
                <!-- start prduct navigation -->
                 <ul class="nav nav-tabs aa-products-tab" style="background-color:#ff6666">
                   @foreach($categories as $c)
                   <li><a href="#tab-{{ $c->id }}" aria-controls="#tab-{{ $c->slug }}" role="tab" data-toggle="tab">{{$c->category}}</a></li>
                   @endforeach
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    @foreach($categories as  $count=>$cat)
                    <!-- Start men product category -->
                    
                    <div  role="tabpanel" @if($count == 0) class="tab-pane fade in active" @else class="tab-pane" @endif id="tab-{{ $cat->id }}">
                      <ul class="aa-product-catg">

                          @foreach($products as $p)
                          
                          @if($p->category_id==$cat->id)

                        <!-- start single product item -->
                        <li>
                          <figure>
                            <a class="aa-product-img" href="{{route('product-details',$p->slug)}}"><img src="{{asset('Images/Product/'.$p->product_image)}}"  class="image-size"></a>
                            <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <figcaption>
                              <h4 class="aa-product-title"><a href="#">{{$p->product_name}}</a></h4>
                              <span class="aa-product-price">RS.{{$p->product_price}}</span>
                            </figcaption>
                          </figure>                        
                          <div class="aa-product-hvr-content">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                            <a href="#"  title="Quick View"  data-toggle="modal" data-target="#quick-view-modal" 
                            data-id="{{$p->id}}" data-image={{$p->product_image}} data-price="{{$p->product_price}}"  data-shortdescription="{{$p->short_description}}"
                              
                              
                              ><span class="fa fa-search"></span></a>                          
                          </div>
            
                         @endif
                         @endforeach
                        

                      </ul>
                      <a class="aa-browse-btn" href="{{route('all-products')}}">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
                    
                    </div>

                    @endforeach
              
                  </div>
                         <!---Modal----->
                         {{-- <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">                      
                              <div class="modal-body">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <div class="row">
                                  <!-- Modal view slider -->
                                  <div class="col-md-6 col-sm-6 col-xs-12">                              
                                 
                                         <img src="" id="image" width="80%">
                                
                                  </div>
                                  <!-- Modal view content -->
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="aa-product-view-content">
                                      <h3>T-Shirt</h3>
                                      <div class="aa-price-block">
                                        <p class="aa-product-view-price">Rs.&nbsp<span id="price" style="color:red"></span></p>
                                      
                                        <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                                      </div>
                                      <p><span id="short_description"></span></p>
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
                        </div><!-- / quick view modal -->    --}}







                     
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Products section -->
  <!-- banner section -->
  <section id="aa-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12">        
          <div class="row">
            <div class="aa-banner-area">
            <a href="#"><img src="{{asset('Frontend/img/fashion-banner.jpg')}}" alt="fashion banner img"></a>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- popular section -->
  <section id="aa-popular-category">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-popular-category-area">
              <!-- start prduct navigation -->
             <ul class="nav nav-tabs aa-products-tab">
           
                <li class="active"><a href="#featured">Featured</a></li>
                 
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <!-- Start men popular category -->
         
                <!-- / popular product category -->
                
                <!-- start featured product category -->
                <div >
                 <ul class="aa-product-catg aa-featured-slider">
                    <!-- start single product item -->
                    @foreach($featured as $feature)

                    <li>
                      <figure>
                        <a class="aa-product-img" href="{{route('product-details',$feature->slug)}}"><img src="{{asset('Images/Product/'.$feature->product_image)}}" width="100%" class="image-size" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                         <figcaption>
                          <h4 class="aa-product-title"><a href="#">{{$feature->product_name}}</a></h4>
                          <span class="aa-product-price">{{$feature->product_price}}</span><span class="aa-product-price"></span>
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
                    @endforeach
                                                                                                  
                  </ul>
           
                </div>
                <!-- / featured product category -->

                <!-- start latest product category -->
    
                <!-- / latest product category -->              
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </section>
  <!-- / popular section -->
  <!-- Support section -->
  <section id="aa-support">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-support-area">
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-truck"></span>
                <h4>FREE SHIPPING</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-clock-o"></span>
                <h4>30 DAYS MONEY BACK</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-phone"></span>
                <h4>SUPPORT 24/7</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Support section -->
  <!-- Testimonial -->
  {{-- <section id="aa-testimonial">  
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-testimonial-area">
            <ul class="aa-testimonial-slider">
              <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="{{asset('Frontend/img/testimonial-img-2.jpg')}}" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>Allison</p>
                    <span>Designer</span>
                    <a href="#">Dribble.com</a>
                  </div>
                </div>
              </li>
              <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="{{asset('Frontend/img/testimonial-img-1.jpg')}}" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>KEVIN MEYER</p>
                    <span>CEO</span>
                    <a href="#">Alphabet</a>
                  </div>
                </div>
              </li>
               <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="{{asset('Frontend/img/testimonial-img-3.jpg')}}" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>Luner</p>
                    <span>COO</span>
                    <a href="#">Kinatic Solution</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section> --}}
  <!-- / Testimonial -->

  <!-- Latest Blog -->
  {{-- <section id="aa-latest-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-latest-blog-area">
            <h2>LATEST BLOG</h2>
            <div class="row">
              <!-- single latest blog -->
              <div class="col-md-4 col-sm-4">
                <div class="aa-latest-blog-single">
                  <figure class="aa-blog-img">                    
                    <a href="#"><img src="{{asset('Frontend/img/promo-banner-1.jpg')}}" alt="img"></a>  
                      <figcaption class="aa-blog-img-caption">
                      <span href="#"><i class="fa fa-eye"></i>5K</span>
                      <a href="#"><i class="fa fa-thumbs-o-up"></i>426</a>
                      <a href="#"><i class="fa fa-comment-o"></i>20</a>
                      <span href="#"><i class="fa fa-clock-o"></i>June 26, 2016</span>
                    </figcaption>                          
                  </figure>
                  <div class="aa-blog-info">
                    <h3 class="aa-blog-title"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, ad? Autem quos natus nisi aperiam, beatae, fugiat odit vel impedit dicta enim repellendus animi. Expedita quas reprehenderit incidunt, voluptates corporis.</p> 
                    <a href="#" class="aa-read-mor-btn">Read more <span class="fa fa-long-arrow-right"></span></a>
                  </div>
                </div>
              </div>
              <!-- single latest blog -->
              <div class="col-md-4 col-sm-4">
                <div class="aa-latest-blog-single">
                  <figure class="aa-blog-img">                    
                    <a href="#"><img src="{{asset('Frontend/img/promo-banner-3.jpg')}}" alt="img"></a>  
                      <figcaption class="aa-blog-img-caption">
                      <span href="#"><i class="fa fa-eye"></i>5K</span>
                      <a href="#"><i class="fa fa-thumbs-o-up"></i>426</a>
                      <a href="#"><i class="fa fa-comment-o"></i>20</a>
                      <span href="#"><i class="fa fa-clock-o"></i>June 26, 2016</span>
                    </figcaption>                          
                  </figure>
                  <div class="aa-blog-info">
                    <h3 class="aa-blog-title"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, ad? Autem quos natus nisi aperiam, beatae, fugiat odit vel impedit dicta enim repellendus animi. Expedita quas reprehenderit incidunt, voluptates corporis.</p> 
                     <a href="#" class="aa-read-mor-btn">Read more <span class="fa fa-long-arrow-right"></span></a>         
                  </div>
                </div>
              </div>
              <!-- single latest blog -->
              <div class="col-md-4 col-sm-4">
                <div class="aa-latest-blog-single">
                  <figure class="aa-blog-img">                    
                    <a href="#"><img src="{{asset('Frontend/img/promo-banner-1.jpg')}}" alt="img"></a>  
                      <figcaption class="aa-blog-img-caption">
                      <span href="#"><i class="fa fa-eye"></i>5K</span>
                      <a href="#"><i class="fa fa-thumbs-o-up"></i>426</a>
                      <a href="#"><i class="fa fa-comment-o"></i>20</a>
                      <span href="#"><i class="fa fa-clock-o"></i>June 26, 2016</span>
                    </figcaption>                          
                  </figure>
                  <div class="aa-blog-info">
                    <h3 class="aa-blog-title"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, ad? Autem quos natus nisi aperiam, beatae, fugiat odit vel impedit dicta enim repellendus animi. Expedita quas reprehenderit incidunt, voluptates corporis.</p> 
                    <a href="#" class="aa-read-mor-btn">Read more <span class="fa fa-long-arrow-right"></span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>    
      </div>
    </div>
  </section> --}}
  <!-- / Latest Blog -->

  <!-- Client Brand -->
  {{-- <section id="aa-client-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-brand-area">
            <ul class="aa-client-brand-slider">
              <li><a href="#"><img src="{{asset('Frontend/img/client-brand-java.png')}}" alt="java img"></a></li>
              <li><a href="#"><img src="{{asset('Frontend/img/client-brand-jquery.png')}}" alt="jquery img"></a></li>
              <li><a href="#"><img src="{{asset('Frontend/img/client-brand-html5.png')}}" alt="html5 img"></a></li>
              <li><a href="#"><img src="{{asset('Frontend/img/client-brand-css3.png')}}" alt="css3 img"></a></li>
              <li><a href="#"><img src="{{asset('Frontend/img/client-brand-wordpress.png')}}" alt="wordPress img"></a></li>
              <li><a href="#"><img src="{{asset('Frontend/img/client-brand-joomla.png')}}" alt="joomla img"></a></li>
              <li><a href="#"><img src="{{asset('Frontend/img/client-brand-java.png')}}" alt="java img"></a></li>
              <li><a href="#"><img src="{{asset('Frontend/img/client-brand-jquery.png')}}" alt="jquery img"></a></li>
              <li><a href="#"><img src="{{asset('Frontend/img/client-brand-html5.png')}}" alt="html5 img"></a></li>
              <li><a href="#"><img src="{{asset('Frontend/img/client-brand-css3.png')}}" alt="css3 img"></a></li>
              <li><a href="#"><img src="{{asset('Frontend/img/client-brand-wordpress.png')}}" alt="wordPress img"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section> --}}
  <!-- / Client Brand -->

  <!-- Subscribe section -->
  <section id="aa-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-subscribe-area">
            <h3>Subscribe our newsletter </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
            <form action="" class="aa-subscribe-form">
              <input type="email" name="" id="" placeholder="Enter your Email">
              <input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Subscribe section -->

    <!-- footer-bottom -->

  <!-- / footer -->

  <!-- Login Modal -->  
  {{-- <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Login or Register</h4>
          <form class="aa-login-form" action="" method="post">
            @csrf
            <label for="">Username or Email address<span>*</span></label>
            <input type="email" name="email" class="form-control" placeholder="Username or email">
            <label for="">Password<span>*</span></label>
            <input type="password" name="password"  class="form-control" placeholder="Password">
            <button class="aa-browse-btn" type="submit">Login</button>
            <label for="rememberme" class="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
            <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
            <div class="aa-register-now">
              Don't have an account?<a href="account.html">Register now!</a>
            </div>
          </form>
        </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>     --}}


@endsection

@push('js')

<script>
  $('#quick-view-modal').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 
var id = button.data('id') 
var price=button.data('price');
var short_description=button.data('shortdescription')
var image= button.data('image') 
var modal = $(this)

modal.find('.modal-body #id').val(id);
modal.find('.modal-body #price').text(price);
modal.find('.modal-body #short_description').text(short_description);
modal.find('.modal-body #image').attr('src','Images/Product/'+image );

})
 </script>


<script>
  $(document).ready( function () {
      
             
          $("selecttab").change(function(){
                     var id = $(this).attr('rel');
                     console.log(id);
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



@endpush()