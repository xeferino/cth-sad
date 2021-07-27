@extends('layouts.app', ['title' => $title ?? 'Clientes'])

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title"><i class="fas fa-user-friends"></i> {{$title ?? 'Clientes'}}</h4>
            <div class="btn-group btn-group-page-header ml-auto">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" id="launch-modal-add">
                            <button type="button" class="btn btn-icon btn-round btn-info btn-xs">
                                <i class="fas fa-user-plus"></i>
                            </button> Registrar Cliente
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Listado de Clientes</div>
                    </div>
                    <div class="card-body">
                        <div class="card-sub">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                                <i class="flaticon-users"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <div class="numbers">
                                                <p class="card-category card-category-title">Listado de clientes. En este modulo podras editar, eliminar e inactivar los clientes que se listan en la siguiente tabla.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table mt-3 display table table-striped table-hover table-head-bg-secondary table-customer">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre y Apellido</th>
                                        <th scope="col">Documento</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Telefono</th>
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
    @include('panel.admin.customers.modal-add')
    @include('panel.admin.customers.modal-show')
    @include('panel.admin.customers.modal-edit')
@endsection
@section('content-js')
<script>
    $(function () {
        var base_url    = $.trim($('meta[name="base_url"]').attr('content') + '/');
        /*DataTables*/
        var table = $('.table-customer').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                "decimal":        "",
                "info":           "Mostrando _START_ - _END_ de un total _TOTAL_ clientes",
                "infoEmpty":      "Mostrando 0 para 0 de 0 Clientes",
                "infoFiltered":   "(Filtrado para un total de _MAX_ clientes)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Mostrar _MENU_ Clientes",
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
            ajax: "{{ route('clientes.index') }}",
            columns: [
                {data: 'idcliente', name: 'idcliente'},
                {data: 'fullname', name: 'fullname'},
                {data: 'documento', name: 'documento'},
                {data: 'email', name: 'email'},
                {data: 'telefono', name: 'telefono'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        /*DataTables*/

        /*modal-customer register*/
        $("#launch-modal-add").click(function(){
            $("#modal-customer-add").modal("show");
            $('#form-customer-add').trigger("reset");
        });

        $("#form-customer-add").submit(function( event ) {
            event.preventDefault();
            $('#btn-customer-add').addClass('btn-white is-loading is-loading-md').prop("disabled", true);

            axios.post('{{ route('clientes.store') }}', $(this).serialize(), {
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
                        $('#form-customer-add').trigger("reset");
                        $('#btn-customer-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
                        setTimeout(function () {$("#modal-customer-add").modal("hide")}, 1200);
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
                    $('#btn-customer-add').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
            });
        });
        /*modal-customer register*/

        /*modal-customer updated*/
        $('body').on('click', '.editCustomer', function () {
            var id = $(this).data("id");
            $("#id_customer").val(id);
            $('#edit_'+id).addClass('btn-white is-loading is-loading-md').prop("disabled", true);
            $('#btn-customer-edit').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);

            axios.get('{{ url(\Request::segment(1)) }}/'+id, {
            }).then(response => {
                console.log(response.data);
                if(response.data.success){
                    $("#modal-customer-edit").modal("show");
                    $('#form-customer-edit').trigger("reset");
                    $('#edit_'+id).removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
                    $('#document_e').val(response.data.customer[0].documento);
                    $('#names_e').val(response.data.customer[0].nombres);
                    $('#surnames_e').val(response.data.customer[0].apellidos);
                    $('#address_e').val(response.data.customer[0].direccion);
                    $('#phone_e').val(response.data.customer[0].telefono);
                    $('#email_e').val(response.data.customer[0].email);
                    $('#social_e').val(response.data.customer[0].razon_social);
                    $('#turn_e').val(response.data.customer[0].giro);
                    $('#type_e').val(response.data.customer[0].tipo_cliente);
                    $('#commune_e').val(response.data.customer[0].comuna);
                    $('#city_e').val(response.data.customer[0].ciudad);
                    $('#region_e').val(response.data.customer[0].region);
                }
            }).catch(error => {
                if (error.response) {
                    if(error.response.status === 404){
                            $.notify({
                                icon: 'flaticon-error',
                                title: 'Error!',
                                message: '<p style="font-size: 14px;">Cliente no encontrado, Intente nuevamente.</p>',
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

        $("#form-customer-edit").submit(function( event ) {
            event.preventDefault();

            $('#btn-customer-edit').addClass('btn-white is-loading is-loading-md').prop("disabled", true);
            var id = $("#id_customer").val();
            axios.post('{{ url(\Request::segment(1)) }}/'+id, $(this).serialize(), {
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
                        $('#form-customer-edit').trigger("reset");
                        $('#btn-customer-edit').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);;
                        setTimeout(function () {$("#modal-customer-edit").modal("hide")}, 1200);
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
                    $('#btn-customer-edit').removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
            });
        });
        /*modal-customer updated*/

        /*modal-customer details*/
        $('body').on('click', '.detalleCustomer', function () {
            var id = $(this).data("id");
            $('#det_'+id).addClass('btn-white is-loading is-loading-md').prop("disabled", true);
            axios.get('{{ url(\Request::segment(1)) }}/'+id, {
                }).then(response => {
                    if(response.data.success){
                        $("#modal-customer-show").modal("show");
                        $('#customer-name').text(response.data.customer[0].fullnames);
                        $('#customer-document').text(response.data.customer[0].documento);
                        $('#customer-email').text(response.data.customer[0].email);
                        $('#customer_social').text(response.data.customer[0].razon_social);
                        $('#customer_type').text(response.data.customer[0].tipo_cliente);
                        $('#customer_turn').text(response.data.customer[0].giro);

                        $('#customer-details').html(function(){
                            var text = '';
                            text +='El cliente se encuentra ubicado, en la region de '+response.data.customer[0].region;
                            text +=', de la comuna '+response.data.customer[0].comuna;
                            text +=', de la ciudad de '+response.data.customer[0].ciudad;
                            text +='. Su direccion fisica es la siguiente: '+response.data.customer[0].direccion;
                            text +='. Telefono de contacto ('+response.data.customer[0].telefono+')';
                            return text;
                        });

                        $('#det_'+id).removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
                    }
                }).catch(error => {
                    if (error.response) {
                        if(error.response.status === 404){
                                $.notify({
                                    icon: 'flaticon-error',
                                    title: 'Error!',
                                    message: '<p style="font-size: 14px;">Cliente no encontrado, Intente nuevamente.</p>',
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
        /*modal-customer details*/


        /*alert-customer-delete*/
        $('body').on('click', '.deleteCustomer', function () {
            var id = $(this).data("id");
            swal({
                    title: '¿Desea eliminar el cliente?',
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
        /*alert-customer-delete*/

    });
</script>
@endsection
