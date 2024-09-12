<?php $this->load->view('template/head') ?>
<?php $this->load->view('template/sidebar') ?>
<?php $this->load->view('template/navbar') ?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tutor1" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
  <i class="ti ti-question-mark"></i>
</button>
<div class="card w-100 bg-primary-subtle overflow-hidden" data-aos="zoom-out" data-aos-delay="0">
	<div class="card-body position-relative">
	  <div class="row">
	    <div class="col-sm-7">
	      <div class="d-flex align-items-center justify-content-between mb-0">
	        <h5 class="fw-semibold mb-0 fs-5">Transaksi</h5>
	      </div>
	      <div class="mb-7" data-aos="zoom-out" data-aos-delay="50">
	      	Transaksi kas masuk, pilih anggota kemudian konfirmasi pembayaran.
	      	<br>
	      	Pilih mode untuk memilih transaksi yang akan dilakukan, baik kas masuk atau penarikan saldo.
	      </div>
	    </div>
	    <div class="col-sm-5">
	      <div class="welcome-bg-img mb-n7 text-end" data-aos="zoom-out" data-aos-delay="100">
	        <img src="<?= base_url() ?>/assets/img/transaksi.png" alt="modernize-img" class="img-fluid" style="width: 250px; height: auto;">
	      </div>
	    </div>
	  </div>
	</div>
</div>
<div class="card" data-aos="zoom-out" data-aos-delay="100">
	<div class="card-body">
		<div class="d-flex justify-content-between">
			<div data-aos="zoom-out" data-aos-delay="100">
        <h4 class="card-title fw-semibold">Transaksi <?php if ($this->session->userdata('periode')){echo $this->session->userdata('periode')->periode;} ?></h4>
      </div>
			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" data-aos="zoom-out" data-aos-delay="200">
			  <li class="nav-item" role="presentation">
			    <button class="nav-link <?php if (!$this->session->flashdata('open_pengeluaran')){echo "active";} ?>" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pemasukan" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="ti ti-arrow-down"></i> Kas Masuk</button>
			  </li>
			  <li class="nav-item" role="presentation">
			    <button class="nav-link <?php if ($this->session->flashdata('open_pengeluaran')){echo "active";} ?>" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pengeluaran" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="ti ti-arrow-up"></i> Kas Keluar</button>
			  </li>
			  <li class="nav-item" role="presentation">
			    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#tabungan" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="ti ti-database"></i> Tabungan</button>
			  </li>
			</ul>
		</div>
		<div class="tab-content" id="pills-tabContent" data-aos="zoom-out" data-aos-delay="300">
		  <div class="tab-pane fade <?php if (!$this->session->flashdata('open_pengeluaran')){echo "show active";} ?>" id="pemasukan" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
				<div id="selectPembayar"></div>
				<div class="alert alert-success alert-dismissible fade show" role="alert" id="alertBerhasilTransaksi" style="display:none;">
					Berhasil melakukan transaksi!
				</div>
				<div class="row" id="infoAnggota" style="display: none;">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-6">
									<span>Nama: <h4 id="namaAnggota"></h4></span>
								</div>
								<div class="col-lg-2">
									<span>Periode: <h5 id="periode"></h5></span>
								</div>
								<div class="col-lg-2">
									<span>Nominal Wajib: <h4 id="nominal"></h4></span>
								</div>
								<div class="col-lg-2 text-end">
									<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalCekBayar"><i class="ti ti-cash"></i> Bayar</button>
								</div>
							</div>
						</div>
					</div>
				</div>
		  </div>
		  <div class="tab-pane fade <?php if ($this->session->flashdata('open_pengeluaran')){echo "show active";} ?>" id="pengeluaran" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
				<div class="alert alert-warning fade show mt-3 w-100" role="alert">
					<div class="d-flex justify-content-between">
						<h4>Peringatan!</h4>
						<div>
							<span>Total saldo:</span>
							<h4 id="totalSaldo"></h4>
						</div>
					</div>
					<p class="mb-0">Transaksi Penarikan hanya <strong>Bendahara</strong> yang dapat mengaksesnya.</p>
					<p>Untuk keamanan hak akses, dimohon untuk mengisi kolom password terlebih dahulu untuk melanjutkan proses penarikan saldo kas.</p>
					<div class="d-flex justify-content-end" data-aos="zoom-out" data-aos-delay="300">
						<?php if ($this->session->userdata('periode')):?>
						<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalPenarikan">Lanjutkan Penarikan</button>
						<?php else: ?>
						<span class="text-danger">Tidak bisa menarik, belum ada periode aktif</span>
						<?php endif ?>
					</div>
				</div>
		  </div>
		  <div class="tab-pane fade" id="tabungan" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
				<div id="pilihNasabah"></div>
				<div class="card" id="infoNasabah" style="display:none;">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-8">
									<span>Nama: <h4 id="namaNasabah">Ahmad Faaza Mubaarok</h4></span>
								</div>
								<div class="col-lg-4">
									<div class="d-flex justify-content-between align-items-center">
										<span style="margin-right: 20px;">Saldo: <h4 id="saldoNasabah"></h4></span>
										<div>
											<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalTabunganMasuk"><i class="ti ti-arrow-down"></i> Masuk</button>
											<button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalTabunganKeluar"><i class="ti ti-arrow-up"></i> Keluar</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
		  </div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalPenarikan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Penarikan Saldo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div class="d-flex justify-content-between mb-3">
	      	<span>Total Saldo:</span>
	      	<h4 id="modalTotalSaldo"></h4>
      	</div>
        <form id="formPenarikan">
        	<div class="input-group mb-3">
						<span class="input-group-text"><i class="ti ti-key"></i></span>
						<div class="form-floating">
							<input type="password" name="password" class="form-control" placeholder="Password" required>
							<label for="floatingInputGroup1">Password</label>
						</div>
					</div>
					<div class="input-group">
						<span class="input-group-text">Rp</span>
						<div class="form-floating">
							<input type="number" name="nominalTarik" class="form-control" placeholder="1000" required>
							<label for="floatingInputGroup1">Nominal yang ditarik</label>
						</div>
					</div>
			<textarea class="form-control mt-3" name="keperluan" placeholder="Keperluan"></textarea>
			<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" id="alertInputSalah" style="display:none;">
				Kesalahan input, cek password, nominal, atau keperluan!
			</div>
			<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" id="alertInputBelumTerisi" style="display:none;">
				Harap isikan semua kolom terlebih dahulu!
			</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="prosesPenarikan">Simpan Transaksi</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalBerhasilPenarikan" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div class="row text-center mb-3">
	      	<i class="ti ti-circle-check" style="font-size: 10em;"></i>
      	</div>
      	<div class="row text-center">
	      	<p class="mb-0">Berhasil melakukan penarikan saldo sebesar Rp<strong id="nominalTarik"></strong>!</p>
			<p class="mb-0">Saldo tersisa: Rp<strong id="saldoBaru"></strong></p>
      	</div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
		    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Selesai</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalBerhasilTransaksi" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div class="row text-center mb-3">
	      	<i class="ti ti-circle-check" style="font-size: 10em;"></i>
      	</div>
      	<div class="row text-center">
	      	<span class="h4">Berhasil melakukan transaksi.</span>
      	</div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
		    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Selesai</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade modalBayar" id="modalCekBayar" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      	<h4>Pembayaran Kas</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-lg-6">
      			<span>Tanggungan Kas :</span>
      			<h5 id="bayarAnggota"></h5>
      		</div>
      		<div class="col-lg-6">
      			<span>Periode :</span>
      			<h5 id="bayarPeriode"></h5>
      		</div>
      	</div>      	
      	<div class="bg-danger rounded d-flex justify-content-between p-3 text-white">
      		<span>Nominal :</span>
      		<h3 class="text-white" id="bayarNominal"></h3>
      	</div>
      </div>
      <div class="modal-footer d-flex justify-content-between">
      		<span>Tabungan : <strong id="infoSaldoViaTabungan"></strong></span>
	      	<form id="formBayar" method="POST">
	      		<input type="hidden" name="id_periode" id="inputHiddenIdPeriode">
	      		<input type="hidden" name="id_anggota" id="inputHiddenIdAnggota">
	      		<input type="hidden" name="nominal" id="inputHiddenNominal">
	      		<input type="hidden" name="saldo" id="inputHiddenSaldo">
	      		<div class="d-flex justify-content-end align-items-center">
	      		</div>
	      	</form>
	      	<div>
	      		<button type="button" class="btn btn-success bayarTanggungan text-center" id="simpanTransaksiViaTabungan"><i class="ti ti-database"></i>Via Tabungan</button>
				    <button type="button" class="btn btn-primary bayarTanggungan text-center" id="simpanTransaksi"><i class="ti ti-cash"></i>Bayar Tunai</button>
	      	</div>
      	</div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal" id="tutor1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Pembayar</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<p>Pilih anggota yang hendak membayar kas dengan klik kolom select dan klik nama anggota, atau bisa langsung ketikkan nama anggota yang hendak membayar lalu klik tombol cari.</p>
        <img src="<?= base_url().'/assets/img/tutor/pilihpembayar.png' ?>" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tutor2"><i class="ti ti-chevron-right"></i></button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal" id="tutor2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<p>Menampilkan data pembayar, periode, dan nominal wajib pada periode ini. Klik bayar untuk melanjutkan proses pembayaran.</p>
        <img src="<?= base_url().'/assets/img/tutor/pembayaran.png' ?>" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tutor1"><i class="ti ti-chevron-left"></i></button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tutor3"><i class="ti ti-chevron-right"></i></button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal" id="tutor3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Pembayaran</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<p>Pastikan uang yang diberikan oleh pembayar sudah sesuai dengan nominal wajib yang telah ditentukan pada periode ini sebelum menyelesaikan proses pembayaran.</p>
        <img src="<?= base_url().'/assets/img/tutor/konfirmasipembayaran.png' ?>" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tutor2"><i class="ti ti-chevron-left"></i></button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tutor4"><i class="ti ti-chevron-right"></i></button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal" id="tutor4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Penarikan Saldo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	Beralih ke mode transaksi pengeluaran untuk melakukan penarikan saldo kas. Klik lajutkan penarikan untuk membuka formulir penarikan saldo.
        <img src="<?= base_url().'/assets/img/tutor/klikpenarikansaldo.png' ?>" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tutor3"><i class="ti ti-chevron-left"></i></button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tutor5"><i class="ti ti-chevron-right"></i></button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal" id="tutor5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Penarikan Saldo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<p>Isikan password bendahara, nominal yang ditarik, dan keperluan untuk melanjutkan proses penarikan saldo.</p>
        <img src="<?= base_url().'/assets/img/tutor/penarikansaldo.png' ?>" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tutor4"><i class="ti ti-chevron-left"></i></button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="ti ti-check"></i>Selesai</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalTabunganMasuk" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      	<h4>Isi saldo tabungan</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<span>Saldo: <h4 id="saldoNasabahModalMasuk"></h4></span>
      	<form id="formTabunganMasuk">
      		<div class="input-group mb-3">
						<span class="input-group-text"><i class="ti ti-arrow-down"></i></span>
						<div class="form-floating">
							<input type="hidden" name="id_nasabah" id="inputHiddenIdNasabahMasuk">
              <input type="number" class="form-control" id="floatingNominalTabunganMasuk" name="nominal_masuk" placeholder="Nominal yang dimasukkan">
              <label for="floatingNominalTabunganMasuk">Nominal yang dimasukkan</label>
            </div>
					</div>
      	</form>
      </div>
      <div class="modal-footer">
		    <button type="button" class="btn btn-primary" id="prosesTabunganMasuk"><i class="ti ti-arrow-down"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalTabunganKeluar" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      	<h4>Tarik saldo tabungan</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<span>Saldo: <h4 id="saldoNasabahModalKeluar"></h4></span>
      	<form id="formTabunganKeluar">
      		<div class="input-group mb-3">
						<span class="input-group-text"><i class="ti ti-arrow-up"></i></span>
						<div class="form-floating">
							<input type="hidden" name="id_nasabah" id="inputHiddenIdNasabahKeluar">
              <input type="text" class="form-control" id="floatingTarikSaldoTabungan" placeholder="Nominal yang ditarik" name="nominal_keluar">
              <label for="floatingTarikSaldoTabungan">Nominal yang ditarik</label>
            </div>
					</div>
      	</form>
      </div>
      <div class="modal-footer">
		    <button type="button" class="btn btn-primary" id="prosesTabunganKeluar"><i class="ti ti-arrow-up"></i>Tarik</button>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('template/foot') ?>
<script type="text/javascript">
	$(document).ready(function(){
		// Tampilkan mode default
		$('#selectPembayar').load('<?= site_url('ajax/get_pembayar') ?>');
		$('#pilihNasabah').load('<?= site_url('ajax/pilih_nasabah') ?>');
		$('#totalSaldo').load('<?= site_url('ajax/get_saldo') ?>');
		$('#modalTotalSaldo').load('<?= site_url('ajax/get_saldo') ?>');

		$('#simpanTransaksi').click(function(event){
			event.preventDefault();//cegah form submit default
			var id_anggota = $('input[name="id_anggota"]').val();
		    var id_periode = $('input[name="id_periode"]').val();
		    var nominal = $('input[name="nominal"]').val();

			$.ajax({
				url:'<?= site_url('ajax/simpan_pemasukan') ?>',
				type:'POST',
				dataType:'json',
				data:{
					id_anggota:id_anggota,
					id_periode:id_periode,
					nominal:nominal
				}
			})
			.done(function(respon){
				$('#totalSaldo').load('<?= site_url('ajax/get_saldo') ?>');
				$('#modalTotalSaldo').load('<?= site_url('ajax/get_saldo') ?>');
				$('#infoAnggota').hide();
				$('#modalCekBayar').modal('hide');
		    $('#modalBerhasilTransaksi').modal('show');
		    $('#pilihIdAnggota').val('');
				$('#selectPembayar').load('<?= site_url('ajax/get_pembayar') ?>');
			})
			.fail(function(respon){
				alert('gagal');
			});
		});

		$('#simpanTransaksiViaTabungan').click(function(event){
			event.preventDefault();//cegah form submit default
				var id_anggota = $('input[name="id_anggota"]').val();
		    var id_periode = $('input[name="id_periode"]').val();
		    var nominal = $('input[name="nominal"]').val();
		    var saldo = $('input[name="saldo"]').val();

			$.ajax({
				url:'<?= site_url('ajax/simpan_pemasukan_via_tabungan') ?>',
				type:'POST',
				dataType:'json',
				data:{
					id_anggota:id_anggota,
					id_periode:id_periode,
					nominal:nominal,
					saldo:saldo
				}
			})
			.done(function(respon){
				if(respon.success === false) {
		        alert('Saldo tidak mencukupi untuk penarikan');
		    } else {
					$('#totalSaldo').load('<?= site_url('ajax/get_saldo') ?>');
					$('#modalTotalSaldo').load('<?= site_url('ajax/get_saldo') ?>');
					$('#infoAnggota').hide();
					$('#modalCekBayar').modal('hide');
			    $('#modalBerhasilTransaksi').modal('show');
			    $('#pilihIdAnggota').val('');
					$('#selectPembayar').load('<?= site_url('ajax/get_pembayar') ?>');
		    }
			})
			.fail(function(respon){
				alert('gagal');
			});
		});

		$('#prosesPenarikan').click(function(event){
		    event.preventDefault();

		    var password = $('input[name="password"]').val();
		    var nominal = $('input[name="nominalTarik"]').val();
		    var keperluan = $('textarea[name="keperluan"]').val();

		    if (!password || !nominal || nominal <= 0 || !keperluan) {
		        $('#alertInputBelumTerisi').show();
		        return; // Hentikan proses jika input tidak valid
		    }

		    $.ajax({
		        url: '<?= site_url('ajax/simpan_penarikan') ?>',
		        type: 'POST',
		        dataType: 'json',
		        data: {
		            password: password,
		            nominal: nominal,
		            keperluan: keperluan
		        }
		    })
		    .done(function(respon) {
		        $('#modalPenarikan').modal('hide');
		        $('#totalSaldo').load('<?= site_url('ajax/get_saldo') ?>');
		        $('#modalTotalSaldo').load('<?= site_url('ajax/get_saldo') ?>');

		        if (respon.hasil) {
		            // Update elemen dengan data dari server
		            $('#nominalTarik').text(respon.nominal);
		            $('#saldoBaru').text(respon.saldo);
		            $('#modalBerhasilPenarikan').modal('show');
		        } else {
		            alert('gagal'); // Tampilkan pesan kesalahan jika ada
		            $('#alertInputBelumTerisi').hide();
		            $('#alertPasswordSalah').hide();
		        }
		    })
		    .fail(function(jqXHR, textStatus, errorThrown) {
		    	alert('gagalllll');
		        $('#alertInputBelumTerisi').hide();
		        $('#alertInputSalah').show();
		    });
		});

		$('#prosesTabunganMasuk').click(function(event){
		    event.preventDefault();

		    var id_anggota = $('input[name="id_nasabah"]').val(); // Ambil id nasabah dengan benar
		    var nominal = $('input[name="nominal_masuk"]').val(); // Ambil nominal dengan benar

		    $.ajax({
		        url: '<?= site_url('ajax/tabungan_masuk') ?>',
		        type: 'POST',
		        dataType: 'json',
		        data: {
		            id_anggota: id_anggota,
		            nominal: nominal
		        }
		    })
		    .done(function(respon){
		        $('#modalTabunganMasuk').modal('hide');
		        $('#modalBerhasilTransaksi').modal('show');
		        $('#infoNasabah').hide();
		    })
		    .fail(function(respon){
		        alert('Gagal melakukan pengisian saldo');
		    });
		});

		$('#formTabunganMasuk').submit(function(event){
		    event.preventDefault();

		    var id_anggota = $('input[name="id_nasabah"]').val(); // Ambil id nasabah dengan benar
		    var nominal = $('input[name="nominal_masuk"]').val(); // Ambil nominal dengan benar

		    $.ajax({
		        url: '<?= site_url('ajax/tabungan_masuk') ?>',
		        type: 'POST',
		        dataType: 'json',
		        data: {
		            id_anggota: id_anggota,
		            nominal: nominal
		        }
		    })
		    .done(function(respon){
		        $('#modalTabunganMasuk').modal('hide');
		        $('#modalBerhasilTransaksi').modal('show');
		        $('#infoNasabah').hide();
		    })
		    .fail(function(respon){
		        alert('Gagal melakukan pengisian saldo');
		    });
		});

		$('#prosesTabunganKeluar').click(function(event){
		    event.preventDefault();

		    var id_anggota = $('input[name="id_nasabah"]').val(); // Ambil id nasabah dengan benar
		    var nominal = $('input[name="nominal_keluar"]').val(); // Ambil nominal dengan benar

		    $.ajax({
		        url: '<?= site_url('ajax/tabungan_keluar') ?>',
		        type: 'POST',
		        dataType: 'json',
		        data: {
		            id_anggota: id_anggota,
		            nominal: nominal
		        }
		    })
		    .done(function(respon){
		        if(respon.success === false) {
				        alert('Saldo tidak mencukupi untuk penarikan');
				    } else {
				        $('#modalTabunganKeluar').modal('hide');
				        $('#modalBerhasilTransaksi').modal('show');
				        $('#infoNasabah').hide();
				    }
		    })
		    .fail(function(respon){
		        alert('Gagal melakukan penarikan saldo');
		    });
		});
	});
</script>