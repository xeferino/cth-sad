<!-- Modal -->
<div class="modal hide fade in" data-keyboard="false" data-backdrop="static" id="modal-user-profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background: #716aca !important;">
				<h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px !important; color:#fff; fon"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <input type="hidden" name="id_user" id="id_user">
                <form method="POST" name="form-user-edit-profile" id="form-user-edit-profile" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="alert alert-secondary" role="alert">
                                <p class="card-category card-category-title">Perfil de usuario, en esta ventana modal podras actualizar los datos de acceso al sistema.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <center>
                                <img src="" style= "margin: 0px 0 5px 0;" width="100px" height="100px" alt="avatar" id="profile_img" class="rounded-circle avatar-img-profile">
                                <br>
                                <input id="status_profile" type="checkbox" data-toggle="toggle">
                               <br><br>
                            </center>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Nombre</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="name" name="name" id="name_profile">
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
                                    <input type="text" class="form-control" aria-label="last_name" name="last_name" id="last_name_profile">
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
                                        <span class="input-group-text">Email</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="email" name="email" id="email_profile">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El email es requerido, debe contener un formato (admin@example.com) y debe ser unicio por cada usuario."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group form-floating-label">
                                <label for="exampleFormControlFile1"><b>Avatar <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="El formato de imagen debe ser (jpeg, png o svg). El peso maximo de la imagen es de 1014 KB"></i></b></label>
                                <input type="file" name="img" id="img_profile" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Clave</span>
                                    </div>
                                    <input type="password" class="form-control" aria-label="password" name="password" id="password_profile">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="la clave debe contener un minimo de 8 y maximo de 16 caracteres."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Confirmar Clave</span>
                                    </div>
                                    <input type="password" class="form-control" aria-label="cpassword" name="cpassword" id="cpassword_profile">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="Confirmar clave debe contener un minimo de 8 y maximo de 16 caracteres ademas de coincidir con la clave ingresada."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group form-floating-label">
                                <br>
                                <button type="button" class="btn btn-sm btn-danger float-right  ml-4" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-sm btn-primary float-right" id="btn-user-profile">Editar</button>
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
