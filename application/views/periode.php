<?php $this->load->view('template/head') ?>
<?php $this->load->view('template/sidebar') ?>
<?php $this->load->view('template/navbar') ?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tutor1" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
  <i class="ti ti-question-mark"></i>
</button>
<div class="card w-100 bg-success-subtle overflow-hidden" data-aos="zoom-out" data-aos-delay="0">
  <div class="card-body position-relative">
    <div class="row">
      <div class="col-sm-7">
        <div class="d-flex align-items-center justify-content-between mb-0">
          <h5 class="fw-semibold mb-0 fs-5">Periode Kas dan Laporan</h5>
        </div>
        <div class="mb-7">
          Menampilkan seluruh data periode.
          <br>
          Cari, tambahkan, ubah data periode yang aktif dan hapus periode yang telah selesai.
          <br>
          Klik info untuk melihat detail transaksi baik pemasukan maupun pengeluaran.
        </div>
      </div>
      <div class="col-sm-5">
        <div class="welcome-bg-img mb-n7 text-end">
          <img src="<?= base_url() ?>/assets/img/periode.png" alt="modernize-img" class="img-fluid" style="width: 250px; height: auto;">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="input-group mb-3 " data-aos="zoom-out" data-aos-delay="100">
  <span class="input-group-text"><i class="ti ti-calendar"></i></span>
  <input type="text" class="form-control bg-white" placeholder="Cari Periode" id="keyword">
</div>
<div id="dataPeriode"></div>
<!-- Modal -->
<div class="modal fade" id="modalBerhasiledit" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
          <p class="mb-0">Berhasil melakukan edit data periode</p>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Selesai</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal" id="tutor1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Periode</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Klik tambah untuk membuka formulir penambahan periode baru.</p>
        <img src="<?= base_url().'/assets/img/tutor/kliktambahperiode.png' ?>" class="img-fluid">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Periode</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Isikan nama periode dan nominal wajib pada periode tersebut.</p>
        <img src="<?= base_url().'/assets/img/tutor/tambahperiode.png' ?>" class="img-fluid">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Periode</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Klik tombol edit untuk membuka formulir edit untuk periode yan hendak diedit.</p>
        <img src="<?= base_url().'/assets/img/tutor/editperiode.png' ?>" class="img-fluid">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Laporan Pemasukan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Pilih mode pemasukan untuk melihat laporan pemasukan yang tercatat pada periode yang dimaksud.</p>
        <img src="<?= base_url().'/assets/img/tutor/infopemasukan.png' ?>" class="img-fluid">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Laporan Pengeluaran</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Beralih ke mode pengeluaran untuk melihat laporan pengeluaran yang tercatat pada periode yang dimaksud.</p>
        <img src="<?= base_url().'/assets/img/tutor/infopengeluaran.png' ?>" class="img-fluid">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ekspor Excel</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Klik tombol ekspor excel untuk mendownload file.xlsx yang berisi laporan pemasukan dan pengeluaran yang telah tercatat. Namun perlu diperhatikan, <strong>Hanya periode yang sudah selesai</strong> yang bisa mengaktifkan fitur ini.</p>
        <img src="<?= base_url().'/assets/img/tutor/eksporexcel.png' ?>" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tutor5"><i class="ti ti-chevron-left"></i></button>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tutor7"><i class="ti ti-chevron-right"></i></button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal" id="tutor7" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ekspor Excel</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Sesuaikan direktori pada perangkat anda untuk menyimpan file.xlsx yang telah didownload.</p>
        <img src="<?= base_url().'/assets/img/tutor/simpanexcel.png' ?>" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tutor6"><i class="ti ti-chevron-left"></i></button>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tutor8"><i class="ti ti-chevron-right"></i></button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal" id="tutor8" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Periode</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Klik hapus tombol hapus untuk menghapus periode yang dimaksud. Penghapusan ini juga akan menghapus laporan transaksi dan tanggungan yang berkaitan dengan periode ini.</p>
        <img src="<?= base_url().'/assets/img/tutor/klikhapusperiode.png' ?>" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tutor7"><i class="ti ti-chevron-left"></i></button>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tutor9"><i class="ti ti-chevron-right"></i></button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal" id="tutor9" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Periode</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Konfirmasikan penghapusan data periode.</p>
        <img src="<?= base_url().'/assets/img/tutor/hapusperiode.png' ?>" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tutor8"><i class="ti ti-chevron-left"></i></button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="ti ti-check"></i>Selesai</button>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('template/foot') ?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#dataPeriode').load('<?= site_url('ajax/get_periode') ?>');

    //evenet ketika keyword ditulis
    $('#keyword').on('keyup',function(){
      $('#dataPeriode').load('<?= site_url('ajax/live_search_periode?keyword=') ?>' + $('#keyword').val());
    });
  });
</script>
