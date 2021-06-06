@extends('layouts.app', ['title' => $title ?? 'Rutas'])

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title"><i class="fas fa-map-marker-alt"></i> {{$title ?? 'Rutas'}}</h4>
            <div class="btn-group btn-group-page-header ml-auto">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" id="launch-modal-add">
                            <button type="button" class="btn btn-icon btn-round btn-info btn-xs">
                                <i class="fas fa-map-marker-alt"></i>
                            </button> Crear Ruta
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Rutas</p>
                                    <h4 class="card-title-counter">{{ $routes }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Listado de Rutas</div>
                    </div>
                    <div class="card-body">
                        <div class="card-sub">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <div class="numbers">
                                                <p class="card-category card-category-title">Listado de rutas. En este modulo podras editar y eliminar, las rutas que se listan en la siguiente tabla.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table mt-3 display table table-striped table-hover table-head-bg-secondary table-route">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Codigo</th>
                                        <th scope="col">Canton</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content-modals')
    @include('panel.admin.routes.modal-add')
    @include('panel.admin.routes.modal-edit')
@endsection
@section('content-js')
<script>
    $(function () {
        var base_url    = $.trim($('meta[name="base_url"]').attr('content') + '/');
        /*DataTables*/
        var table = $('.table-route').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                "decimal":        "",
                "emptyTable":     "No hay rutas registradas",
                "info":           "Mostrando _START_ - _END_ de un total _TOTAL_ rutas",
                "infoEmpty":      "Mostrando 0 para 0 de 0 rutas",
                "infoFiltered":   "(Filtrado para un total de _MAX_ rutas)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Mostrar _MENU_ Rutas",
                "loadingRecords": "Cargando...",
                "processing":     "Procesando...",
                "search":         "Buscar:",
                "zeroRecords":    "No hay coicidencias de registros en la busqueda",
                "paginate": {
                    "first":      "Primero",
                    "last":       "Ultimo",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "aria": {
                    "sortAscending":  ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            },
            ajax: "{{ route('routes.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'code', name: 'code'},
                {data: 'canton', name: 'canton'},
                {data: 'description', name: 'description'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        /*DataTables*/

        /*modal-route register*/
        $("#launch-modal-add").click(function(){
            axios.get('{{ route('routes.cantons') }}', {
            }).then(response => {
                if(response.data.success){
                    $("#modal-route-add").modal("show");
                    $('#form-route-add').trigger("reset");
                    $('#btn-route-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
                    $('#canton_id').html(function(){
                        var html = '';
                        if(response.data.cantons.length!=0){
                            html += '<option value="">.::Seleccione::.</option>';
                            $.each(response.data.cantons, function( key, value) {
                                html += '<option value="'+value.id+'">'+value.name+'</option>';
                            });
                        }else{
                            html += '<option value="">.::No hay cantones registrados::.</option>';
                        }
                        return html;
                    });
                }
            }).catch(error => {
                if (error.response) {
                    if(error.response.status === 404){
                            $.notify({
                                icon: 'flaticon-error',
                                title: 'Error!',
                                message: '<p style="font-size: 14px;">Error en el cargado los cantones, Intente nuevamente.</p>',
                                },
                                {
                                    type: 'danger',
                                    placement: {
                                        from: "top",
                                        align: "right"
                                },
                                    time: 3000,
                                    z_index: 1500,
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
                                    z_index: 1500,
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
                                    z_index: 1500,
                        });
                }
            });
        });
        $("#form-route-add").submit(function( event ) {
            event.preventDefault();
            $('#btn-route-add').addClass('btn-white is-loading is-loading-md').prop("disabled", true);
            var formData = new FormData();
            formData.append('name', $('#name').prop('value'));
            formData.append('description', $('#description').prop('value'));
            formData.append('code', $('#code').prop('value'));
            formData.append('canton_id', $('#canton_id').prop('value'));

            axios.post('{{ route('routes.store') }}', formData, {
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
                        $('#form-route-add').trigger("reset");
                        $('#btn-route-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
                        setTimeout(function () {$("#modal-route-add").modal("hide")}, 1200);
                        table.ajax.reload();
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
                    $('#btn-route-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
            });
        });
        /*modal-route register*/

        /*modal-route updated*/
        $('body').on('click', '.editRoute', function () {
            var id = $(this).data("id");
            $("#id_route").val(id);
            $('#edit_'+id).addClass('btn-white is-loading is-loading-md').prop("disabled", true);

            axios.get('{{ url(\Request::segment(1)) }}/'+id, {
                                }).then(response => {
                                    if(response.data.success){
                                        $("#modal-route-edit").modal("show");
                                        $('#form-route-edit').trigger("reset");
                                        $('#edit_'+id).removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
                                        $('#name_e').val(response.data.route.name);
                                        $('#code_e').val(response.data.route.code);
                                        $('.route-title').html('Editar Ruta: <b>'+response.data.route.name+'</b>');
                                        $('#description_e').val(response.data.route.description);
                                        $('#canton_id_e').html(function(){
                                        var html = '';
                                             if(response.data.cantons.length!=0){
                                                html += '<option value="">.::Seleccione::.</option>';
                                                $.each(response.data.cantons, function( key, value) {
                                                    html += '<option value="'+value.id+'">'+value.name+'</option>';
                                                });
                                            }else{
                                                html += '<option value="">.::No hay cantones registrados::.</option>';
                                            }
                                            return html;
                                        });
                                        $('#canton_id_e').val(response.data.route.canton_id);

                                    }
                                }).catch(error => {
                                    if (error.response) {
                                        if(error.response.status === 404){
                                                $.notify({
                                                    icon: 'flaticon-error',
                                                    title: 'Error!',
                                                    message: '<p style="font-size: 14px;">Seccion no encontrada, Intente nuevamente.</p>',
                                                    },
                                                    {
                                                        type: 'danger',
                                                        placement: {
                                                            from: "top",
                                                            align: "right"
                                                    },
                                                        time: 3000,
                                                        z_index: 1500,
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
                                                        z_index: 1500,
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
                                                    z_index: 1500,
                                        });
                                    }
                                    $('#edit_'+id).removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
                                });

        });
        $("#form-route-edit").submit(function( event ) {
            event.preventDefault();

            $('#btn-route-edit').addClass('btn-white is-loading is-loading-md').prop("disabled", true);
            var id = $("#id_route").val();
            var formData = new FormData();
            formData.append('name', $('#name_e').prop('value'));
            formData.append('description', $('#description_e').prop('value'));
            formData.append('code', $('#code_e').prop('value'));
            formData.append('canton_id', $('#canton_id_e').prop('value'));
            formData.append('_method', 'PUT');

            axios.post('{{ url(\Request::segment(1)) }}/'+id, formData,{
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
                        $('#form-route-edit').trigger("reset");
                        $('#btn-route-edit').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
                        setTimeout(function () {$("#modal-route-edit").modal("hide")}, 1200);
                        table.ajax.reload();
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
                    $('#btn-route-edit').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
            });
        });
        /*modal-route updated*/

        /*modal-route details*/
        $('body').on('click', '.detalleRoute', function () {
            var id = $(this).data("id");
            $('#det_'+id).addClass('btn-white is-loading is-loading-md').prop("disabled", true);
            axios.get('{{ url(\Request::segment(1)) }}/'+id, {
                }).then(response => {
                    if(response.data.success){
                        $("#modal-route-show").modal("show");
                        $('#poll-name').text(response.data.route.name);
                        $('#poll-description').text(response.data.route.description);

                        $('#det_'+id).removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
                    }
                }).catch(error => {
                    if (error.response) {
                        if(error.response.status === 404){
                                $.notify({
                                    icon: 'flaticon-error',
                                    title: 'Error!',
                                    message: '<p style="font-size: 14px;">Seccion no encontrada, Intente nuevamente.</p>',
                                    },
                                    {
                                        type: 'danger',
                                        placement: {
                                            from: "top",
                                            align: "right"
                                    },
                                        time: 3000,
                                        z_index: 1500,
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
                                        z_index: 1500,
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
                                        z_index: 1500,
                            });
                    }
                    $('#det_'+id).removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
                });
        });
        /*modal-route details*/


        /*alert-route-delete*/
        $('body').on('click', '.deleteRoute', function () {
            var id = $(this).data("id");
            swal({
                    title: '¿Desea eliminar la Ruta?',
                    text: "Recuerde que esta acción no tiene revera.",
                    type: 'error',
                    icon : "error",
                    buttons:{
                        cancel: {
                            visible: true,
                            text : 'Cancelar',
                            className: 'btn btn-default'
                        },
                        confirm: {
                            text : 'Eliminar',
                            className : 'btn btn-danger',
                            showLoaderOnConfirm: true,
                        }
                    }
                }).then((confirm) => {
                    if (confirm) {
                        axios.delete('{{ url(\Request::segment(1)) }}/'+id, {
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
                                        table.ajax.reload();
                                    }
                                }).catch(error => {
                                    if (error.response) {
                                        if(error.response.status === 403){
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
                                                        z_index: 1500,
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
                                                        z_index: 1500,
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
                                                        z_index: 1500,
                                            });
                                    }
                                });
                    } else {
                        swal.close();
                    }
                });
        });
        /*alert-route-delete*/
    });
</script>
@endsection
