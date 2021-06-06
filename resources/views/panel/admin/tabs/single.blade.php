@extends('layouts.app', ['title' => $title ?? 'Tabulaciones Individuales'])

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title"> <i class="fas fa-chart-line"></i> {{$title ?? 'Tabulaciones'}}</h4>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Busqueda de Datos</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="" name="form-tab" id="form-tab">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="alert alert-secondary" role="alert">
                                        <p class="card-category card-category-title">Filtros para la busqueda de tabulaciones.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="ruta"><b>Encuestas <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="La encuesta es requerida"></i></b></label>
                                            <select class="form-control" style="width:100%" id="poll" name="poll" required>
                                                <option value="">.::Seleccione::.</option>
                                               @foreach ($polls as $poll)
                                                    @php
                                                        $length = Str::of($poll->poll)->length();
                                                        $survey = ($length>20) ? Str::substr($poll->poll, 4, 25) : $poll->poll;
                                                    @endphp
                                                        <option value="{{ encrypt($poll->period_id) }}" title="{{ $poll->poll }}" >{{ $survey." (".$poll->period.")" }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="ruta"><b>Cantones <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="La ruta es requerida"></i></b></label>
                                            <select class="form-control" style="width:100%" id="canton" name="canton" required>
                                                {{-- <option value="{{ encrypt(json_encode($all)) }}">.::Todos::.</option> --}}
                                                <option value="">.::Seleccione::.</option>
                                                @foreach ($cantons as $canton)
                                                        <option value="{{ encrypt($canton->id) }}">{{ $canton->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group form-floating-label">
                                        <button type="submit" class="btn btn-sm btn-secondary float-right ml-4" id="btn-form-tab">Consultar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="table-tabs"></div>
    </div>
</div>
@endsection

@section('content-js')
<script>
/*DataTables*/
jQuery(document).ready(function($){
    $('#form-tab').on('submit',function(e) {
        e.preventDefault();
        $('#btn-form-tab').addClass('btn-white is-loading is-loading-md').prop("disabled", true);
        if($('select[name="canton"] option:selected').text()!=".::Todos::."){
            axios.post('{{ route('tabs.history')}}', {
                poll:$('#poll').val(),
                canton:$('#canton').val()
            }).then(response => {
                console.log(response);
                $("#table-tabs").html(response.data).fadeIn();
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
                });
        }
        setTimeout(() => { $('#btn-form-tab').removeClass('btn-white is-loading is-loading-md').prop("disabled", false); }, 800);
    });
});
</script>
@endsection
