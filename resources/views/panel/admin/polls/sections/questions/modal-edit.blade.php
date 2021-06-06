<!-- Modal -->
<div class="modal hide fade in" style="z-index: 1400;" data-keyboard="false" data-backdrop="static" id="modal-section-question-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content modal-content-modal">
			<div class="modal-body">
                <form method="POST" name="form-section-question-edit" id="form-section-question-edit" enctype="multipart/form-data">
                    <input type="hidden" name="section_poll_id" id="section_poll_id">
                    <input type="hidden" name="section_question_id" id="section_question_id">
                    <input type="hidden" name="section_question_option_id" id="section_question_option_id">
                    <input type="hidden" name="section_question_option_item_id" id="section_question_option_item_id">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="alert alert-secondary" role="alert">
                                <p class="card-category card-category-title">Editar segmento de pregunta de encuesta!</p>
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
                                    <input type="text" class="form-control" aria-label="name" name="name" id="name_question_section">
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
                                    <input type="text" class="form-control" aria-label="description" name="description" id="description_question_section">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="La descripcion es requerida y debe contener un minimo de 10 caracteres."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group form-floating-label">
                                <button type="button" class="btn btn-sm btn-danger float-right  ml-4" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-sm btn-secondary float-right" id="btn-section-question-edit">Editar</button>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
