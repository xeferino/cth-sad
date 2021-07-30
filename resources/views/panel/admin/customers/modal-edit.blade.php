<!-- Modal -->
<div class="modal hide fade in" data-keyboard="false" data-backdrop="static" id="modal-customer-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background: #716aca !important;">
				<h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px !important; color:#fff; fon"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <form method="POST" name="form-customer-edit" id="form-customer-edit">
                    {{-- @method('PUT') --}}
                    <input type="hidden" name="idcliente" id="id_customer">
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
                                    <input type="text" class="form-control" aria-label="document_e" name="document_e" id="document_e">
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
                                    <input type="text" class="form-control" aria-label="names_e" name="names_e" id="names_e">
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
                                    <input type="text" class="form-control" aria-label="surnames_e" name="surnames_e" id="surnames_e">
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
                                    <input type="text" class="form-control" aria-label="address_e" name="address_e" id="address_e">
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
                                    <input type="text" class="form-control" aria-label="phone_e" name="phone_e" id="phone_e">
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
                                    <input type="text" class="form-control" aria-label="email_e" name="email_e" id="email_e">
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
                                    <input type="text" class="form-control" aria-label="social_e" name="social_e" id="social_e">
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
                                    <input type="text" class="form-control" aria-label="turn_e" name="turn_e" id="turn_e">
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
                                    <select class="form-control" name="type_e" id="type_e">
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
                                    <select class="form-control" name="commune_e" id="commune_e">
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
                                    <select class="form-control" name="city_e" id="city_e">
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
                                    <select class="form-control" name="region_e" id="region_e">
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
                                <button type="submit" class="btn btn-sm btn-primary float-right" id="btn-customer-edit">Editar</button>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
