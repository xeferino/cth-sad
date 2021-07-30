<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login - {{env('APP_NAME')}}</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta name="base_url" content="{{url('')}}" id="base_url"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" id="csrf_token"/>
	<link rel="icon" href="{{ asset('img/polling.svg') }}" type="image/x-icon"/>
	<!-- Fonts and icons -->
	<script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['{{ asset("css/fonts.css") }}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/azzara.min.css') }}">
    <!-- CSS style -->
    <style>
      html, body {
            height: 100%;
            width: 100%;
            background-color: #f5f5f5 !important;
            display: flex;
            align-items: center !important;
        }
        .panel   {
            background-color: #fff;
        }
        .panel__left-title {
            font-size: 2rem;
            color: rgb(69, 57, 97);
        }
        .panel__left-title-logo {
            width: 40px;
            height: auto;
            padding-right: 5px;
        }

        .panel__left-body {
            padding: 30px 0px;
        }
        .form-group label {
            font-weight: 400;
            font-size: 0.9rem;
        }
        input::placeholder {
            font-weight: 400;
            font-size: 0.9rem;
        }
        .btn-primary {
            background-color: #5b2886f2 !important;
            border: #5b2886f2 !important;
            font-size: 0.9rem !important;
            font-weight: 400 !important;
        }

        .panel__left-footer a {
            font-size: 0.9rem;
            font-weight: 300;
        }
        .panel__right {
            background-color: #5b2886f2;
        }

        .panel__right-title {
            color: #fff;
            font-weight: 600;
            font-size: 1.5rem;
            line-height: 1.5rem;
        }

        .panel__left-img {
            position: absolute;
            bottom: 1.8rem;
            left: 0;
        }
        .panel__left-img svg {
            width: 50%;
            height: auto;
        }
    </style>
</head>
<body class="px-4 px-lg-0">
    <div class="panel col-12 col-lg-6 offset-lg-3">
        <div class="row">
            <div class="panel__left col-12 col-lg-7 py-4 px-4">
                <div class="panel__left-title text-center">
                    <img src="{{ asset('img/avatar.svg') }}" id="avatar" width="30%" alt="avatar">
                    <br>
                    <span>Panel <b>Admistrativo</b></span>
                </div>

                <div class="panel__left-body">
                    <form method="POST" name="form-login" id="form-login">
                        <div class="form-group">
                            <label for="user" style=" color:  rgb(69, 57, 97); !important; font-size:15px !important;"> <b> Usuario de Acceso </b></label>
                            <input type="text" name="user" id="user" class="form-control input-border-bottom" placeholder="usuario" />
                        </div>
                        <div class="form-group">
                            <label for="password" style=" color:  rgb(69, 57, 97); !important; font-size:15px !important;"> <b> Clave de Acceso</b></label>
                            <input type="password" name="password" id="password" class="form-control input-border-bottom" placeholder="***********" />
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-secondary btn-block" style="background:#5b2886f2 !important; border:#5b2886f2 !important;" id="login"> Login</button>
                        </div>
                    </form>
                </div>
                {{-- <div class="panel__left-footer text-center">
                    <span class="msg">Olvid&oacute; su clave?</span>
                    <a href="{{ url('reset/password') }}" target="_blank" class="link">Click Aqui</a>
                </div> --}}
            </div>
            <div class="panel__right col-lg-5 d-none d-lg-block py-5 px-3">
                <div class="panel__right-title text-center">
                    <img src="{{ asset('img/login-right.svg') }}" width="100%" alt="polling" style=" padding-top:3.5em;">
                    {{-- <br><span style=" color:#fff !important; font-size:30px !important; font-weight:bold">Bienvenido</span> --}}
                </div>
                <div class="panel__left-img text-center w-100"></div>
            </div>
        </div>
    </div>

	<script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/core/popper.min.js') }}"></script>
	<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/ready.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>
    <!-- Bootstrap Notify -->
    <script src="{{ asset('js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script>
        $("#form-login").submit(function( event ) {
            event.preventDefault();
            //variables
            var base_url    = $.trim($('meta[name="base_url"]').attr('content') + '/');
            var user        = $("#user").val();
            var password    = $("#password").val();

            $("#login").prop("disabled", true).text("Enviando...");
            $('#avatar').attr('src', '{{ asset('img/loader.gif') }}');
            if(user=="" || password==""){
                //Notify
                $.notify({
                        icon: 'flaticon-error',
                        title: 'Error!',
                        message: '<p style="font-size: 14px;">El usuario y la clave son obligatorios.</p>',
                    },
                    {
                        type: 'danger',
                        placement: {
                            from: "top",
                            align: "right"
                    },
                        time: 1000,
                });
                $('#login').prop("disabled", false).text("Login");
                setTimeout(function () { $('#avatar').attr('src', '{{ asset('img/avatar.svg') }}'); }, 1000);
            }else{
                axios.post('{{ route('login')}}', {
                    user:user,
                    password:password
                }).then(response => {
                    if(response.data.success){
                        $.notify({
                                icon: 'flaticon-success',
                                title: 'Exito!',
                                message: '<p style="font-size: 14px;">'+response.data.message+'</p>',
                            },
                            {
                                type: 'success',
                                placement: {
                                    from: "top",
                                    align: "right"
                            },
                                time: 1000,
                        });
                        $('#login').text("Cargando...");
                        setTimeout(function () {location.href = base_url+response.data.url}, 3000);
                        clear();
                    }
                }).catch(error => {
                    if (error.response) {
                        if(error.response.status === 401){
                            $.notify({
                                icon: 'flaticon-error',
                                title: 'Error!',
                                message: '<p style="font-size: 14px;">'+error.response.data.message+'</p>',

                                },
                                {
                                    type: 'danger',
                                    placement: {
                                        from: "top",
                                        align: "right"
                                },
                                    time: 3000,
                            });
                        }else{
                            $.notify({
                                    icon: 'flaticon-error',
                                    title: 'Error!',
                                    message: '<p style="font-size: 14px;">Intente nuevamente mas tarde.</p>',
                                    },
                                    {
                                        type: 'danger',
                                        placement: {
                                            from: "top",
                                            align: "right"
                                    },
                                        time: 3000,
                            });
                        }
                    }else{
                        $.notify({
                            icon: 'flaticon-error',
                            title: 'Error!',
                            message: '<p style="font-size: 14px;">Intente nuevamente mas tarde.</p>',
                            },
                            {
                                type: 'danger',
                                placement: {
                                    from: "top",
                                    align: "right"
                            },
                                time: 3000,
                        });
                    }
                    setTimeout(function () { $('#avatar').attr('src', '{{ asset('img/avatar.svg') }}'); }, 1000);
                    $('#login').prop("disabled", false).text("Login");
                    clear();
                });
            }
        });
        function clear() {
            $("#user").val('');
            $("#password").val('');
        }
    </script>
</body>
</html>
