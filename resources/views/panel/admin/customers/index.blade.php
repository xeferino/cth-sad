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
            <div class="col-sm-4 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Clientes</p>
                                    <h4 class="card-title-counter">{{ $customers }}</h4>
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
                                        <th scope="col">Sexo</th>
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
    @include('panel.admin.customers.modal-add')
    @include('panel.admin.customers.modal-edit')
    @include('panel.admin.customers.modal-show')
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
            ajax: "{{ route('customers.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'fullname', name: 'fullname'},
                {data: 'document', name: 'document'},
                {data: 'email', name: 'email'},
                {data: 'gender', name: 'gender'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        /*DataTables*/

        /*modal-customer register*/
        $("#launch-modal-add").click(function(){
            axios.get('{{ url('routes/all') }}', {
            }).then(response => {
                console.log(response);
                if(response.data.success){
                    $("#modal-customer-add").modal("show");
                    $('#form-customer-add').trigger("reset");
                    $('#route').html(function(){
                        var html = '';
                        html += '<option value="">.::Seleccione::.</option>';
                        $.each(response.data.cantons, function( key, value) {
                            html += '<optgroup label="'+value.canton+'">';
                                $.each(value.routes, function( key, route) {
                                    html += '<option value="'+route.id+'">'+route.name+'</option>';
                                });
                            html += '</optgroup>';
                        });
                        return html;
                    });
                }
            }).catch(error => {
                if (error.response) {
                    if(error.response.status === 404){
                            $.notify({
                                icon: 'flaticon-error',
                                title: 'Error!',
                                message: '<p style="font-size: 14px;">Error en el cargado de las rutas, Intente nuevamente.</p>',
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

        $("#form-customer-add").submit(function( event ) {
            event.preventDefault();
            $('#btn-customer-add').addClass('btn-white is-loading is-loading-md').prop("disabled", true);

            var formData = new FormData();
            formData.append('img', $('#img')[0].files[0]);
            formData.append('name', $('#name').prop('value'));
            formData.append('last_name', $('#last_name').prop('value'));
            formData.append('email', $('#email').prop('value'));
            formData.append('document', $('#document').prop('value'));
            formData.append('address', $('#address').prop('value'));
            formData.append('phone', $('#phone').prop('value'));
            formData.append('city', $('#city').prop('value'));
            formData.append('province', $('#province').prop('value'));
            formData.append('route', $('#route').prop('value'));
            formData.append('route', $('#route').prop('value'));
            formData.append('mobile', $('#mobile').prop('value'));
            formData.append('number_measurer', $('#number_measurer').prop('value'));
            formData.append('rate', $('#rate').prop('value'));
            formData.append('half', $('#half').prop('value'));
            formData.append('code', $('#code').prop('value'));
            formData.append('observation', $('#observation').prop('value'));
            formData.append('gender', $('input:radio[name=gender]:checked').val());

            axios.post('{{ route('customers.store') }}', formData, {
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

            axios.get('{{ url('routes/all') }}', {
            }).then(response => {
                console.log(response);
                if(response.data.success){
                    $('#route_e').html(function(){
                        var html = '';
                        html += '<option value="">.::Seleccione::.</option>';
                        $.each(response.data.cantons, function( key, value) {
                            html += '<optgroup label="'+value.canton+'">';
                                $.each(value.routes, function( key, route) {
                                    html += '<option value="'+route.id+'">'+route.name+'</option>';
                                });
                            html += '</optgroup>';
                        });
                        return html;
                    });
                }
            }).catch(error => {
                if (error.response) {
                    if(error.response.status === 404){
                            $.notify({
                                icon: 'flaticon-error',
                                title: 'Error!',
                                message: '<p style="font-size: 14px;">Error en el cargado de las rutas, Intente nuevamente.</p>',
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

            axios.get('{{ url(\Request::segment(1)) }}/'+id, {
            }).then(response => {
                if(response.data.success){
                    $("#modal-customer-edit").modal("show");
                    $('#form-customer-edit').trigger("reset");
                    $('#edit_'+id).removeClass('btn-white is-loading is-loading-md').prop("disabled", false);
                    $('#name_e').val(response.data.customer.name);
                    $('#last_name_e').val(response.data.customer.last_name);
                    $('#document_e').val(response.data.customer.document);
                    $('#email_e').val(response.data.customer.email);
                    $('#phone_e').val(response.data.customer.phone);
                    $('#city_e').val(response.data.customer.city);
                    $('#province_e').val(response.data.customer.province);
                    $('#address_e').val(response.data.customer.address);
                    $('#mobile_e').val(response.data.customer.mobile);
                    $('#number_measurer_e').val(response.data.customer.number_measurer);
                    $('#rate_e').val(response.data.customer.rate);
                    $('#half_e').val(response.data.customer.half);
                    $('#code_e').val(response.data.customer.code);
                    $('#observation_e').val(response.data.customer.observation);

                   //$("#route_e").select2("val", response.data.route.id);
                    $("#route_e").val(response.data.route.id);
                    $('input:radio[name=gender_e]:checked').val(response.data.customer.gender);

                    if(response.data.customer.img==null || response.data.customer.img==""){
                        $('#avatar_e').attr('src', '{{ asset('img/customer/avatar.svg') }}');
                    }else{
                        var img = base_url+'img/customer/'+response.data.customer.img;
                        $('#avatar_e').attr('src', img);
                    }

                    if(response.data.customer.gender=="M"){
                        $("#gender_m").prop("checked", true)
                    }else{
                        $("#gender_f").prop("checked", true)
                    }
                    if(response.data.customer.status==1){
                        $('#status').prop('checked', true).change()
                    }else{
                        $('#status').prop('checked', false).change()
                    }
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
            var formData = new FormData();
            formData.append('img', $('#img_e')[0].files[0]);
            formData.append('name', $('#name_e').prop('value'));
            formData.append('last_name', $('#last_name_e').prop('value'));
            formData.append('email', $('#email_e').prop('value'));
            formData.append('document', $('#document_e').prop('value'));
            formData.append('address', $('#address_e').prop('value'));
            formData.append('phone', $('#phone_e').prop('value'));
            formData.append('city', $('#city_e').prop('value'));
            formData.append('province', $('#province_e').prop('value'));
            formData.append('route', $('#route_e').prop('value'));
            formData.append('mobile', $('#mobile_e').prop('value'));
            formData.append('number_measurer', $('#number_measurer_e').prop('value'));
            formData.append('rate', $('#rate_e').prop('value'));
            formData.append('half', $('#half_e').prop('value'));
            formData.append('code', $('#code_e').prop('value'));
            formData.append('observation', $('#observation_e').prop('value'));
            formData.append('gender', $('input:radio[name=gender_e]:checked').val());


            formData.append('id', $("#id_customer").prop('value'));
            formData.append('status', $("#status").prop('checked'));
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
                        $('#customer-name').text(response.data.customer.name+' '+response.data.customer.last_name);
                        $('#customer-document').text(response.data.customer.document);
                        $('#customer-email').text(response.data.customer.email);
                        $('#customer-number_measurer').text(response.data.customer.number_measurer);
                        $('#customer-rate').text(response.data.customer.rate);
                        $('#customer-half').text(response.data.customer.half);
                        $('#customer-code').text(response.data.customer.code);
                        $('#customer-details').html(function(){
                            var text = '';
                            text +='El cliente se encuentra ubicado, en la provincia de '+response.data.customer.province;
                            text +=', de la ciudad de '+response.data.customer.city;
                            text +='. Su direccion fisica es la siguiente: '+response.data.customer.address;
                            text +='. Telefono de contacto ('+response.data.customer.phone+')';
                            if(response.data.customer.observation==null || response.data.customer.observation==""){
                                text +='. <br> <br><b>Observaciones:</b> ';
                            }else{
                                text +='. <br> <br><b>Observaciones:</b> '+response.data.customer.observation;
                            }
                            return text;
                        });

                        if(response.data.customer.img==null || response.data.customer.img==""){
                            $('.customer-avatar').attr('src', '{{ asset('img/customer0/avatar.svg') }}');
                        }else{
                            var img = base_url+'img/customer/'+response.data.customer.img;
                            $('.customer-avatar').attr('src', img);
                        }

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
