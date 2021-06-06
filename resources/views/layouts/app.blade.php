<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base_url" content="{{url('')}}" id="base_url"/>
    <title>{{ config('app.name', 'Laravel') }} - {{ $title ?? ''}}</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('img/polling.svg') }}" type="image/x-icon"/>
	<!-- Fonts and icons -->
	<script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['{{ asset('css/fonts.css') }}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/azzara.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/multi.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <style>
        /* .select2-drop-active {
            bottom: 380px !important;;
        } */

        .tooltip {
            z-index: 100000000 !important;
            position: fixed;
        }

        .input-group-text {
            color: #ffffff !important;
            background-color: #8280a0 !important;
        }
        .no-match{
            padding: 20px !important;
        }
        .SumoSelect>.optWrapper {
            height: 70px !important;
        }

        .card .card-header {
            background-color: #6660b5 !important;
        }
        .card-title {
            color: #fff !important;
        }

        .card-title-counter{
            color: #5b5a5a !important;
            font-size: 14px !important;
            font-weight: bold !important;
        }
        .modal-content-modal {
                background-color: #f8f4f9 !important;

        }
        .navbar-brand-text{
            color: #fff !important;
        }
        .card-category-title {
            font-size: 14px !important;
            color: #5e5b5b !important;
        }

        .activity-feed .feed-item {
            position: relative !important;
            padding-bottom: 5px !important;
            padding-left: 15px !important;
            border-left: 2px solid #716aca !important;
        }

        .activity-feed {
            padding: 15px !important;
            list-style: none !important;
        }

        ol, ul, dl {
            margin-top: 0px !important;
            margin-bottom: -1rem !important;
            margin-left: 20px !important;
        }

        .scroll-poll {
            max-height: calc(100vh - 60px);
            overflow-y: auto;
        }
        .modal-body::-webkit-scrollbar {
            width: 4px;
        }
        .modal-body::-webkit-scrollbar-thumb{
            background: #716aca; /* color de la barra */
            border-radius: 4px;
        }

       modal-content::-webkit-scrollbar {
            width: 4px;
        }
       modal-content::-webkit-scrollbar-thumb{
            background: #716aca; /* color de la barra */
            border-radius: 4px;
        }
        body::-webkit-scrollbar {
            width: 4px;
        }
        body::-webkit-scrollbar-thumb{
            background: #716aca; /* color de la barra */
            border-radius: 4px;
        }
    </style>
</head>
<body>
	<div class="wrapper">
		<!--include header-->
        @include('layouts.header', ['home' => route('home')])

        <!--include header-->
        @include('layouts.sidebar')

		<div class="main-panel">
            @yield('content')
		</div>

		<!-- Custom template | don't include it in your project! -->
		{{-- <div class="custom-template">
			<div class="title">Settings</div>
			<div class="custom-content">
				<div class="switcher">
					<div class="switch-block">
						<h4>Topbar</h4>
						<div class="btnSwitch">
							<button type="button" class="changeMainHeaderColor" data-color="blue"></button>
							<button type="button" class="selected changeMainHeaderColor" data-color="purple"></button>
							<button type="button" class="changeMainHeaderColor" data-color="light-blue"></button>
							<button type="button" class="changeMainHeaderColor" data-color="green"></button>
							<button type="button" class="changeMainHeaderColor" data-color="orange"></button>
							<button type="button" class="changeMainHeaderColor" data-color="red"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Background</h4>
						<div class="btnSwitch">
							<button type="button" class="changeBackgroundColor" data-color="bg2"></button>
							<button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
							<button type="button" class="changeBackgroundColor" data-color="bg3"></button>
						</div>
					</div>
				</div>
			</div>
			<div class="custom-toggle">
				<i class="flaticon-settings"></i>
			</div>
		</div> --}}
        <!-- End Custom template -->
        @yield('content-modals')
        @include('panel.admin.users.modal-profile')
	</div>
</div>
<!--   Core JS Files   -->
<script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bundle.min.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ asset('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

<!-- JS select2 -->
<script src="{{ asset('js/plugin/select2/select2.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Moment JS -->
<script src="{{ asset('js/plugin/moment/moment.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ asset('js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset('js/plugin/datatables/datatables.min.js') }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset('js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<!-- Bootstrap Toggle -->
<script src="{{ asset('js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ asset('js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

<!-- Google Maps Plugin -->
<script src="{{ asset('js/plugin/gmaps/gmaps.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ asset('js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<!-- Multi Js -->
<script src="{{ asset('js/plugin/multi.js/multi.min.js') }}"></script>

<!-- Azzara JS -->
<script src="{{ asset('js/ready.min.js') }}"></script>

<!-- Azzara DEMO methods, don't include it in your project! -->
<script src="{{ asset('js/axios.js') }}"></script>
<script src="{{ asset('js/setting-demo.js') }}"></script>
{{-- <script src="{{ asset('js/demo.js') }}"></script>--}}
@yield('content-js')
<script>
    $('.select2').select2({
        theme: "classic",
        placeholder: "Select a state",
        allowClear: true,
        formatNoMatches: function(){
            return '';
        },
    });
    var SweetAlert2Polls = function() {
        //== Demos
        var initDemos = function() {

            $('#alert_logout').click(function(e) {
                swal({
                    title: '{{ Auth::user()->name." ".Auth::user()->last_name }}',
                    text: "Desea salir del sistema!",
                    type: 'warning',
                    icon : "info",
                    buttons:{
                        confirm: {
                            text : 'OK',
                            className : 'btn btn-secondary',
                            showLoaderOnConfirm: true,
                        },
                        cancel: {
                            visible: true,
                            text : 'Cancelar',
                            className: 'btn btn-default'
                        }
                    }
                }).then((confirm) => {
                    if (confirm) {
                        var base_url    = $.trim($('meta[name="base_url"]').attr('content') + '/');
                        axios.post('{{ route('logout')}}', {
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
                                    }
                                }).catch(error => {
                                    if (error.response) {
                                        if(error.response.status === 502){
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
                                });
                    } else {
                        swal.close();
                    }
                });
            });
        };
        return {
            //== Init
            init: function() {
                initDemos();
            },
        };
    }();
//== Class Initialization
jQuery(document).ready(function() {
SweetAlert2Polls.init();
});

var base_url_users    = $.trim($('meta[name="base_url"]').attr('content') + '/users/');
var base_url    = $.trim($('meta[name="base_url"]').attr('content') + '/');

 /*modal-user-profile updated*/
 $('#profile-user').click(function(e) {
     axios.get(base_url_users+'{{ Auth::user()->id }}', {
        }).then(response => {
            if(response.data.success){
                $("#modal-user-profile").modal("show");
                $('#form-user-edit-profile').trigger("reset");
                $('#name_profile').val(response.data.user.name);
                $('#last_name_profile').val(response.data.user.last_name);
                $('#email_profile').val(response.data.user.email);
                $('input:radio[name=role_profile]:checked').val(response.data.user.role);

                if(response.data.user.img==null || response.data.user.img==""){
                    $('#profile_img').attr('src', '{{ asset('img/avatar.svg') }}');
                }else{
                    var img = base_url+'img/profile/'+response.data.user.img;
                    $('#profile_img').attr('src', img);
                }

                if(response.data.user.status==1){
                    $('#status_profile').prop('checked', true).change()
                }else{
                    $('#status_profile').prop('checked', false).change()
                }
            }
        }).catch(error => {
            if (error.response) {
                if(error.response.status === 404){
                        $.notify({
                            icon: 'flaticon-error',
                            title: 'Error!',
                            message: '<p style="font-size: 14px;">Usuario no encontrado, Intente nuevamente.</p>',
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
        });
    });

    $("#form-user-edit-profile").submit(function( event ) {
    event.preventDefault();

    $('#btn-user-profile').addClass('btn-white is-loading is-loading-md').prop("disabled", true);
    var formData = new FormData();
    formData.append('img', $('#img_profile')[0].files[0]);
    formData.append('name', $('#name_profile').prop('value'));
    formData.append('last_name', $('#last_name_profile').prop('value'));
    formData.append('email', $('#email_profile').prop('value'));
    formData.append('password', $('#password_profile').prop('value'));
    formData.append('cpassword', $('#cpassword_profile').prop('value'));
    formData.append('status', $("#status_profile").prop('checked'));
    formData.append('_method', 'PUT');

    axios.post(base_url_users+'profile/'+'{{ Auth::user()->id }}', formData,{
        headers: {
            'Content-Type': 'multipart/form-data'
        }
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
                        z_index: 1500,
                        time: 2000,
                });
                console.log(response.data);
                $('.avatar-img-profile').attr('src', base_url+'img/profile/'+response.data.profile_img);
                $('#btn-user-profile').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
                setTimeout(function () {$("#modal-user-profile").modal("hide")}, 1200);
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
                                    align: "right"
                            },
                                z_index: 1500,
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
                        z_index: 1500,
                        time: 3000,
                });
            }
            $('#btn-user-profile').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
    });
});
 /*modal-user-profile updated*/
</script>
@if(session()->has('connect'))
    <script>
        $.notify({
                icon: 'flaticon-success',
                title: 'Exito!',
                message: '<p style="font-size: 14px;">Hola! <b>{{ Auth::user()->name }}</b> has iniciado sesión correctamente.</p>',
            },
            {
                type: 'success',
                placement: {
                    from: "top",
                    align: "right"
            },
                time: 5000,
        });
    </script>
@endif

</body>
</html>
