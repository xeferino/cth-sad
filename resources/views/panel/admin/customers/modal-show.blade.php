<!-- Modal -->
<div class="modal hide fade in" id="modal-customer-show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
            <div class="card card-profile card-secondary">
                <div class="card-header">
                    <div class="profile-picture">
                        <div class="avatar avatar-xl">
                            <img src="" alt="..." class="avatar-img rounded-circle customer-avatar">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="user-profile text-center">
                        <div class="name" id="customer-name"></div>
                        <div class="job" id="customer-document"></div>
                        <div class="desc" id="customer-email"></div>

                        {{-- <div class="social-media">
                            <a class="btn btn-info btn-twitter btn-sm btn-link" href="#">
                                <span class="btn-label just-icon"><i class="flaticon-twitter"></i> </span>
                            </a>
                            <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
                                <span class="btn-label just-icon"><i class="flaticon-google-plus"></i> </span>
                            </a>
                            <a class="btn btn-primary btn-sm btn-link" rel="publisher" href="#">
                                <span class="btn-label just-icon"><i class="flaticon-facebook"></i> </span>
                            </a>
                            <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
                                <span class="btn-label just-icon"><i class="flaticon-dribbble"></i> </span>
                            </a>
                        </div> --}}
                        <div class="view-profile">
                        </div>
                    </div>

                    <div class="card-sub" id="customer-details">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row user-stats text-center">
                        <div class="col">
                            <div class="number" id="customer-number_measurer"></div>
                            <div class="title"><b>Medidor</b></div>
                        </div>
                        <div class="col">
                            <div class="number" id="customer-rate"></div>
                            <div class="title"><b>Tarifa</b></div>
                        </div>
                        <div class="col">
                            <div class="number" id="customer-half"></div>
                            <div class="title"><b>Promedio</b></div>
                        </div>
                        <div class="col">
                            <div class="number" id="customer-code"></div>
                            <div class="title"><b>Codigo</b></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
