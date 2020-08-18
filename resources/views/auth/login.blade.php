<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | tklinik</title>
    <!-- Favicon-->
    <link rel="icon" href="{{'favicon.ico'}}" type="image/x-icon">

    <link href="{{asset('google.css')}}" rel="stylesheet">
    <link href="{{asset('material.css')}}" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('plugins/node-waves/waves.css')}}" rel="stylesheet"/>

    <!-- Animation Css -->
    <link href="{{asset('plugins/animate-css/animate.css')}}" rel="stylesheet"/>

    <!-- Custom Css -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>

<body class="login-page" style="background-color:white!important;">
<div class="login-box">

    <div class="card">
        <div class="body">
            <div class="logo">
                <img src="{{asset('tempsnip.png')}}" style="margin: 0 50px;">
                <div class="msg">Connectez-vous pour demarrer votre session</div>
            </div>

            <form id="sign_in" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Entrer l'email" required autocomplete="email" autofocus>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                             </span>
                    @enderror
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="Entrer le mot de passe" required autocomplete="current-password">
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-xs-7 p-t-5">

                        <div class="align-right">
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit">Connexion</button>

                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="{{'plugins/jquery/jquery.min.js'}}"></script>

<!-- Bootstrap Core Js -->
<script src="{{'plugins/bootstrap/js/bootstrap.js'}}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{'plugins/node-waves/waves.js'}}"></script>

<!-- Validation Plugin Js -->
<script src="{{'plugins/jquery-validation/jquery.validate.js'}}"></script>

<!-- Custom Js -->
<script src="{{asset('js/admin.js')}}"></script>
<script src="{{asset('js/pages/examples/sign-in.js')}}"></script>
</body>

</html>
