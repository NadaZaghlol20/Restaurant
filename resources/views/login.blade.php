<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Login</title>
    <link rel="stylesheet" href="{{asset('login/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('login/css/ionicons.min.css')}}">
    <style>
        .login-dark {
            height:750px;
            background:#475d62 url('{{asset('login/images/1.jpg')}}');
            background-size:cover;
            position:relative;
        }

        .login-dark form {
            max-width:400px;
            width:90%;
            background-color:#1e2833;
            padding:40px;
            /* margin-top: 100px; */
            border-radius:4px;
            transform:translate(-50%, -50%);
            position:absolute;
            top:50%;
            left:50%;
            color:#fff;
            box-shadow:3px 3px 4px rgba(0,0,0,0.2);
        }

        .login-dark .illustration {
            text-align:center;
            padding:10px 0 20px;
            font-size:100px;
            color:#2980ef;
        }

        .login-dark form .form-control {
            background:none;
            border:none;
            border-bottom:1px solid #434a52;
            border-radius:0;
            box-shadow:none;
            outline:none;
            color:inherit;
        }

        .login-dark form .btn-primary {
            background:#214a80;
            border:none;
            border-radius:4px;
            padding:11px;
            box-shadow:none;
            margin-top:26px;
            text-shadow:none;
            outline:none;
        }

        .login-dark form .btn-primary:hover, .login-dark form .btn-primary:active {
            background:#214a80;
            outline:none;
        }

        .login-dark form .forgot {
            display:block;
            text-align:center;
            font-size:12px;
            color:#6f7a85;
            opacity:0.9;
            text-decoration:none;
        }

        .login-dark form .forgot:hover, .login-dark form .forgot:active {
            opacity:1;
            text-decoration:none;
        }

        .login-dark form .btn-primary:active {
            transform:translateY(1px);
        }


    </style>
</head>

<body>
    <div class="login-dark">
        <form class="form" role="form" method="post">
            @csrf
            <h2 class="text-center">اطلب واتمنى</h2><hr>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" required></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password" required></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div>
            <div class="form-group text-center"><a href="/register">Register</a></div>
        </form>
    </div>
    <script src="{{asset('login/js/jquery.min.js')}}"></script>
    <script src="{{asset('login/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>
