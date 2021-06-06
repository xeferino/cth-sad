@extends('layouts.app', ['title' => $title ?? 'Encuestas Asignadas'])

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title"><i class="fas fa-file-signature"></i> {{$title ?? 'Encuestas Aperturadas'}}</h4>
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
                                    <p class="card-category">Asignaciones</p>
                                    <h4 class="card-title-counter">{{ $assignments }}</h4>
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
                        <div class="card-title">Asignaciones de Encuesta</div>
                    </div>
                    <div class="card-body">
                        <div class="card-sub">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div data-toggle="tooltip" data-placement="top" title="Crear Asignacion" style="cursor: pointer;" class="icon-big text-center icon-secondary bubble-shadow-small launch-modal-add">
                                                <i class="fas fa-file-signature"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <div class="numbers">
                                                <p class="card-category card-category-title">Listado de Asignaciones de encuestas.</p>
                                            </div>
                                        </div>
                                        <button type="button" data-toggle="tooltip" data-placement="top" title="Crear Asignacion" class="btn btn-icon btn-round btn-success float-right mr-2 launch-modal-add">
                                            <i class="fas fa-user-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table mt-3 display table table-striped table-hover table-head-bg-secondary table-assignment">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Encuestador</th>
                                        <th scope="col">Canton</th>
                                        <th scope="col">Rutas</th>
                                        <th scope="col">Encuesta</th>
                                        <th scope="col">Estatus</th>
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
    @include('panel.admin.polls.assignments.modal-add', ['pollsters' => $pollsters, 'periods' => $periods, 'cantons' => $cantons])
    @include('panel.admin.polls.assignments.modal-customer-route')
@endsection
@section('content-js')
<script>
    $(function () {
        var base_url    = $.trim($('meta[name="base_url"]').attr('content') + '/');
        /* $('#demo').multi({
        non_selected_header:'Languages',
        selected_header:'Selected Languages'

        }); */


        /*DataTables*/
        var table = $('.table-assignment').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                "decimal":        "",
                "emptyTable":     "No hay asignaciones registradas",
                "info":           "Mostrando _START_ - _END_ de un total _TOTAL_ asignaciones",
                "infoEmpty":      "Mostrando 0 para 0 de 0 asignaciones",
                "infoFiltered":   "(Filtrado para un total de _MAX_ asignaciones)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Mostrar _MENU_ Asignaciones",
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
            ajax: "{{ route('assignments.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'fullname', name: 'fullname'},
                {data: 'canton', name: 'canton'},
                {data: 'route', name: 'route'},
                {data: 'poll', name: 'poll'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        /*DataTables*/

        /*modal-route register*/
        $(".launch-modal-add").click(function(){
            $('#form-assignment-add').trigger("reset");
            $("#modal-assignment-add").modal("show");
        });

        $("#canton_id").change(function(){
            axios.get('{{ url(\Request::segment(1)) }}/route/canton/'+$(this).val(), {
            }).then(response => {
                if(response.data.success){
                    $('#routes').html(function(){
                        var html = '';
                        if(response.data.routes.length!=0){
                            $.each(response.data.routes, function( key, value) {
                                if(value.exists=='true'){
                                    html += '<option value="'+value.id+'" disabled style="color:#ff000085;"> '+value.name+'</option>';
                                }else{
                                    html += '<option value="'+value.id+'" style="color:#35cd3a;">'+value.name+'</option>';
                                }
                            });
                        }else{
                            html += '<option disabled>El canton seleccionado, no posee rutas configuradas</option>';
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


        $("#form-assignment-add").submit(function( event ) {
            event.preventDefault();
            $('#btn-assignment-add').addClass('btn-white is-loading is-loading-md').prop("disabled", true);
            var formData = new FormData();
            formData.append('pollster_id', $('#pollster_id').prop('value'));
            formData.append('period_id', $('#period_id').prop('value'));
            formData.append('canton_id', $('#canton_id').prop('value'));
            formData.append('routes', $('#routes').prop('value'));

            axios.post('{{ route('assignments.store') }}',{
                routes:$('#routes').val(),
                pollster_id:$('#pollster_id').val(),
                period_id:$('#period_id').val(),
                canton_id:$('#canton_id').val()
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
                        $('#form-assignment-add').trigger("reset");
                        $('#btn-assignment-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
                        setTimeout(function () {$("#modal-assignment-add").modal("hide")}, 1200);
                        table.ajax.reload();
                        $('#routes').html('');
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
                            time: 5000,
                            z_index: 1500,
                    });
                    $('#btn-assignment-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
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
                        }else if (error.response.status === 401){
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
                                    time: 5000,
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
                    $('#btn-assignment-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
            });
        });
        /*modal-route register*/

        /*alert-assignment-delete*/
        $('body').on('click', '.deleteAssignment', function () {
            var id = $(this).data("id");
            swal({
                    title: '¿Desea eliminar la asignacion?',
                    text: 'Recuerde que esta acción no tiene revera.',
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
        /*alert-assignment-delete*/

        /*route customers*/
        $('body').on('click', '.modalRouteCustomer', function () {
            var id = $(this).data("id");
            var canton_id = $(this).data("canton_id");
            var canton = $(this).data("canton");
            var period = $(this).data("period");
            var pollster_id = $(this).data("pollster_id");
            var routes = $(this).data("routes");

            $(this).addClass('btn-white is-loading is-loading-md').prop("disabled", true);

            axios.post('{{ route('assignments.route') }}', {
                canton:canton_id,
                period:period,
                pollster_id:pollster_id,
                routes:routes
            }).then(response => {
                if(response.data.success){
                    $("#modal-route-customer").modal("show");
                    $('.card-route-title').text('Listado de Clientes. Aqui se muestra los clientes que pertenecen al canton ('+canton+')');
                    $('.card-route-header').text('Listado de Clientes del canton ('+canton+')');
                    $('#customers_routes').html('');
                    var html ='';
                    if(response.data.routes!=0){
                        $('#customers_routes').html(function(){
                            $.each(response.data.routes, function( key, value) {
                                var two = value.fullname.substring(2,-1).toUpperCase();
                                var text = (value.status=='si') ? "success" : "danger";
                                var encuestado = (value.status=='si') ? "Encuestado" : "Pendiente";
                                html +='<div class="d-flex">';
                                    html +='<div class="avatar">';
                                        html +='<span class="avatar-title rounded-circle border border-white bg-info">'+two+'</span>';
                                    html +='</div>';
                                    html +='<div class="flex-1 ml-3 pt-1">';
                                        html +='<h5 class="text-uppercase fw-bold mb-1">'+value.fullname+' <span class="text-'+text+' pl-3">'+encuestado+'</span></h5>';
                                        html +='<span class="text-muted">'+value.address+'</span>';
                                        html +='<br><span class="text-muted">'+value.route+'</span>';
                                    html +='</div>';
                                    html +='<div class="float-right pt-1">';
                                        html +='<span><a href="javascript:void(0)" data-poll="'+value.poll+'" data-period="'+value.period+'" data-customer="'+value.id+'"  data-pollster="'+pollster_id+'" id="pdf_'+value.id+'" title="Exportar PDF" class="btn btn-danger btn-xs pdf-poll">PDF</a></span>';
                                    html +='</div>';
                                html +='</div>';
                                html +='<div class="separator-dashed"></div>';
                            });
                            return html;
                        });
                    }
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
            setTimeout(() => { $(this).removeClass('btn-white is-loading is-loading-md').prop("disabled", false); }, 800);
        });

        $('body').on('click', '.pdf-poll', function () {
            $(this).addClass('btn-white is-loading is-loading-md').prop("disabled", true);
            var base_url    = $.trim($('meta[name="base_url"]').attr('content') + '/');
            var period = $(this).data("period");
            var customer = $(this).data("customer");
            var poll = $(this).data("poll");
            var pollster = $(this).data("pollster");
            //location.href = base_url+"polls/customer/pdf/"+poll+"/"+period+"/"+customer;
            var url = base_url+"polls/customer/pdf/"+poll+"/"+period+"/"+customer+"/"+pollster;
            setTimeout(() => { window.open(url, '_blank'); }, 800);
            setTimeout(() => { $(this).removeClass('btn-white is-loading is-loading-md').prop("disabled", false); }, 800);
        });
        /*route customers*/
    });
</script>
@endsection
