<!DOCTYPE html>
<html lang="en" dir="ltr">
@extends('common.sidebare')
@extends('common.navbar')
@include('common.head')

<body>
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-fullbleed data-push data-responsive-width="992px"
        data-has-scrolling-region>

        <div class="mdk-drawer-layout__content">
            {{-- <div class="mdk-drawer-layout js-mdk-drawer-layout" data-fullbleed data-push data-has-scrolling-region>
                <div class="mdk-drawer-layout__content mdk-header-layout__content--scrollable" style="overflow-y: auto;" data-simplebar data-simplebar-force-enabled="true">
        
        
                    <div class="container h-vh d-flex justify-content-center align-items-center flex-column">
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <a href="index.html" class="drawer-brand-circle mr-2">R</a>
                            <h2 class="ml-2 text-bg mb-0"><strong>{{__('Real States')}}</strong></h2>
                        </div>
                        <div class="row w-100 justify-content-center">
                            <div class="card card-login mb-3">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label>{{__('UserName')}}</label>
        
                                            <div class="input-group input-group--inline">
                                                <div class="input-group-addon">
                                                    <i class="material-icons">account_circle</i>
                                                </div>
                                                <input type="text" class="form-control" name="name" value="admin@example.com">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label>{{__('Password')}}</label>
                                                <span class="ml-auto"><a href="forgot-password.html">Forgot password?</a></span>
                                            </div>
        
                                            <div class="input-group input-group--inline">
                                                <div class="input-group-addon">
                                                    <i class="material-icons">lock_outline</i>
                                                </div>
                                                <input type="password" class="form-control" name="password" value="123456789">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="text-center">
                                         <button class="btn btn-primary" type="submit">{{__('LogIn')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
        
                        
                    </div>
        
        
                </div>
            </div> --}}
            <div class="container">
                
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Login') }}</div>
            
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
            
                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
            
                                        <div class="col-md-6">
                                            <input value="admin@example.com" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
            
                                        <div class="col-md-6">
                                            <input value="123456789" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="row mb-3">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Login') }}
                                            </button>
            
                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @extends('common.script')

</body>

</html>
