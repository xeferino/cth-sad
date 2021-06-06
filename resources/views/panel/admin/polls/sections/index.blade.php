@extends('layouts.app', ['title' => $title ?? 'Encuestas - Secciones'])

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title"><i class="fas fa-columns"></i> {{$title ?? 'Encuestas - Secciones'}}</h4>
            <div class="btn-group btn-group-page-header ml-auto">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('polls.index')}}">
                            <button type="button" class="btn btn-icon btn-round btn-info btn-xs">
                                <i class="fas fa-file-signature"></i>
                            </button> Encuentas
                        </a>
                        <a class="dropdown-item" href="#" id="launch-modal-add">
                            <button type="button" class="btn btn-icon btn-round btn-info btn-xs">
                                <i class="fas fa-columns"></i>
                            </button> Crear Seccion
                        </a>
                        <a class="dropdown-item" href="#" id="launch-modal-add">
                            <button type="button" class="btn btn-icon btn-round btn-info btn-xs">
                                <i class="fas fa-bars"></i>
                            </button> Preguntas
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
                                    <i class="fas fa-file-signature"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Secciones</p>
                                    <h4 class="card-title-counter">{{ $sections }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-sm-4 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-danger bubble-shadow-small">
                                    <i class="fas fa-user-alt-slash"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Inactivos</p>
                                    <h4 class="card-title-counter">{{ $customers_inactive }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Activos</p>
                                    <h4 class="card-title-counter">{{ $customers_active }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Listado de Secciones</div>
                    </div>
                    <div class="card-body">
                        <div class="card-sub">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                                <i class="fas fa-file-signature"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <div class="numbers">
                                                <p class="card-category card-category-title">Listado de secciones. En este modulo podras editar y eliminar, las Secciones que se listan en la siguiente tabla.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table mt-3 display table table-striped table-hover table-head-bg-secondary table-section">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
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
    @include('panel.admin.polls.sections.modal-add')
    @include('panel.admin.polls.sections.modal-edit')
@endsection
@section('content-js')
<script>
    $(function () {
        var base_url    = $.trim($('meta[name="base_url"]').attr('content') + '/');
        /*DataTables*/
        var table = $('.table-section').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                "decimal":        "",
                "emptyTable":     "No hay secciones registradas",
                "info":           "Mostrando _START_ - _END_ de un total _TOTAL_ secciones",
                "infoEmpty":      "Mostrando 0 para 0 de 0 secciones",
                "infoFiltered":   "(Filtrado para un total de _MAX_ secciones)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Mostrar _MENU_ Secciones",
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
            ajax: "{{ route('sections.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        /*DataTables*/

        /*modal-section register*/
        $("#launch-modal-add").click(function(){
            $("#modal-section-add").modal("show");
            $('#form-section-add').trigger("reset");
            $('#btn-section-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
        });
        $("#form-section-add").submit(function( event ) {
            event.preventDefault();
            $('#btn-section-add').addClass('btn-white is-loading is-loading-md').prop("disabled", true);

            var formData = new FormData();
            formData.append('name', $('#name').prop('value'));
            formData.append('description', $('#description').prop('value'));

            axios.post('{{ route('sections.store') }}', formData, {
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
                        $('#form-section-add').trigger("reset");
                        $('#btn-section-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
                        setTimeout(function () {$("#modal-section-add").modal("hide")}, 1200);
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
                    $('#btn-section-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
            });
        });
        /*modal-section register*/

        /*modal-section updated*/
        $('body').on('click', '.editSection', function () {
            var id = $(this).data("id");
            $("#id_section").val(id);
            $('#edit_'+id).addClass('btn-white is-loading is-loading-md').prop("disabled", true);

            axios.get('{{ url(\Request::segment(1)) }}/'+id, {
                                }).then(response => {
                                    if(response.data.success){
                                        $("#modal-section-edit").modal("show");
                                        $('#form-section-edit').trigger("reset");
                                        $('#edit_'+id).removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
                                        $('#name_e').val(response.data.section.name);
                                        $('#description_e').val(response.data.section.description);

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
        $("#form-section-edit").submit(function( event ) {
            event.preventDefault();

            $('#btn-section-edit').addClass('btn-white is-loading is-loading-md').prop("disabled", true);
            var id = $("#id_section").val();
            var formData = new FormData();
            formData.append('name', $('#name_e').prop('value'));
            formData.append('description', $('#description_e').prop('value'));
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
                        $('#form-section-edit').trigger("reset");
                        $('#btn-section-edit').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
                        setTimeout(function () {$("#modal-section-edit").modal("hide")}, 1200);
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
                    $('#btn-section-edit').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
            });
        });
        /*modal-section updated*/

        /*modal-section details*/
        $('body').on('click', '.detalleSection', function () {
            var id = $(this).data("id");
            $('#det_'+id).addClass('btn-white is-loading is-loading-md').prop("disabled", true);
            axios.get('{{ url(\Request::segment(1)) }}/'+id, {
                }).then(response => {
                    if(response.data.success){
                        $("#modal-section-show").modal("show");
                        $('#poll-name').text(response.data.section.name);
                        $('#poll-description').text(response.data.section.description);

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
        /*modal-section details*/


        /*alert-poll-delete*/
        $('body').on('click', '.deleteSection', function () {
            var id = $(this).data("id");
            swal({
                    title: '¿Desea eliminar la Seccion?',
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
        /*alert-poll-delete*/
    });
</script>
@endsection
