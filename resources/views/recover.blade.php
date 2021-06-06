<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Recuperar Clave - {{env('APP_NAME')}}</title>
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
        .avatar-md {
            width: 5.5rem;
            height: 5.5rem;
            align-content: center;
            margin: auto;
            margin-top:-30px;
        }
        .login {
            background: #5b2886f2 !important;
        }
    </style>
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
            <div class="avatar-md">
                <img src="{{ asset('img/avatar.svg') }}" alt="..." id="avatar" class="avatar-img rounded-circle">
            </div>
			<div class="login-form">
                <form method="POST" name="form-login-reset" id="form-login-reset">
                    <div class="form-group form-floating-label">
                        <input id="email" name="email" type="email" class="form-control input-border-bottom">
                        <label for="email" class="placeholder">Email</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="code" name="code" type="text" class="form-control input-border-bottom">
                        <label for="code" class="placeholder">C&oacute;digo</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="password" name="password" type="password" class="form-control input-border-bottom">
                        <label for="password" class="placeholder">Nueva Clave</label>
                        <div class="show-password">
                            <i class="flaticon-interface"></i>
                        </div>
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="cpassword" name="cpassword" type="password" class="form-control input-border-bottom">
                        <label for="cpassword" class="placeholder">Confirmar Clave</label>
                        <div class="show-password">
                            <i class="flaticon-interface"></i>
                        </div>
                    </div>
                    <div class="form-action mb-3">
                      <button type="submit" class="btn btn-secondary btn-block" id="login"> Restablecer</button>
                    </div>
                    <div class="login-account" style="margin-bottom:-40px;">
                        <span class="msg">¿Regresar al inicio de sesi&oacute;n?</span>
                        <a href="{{ url('/login') }}" class="link">Click Aqui</a>
                    </div>
                </form>
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
        $("#form-login-reset").submit(function( event ) {
            event.preventDefault();
            //variables
            var base_url    = $.trim($('meta[name="base_url"]').attr('content') + '/');
            var email       = $("#email").val();
            var code        = $("#code").val();
            var password    = $("#password").val();
            var cpassword   = $("#cpassword").val();

            $("#login").prop("disabled", true).text("Enviando...");
            $('#avatar').attr('src', '{{ asset('img/loader.gif') }}');

            axios.post('{{ route('recovery.post')}}', {
                email:email,
                code:code,
                password:password,
                cpassword:cpassword
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
                    setTimeout(function () {location.href = base_url+response.data.url}, 2000);
                    clear();
                }else{
                    $.notify({
                        icon: 'flaticon-error',
                        title: 'Error!',
                        message: '<p style="font-size: 14px;">'+response.data.message+'</p>',
                        },
                        {
                            type: 'danger',
                            placement: {
                                from: "top",
                                align: "right"
                        },
                            time: 3000,
                    });

                    clear();
                    $('#login').prop("disabled", false).text("Restablecer");
                    setTimeout(function () { $('#avatar').attr('src', '{{ asset('img/avatar.svg') }}'); }, 1000);
                }
            }).catch(error => {
                if (error.response) {
                    if(error.response.status === 422){
                        var err = error.response.data.errors;
                        $.each(err, function( key, value) {
                            $.notify({
                                icon: 'flaticon-error',
                                title: 'Error!',
                                message:  value,

                                },
                                {
                                    type: 'danger',
                                    placement: {
                                        from: "top",
                                        align: "right"
                                },
                                    z_index: 1500,
                                    time: 5000,
                            });
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
                                        align: "center"
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
                clear();
                $('#login').prop("disabled", false).text("Restablecer");
                setTimeout(function () { $('#avatar').attr('src', '{{ asset('img/avatar.svg') }}'); }, 1000);
            });
        });

        function clear() {
            $("#email").val('');
            $("#code").val('');
            $("#password").val('');
            $("#cpassword").val('');
        }
    </script>
</body>
</html>
