@extends('Frontend.partials.master')
@include('Frontend.partials.header')
@include('Frontend.partials.footer')


@section('content')

 <!-- Cart view section -->
 <section id="cart-view">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="cart-view-area">
            <div class="cart-view-table">
              <form action="">
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                         <th>Image</th>
                         <th>Product</th>
                         <th>Size</th>
                         <th>Color</th>
                         <th>Price</th>
                         <th>Quantity</th>
                         <th>Total</th>
                         <th></th>
                       </tr>
                     </thead>
                     <tbody>

                       @foreach($cart as $allcart)
                       <tr>
                         <td><a href="#"><img src="{{asset('Images/Product/'.$allcart->product_image)}}" width="100px" alt="img"></a></td>
                         <td><a class="aa-cart-title" href="#">{{$allcart->product_name}}</a></td>
                         <td>{{$allcart->size}}</td>
                         <td ><div style="background-color:{{$allcart->color}};border:1px solid;padding:20px"></div></td>
                         <td>Rs:{{$allcart->price}}</td>
                         <td><input class="aa-cart-quantity" type="number" max="10" min="1" value="{{$allcart->quantity}}"></td>
                         <td>Rs:{{$allcart->price * $allcart->quantity}}</td>
                         <td><a class="remove" href="#"><fa class="fa fa-close"></fa></a></td>
                       </tr>
                       @endforeach
             
          
                   </table>
                 </div>
              </form>
              <!-- Cart Total view -->
              <div class="cart-view-total">
                <h4>Cart Totals</h4>
                <table class="aa-totals-table">
                  <tbody>
                    <tr>
                      <th>Subtotal</th>
                      <td>$450</td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <td>$450</td>
                    </tr>
                  </tbody>
                </table>
                <a href="#" class="aa-cart-view-btn">Proced to Checkout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Cart view section -->
 
 



@endsection()