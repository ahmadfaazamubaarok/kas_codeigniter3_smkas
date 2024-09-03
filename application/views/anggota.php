<?php $this->load->view('template/head') ?>
<?php $this->load->view('template/sidebar') ?>
<?php $this->load->view('template/navbar') ?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#tutor1" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
  <i class="ti ti-question-mark"></i>
</button>
<div class="card w-100 bg-warning-subtle overflow-hidden" data-aos="zoom-out" data-aos-delay="0">
	<div class="card-body position-relative">
	  <div class="row">
	    <div class="col-sm-7" data-aos="zoom-out" data-aos-delay="100">
	      <div class="d-flex align-items-center justify-content-between mb-0">
	        <h5 class="fw-semibold mb-0 fs-5">Data Anggota</h5>
	      </div>
	      <div class="mb-7">
	      	Menampilkan seluruh data anggota.
	      	<br>
	      	Cari, tambahkan, ubah, dan hapus anggota.
	      </div>
	    </div>
	    <div class="col-sm-5" data-aos="zoom-out" data-aos-delay="200">
	      <div class="welcome-bg-img mb-n7 text-end">
	        <img src="<?= base_url() ?>/assets/img/anggota.png" alt="modernize-img" class="img-fluid" style="width: 250px; height: auto;">
	      </div>
	    </div>
	  </div>
	</div>
</div>
<div class="input-group mb-3 " data-aos="zoom-out" data-aos-delay="100">
  <span class="input-group-text"><i class="ti ti-user-search"></i></span>
  <input type="text" class="form-control bg-white" placeholder="Cari Anggota" id="keyword">
</div>
<div id="dataAnggota"></div>
<!-- Modal -->
<div class="modal" id="tutor1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Anggota</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Klik tombol tambah untuk membuka formulir penambahan anggota.</p>
        <img src="<?= base_url().'/assets/img/tutor/kliktambahanggota.png' ?>" class="img-fluid">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Anggota</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Isikan nama anggota pada kolom yang telah disediakan kemudian klik tambahkan.</p>
        <img src="<?= base_url().'/assets/img/tutor/tambahanggota.png' ?>" class="img-fluid">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Anggota</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Klik tombol edit untuk membuka formulir edit anggota yang hendak diedit.</p>
        <img src="<?= base_url().'/assets/img/tutor/editanggota.png' ?>" class="img-fluid">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Info Anggota</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Klik tombol info untuk meninjau tanggungan yang dimiliki oleh pengguna, dari sini dapat untuk melakukan pelunasan hutang yang telah terlewat pada periode sebelumnya.</p>
        <img src="<?= base_url().'/assets/img/tutor/infoanggota.png' ?>" class="img-fluid">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Anggota</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Klik tombol hapus untuk melakukan penghapusan anggota.</p>
        <img src="<?= base_url().'/assets/img/tutor/klikhapusanggota.png' ?>" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tutor4"><i class="ti ti-chevron-left"></i></button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tutor6"><i class="ti ti-chevron-right"></i></button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal" id="tutor6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Anggota</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Konfirmasikan penghapusan anggota.
        <img src="<?= base_url().'/assets/img/tutor/hapusanggota.png' ?>" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tutor5"><i class="ti ti-chevron-left"></i></button>
        <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#tutor7"><i class="ti ti-check"></i>Selesai</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal" id="tutor6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Info Tanggungan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="<?= base_url().'/assets/img/tutor/infoanggota.png' ?>" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tutor6"><i class="ti ti-chevron-left"></i></button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="ti ti-check"></i>Selesai</button>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('template/foot') ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#dataAnggota').load('<?= site_url('ajax/get_anggota') ?>');

    //evenet ketika keyword ditulis
    $('#keyword').on('keyup',function(){
      $('#dataAnggota').load('<?= site_url('ajax/live_search_anggota?keyword=') ?>' + $('#keyword').val());
    });
	})
</script>