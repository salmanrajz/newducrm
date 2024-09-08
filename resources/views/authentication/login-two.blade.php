@extends('layouts.authentication.master')
@section('title', 'Login')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-xl-5"><img class="bg-img-cover bg-center" src="{{asset('assets/images/login/3.jpg')}}" alt="Vocus Login"></div>
      <div class="col-xl-7 p-0">
         <div class="login-card">
            <div>
               {{-- <div><a class="logo text-start" href="{{ route('index')}}"><img class="img-fluid for-light" src="{{asset('assets/images/logo/login.png')}}" alt="Vocus Login"><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt="Vocus Login"></a></div> --}}
               <div class="login-main">
                <form method="POST" action="{{ route('login') }}" class="theme-form">
                        @csrf
                  {{-- <form class="theme-form"> --}}
                     <h4>Sign in to account</h4>
                     <p>Enter your email & password to login</p>
                     <div class="form-group">
                        <label class="col-form-label">Email Address</label>
                        {{-- <input class="form-control" type="email" required="" placeholder="Test@gmail.com"> --}}
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }} - Salman</strong>
                                    </span>
                                @enderror
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Password</label>
                        {{-- <input class="form-control" type="password" name="login[password]" required="" placeholder="*********"> --}}
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        <div class="show-hide"><span class="show">                         </span></div>
                     </div>
                     <div class="form-group mb-0">
                        <div class="checkbox p-0">
                           <input id="checkbox1" type="checkbox">
                           <label class="text-muted" for="checkbox1">Remember password</label>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                     </div>

                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection
