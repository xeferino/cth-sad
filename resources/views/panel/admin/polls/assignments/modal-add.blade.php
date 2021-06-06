<!-- Modal -->
<div class="modal hide fade in" data-keyboard="false" data-backdrop="static" id="modal-assignment-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content modal-content-modal">
            <div class="modal-header" style="background: #716aca !important;">
				<h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px !important; color:#fff; fon"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <form method="POST" name="form-assignment-add" id="form-assignment-add" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="alert alert-secondary" role="alert">
                                <p class="card-category card-category-title">Asignar Encuestador</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group form-floating-label">
                                <label for="ruta"><b>Encuestadores <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="El Encuentador es requerido."></i></b></label>
                                <select class="form-control" style="width:100%" id="pollster_id" name="pollster_id">
                                    <option value="">.::Seleccione::.</option>
                                    @foreach ($pollsters->chunk(100) as $pollster)
                                        @foreach ($pollster as $item)
                                            <option value="{{ $item['id'] }}">{{ $item['name']." ".$item['last_name'] }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group form-floating-label">
                                <label for="ruta"><b>Aperturas <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="La Apertura es requerida."></i></b></label>
                                <select class="form-control" style="width:100%" id="period_id" name="period_id">
                                    <option value="">.::Seleccione::.</option>
                                    @foreach ($periods->chunk(100) as $period)
                                        @foreach ($period as $item)
                                            @php
                                                $length = Str::of($item['poll'])->length();
                                                $poll = ($length>20) ? Str::substr($item['poll'], 4, 25) : $item['poll'];
                                            @endphp
                                            <option value="{{ $item['id'] }}" title="{{ $item['poll'] }}">{{ 'Apertura: ('.$item['period'].') Encuesta: '.$poll }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group form-floating-label">
                                <label for="ruta"><b>Cantones <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="El Canton es requerido."></i></b></label>
                                <select class="form-control" style="width:100%" id="canton_id" name="canton_id">
                                    <option value="">.::Seleccione::.</option>
                                    @foreach ($cantons->chunk(100) as $canton)
                                        @foreach ($canton as $item)
                                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group form-floating-label">
                                <label for="ruta"><b>Rutas <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="la ruta es requerida."></i></b></label>
                                <select name="routes[]" id="routes" class="form-control" style="width:100%" style="width:100%" multiple="multiple"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group form-floating-label">
                                <br>
                                <button type="button" class="btn btn-sm btn-danger float-right  ml-4" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-sm btn-secondary float-right" id="btn-assignment-add">Registrar</button>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
