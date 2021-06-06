<!-- Modal -->
<div class="modal hide fade in" style="z-index: 1400;" data-keyboard="false" data-backdrop="static" id="modal-section-question-option-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content modal-content-modal">
			<div class="modal-body">
                <form method="POST" name="form-section-question-option-add" id="form-section-question-option-add" enctype="multipart/form-data">
                    <input type="hidden" name="question_option_id" id="question_option_id">
                    <input type="hidden" name="question_option_item_id" id="question_option_item_id">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="alert alert-secondary" role="alert">
                                <p class="card-category card-category-title">Agregar Pregunta!</p>
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
                                    <input type="text" class="form-control" aria-label="name" name="name" id="name_question_section_option">
                                    <div class="input-group-append">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="El nombre es requerido y debe contener un minimo de 5 caracteres."><i class="fas fa-info-circle btn-secondary btn-dark btn-round"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group form-floating-label">
                                <button type="button" class="btn btn-sm btn-danger float-right  ml-4" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-sm btn-secondary float-right" id="btn-section-question-option-add">Agregar</button>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
