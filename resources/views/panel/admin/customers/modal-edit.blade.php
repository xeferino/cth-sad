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
                <input type="hidden" name="id_customer" id="id_customer">
                <form method="POST" name="form-customer-edit" id="form-customer-edit" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="alert alert-secondary" role="alert">
                                <p class="card-category card-category-title">Edici&oacute;n de cliente, en esta ventana modal podras actualizar los datos acceso del cliente al sistema.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <center>
                                <img src="" style= "margin: 0px 0 5px 0;" width="100px" height="100px" alt="avatar" id="avatar_e" class="rounded-circle">
                                <br>
                                <input id="status" type="checkbox" data-toggle="toggle">
                               <br><br>
                            </center>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Nombre</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="name" name="name" id="name_e">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El nombre es requerido y debe contener un minimo de 3 caracteres."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Apellido</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="last_name" name="last_name" id="last_name_e">
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
                                        <span class="input-group-text">Documento</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="document" name="document" id="document_e">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El documento es requerido."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Email</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="email" name="email" id="email_e">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El email es requerido, debe contener un formato (admin@example.com)."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
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
                                    <input type="text" class="form-control" aria-label="address" name="address" id="address_e">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="La direccion no es requerida, debe contener un minimo de 4 caracteres."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Ciudad</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="city" name="city" id="city_e">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="La ciudad no es requerida, debe contener un minimo de 4 caracteres."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
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
                                        <span class="input-group-text">Provincia</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="province" name="province" id="province_e">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="La provincia no es requerida, debe contener un minimo de 4 caracteres."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
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
                                    <input type="text" class="form-control" aria-label="phone" name="phone" id="phone_e">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El telefono no es requerido, debe contener un minimo de 11 caracteres y solo acepta numeros."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
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
                                        <span class="input-group-text">Celular</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="mobile" name="mobile" id="mobile_e">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El celular no es requerido, debe contener un minimo de 11 caracteres y solo acepta numeros."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">N° de Medidor</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="number_measurer" name="number_measurer" id="number_measurer_e">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El numero de medidor no es requerido, debe contener un minimo de 4 caracteres y debe ser numerico."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
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
                                        <span class="input-group-text">Tarifa</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="rate" name="rate" id="rate_e">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="La tarifa no es requerida, debe contener un minimo de 11 caracteres."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Promedio de Consumo</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="half" name="half" id="half_e">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El promedio de consumo no es requerido, debe contener un minimo de 4 caracteres."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
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
                                        <span class="input-group-text">Codigo</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="code" name="code" id="code_e">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El codigo no es requerido, debe contener un minimo de 4 caracteres."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group form-floating-label">
                                <label><b>Rutas <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="La ruta es requerida"></i></b></label><br/>
                                <select class="form-control" {{-- class="select2" style="width:100%" --}} id="route_e" name="route"></select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-check">
                                <label><b>Sexo del Cliente <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="El sexo es requerido"></i></b></label><br/>
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="gender_e" id="gender_m" value="M">
                                    <span class="form-radio-sign">Masculino</span>
                                    <input class="form-radio-input" type="radio" name="gender_e" id="gender_f" value="F">
                                    <span class="form-radio-sign">Femeninno</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group form-floating-label">
                                <label><b>Observaciones <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="La observacion no es requerida, debe contener un minimo de 10 caracteres."></i></b></label><br/>
                                <textarea class="form-control" style="width: 100%" aria-label="Observacion" name="observation" id="observation_e" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group form-floating-label">
                                <label for="exampleFormControlFile1"><b>Avatar <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="El formato de imagen debe ser (jpeg, png o svg). El peso maximo de la imagen es de 1014 KB"></i></b></label>
                                <input type="file" name="img" id="img_e" class="form-control-file" id="exampleFormControlFile1">
                            </div>
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
			{{-- <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div> --}}
		</div>
	</div>
</div>