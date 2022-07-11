<div class="main-container" style="min-height: 100%;">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="title pb-20">
            <h2 class="h3 mb-0">Laporan Pembelian</h2>
        </div>

        <div class="row pb-10">
           <div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form action="<?=base_url('laporan_pemesanan/download_laporan')?>" method="post">
					<div class="row">
						<div class="col-md-6">
							Start Date
							<input type="date" name="start" class="form-control">
						</div>
						<div class="col-md-6">
							End Date
							<input type="date" name="end" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 mt-2">
							<button class="btn btn-primary"><span class="fa fa-download"></span> Download</button>
						</div>
					</div>
					</form>
					
				</div>
			</div>
		   </div>
        </div>
    </div>
</div>


