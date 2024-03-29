@extends('Frontend.partials.master')
@include('Frontend.partials.header')
@include('Frontend.partials.footer')

@push('css')
<link rel="stylesheet" href="{{ asset('Frontend/css/filter.css') }}">
<style>
  
   
    #treeUL {
    list-style-type: none;
    color:#ff6666;
    }
    #treeUL {
    margin: 0;
    padding: 0;
    }
    .rootTree {
    cursor: pointer;
    user-select: none;
    }
  
    .rootTree::before {
        content: "\25B6";
    display: inline-block;
    margin-right: 6px;
    }
    .rootTree-down::before {
    transform: rotate(90deg);
    }
    .children {
    display: none;
    }
    .active {
    display: block;
    margin-left:30px;
    }
    </style>
@endpush()
@section('content')

<section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
                <form action="" class="aa-sort-form">
                  @csrf
                  <label for="">Sort by</label>
                  <select name="" id="sortby">
                    <option value="default">Default</option>
                    <option value="high">High To Low</option>
                    <option value="low">Low To High</option>
                  </select>
                </form>
           
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
            </div>
            <div class="aa-product-catg-body">
              <ul class="aa-product-catg causes_div">
                <!-- start single product item -->
                @foreach($allproducts as $products)
                <li>
                  <figure>
                    <a class="aa-product-img" href="{{route('product-details',$products->slug)}}"><img src="{{asset('Images/Product/'.$products->product_image)}}" width="100%"  class="image-size" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                    <figcaption>
                      <h4 class="aa-product-title"><a href="#">This is Title</a></h4>
                      <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                      <p class="aa-product-descrip">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam accusamus facere iusto, autem soluta amet sapiente ratione inventore nesciunt a, maxime quasi consectetur, rerum illum.</p>
                    </figcaption>
                  </figure>                         
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
                  </div>
                  <span class="aa-badge aa-sale" href="#">SALE!</span>
                </li>
       
                 @endforeach                                     
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
            {{-- <div class="aa-product-catg-pagination">
              <nav>
                <ul class="pagination">
                  <li>
                    <a href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li>
                    <a href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div> --}}
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
             <div class="aa-sidebar-widget">
              <h3>Category</h3>
              {{-- <ul class="aa-catg-nav">
                <li><a href="#">Men</a></li>
                <li><a href="">Women</a></li>
                <li><a href="">Kids</a></li>
                <li><a href="">Electornics</a></li>
                <li><a href="">Sports</a></li>
              </ul> --}}
              <ul id="treeUL" class="aa-catg-nav">
                  @foreach($categories as $c)
                <li>
                <span class="rootTree">{{$c->category}}</span>
                    
                   <ul class="children">
                      @foreach($c->subcategories  as $key=>$sub) 
                     <li>
                     <span class="rootTree">{{$sub->sub_category}}</span>
                     <ul class="children">
                  
                        @foreach($sub->subsubcategories as $s)
                        {{-- <li><label><input type="checkbox"><span style="margin-left:10px">{{ucfirst($s->sub_subcategory)}}</span></label></li> --}}
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" 
                              attr-name="{{$s->sub_subcategory}}"
                              class="custom-control-input category_checkbox" id="{{$s->id}}">
                          <label class="custom-control-label"
                              for="{{$s->id}}">{{ucfirst($s->sub_subcategory)}}</label>
                        </div>
                        @endforeach
      
                     </ul>
                     @endforeach
                  </ul>
                </li>
                   @endforeach
                </ul>
              
            </div> 
        
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Brands</h3>
              <div class="tag-cloud">
                 @foreach($brands as $brand)
                 <div class="custom-control custom-checkbox">
                  <input type="checkbox" 
                      attr-name="{{$brand->brand_name}}"
                      class="custom-control-input brand_checkbox" id="{{$brand->id}}">
                  <span class="custom-control-label"
                      for="{{$brand->id}}">{{ucfirst($brand->brand_name)}}</span>
                </div>
                 @endforeach
            
              </div>
            </div>
            <!-- single sidebar -->
            {{-- <div class="aa-sidebar-widget">
              <h3>Shop By Price</h3>              
              <!-- price range -->
              <div class="aa-sidebar-price-range">
               <form action="">
                  <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                  </div>
                  <span id="skip-value-lower" class="example-val">30.00</span>
                 <span id="skip-value-upper" class="example-val">100.00</span>
                 <button class="aa-filter-btn" type="submit">Filter</button>
               </form>
              </div>              

            </div> --}}
            <!-- single sidebar -->
            {{-- <div class="aa-sidebar-widget">
              <h3>Shop By Color</h3>
              <div class="aa-color-tag">
                <a class="aa-color-green" href="#"></a>
                <a class="aa-color-yellow" href="#"></a>
                <a class="aa-color-pink" href="#"></a>
                <a class="aa-color-purple" href="#"></a>
                <a class="aa-color-blue" href="#"></a>
                <a class="aa-color-orange" href="#"></a>
                <a class="aa-color-gray" href="#"></a>
                <a class="aa-color-black" href="#"></a>
                <a class="aa-color-white" href="#"></a>
                <a class="aa-color-cyan" href="#"></a>
                <a class="aa-color-olive" href="#"></a>
                <a class="aa-color-orchid" href="#"></a>
              </div>                            
            </div> --}}
            <!-- single sidebar -->
            {{-- <div class="aa-sidebar-widget">
              <h3>Recently Views</h3>
              <div class="aa-recently-views">
                
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                   <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>                                      
                </ul>
              </div>                            
            </div> --}}
            <!-- single sidebar -->
            {{-- <div class="aa-sidebar-widget">
              <h3>Top Rated Products</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                   <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>                                      
                </ul>
              </div>                            
            </div> --}}
          </aside>
        </div>
       
      </div>
    </div>
  </section>
 



@endsection()

@push('js')
<script src="{{ asset('Frontend/js/filter.js') }}"></script>
<script>
  
$(document).ready(function () {
  $('#sortby').on('change',function(){
    // console.log("hmm its change");
    var sort=$(this).val();
    //  console.log(sort);
    // var div=$(this).parent();
    $('.causes_div').empty();
    var op = " ";

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'get',
        url: '{!!URL::to('findProducts')!!}',
        data: { 'sort': sort },
        success: function (data) {
          console.log(data);
          // var response = JSON.parse(data);
            // console.log(data);
            display = data;

            if (data.length == 0) {
                $('.causes_div').append('No Data Found');
            } else {
                $.each(display, function (i, member) {
                    $('.causes_div').append(`
                    <li>
                    <figure>
                      <a class="aa-product-img" href="dp/${display[i].slug}"><img src="Images/Product/${display[i].product_image}" width="100%"  class="image-size" alt="polo shirt img"></a>
                      <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                      <figcaption>
                        <h4 class="aa-product-title"><a href="#">${display[i].product_name}</a></h4>
                        <span class="aa-product-price">${display[i].product_price}</span>
                        <p class="aa-product-descrip">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam accusamus facere iusto, autem soluta amet sapiente ratione inventore nesciunt a, maxime quasi consectetur, rerum illum.</p>
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
                    `);
                });
            }

        },
        error: function () {

        }
    });
});
});
</script>
<script>
    var toggler = document.querySelectorAll(".rootTree");
    Array.from(toggler).forEach(item => {
    item.addEventListener("click", () => {
    item.parentElement
    .querySelector(".children")
    .classList.toggle("active");
    item.classList.toggle("rootTree-down");
    });
    });
    </script>

@endpush()