@extends('layouts.app')

@section('content')

<img class="wave" src="{{asset('Backend/dist/img/login/wave.png')}}">
	<div class="container">
		<div class="img">
			<img src="{{asset('Backend/dist/img/login/bg.svg')}}">
		</div>
		<div class="login-content">
			<form action="{{ route('login') }}" method="POST" >
				@csrf
				<img src="{{asset('Backend/dist/img/login/user.svg')}}">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
					<input id="email" type="email" class="form-control input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required  >
					
					   @error('email')
							  <span style="margin-top:50px;" class="invalid-feedback" role="alert">
								  <strong>{{ $message }}</strong>
							  </span>
						     @enderror
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
						   <input id="password" type="password" class="form-control @error('password') is-invalid @enderror  input" name="password" required >
						   @error('password')
						   <span class="invalid-feedback" role="alert">
							   <strong>{{ $message }}</strong>
						   </span>
					   @enderror
            	   </div>
            	</div>
            	<a href="#" style=" font-family: Poppins, sans-serif;">Forgot Password?</a>
            	 <button type="submit" class="btn" > {{ __('Login') }}</button>
            </form>
        </div>
    </div>


@endsection
