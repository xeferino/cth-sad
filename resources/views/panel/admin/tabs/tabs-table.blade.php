  <div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="alert alert-secondary" role="alert">
                            <p class="card-category card-category-title">A continuacion en la siguiente tabla puede buscar a los clientes encuestados del periodo, la encuesta y canton seleccionado <b>{{ $canton->name }}</b></p>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table mt-3 display table table-striped table-hover table-head-bg-secondary table-tabs">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">N° de Medidor</th>
                                <th scope="col">Nombre del Encuestado</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Ruta</th>
                                <th scope="col">Encuestador</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Descargar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1; @endphp
                            @foreach ($clients as $client)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $client['number'] }}</td>
                                <td>{{ $client['fullname'] }}</td>
                                <td>{{ $client['address'] }}</td>
                                <td>{{ $client['route'] }}</td>
                                <td>{{ $client['pollster'] }}</td>
                                <td>
                                    @if ($client['respondent'] == "si")
                                        <button type="button" class="btn btn-xs btn-success">
                                            Encuestado
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-xs btn-danger">
                                            Pendiente
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if ($client['respondent'] == "si")
                                        <a href="{{ route('polls.pdf.customer', ['poll' => $client['poll_id'], 'period' => $client['period_id'], 'customer' => $client['customer_id'], 'pollster' => $client['pollster_id']]) }}" target="_blank" class="btn btn-danger btn-xs">PDF</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var table = $('.table-tabs').DataTable({
        "language": {
                "decimal":        "",
                "emptyTable":     "No hay registros, en el canton seleccionado",
                "info":           "Mostrando _START_ - _END_ de un total _TOTAL_ registros",
                "infoEmpty":      "Mostrando 0 para 0 de 0 registros",
                "infoFiltered":   "(Filtrado para un total de _MAX_ registros)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Mostrar _MENU_ registros",
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
        }
    });
</script>
