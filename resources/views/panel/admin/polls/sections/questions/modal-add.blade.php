<!-- Modal -->
<div class="modal hide fade in" style="z-index: 1400;" data-keyboard="false" data-backdrop="static" id="modal-section-question-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content modal-content-modal">
			<div class="modal-body">
                <form method="POST" name="form-section-add" id="form-section-question-add" enctype="multipart/form-data">
                    <input type="hidden" name="section_poll_id" id="section_poll_id">
                    <input type="hidden" name="section_id" id="option_secion_id">

                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="alert alert-secondary" role="alert">
                                <p class="card-category card-category-title section-question-title"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Nombre</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="name" name="name" id="name_sect_poll_question_e">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El nombre es requerido y debe contener un minimo de 5 caracteres."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Descripcion</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="description" name="description" id="description_sect_poll_question_e">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="La descripcion es requerida y debe contener un minimo de 10 caracteres."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-check">
                                <label><b>Tipo de Pregunta</b></label><br/>
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="type" id="type" value="close" checked>
                                    <span class="form-radio-sign">Cerrada</span>
                                    <input class="form-radio-input" type="radio" name="type" id="type" value="open" >
                                    <span class="form-radio-sign">Abierta</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="open_option_question" style="display: none;">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                 <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Opcion</span>
                                        </div>
                                        <input type="text" class="form-control" name="name_options[]" value="" id="name_options">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                    <a href="javascript:void(0);" title="Agregar" class="add_button btn btn-success btn-xs">
                                                        <i class="fas fa-plus"></i>
                                                    </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="open_option_question"></div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group form-floating-label">
                                <button type="button" class="btn btn-sm btn-danger float-right  ml-4" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-sm btn-secondary float-right" id="btn-section-question-add">Registrar</button>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
