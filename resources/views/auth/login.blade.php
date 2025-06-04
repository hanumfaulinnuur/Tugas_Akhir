
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login | Kiaalap - Kiaalap Admin Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('/template/css/bootstrap.min.css')}}">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('/template/css/font-awesome.min.css')}}">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('/template/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset ('/template/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset ('/template/css/owl.transitions.css')}}">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('/template/css/animate.css')}}">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('/template/css/normalize.css')}}">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('/template/css/main.css')}}">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('/template/css/morrisjs/morris.css')}}">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('/template/css/scrollbar/jquery.mCustomScrollbar.min.css')}}">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('/template/css/metisMenu/metisMenu.min.css')}}">
    <link rel="stylesheet" href="{{asset ('/template/css/metisMenu/metisMenu-vertical.css')}}">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('/template/css/calendar/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset ('/template/css/calendar/fullcalendar.print.min.css')}}">
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('/template/css/form/all-type-forms.css')}}">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('/template/style.css')}}">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('/template/css/responsive.css')}}">
    <!-- modernizr JS
		============================================ -->
    <script src="{{asset ('/template/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<div class="error-pagewrap">
		<div class="error-page-int">
			<div class="d-flex align-items-center" style="gap: 20px;">
                <img src="{{ asset('img/logosmp.jpg') }}" alt="Logo" style="width: 80px; height: auto;">
                <div>
                    <h3 class="mb-1">Silahkan Login Sistem Administrasi</h3>
                    <p class="mb-0">SMP Nuhuudliyah Srono</p>
                </div>
            </div>

			<div class="content-error">
				<div class="hpanel">
                    <div class="panel-body">
                         <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label class="control-label" for="email">Username</label>
                                <input type="text" placeholder="example@gmail.com" title="Please enter you username" required name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******" required name="password" id="password" class="form-control">
                                <span class="help-block small">wajib isi bagian ini</span>
                            </div>
                            <div class="checkbox login-checkbox">
                                <label>
                                    <input type="checkbox" class="i-checks"> Remember me
                                </label>
                            </div>
                            <button class="btn btn-success btn-block loginbtn">Login</button>
                            <a class="btn btn-default btn-block" href="#">Register</a>
                        </form>
                    </div>
                </div>
			</div>
			<div class="text-center login-footer">
				<p>Copyright © 2018. All rights reserved. Template by <a href="https://colorlib.com/wp/templates/">Colorlib</a></p>
			</div>
		</div>   
    </div>
    <!-- jquery
		============================================ -->
    <script src="{{asset ('/template/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="{{asset ('/template/js/bootstrap.min.js')}}"></script>
    <!-- wow JS
		============================================ -->
    <script src="{{asset ('/template/js/wow.min.js')}}"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="{{asset ('/template/js/jquery-price-slider.js')}}"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="{{asset ('/template/js/jquery.meanmenu.js')}}"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="{{asset ('/template/js/owl.carousel.min.js')}}"></script>
    <!-- sticky JS
		============================================ -->
    <script src="{{asset ('/template/js/jquery.sticky.js')}}"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="{{asset ('/template/js/jquery.scrollUp.min.js')}}"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="{{asset ('/template/js/scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset ('/template/js/scrollbar/mCustomScrollbar-active.js')}}"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="{{asset ('/template/js/metisMenu/metisMenu.min.js')}}"></script>
    <script src="{{asset ('/template/js/metisMenu/metisMenu-active.js')}}"></script>
    <!-- tab JS
		============================================ -->
    <script src="{{asset ('/template/js/tab.js')}}"></script>
    <!-- icheck JS
		============================================ -->
    <script src="{{asset ('/template/js/icheck/icheck.min.js')}}"></script>
    <script src="{{asset ('/template/js/icheck/icheck-active.js')}}"></script>
    <!-- plugins JS
		============================================ -->
    <script src="{{asset ('/template/js/plugins.js')}}"></script>
    <!-- main JS
		============================================ -->
    <script src="{{asset ('/template/js/main.js')}}"></script>
    <!-- tawk chat JS
		============================================ -->
    <script src="{{asset ('/template/js/tawk-chat.js')}}"></script>
</body>

</html>