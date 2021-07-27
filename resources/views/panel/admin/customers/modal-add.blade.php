<!-- Modal -->
<div class="modal hide fade in" data-keyboard="false" data-backdrop="static" id="modal-customer-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background: #716aca !important;">
				<h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px !important; color:#fff; fon"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <form method="POST" name="form-customer-add" id="form-customer-add" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="alert alert-secondary" role="alert">
                                <p class="card-category card-category-title">Registro de cliente, en esta ventana modal podras realizar nuevos ingresos de clientes al sistema.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <center>
                                <img src="{{ asset('img/avatar.svg') }}" style= "margin: 5px 0 25px 0;" width="100px" height="100px" alt="avatar" id="avatar" class="rounded-circle">
                            </center>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rut/Run</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="document" name="document" id="document">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El Rut/Run es requerido."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Nombres</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="names" name="names" id="names">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El nombre es requerido y debe contener un minimo de 3 caracteres."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Apellidos</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="surnames" name="surnames" id="surnames">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El apellido es requerido y debe contener un minimo de 3 caracteres."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Direccion</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="address" name="address" id="address">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="La direccion es requerida, debe contener un minimo de 4 caracteres."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Telefono</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="phone" name="phone" id="phone">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El telefono es requerido, debe contener un minimo de 11 caracteres y solo acepta numeros."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Email</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="email" name="email" id="email">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El email es requerido, debe contener un formato (admin@example.com)."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Razon Social</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="social" name="social" id="social">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="La rason social es requerida, debe contener un minimo de 4 caracteres."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Giro</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="turn" name="turn" id="turn">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El giro es requerido, debe contener un minimo de 4 caracteres."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Tipo de Cliente</span>
                                    </div>
                                    <select class="form-control" name="type" id="type">
                                        <option value="">.::Selccione::.</option>
                                        <option value="EMPRESA">EMPRESA</option>
                                        <option value="PARTICULAR">PARTICULAR</option>
                                        <option value="NATURAL">NATURAL</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El tipo de cliente es requerido"><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Comuna</span>
                                    </div>
                                    <select class="form-control" name="commune" id="commune">
                                        <option value="">.::Selccione::.</option>
                                        <option value="GRANEROS">GRANEROS</option>
                                        <option value="RANCAGUA">RANCAGUA</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="la comuna es requerida"><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Ciudad</span>
                                    </div>
                                    <select class="form-control" name="city" id="city">
                                        <option value="">.::Selccione::.</option>
                                        <option value="GRANEROS">GRANEROS</option>
                                        <option value="RANCAGUA">RANCAGUA</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="La ciudad es requerida"><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Region</span>
                                    </div>
                                    <select class="form-control" name="region" id="region">
                                        <option value="">.::Selccione::.</option>
                                        <option value="O'HIGGINS">O'HIGGINS</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="La region es requerida"><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group form-floating-label">
                                <br>
                                <button type="button" class="btn btn-sm btn-danger float-right  ml-4" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-sm btn-primary float-right" id="btn-customer-add">Registrar</button>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
