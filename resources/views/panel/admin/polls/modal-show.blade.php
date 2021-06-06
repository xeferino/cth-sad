<!-- Modal -->
<div class="modal hide fade in" data-keyboard="false" data-backdrop="static" id="modal-poll-section-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background: #716aca !important;">
				<h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px !important; color:#fff; fon"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body scroll-poll">
                <input type="hidden" name="id_poll" id="select_poll">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="alert alert-primary" role="alert">
                                <p class="card-category card-category-title poll-title"></p>
                            </div>
                        </div>
                    </div>
                    <div id="sections_polls" class=""></div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group form-floating-label">
                                <button type="button" class="btn btn-sm btn-danger float-right  ml-4" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-sm btn-primary float-right" id="btn-poll-section-add">Agregar Seccion</button>
                            </div>
                        </div>
                    </div>
			</div>
		</div>
	</div>
</div>
