<!DOCTYPE html>
<html>
<head>
    <title>Custom Auth in Laravel</title>
    <!-- Theme style  -->
    <script src="{{asset('js/bootstrap.bundle.js')}}" rel="stylesheet" ></script>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- RECAPTCHA  ------------------------------------------------>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    <div id="idContent3" class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div id="idContent4" class="card">
                    <h3 class="card-header text-center">Login</h3>
                    <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                    @endif
                        <form method="POST" action="/authenticate">
                            {{ csrf_field() }} {{-- ------------------ RECAPTCHA ------------------------------------- --}}
                            <div class="form-group">
                                <input hidden name="name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}" name="email" id="email" value="{{old('email')}}">
                                @if ($errors->has('email'))
                                <div class="error">
                                    {{ $errors->first('email') }}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control {{ $errors->has('password') ? 'error' : '' }}" name="password" id="password" value="{{old('password')}}">
                                @if ($errors->has('password'))
                                <div class="error">
                                    {{ $errors->first('password') }}
                                </div>
                                @endif
                            </div>
                            {{-- ------------------ INIZIO RECAPTCHA ------------------------------------- --}}
                            <div class="form-group mt-2">
                                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                @endif
                            </div>
                            {{-- ------------------ FINE RECAPTCHA --------------------------------------- --}}
                                <div class="form-group mb-3">
                                    <div class="checkbox">
                                        <a class="size1rem nav-link" href="{{ route('register-user') }}">Sono un nuovo utente.</a>
                                    </div>
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Invio</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
