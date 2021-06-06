@extends('layouts.app', ['title' => $title ?? 'Encuestas'])

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title"><i class="fas fa-file-signature"></i> {{$title ?? 'Encuestas'}}</h4>
            <div class="btn-group btn-group-page-header ml-auto">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" id="launch-modal-add">
                            <button type="button" class="btn btn-icon btn-round btn-info btn-xs">
                                <i class="fas fa-file-signature"></i>
                            </button> Crear Encuesta
                        </a>
                        {{-- <a class="dropdown-item" href="{{ route('sections.index')}}">
                            <button type="button" class="btn btn-icon btn-round btn-info btn-xs">
                                <i class="fas fa-columns"></i>
                            </button> Secciones
                        </a>
                        <a class="dropdown-item" href="#" id="launch-modal-add">
                            <button type="button" class="btn btn-icon btn-round btn-info btn-xs">
                                <i class="fas fa-bars"></i>
                            </button> Preguntas
                        </a> --}}
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
                                    <p class="card-category">Encuentas</p>
                                    <h4 class="card-title-counter">{{ $polls }}</h4>
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
                        <div class="card-title">Listado de Encuentas</div>
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
                                                <p class="card-category card-category-title">Listado de encuestas. En este modulo podras editar y eliminar, las encuestas que se listan en la siguiente tabla.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table mt-3 display table table-striped table-hover table-head-bg-secondary table-poll">
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
    @include('panel.admin.polls.modal-add')
    @include('panel.admin.polls.modal-edit')
    @include('panel.admin.polls.modal-show')
    @include('panel.admin.polls.sections.modal-add')
    @include('panel.admin.polls.sections.modal-edit')
    @include('panel.admin.polls.sections.questions.modal-question')
    @include('panel.admin.polls.sections.questions.modal-add')
    @include('panel.admin.polls.sections.questions.modal-edit')
@endsection
@section('content-js')
<script>
    $(function () {
        var base_url    = $.trim($('meta[name="base_url"]').attr('content') + '/');
        /*DataTables*/
        var table = $('.table-poll').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                "decimal":        "",
                "emptyTable":     "No hay encuestas registradas",
                "info":           "Mostrando _START_ - _END_ de un total _TOTAL_ encuestas",
                "infoEmpty":      "Mostrando 0 para 0 de 0 Encuestas",
                "infoFiltered":   "(Filtrado para un total de _MAX_ Encuestas)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Mostrar _MENU_ encuestas",
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
            ajax: "{{ route('polls.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        /*DataTables*/

        /*modal-poll register*/
        $("#launch-modal-add").click(function(){
            $("#modal-poll-add").modal("show");
            $('#form-poll-add').trigger("reset");
            $('#btn-poll-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
        });
        $("#form-poll-add").submit(function( event ) {
            event.preventDefault();
            $('#btn-poll-add').addClass('btn-white is-loading is-loading-md').prop("disabled", true);

            var formData = new FormData();
            formData.append('name', $('#name').prop('value'));
            formData.append('description', $('#description').prop('value'));

            axios.post('{{ route('polls.store') }}', formData, {
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
                        $('#form-poll-add').trigger("reset");
                        $('#btn-poll-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
                        setTimeout(function () {$("#modal-poll-add").modal("hide")}, 1200);
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
                    $('#btn-poll-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
            });
        });
        /*modal-poll register*/

        /*modal-poll updated*/
        $('body').on('click', '.editPoll', function () {
            var id = $(this).data("id");
            $("#id_poll").val(id);
            $('#edit_'+id).addClass('btn-white is-loading is-loading-md').prop("disabled", true);

            axios.get('{{ url(\Request::segment(1)) }}/'+id, {
            }).then(response => {
                if(response.data.success){
                    $("#modal-poll-edit").modal("show");
                    $('#form-poll-edit').trigger("reset");
                    $('#edit_'+id).removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
                    $('#name_e').val(response.data.poll.name);
                    $('#description_e').val(response.data.poll.description);

                }
            }).catch(error => {
                if (error.response) {
                    if(error.response.status === 404){
                            $.notify({
                                icon: 'flaticon-error',
                                title: 'Error!',
                                message: '<p style="font-size: 14px;">Encuesta no encontrado, Intente nuevamente.</p>',
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
        $("#form-poll-edit").submit(function( event ) {
            event.preventDefault();

            $('#btn-poll-edit').addClass('btn-white is-loading is-loading-md').prop("disabled", true);
            var id = $("#id_poll").val();
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
                        $('#form-poll-edit').trigger("reset");
                        $('#btn-poll-edit').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
                        setTimeout(function () {$("#modal-poll-edit").modal("hide")}, 1200);
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
                    $('#btn-poll-edit').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
            });
        });
        /*modal-poll updated*/

        /*modal-section-add*/
        $('body').on('click', '.sectionPoll', function () {
            var id = $(this).data("id");
            $('#add_'+id).addClass('btn-white is-loading is-loading-md').prop("disabled", true);
            axios.get('{{ url(\Request::segment(1)) }}/'+id, {
            }).then(response => {
                //console.log(response.data.poll);
                if(response.data.success){
                    $("#modal-poll-section-add").modal("show");
                    $('#add_'+id).removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
                    $('#select_poll').val(response.data.poll.id);
                    $('.poll-title').html('Agregar seccion a encuesta, (<b>'+response.data.poll.name+'</b>)');
                    sectionsPolls(response.data.poll.id);
                }
            }).catch(error => {
                if (error.response) {
                    if(error.response.status === 404){
                            $.notify({
                                icon: 'flaticon-error',
                                title: 'Error!',
                                message: '<p style="font-size: 14px;">Encuesta no encontrada, Intente nuevamente.</p>',
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
                $('#add_'+id).removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
            });
        });
        /*modal-section-add*/

        /********************************ADD SECTION POLL******************************************************/
        $("#btn-poll-section-add").click(function(){
            $('#section_poll_id').val($('#select_poll').val());
            getPoll($('#select_poll').val());
        });

        $("#form-section-add").submit(function( event ) {
            event.preventDefault();
            $('#btn-section-add').addClass('btn-white is-loading is-loading-md').prop("disabled", true);
            var formData = new FormData();
            formData.append('name', $('#name_poll_sect').prop('value'));
            formData.append('description', $('#description_poll_sect').prop('value'));
            formData.append('poll_id', $('#section_poll_id').prop('value'));

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
                        $('#btn-section-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
                        setTimeout(function () {$("#modal-section-add").modal("hide")}, 900);
                        table.ajax.reload();
                        sectionsPolls($('#section_poll_id').val());
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
        /********************************ADD SECTION POLL******************************************************/

        /*********************************UPDATE SECTION POLL***************************************************/
        $('body').on('click', '.updatePollSection', function(){
            var id = $(this).data("id");
            var poll = $('#select_poll').val();
            $('#edit_sec_'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", true);
            axios.get('{{ url('sections') }}/'+id, {
            }).then(response => {
                if(response.data.success){
                    $("#modal-section-edit").modal("show");
                    $('#form-section-edit').trigger("reset");
                    $('.section-title').html('Editar Seccion, <b>'+response.data.section.name+'</b>')
                    $('#name_sect_poll_e').val(response.data.section.name);
                    $('#description_sect_poll_e').val(response.data.section.description);
                    $('#id_section').val(response.data.section.id);
                    sectionsPolls(poll);
                    table.ajax.reload();
                    $('#edit_sec_'+id).removeClass('btn-white is-loading is-loading-xs').prop("disabled", false);
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
                                    z_index: 1500,
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
                    $('#edit_sec_'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", false);
                }
            });
        });

        $("#form-section-edit").submit(function( event ) {
            event.preventDefault();
            $('#btn-section-edit').addClass('btn-white is-loading is-loading-md').prop("disabled", true);
            var id = $("#id_section").val();
            var formData = new FormData();
            formData.append('name', $('#name_sect_poll_e').prop('value'));
            formData.append('description', $('#description_sect_poll_e').prop('value'));
            formData.append('_method', 'PUT');

            axios.post('{{ url('sections') }}/'+id, formData,{
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
                        setTimeout(function () {$("#modal-section-edit").modal("hide")}, 900);
                        table.ajax.reload();
                        sectionsPolls($('#select_poll').val());
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
        /*********************************UPDATE SECTION POLL***************************************************/

        /*********************************ADD SECTION QUESTION POLL***************************************************/
        $('body').on('click', '.addPregPollSection', function(){
            $('#options_questions div').remove();
            $('.open_option_question').hide();
            $('#open_option_question').hide();
            $('#name_options').val('');
            $("#name_options").attr("required", false);

            var id = $(this).data("id");
            var poll = $('#select_poll').val();
            $('#preg_sec_add_'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", true);
            axios.get('{{ url('sections') }}/'+id, {
            }).then(response => {
            //console.log(response.data);
                if(response.data.success){
                    $("#modal-section-question-add").modal("show");
                    $('#form-section-question-add').trigger("reset");
                    $('.section-question-title').html('Agregar Pregunta. <b>'+response.data.section.name+'</b>')
                    $('#id_section').val(response.data.section.id);
                    $('#option_secion_id').val(response.data.section.id);
                    sectionsPolls(poll);
                    table.ajax.reload();
                    $('#preg_sec_add_'+id).removeClass('btn-white is-loading is-loading-xs').prop("disabled", false);
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
                                    z_index: 1500,
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
                    $('#preg_sec_add_'+id).removeClass('btn-white is-loading is-loading-xs').prop("disabled", false);
                }
            });
        });

        $("input[name=type]").click(function () {
            if($(this).val()=='open'){
                $('#open_option_question').show();
                $('.open_option_question').show();
                $("#name_options").attr("required", true);


            }else{
                $("#name_options").attr("required", false);
                $('#open_option_question').hide();
                $('#options_questions div').remove();
                $('.open_option_question').hide();
                $('#name_options').val('');
            }
        });

        var maxField = 10;
        var addButton = $('.add_button');
        var wrapper = $('.open_option_question');
        var x = 1;
        $(addButton).click(function(){
            if(x < maxField){
                x++;
                $(wrapper).append(function(){
                        fieldHTML ='';
                        fieldHTML +='<div id="options_questions">';
                        fieldHTML +='<div class="row">';
                            fieldHTML +='<div class="col-sm-12 col-md-12">';
                                fieldHTML +=' <div class="form-group">';
                                    fieldHTML +='<div class="input-group mb-3">';
                                        fieldHTML +='<div class="input-group-prepend">';
                                            fieldHTML +='<span class="input-group-text">Opcion</span>';
                                        fieldHTML +='</div>';
                                        fieldHTML +='<input type="text" class="form-control" name="name_options[]" value="" id="name_options">';
                                        fieldHTML +='<div class="input-group-append">';
                                            fieldHTML +='<span class="input-group-text">';
                                                    fieldHTML +='<a href="javascript:void(0);" title="Quitar" class="remove_button btn btn-danger btn-xs">';
                                                        fieldHTML +='<i class="fas fa-trash-alt"></i>';
                                                    fieldHTML +='</a>';
                                            fieldHTML +='</span>';
                                        fieldHTML +='</div>';
                                    fieldHTML +='</div>';
                                fieldHTML +='</div>';
                            fieldHTML +='</div>';
                        fieldHTML +='</div>';
                    fieldHTML +='</div>';
                    return fieldHTML;
                });
            }
        });
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $('#options_questions').remove();
            x--;
        });

        $("#form-section-question-add").submit(function( event ) {
            event.preventDefault();
            $('#btn-section-question-add').addClass('btn-white is-loading is-loading-md').prop("disabled", true);
            var id   = $("#id_section").val();
            axios.post('{{ url('questions') }}', $("#form-section-question-add").serialize(),{
            }).then(response => {
                //console.log(response.data);
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
                        $('#form-section-question-add').trigger("reset");
                        $('#btn-section-question-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
                        setTimeout(function () {$("#modal-section-question-add").modal("hide")}, 800);
                        table.ajax.reload();
                        sectionsPolls($('#select_poll').val());
                }else{
                    $.notify({
                                icon: 'flaticon-error',
                                title: 'Error!',
                                message: '<p style="font-size: 14px;">la opcion es requerida</p>',
                            },
                            {
                                type: 'danger',
                                placement: {
                                    from: "top",
                                    align: "right"
                            },
                                z_index: 1500,
                                time: 2000,
                        });
                        $('#btn-section-question-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;

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
                    $('#btn-section-question-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
            });
        });

        $('body').on('click', '.addPollSectionQuestionOption', function(){
            var id = $(this).data("id");
            var poll = $('#select_poll').val();
            var id_question = $('#question_option_id').val(id);
            var id_option = $('#question_option_item_id').val('');
            $('#form-section-question-option-add').trigger("reset");
            $('#add_sec_question_option_'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", true);
            setTimeout(() => { $('#add_sec_question_option_'+id).removeClass('btn-white is-loading is-loading-xs').prop("disabled", false); }, 500);
            setTimeout(() => { $("#modal-section-question-option-add").modal("show"); }, 500);
        });

        $('body').on('click', '.additemPollSectionQuestionOption', function(){
            var id = $(this).data("id");
            var poll = $('#select_poll').val();
            var id_option = $('#question_option_item_id').val(id);
            var id_question = $('#question_option_id').val('');
            $('#form-section-question-option-add').trigger("reset");
            $('#add_sec_item_question_option_'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", true);
            setTimeout(() => { $('#add_sec_item_question_option_'+id).removeClass('btn-white is-loading is-loading-xs').prop("disabled", false); }, 500);
            setTimeout(() => { $("#modal-section-question-option-add").modal("show"); }, 500);
        });

        $("#form-section-question-option-add").submit(function( event ) {
            event.preventDefault();
            $('#btn-section-question-option-add').addClass('btn-white is-loading is-loading-md').prop("disabled", true);
            var formData = new FormData();
            formData.append('name', $('#name_question_section_option').prop('value'));
            formData.append('question_id', $("#question_option_id").val());
            formData.append('option_id', $("#question_option_item_id").val());

            axios.post('{{ url('questions') }}/options/store', formData,{
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
                        $('#form-section-question-option-add').trigger("reset");
                        $('#btn-section-question-option-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
                        setTimeout(function () {$("#modal-section-question-option-add").modal("hide")}, 800);
                        table.ajax.reload();
                        sectionsPolls($('#select_poll').val());
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
                    $('#btn-section-question-option-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
            });
        });

        /*********************************ADD SECTION QUESTION POLL***************************************************/

        /*********************************UPDATE SECTION QUESTIONS SEGMENTS POLL***************************************************/
        $('body').on('click', '.updatePollSectionQuestion', function(){
            var id = $(this).data("id");
            $('#edit_sec_question_'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", false);
            axios.get('{{ url('questions') }}/'+id, {
            }).then(response => {
                if(response.data.success){
                    $('#form-section-question-edit').trigger("reset");
                    $("#modal-section-question-edit").modal("show");
                    $("#section_question_option_id").val("");
                    $("#section_question_option_item_id").val("");
                    $('#section_question_id').val(response.data.question.id);
                    $('#name_question_section').val(response.data.question.name);
                    $('#description_question_section').val(response.data.question.description);
                    $('#edit_sec_question_'+id).removeClass('btn-white is-loading is-loading-xs').prop("disabled", false);
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
                                    z_index: 1500,
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
                    $('#edit_sec_question_'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", false);
                }
            });
        });

        $('body').on('click', '.updatePollSectionQuestionOption', function(){
            var id = $(this).data("id");
            $('#edit_sec_question_option_'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", false);
            axios.get('{{ url('questions') }}/options/'+id, {
            }).then(response => {
                if(response.data.success){
                    $('#form-section-question-edit').trigger("reset");
                    $("#modal-section-question-edit").modal("show");
                    $("#section_question_option_item_id").val("");
                    $('#section_question_id').val("");
                    $('#section_question_option_id').val(response.data.option.id);
                    $('#name_question_section').val(response.data.option.name);
                    $('#edit_sec_question_option_'+id).removeClass('btn-white is-loading is-loading-xs').prop("disabled", false);
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
                                    z_index: 1500,
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
                    $('#edit_sec_question_'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", false);
                }
            });
        });

        $('body').on('click', '.updatePollSectionQuestionOptionItem', function(){
            var id = $(this).data("id");
            $('#edit_sec_question_option_item_'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", false);
            axios.get('{{ url('questions') }}/options/items/'+id, {
            }).then(response => {
                if(response.data.success){
                    $('#form-section-question-edit').trigger("reset");
                    $("#modal-section-question-edit").modal("show");
                    $('#section_question_id').val("");
                    $('#section_question_option_id').val("");
                    $('#section_question_option_item_id').val(response.data.item.id);
                    $('#name_question_section').val(response.data.item.name);
                    $('#edit_sec_question_option_item_'+id).removeClass('btn-white is-loading is-loading-xs').prop("disabled", false);
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
                                    z_index: 1500,
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
                    $('#edit_sec_question_'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", false);
                }
            });
        });

        $("#form-section-question-edit").submit(function( event ) {
            event.preventDefault();
            $('#btn-section-question-edit').addClass('btn-white is-loading is-loading-md').prop("disabled", true);
            var id = $("#section_question_id").val();
            var formData = new FormData();
            formData.append('name', $('#name_question_section').prop('value'));
            formData.append('description', $('#description_question_section').prop('value'));
            formData.append('question_id', $('#section_question_id').prop('value'));
            formData.append('option_id', $('#section_question_option_id').prop('value'));
            formData.append('item_id', $('#section_question_option_item_id').prop('value'));
            //formData.append('_method', 'PUT');

            axios.post('{{ url('questions') }}/update', formData,{
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
                        $('#form-section-question-edit').trigger("reset");
                        $('#btn-section-question-edit').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
                        setTimeout(function () {$("#modal-section-question-edit").modal("hide")}, 900);
                        table.ajax.reload();
                        sectionsPolls($('#select_poll').val());
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
                    $('#btn-section-question-edit').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
            });
        });
        /*********************************UPDATE SECTION QUESTIONS SEGMENTS POLL***************************************************/

        /*********************************DELETE SECTION QUESTIONS SEGMENTS POLL***************************************************/
        $('body').on('click', '.deletePollSectionQuestion', function(){
            var id = $(this).data("id");
            var poll = $('#select_poll').val();
            $('#del_sec_question_'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", true);
            axios.post('{{ url('questions') }}/delete', {
                'question_id': id
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
                    sectionsPolls(poll)
                    table.ajax.reload();
                    $('#del_sec_question_'+id).removeClass('btn-white is-loading is-loading-xs').prop("disabled", false);
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
                                    z_index: 1500,
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
                    $('#del_sec_question_'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", false);
                }
            });
        });

        $('body').on('click', '.deletePollSectionQuestionOption', function(){
            var id = $(this).data("id");
            var poll = $('#select_poll').val();

            $('#del_sec_question_option_'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", true);
            axios.post('{{ url('questions') }}/delete', {
                'option_id': id
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
                    sectionsPolls(poll)
                    table.ajax.reload();
                    $('#del_sec_question_option_'+id).removeClass('btn-white is-loading is-loading-xs').prop("disabled", false);
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
                                    z_index: 1500,
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
                    $('#del_sec_question_option_'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", false);
                }
            });
        });

        $('body').on('click', '.deletePollSectionQuestionOptionItem', function(){
            var id = $(this).data("id");
            var poll = $('#select_poll').val();

            $('#del_sec_question_option_item'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", true);
            axios.post('{{ url('questions') }}/delete', {
                'item_id': id
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
                    sectionsPolls(poll)
                    table.ajax.reload();
                    $('#del_sec_question_option_item'+id).removeClass('btn-white is-loading is-loading-xs').prop("disabled", false);
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
                                    z_index: 1500,
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
                    $('#del_sec_question_option_item'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", false);
                }
            });
        });

        /*********************************DELETE SECTION QUESTIONS SEGMENTS POLL***************************************************/

        /*********************************DELETE SECTION POLL***************************************************/
        $('body').on('click', '.deletePollSection', function(){
            var id = $(this).data("id");
            var poll = $('#select_poll').val();
            $('#del_sec_'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", true);
            axios.delete('{{ url('sections') }}/'+id, {
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
                    sectionsPolls(poll)
                    table.ajax.reload();
                    $('#del_sec_'+id).removeClass('btn-white is-loading is-loading-xs').prop("disabled", false);
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
                                    z_index: 1500,
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
                    $('#del_sec_'+id).addClass('btn-white is-loading is-loading-xs').prop("disabled", false);
                }
            });
        });
        /*********************************DELETE SECTION POLL***************************************************/


        /*alert-poll-delete*/
        $('body').on('click', '.deletePoll', function () {
            var id = $(this).data("id");
            swal({
                    title: '¿Desea eliminar la Encuesta?',
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

    function sectionsPolls(id){
        axios.get('{{ url(\Request::segment(1)) }}/'+id, {
            }).then(response => {
                //console.log(response.data.sections);
                if(response.data.success){
                    if(response.data.sections!=0){
                        $('#sections_polls').html(function(){
                            var html ='';
                                html +='<div class="row">';
                                    html +='<div class="col-sm-12 col-md-12 ">';
                                        html +='<div class="alert alert-primary" role="alert">';
                                            html +='<div class="card-list">';
                                                html +='<div class="row">';
                                                        $.each(response.data.sections, function( key, value) {
                                                            var sec = value.name.substring(2,-1).toUpperCase();
                                                            html +='<div class="col-sm-12 col-md-12">';
                                                                    html +='<div class="item-list">';
                                                                        html +='<div class="avatar">';
                                                                            html +='<span class="avatar-title rounded-circle border border-white">'+sec+'</span>';
                                                                        html +='</div>';
                                                                        html +='<div class="info-user ml-3">';
                                                                            html +='<div class="username">'+value.name+'</div>';
                                                                            html +='<div class="status">'+value.description+'</div>';
                                                                        html +='</div>';

                                                                        html +='<a href="javascript:void(0)" title="Agregar Preguntas"  data-id="'+value.id+'" id="preg_sec_add_'+value.id+'"  class="btn btn-success btn-xs addPregPollSection mr-2">';
                                                                                    html +='<i class="fas fa-tasks"></i>';
                                                                        html +='</a>';

                                                                        html +='<a href="javascript:void(0)" title="Editar"  data-id="'+value.id+'" id="edit_sec_'+value.id+'"  class="btn btn-secondary btn-xs updatePollSection mr-2">';
                                                                            html +='<i class="fas fa-pencil-alt"></i>';
                                                                        html +='</a>';

                                                                        html +='<a href="javascript:void(0)" title="Eliminar"  data-id="'+value.id+'" id="del_sec_'+value.id+'"  class="btn btn-danger btn-xs deletePollSection">';
                                                                            html +='<i class="fas fa-trash-alt"></i>';
                                                                        html +='</a>';
                                                                    html +='</div>';
                                                                    if(value.questions.length!=0){
                                                                            html +='<ol class="activity-feed">';
                                                                            var i = 0;
                                                                            $.each(value.questions, function(key, question) {
                                                                                i++;
                                                                                    html +='<li class="feed-item feed-item-secondary">';
                                                                                        html +='<time class="date">Pregunta '+i+': '+question.name+'<br></time>';
                                                                                        if(question.type=="open"){
                                                                                            html +='<a href="javascript:void(0)" title="Opcion"  data-id="'+question.id+'" id="add_sec_question_option_'+question.id+'"  class="btn btn-success btn-xs addPollSectionQuestionOption mr-2">';
                                                                                                html +='<i class="fas fa-plus"></i>';
                                                                                            html +='</a>';
                                                                                        }

                                                                                        html +='<a href="javascript:void(0)" title="Editar"  data-id="'+question.id+'" id="edit_sec_question_'+question.id+'"  class="btn btn-secondary btn-xs updatePollSectionQuestion mr-2">';
                                                                                            html +='<i class="fas fa-pencil-alt"></i>';
                                                                                        html +='</a>';

                                                                                        html +='<a href="javascript:void(0)" title="Eliminar"  data-id="'+question.id+'" id="del_sec_question_'+question.id+'"  class="btn btn-danger btn-xs deletePollSectionQuestion  mr-2">';
                                                                                            html +='<i class="fas fa-trash-alt"></i>';
                                                                                        html +='</a>';

                                                                                        html +='<span class="text" title="'+question.title+'">'+question.description+'</span>';

                                                                                            var j = 0;
                                                                                            html +='<ol class="activity-feed">';
                                                                                                        $.each(question.options, function(key, option) {
                                                                                                            j++;
                                                                                                            html +='<li class="feed-item feed-item-secondary">';
                                                                                                                html +='<time class="date">Option '+j+'</time>';

                                                                                                                html +='<a href="javascript:void(0)" title="Item"  data-id="'+option.id+'" data-question='+option.name+' id="add_sec_item_question_option_'+option.id+'"  class="btn btn-success btn-xs additemPollSectionQuestionOption mr-2">';
                                                                                                                    html +='<i class="fas fa-plus"></i>';
                                                                                                                html +='</a>';

                                                                                                                html +='<a href="javascript:void(0)" title="Editar"  data-id="'+option.id+'" data-question='+option.name+' id="edit_sec_question_option_'+option.id+'"  class="btn btn-secondary btn-xs updatePollSectionQuestionOption mr-2">';
                                                                                                                    html +='<i class="fas fa-pencil-alt"></i>';
                                                                                                                html +='</a>';

                                                                                                                html +='<a href="javascript:void(0)" title="Eliminar"  data-id="'+option.id+'" id="del_sec_question_option_'+option.id+'"  class="btn btn-danger btn-xs deletePollSectionQuestionOption  mr-2">';
                                                                                                                    html +='<i class="fas fa-trash-alt"></i>';
                                                                                                                html +='</a>';
                                                                                                                html +='<span class="text">'+option.name+'</span>';

                                                                                                                    var k = 0;
                                                                                                                    html +='<ol class="activity-feed">';
                                                                                                                                $.each(option.items, function(key, item) {
                                                                                                                                    k++;
                                                                                                                                    html +='<li class="feed-item feed-item-secondary">';
                                                                                                                                        html +='<time class="date">Pregunta '+k+'<br></time>';

                                                                                                                                        html +='<a href="javascript:void(0)" title="Editar"  data-id="'+item.id+'" data-question='+item.name+' id="edit_sec_question_option_item_'+item.id+'"  class="btn btn-secondary btn-xs updatePollSectionQuestionOptionItem mr-2">';
                                                                                                                                                html +='<i class="fas fa-pencil-alt"></i>';

                                                                                                                                        html +='</a>';
                                                                                                                                            html +='<a href="javascript:void(0)" title="Eliminar"  data-id="'+item.id+'" id="del_sec_question_option_item_'+option.id+'"  class="btn btn-danger btn-xs deletePollSectionQuestionOptionItem  mr-2">';
                                                                                                                                                html +='<i class="fas fa-trash-alt"></i>';
                                                                                                                                        html +='</a>';

                                                                                                                                        html +='<span class="text">'+item.name+'</span>';
                                                                                                                                    html +='</li>';
                                                                                                                                });
                                                                                                                    html +='</ol>';
                                                                                                            html +='</li>';
                                                                                                        });
                                                                                            html +='</ol>';
                                                                                    html +='</li>';
                                                                            });
                                                                            html +='</ol>';
                                                                    }
                                                                    else{
                                                                        html +='';
                                                                    }
                                                            html +='</div>';
                                                        });
                                                html +='</div>';
                                            html +='</div>';
                                        html +='</div>';
                                    html +='</div>';
                                html +='</div>';
                            return html;
                        });
                    }else{
                        $('#sections_polls').html(function(){
                            var html ='';
                            html +='<div class="row">';
                                html +='<div class="col-sm-12 col-md-12">';
                                    html +='<div class="alert alert-dark" role="alert">';
                                        html +='<p class="card-category card-category-title poll-title"> No hay Secciones Agregadas</p>';
                                    html +='</div>';
                                html +='</div>';
                            html +='</div>';
                            return html;
                        });
                    }
                }
            }).catch(error => {
                if (error.response) {
                    if(error.response.status === 404){
                            $.notify({
                                icon: 'flaticon-error',
                                title: 'Error!',
                                message: '<p style="font-size: 14px;">Encuesta no encontrada, Intente nuevamente.</p>',
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
    }

    function getPoll(id){
        $('#btn-poll-section-add').addClass('btn-white is-loading is-loading-md').prop("disabled", true);
        axios.get('{{ url(\Request::segment(1)) }}/'+id, {
            }).then(response => {
                if(response.data.success){
                    $("#modal-section-add").modal("show");
                    $('#form-section-add').trigger("reset");
                    $('.section-title').html('Agregar seccion a encuesta, (<b>'+response.data.poll.name+'</b>)');
                    $('#btn-poll-section-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
                }
            }).catch(error => {
                if (error.response) {
                    if(error.response.status === 404){
                            $.notify({
                                icon: 'flaticon-error',
                                title: 'Error!',
                                message: '<p style="font-size: 14px;">Encuesta no encontrada, Intente nuevamente.</p>',
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
                $('#btn-poll-section-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
            });
    }
</script>
@endsection
