
<html>
	<head>
        <!--TO Support Many Language Include Arabic Language-->
        <meta charset="utf-8"/>
        <!--For Internet Explorer-->
        <meta http-equiv="X-UA-	Compatible"content="IE=edge">
        <!--First mobilw meta-->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description"content="mt company">
        <title>Dashboard Login</title>
        <!--call bootstrap-->
        <link rel="stylesheet"href="{{asset('login/css/bootstrap.css')}}"/>
        <!--Page Style-->
        <link rel="stylesheet"href="{{asset('login/css/s.css')}}"/>
        <!--Animate.css-->
        <link rel="stylesheet"href="{{asset('login/css/animate.min.css')}}"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Pacifico"rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Exo+2&display=swap" rel="stylesheet"><!---AOS LAIBIRARY-->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <!--Internet Explorer-->
        <script src="{{asset('login/js/html5shiv.min.js')}}"></script>
        <script src="{{asset('login/js/respond.min.js')}}"></script>
        <!---->
	</head>
	<body>
		<div class="MainPicDiv2">
			<div class="container"id="log">
				<div class="row">
					<div class="col-sm-6 offset-md-3  wow fadeInUp " data-wow-duration="2s" data-wow-delay="0s" style="padding-top: 60px">
						<div class="card">
							<div class="card-body ">
								<div class="text-center">
									<img style="border-radius:50%;width: 100px "src="{{asset('login/images/download.jpg')}}">
								</div><br>
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                @endif
                                <form class="form" role="form" autocomplete="off" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input class="form-control" type="email" name="email" placeholder="E-mail">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input class="form-control" type="password" name="password" placeholder="Password">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class=" text-center">
                                        <input type="submit" value="Log in" class="btn btn-danger">
                                    </div>
                                </form>
							</div>
						</div>
					</div>
			    </div>
		    </div>
        </div>

		<script src="{{asset('login/js/wow.min.js')}}"></script>
		<script>new WOW().init();</script>
		<script src="{{asset('login/js/jQuery3.3.1.min.js')}}"></script>
		<script src="{{asset('login/js/bootstrap.min.js')}}"></script>
		<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
		<script src="{{asset('login/js/e.js')}}"></script>
	</body>
 </html>
