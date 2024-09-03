<?php $this->load->view('template/head') ?>
<?php $this->load->view('template/sidebar') ?>
<?php $this->load->view('template/navbar') ?>
<div class="row">
	<div class="col-lg-2 col-md-4 col-sm-6 col-6">
		<a href="<?= site_url('page') ?>">
			<div class="alert alert-primary border-0 d-flex justify-content-center align-items-center flex-column" data-aos="flip-left" data-aos-delay="0">
				<img src="<?= base_url().'/assets/icon/saldo.png' ?>" style="width:80px;">
				<span class="fs-6 mt-3 fw-bolder">Rp <?= $total_saldo->nominal ?></span>
				<span>Total Saldo</span>
			</div>
		</a>
	</div>
	<div class="col-lg-2 col-md-4 col-sm-6 col-6">
		<a href="<?= site_url('page/periode') ?>">
			<div class="alert alert-success border-0 d-flex justify-content-center align-items-center flex-column" data-aos="flip-left" data-aos-delay="100">
				<img src="<?= base_url().'/assets/icon/periode.png' ?>" style="width:80px;">
				<span class="fs-6 mt-3 fw-bolder"><?= $total_periode ?></span>
				<span>Total Periode</span>
			</div>
		</a>
	</div>
	<div class="col-lg-2 col-md-4 col-sm-6 col-6">
		<a href="<?= site_url('page/transaksi') ?>">
			<div class="alert alert-info border-0 d-flex justify-content-center align-items-center flex-column" data-aos="flip-left" data-aos-delay="200">
				<img src="<?= base_url().'/assets/icon/pemasukan.png' ?>" style="width:80px;">
				<span class="fs-6 mt-3 fw-bolder">Rp <?= $total_pemasukan ?></span>
				<span>Total Pemasukan</span>
			</div>
		</a>
	</div>
	<div class="col-lg-2 col-md-4 col-sm-6 col-6">
		<a href="<?= site_url('page/open_pengeluaran') ?>">
			<div class="alert alert-danger border-0 d-flex justify-content-center align-items-center flex-column" data-aos="flip-left" data-aos-delay="300">
				<img src="<?= base_url().'/assets/icon/pengeluaran.png' ?>" style="width:80px;">
				<span class="fs-6 mt-3 fw-bolder">Rp <?= $total_pengeluaran ?></span>
				<span>Total Pengeluaran</span>
			</div>
		</a>
	</div>
	<div class="col-lg-2 col-md-4 col-sm-6 col-6">
		<a href="<?= site_url('page/anggota') ?>">
			<div class="alert alert-warning border-0 d-flex justify-content-center align-items-center flex-column" data-aos="flip-left" data-aos-delay="400">
				<img src="<?= base_url().'/assets/icon/anggota.png' ?>" style="width:80px;">
				<span class="fs-6 mt-3 fw-bolder"><?= $total_anggota ?></span>
				<span>Total Anggota</span>
			</div>
		</a>
	</div>
	<div class="col-lg-2 col-md-4 col-sm-6 col-6">
		<a href="<?= site_url('page/anggota') ?>">
			<div class="alert alert-dark border-0 d-flex justify-content-center align-items-center flex-column text-white" data-aos="flip-left" data-aos-delay="500">
				<img src="<?= base_url().'/assets/icon/hutang.png' ?>" style="width:80px;">
				<span class="fs-6 mt-3 fw-bolder"><?= $total_hutang ?></span>
				<span>Total Hutang</span>
			</div>
		</a>
	</div>
</div>
<div class="row">
	<div class="col-lg-8">
		<div class="d-flex justify-content-center flex-column" data-aos="zoom-out" data-aos-delay="100">
			<div class="card w-100 bg-info-subtle overflow-hidden shadow-none h-100">
				<div class="card-body position-relative">
				  <div class="row">
				    <div class="col-sm-7" data-aos="zoom-out" data-aos-delay="200">
				      <div class="d-flex align-items-center justify-content-between">
				        <h3 class="fw-semibold mb-3">Sistem Kas berbasis Website</h3>
				      </div>
				      <div class="mb-7">
						<p>Menggunakan bahasa pemrogramman HTML 5, CSS, Javascript, PHP. Menggunakan framework CSS Bootstrap 5.3 dan PHP Codeigniter 3. Template Modernize admin free.</p>
				      </div>
				      <p>Developed by : <strong>Ahmad Faaza Mubaarok</strong></p>
				    </div>
				    <div class="col-sm-5" data-aos="zoom-out" data-aos-delay="500">
				      <div class="welcome-bg-img mb-n7 text-end">
				        <img src="<?= base_url() ?>/assets/img/sistemkas.png" alt="modernize-img" class="img-fluid" style="width: 250px; height: auto;">
				      </div>
				    </div>
				  </div>
				</div>
			</div>
			<div class="card w-100 bg-light-subtle overflow-hidden alert alert-light border-3 p-0">
				<div class="card-body position-relative">
				  <div class="row">
				    <div class="col-sm-9">
				      <div class="mb-8">
						<span>
							Download repository: <a href="https://github.com/ahmadfaazamubaarok/kas_codeigniter3_smkas" target="_blank">https://github.com/ahmadfaazamubaarok/kas_codeigniter3_smkas</a>
						</span>
				      </div>
				    </div>
				    <div class="col-sm-3">
				      <div class="welcome-bg-img mb-n7 text-end">
				      	<img src="<?= base_url() ?>/assets/img/github.png" class="img-fluid" style="width: 50px; height: auto;">
				      </div>
				    </div>
				  </div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="alert alert-info border-0" data-aos="zoom-out" data-aos-delay="300">
			<!-- Donut Chart -->
		    <div id="donutChart" style="min-height: 400px;" class="echart"></div>
		    <script>
		      document.addEventListener("DOMContentLoaded", () => {
		        echarts.init(document.querySelector("#donutChart")).setOption({
		          tooltip: {
		            trigger: 'item'
		          },
		          legend: {
		            top: '5%',
		            left: 'center'
		          },
		          series: [{
		            name: 'Anggota yang :',
		            type: 'pie',
		            radius: ['40%', '70%'],
		            avoidLabelOverlap: false,
		            label: {
		              show: false,
		              position: 'center'
		            },
		            emphasis: {
		              label: {
		                show: true,
		                fontSize: '18',
		                fontWeight: 'bold'
		              }
		            },
		            labelLine: {
		              show: false
		            },
		            data: [{
		                value: <?= $persentase_anggota_lunas ?>,
		                name: 'Lunas'
		              },
		              {
		                value: <?= $persentase_anggota_belum_lunas ?>,
		                name: 'Belum lunas'
		              }
		            ]
		          }]
		        });
		      });
		    </script>
		    <!-- End Donut Chart -->
		</div>
	</div>
</div>
<?php if ($this->session->flashdata('welcome')): ?>
<!-- Modal -->
<div class="modal fade" id="modalWelcome" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<center>
      		<h1>Selamat Datang <strong><?= $this->session->userdata('username') ?></strong></h1>
      		<span>Anda sekarang memasuki periode : <strong><?= $this->session->userdata('periode')->periode ?></strong></span>
	        <img src="<?= base_url().'/assets/img/transaksi.png' ?>" class="img-fluid">
	        <p>Semoga pengalaman anda dalam menggunakan sistem kas berbasis website ini memuaskan.</p>
      	</center>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-primary w-50" data-bs-dismiss="modal">Oke</button>
      </div>
    </div>
  </div>
</div>
<?php endif ?>
<?php $this->load->view('template/foot') ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#modalWelcome').modal('show');
	})
</script>