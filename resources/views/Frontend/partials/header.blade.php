

@section('header')


  <!-- wpf loader Two -->
  {{-- <div id="wpf-loader-two">          
    <div class="wpf-loader-two-inner">
      <span>Loading</span>
    </div>
  </div>  --}}
  <!-- / wpf loader Two -->       
<!-- SCROLL TOP BUTTON -->
  <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
<!-- END SCROLL TOP BUTTON -->


<!-- Start header section -->
<header id="aa-header">
  <!-- start header top  -->
  {{-- <div class="aa-header-top">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-header-top-area">
            <!-- start header top left -->
            <div class="aa-header-top-left">
    
              <div class="cellphone hidden-xs">
                <p><span class="fa fa-phone"></span>00-62-658-658</p>
              </div>
              <!-- / cellphone -->
            </div>
            <!-- / header top left -->
            <div class="aa-header-top-right">
              <ul class="aa-head-top-nav-right">
                <li class="hidden-xs"><a href="wishlist.html">Wishlist</a></li>
                <li class="hidden-xs"><a href="cart.html">My Cart</a></li>
                <li class="hidden-xs"><a href="checkout.html">Checkout</a></li>
                @if(Session::has('frontSession'))

                <li><a href="account.html">My Account</a></li>
                <li><a href="{{route('customer.logout')}}">Logout</a></li>
                @else
                <li><a href="{{route('customer.login')}}" >Login</a></li>
                @endif
        
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
  <!-- / header top  -->

  <!-- start header bottom  -->
  <div class="aa-header-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-header-bottom-area">
            <!-- logo  -->
            <div class="aa-logo">
              <!-- Text based logo -->
              <a href="index.html">
                <span class="fa fa-shopping-cart"></span>
                <p>OutDoor<strong>Fashion</strong> <span>Your Style Your Fashion</span></p>
              </a>
              <!-- img based logo -->
              <!-- <a href="index.html"><img src="img/logo.jpg" alt="logo img"></a> -->
            </div>

             <!-- cart box -->
            <div class="aa-cartbox">
              <a class="aa-cart-link" href="{{route('view.cart')}}">
                <span class="fa fa-shopping-basket"></span>
                <span class="aa-cart-title">CART</span>
                <span class="aa-cart-notify">2</span>
              </a>
        
            </div>


            <!-- / login  -->
            @if(Session::has('frontSession'))
            <div class="aa-cartbox">
              <a class="aa-cart-link" href="">
                <span class="fa fa-user"></span>
                <span class="aa-cart-title">My Account</span>
              </a>
              <div class="aa-cartbox-summary">
                <ul>
                  <li>
                    <a class="aa-cartbox-img" href="#"><i class="fa fa-user"></i></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">My Profile</a></h4>
     
                    </div>
                  </li>
                  <li>
                    <a class="aa-cartbox-img" href="#"><i class="fa fa-heart"></i></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">My Wishlist</a></h4>
                 
                    </div>
                  </li>
                  <li>
                    <a class="aa-cartbox-img" href="#"><i class="fa fa-key"></i></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Change Password</a></h4>
     
                    </div>
                  </li>
                                   
                  
                </ul>
                <a class="aa-cartbox-checkout aa-primary-btn" href="{{route('customer.logout')}}">Logout</a>
              </div>
            </div>
            @else
               
                 <div class="aa-cartbox">
                   <a class="aa-cart-link" href="{{route('customer.login')}}">
                     <span class="fa fa-sign-in"></span>
                     <span class="aa-cart-title">Sign In</span>
                   </a>
                 </div>
            @endif
       
            
            <!-- / cart box -->
            <!-- search box -->
            <div class="aa-search-box">
              <form action="">
                <input type="text" name="" id="" placeholder="Search here ex. 'man' ">
                <button type="submit"><span class="fa fa-search"></span></button>
              </form>
            </div>
            <!-- / search box -->             
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- / header bottom  -->
</header>

<section id="menu">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>          
          </div>
          <div class="navbar-collapse collapse">
            <!-- Left nav -->
            <ul class="nav navbar-nav">
              <li><a href="{{route('outdoor')}}">Home</a></li>
              @foreach($categories as $c)
              <li><a href="#">{{ucfirst($c->category)}}<span class="caret"></span></a>
                  <ul class="dropdown-menu category"> 
                    <div class="row subcategory">
                      @foreach($c->subcategories as $key=>$sub)
                      <div class="col-md-4 ">
                       <h5>{{ucfirst($sub->sub_category)}}</h5>
                            @foreach($sub->subsubcategories as $s)
                             <li><a href="">{{ucfirst($s->sub_subcategory)}}</a></li>
                      
                             @endforeach
                      </div>
                      @endforeach
                     
                    </div> 
                         
           
                  </ul>
            
              </li>
              @endforeach
              <li><a href="{{route('all-products')}}">Shop</a></li>
           
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>       
    </div>
  </section>


@endsection