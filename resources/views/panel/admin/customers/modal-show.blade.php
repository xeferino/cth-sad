<!-- Modal -->
<style>
    .card-profile .card-header {
        height: 50px !important;
        color: #fff !important;
        font-weight: 800 !important;
    }
</style>
<div class="modal hide fade in" id="modal-customer-show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
            <div class="card card-profile card-default">
                <div class="card-header">
                    <h2>Detalles del cliente</h2>
                </div>
                <div class="card-body">
                    <div class="user-profile text-center">
                        <div class="name" id="customer-name"></div>
                        <div class="job" id="customer-document"></div>
                        <div class="desc" id="customer-email"></div>
                        <div class="view-profile">
                        </div>
                    </div>

                    <div class="card-sub" id="customer-details">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row user-stats text-center">
                        <div class="col">
                            <div class="number" id="customer_social"></div>
                            <div class="title"><b>Razon social</b></div>
                        </div>
                        <div class="col">
                            <div class="number" id="customer_turn"></div>
                            <div class="title"><b>Giro</b></div>
                        </div>
                        <div class="col">
                            <div class="number" id="customer_type"></div>
                            <div class="title"><b>Tipo</b></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
