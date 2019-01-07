<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BHIMS') }}</title>

    <!-- Reset -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">


</head>
<body>
    <div class="container welcome-page-head">
        <div class="row">
            <div class="col-md-7 brand">
                <a href="/">
                    <img src="{{url('/img/doh.svg')}}" alt="DOH Logo">
                </a>
                <h3>DEPARTMENT OF HEALTH</h3>
                <p>Municipality of Prieto Diaz</p>
            </div>
            <div class="col-md-5 login">
                
                    <form class="form-inline" method="POST" action="{{ route('login') }}">
                        @csrf
                        <h4><strong>Sign In:</strong></h4>
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} mr-sm-2" id="email" placeholder="Enter Email" value="{{ old('email') }}" required autofocus>
                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }} mr-sm-2" id="password" placeholder="Enter Password" required>

                        <button type="submit" class="btn btn-success">Login</button>
                        @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </form>
            </div>
        </div>
    </div>

    <div class="container welcome-registration mt-3">
        <div class="row">
            <div class="col-md-7">
                <h1>Barangay Health Information Management Systems</h1>
                <p>Aim to provide a system for Health Workers and Community Nurse to make their Patient's medical records would be systematically, securely done and on real time.</p>
                <p>A system that will help health center in delivering a better service to the community in a precise manner by providing a more systematic way of manipulating all the information gathered from Patients.</p>
                <a href="#" class="btn btn-success">Learn More..</a>
            </div>
            <div class="col-md-5">
                <strong>Request Access Form</strong>
                <div class="card bg-light px-3 py-3">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Enter Fullname:') }}</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="barangay">Barangay health center of:</label>
                            <select name="barangay" id="barangay" class="form-control">
                                @foreach($barangays as $barangay)
                                    <option value="{{ $barangay->id }}">{{$barangay->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="contact_no">Contact Number:</label>
                            <input type="text" class="form-control" id="contact_no" name="contact_no" required value="{{old('contact_no')}}">
                        </div>

                        <div class="form-group">
                            <label for="reg_email">{{ __('Enter Email Address:') }}</label>
                            <input id="reg_email" type="email" class="form-control{{ $errors->has('reg_email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="reg_password">{{ __('Password') }}</label>
                            <input id="reg_password" type="password" class="form-control{{ $errors->has('reg_password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="form-group">
                            <p>By clicking Sign Up, you agree to our <a href="#">Terms</a> and <a href="#">Data Policy</a>.</p>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Sign Up') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
