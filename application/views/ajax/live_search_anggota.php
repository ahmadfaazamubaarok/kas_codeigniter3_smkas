<?php if (count($data_anggota) > 0): ?>
<div class="card" data-aos="zoom-out" data-aos-delay="100">
  <div class="card-body">
      <div class="d-flex justify-content-between">
	      <div data-aos="zoom-out" data-aos-delay="100">
	        <h4 class="card-title fw-semibold">Data Anggota</h4>
	        <p class="card-subtitle">Menampilkan seluruh data anggota.</p>
	      </div>
				<div class="d-flex align-items-center" data-aos="zoom-out" data-aos-delay="150">
	         <div class="border-end pe-4 border-muted border-opacity-10">
	           <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center"><?= count($data_anggota) ?><i class="ti ti-plus fs-5 lh-base text-success"></i>
	           </h3>
	           <p class="mb-0 text-dark">Total Anggota</p>
	         </div>
	      </div>
	        <button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#modalTambahAnggota" data-aos="zoom-out" data-aos-delay="200"><i class="ti ti-plus"></i>Tambah Anggota</button>
	    	</div>
	      <div class="table-responsive mt-4" data-aos="zoom-out" data-aos-delay="300">
	        <table class="table table-borderless text-nowrap align-middle mb-0">
	          <tbody>
	        <?php $no = 1; ?>
	        <?php foreach ($data_anggota as $anggota): ?>
	            <tr class="bg-light" data-aos="zoom-out" data-aos-delay="100">
	              <td class="rounded-start bg-transparent">
	                <div class="d-flex align-items-center gap-3">
	                  <div>
	                    <h6 class="mb-0"><?= $no ?>.</h6>
	                  </div>
	                </div>
	              </td>
	              <td class="bg-transparent"><?= $anggota->id_anggota ?></td>
	              <td class="bg-transparent"><strong><?= $anggota->nama_anggota ?></strong><?php if ($this->session->flashdata('user_baru') === $anggota->id_anggota): ?><span class="badge bg-success mx-3">Baru</span><?php endif ?></td>
	              <td class="bg-transparent">Tabungan: <strong>Rp <?= $anggota->saldo ?></strong></td>
	              <td class="text-end rounded-end bg-transparent">
              		<span class="text-bold mx-3 badge bg-<?php if (count($anggota->hutang) <= 0) {echo "success";} else {echo "danger";} ?>" data-aos="flip-left" data-aos-delay="400"><?php if (count($anggota->hutang) <= 0) {echo "Lunas";} else {echo "Belum Lunas";} ?></span>
                  <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#info<?= $anggota->id_anggota ?>" aria-expanded="false" aria-controls="collapseThree" data-aos="zoom-out" data-aos-delay="500">
                    <i class="ti ti-info-circle"></i>
                  </button>
                  <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#edit<?= $anggota->id_anggota ?>" aria-expanded="false" aria-controls="collapseTwo" data-aos="zoom-out" data-aos-delay="600">
                    <i class="ti ti-edit"></i>
                  </button>
                  <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#hapus<?= $anggota->id_anggota ?>" data-aos="zoom-out" data-aos-delay="600">
                    <i class="ti ti-trash"></i>
                  </button>
	              </td>
	            </tr>
	            <tr>
	              <td colspan="6">
	              	<div class="accordion-item">
                      <div id="edit<?= $anggota->id_anggota ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                              <div class="mb-4">
                                  <span>Edit Anggota:</span>
                                  <h5><?= $anggota->nama_anggota ?></h5>
                              </div>
                              <form id="formEditAnggota<?= $anggota->id_anggota ?>" class="formEditAnggota">
                                  <div class="row">
                                      <div class="col-lg-4">
                                          <div class="input-group mb-2">
                                              <span class="input-group-text"><i class="ti ti-key"></i></span>
                                              <div class="form-floating">
                                                  <input readonly name="id_anggota" value="<?= $anggota->id_anggota ?>" class="form-control">
                                                  <label for="floatingInputGroup1">Kode Anggota</label>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-lg-8">
                                          <div class="input-group mb-2">
                                              <span class="input-group-text"><i class="ti ti-calendar"></i></span>
                                              <div class="form-floating">
                                                  <input name="nama_anggota" value="<?= $anggota->nama_anggota ?>" class="form-control">
                                                  <label for="floatingInputGroup1">Nama Anggota</label>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="d-flex justify-content-end mt-2">
                                          <button class="btn btn-success editAnggota" data-id="<?= $anggota->id_anggota ?>"><i class="ti ti-edit"></i>Simpan perubahan</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  <div class="accordion-item">
                    <div id="info<?= $anggota->id_anggota ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                  			<div class="mb-4 d-flex justify-content-between">
                            <?php
                            	$total_hutang = 0;
                            	foreach ($anggota->hutang as $hutang){
                              	$total_hutang += $hutang->nominal;
                            	}
                            ?>
                            <span>Total tanggungan <?= $anggota->nama_anggota ?>:<h5>Rp <?= $total_hutang ?></h5></span>
		                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
													     <li class="nav-item" role="presentation">
													       <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#hutang<?= $anggota->id_anggota ?>" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="ti ti-cash"></i> Hutang</button>
													     </li>
													     <li class="nav-item" role="presentation">
													       <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#tabungan<?= $anggota->id_anggota ?>" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="ti ti-database"></i> Tabungan</button>
													     </li>
													  </ul>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                           <div class="tab-pane fade show active" id="hutang<?= $anggota->id_anggota ?>" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                           	<?php if (count($anggota->hutang) > 0): ?>
			                        <table class="table table-borderless text-nowrap align-middle mb-0">
			                        	<tbody>
			                        		<?php $urut = 1 ?>
			                        		<?php foreach ($anggota->hutang as $hutang): ?>
			                        			<tr class="bg-light">
												              <td class="rounded-start bg-transparent">
												                <div class="d-flex align-items-center gap-3">
												                  <div>
												                    <h6 class="mb-0"><?= $urut ?>.</h6>
												                  </div>
												                </div>
												              </td>
												              <td class="bg-transparent"><?= $hutang->id_hutang ?></td>
												              <td class="bg-transparent"><?= $hutang->periode ?></td>
												              <td class="bg-transparent">Rp<strong><?= $hutang->nominal ?></strong></td>
												              <td class="text-end rounded-end bg-transparent">
											                  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#hutang<?= $hutang->id_hutang ?>" aria-expanded="false" aria-controls="collapseThree">
											                    <i class="ti ti-cash"></i>Bayar
											                  </button>
												              </td>
												            </tr>
												            <tr>
												            	<td colspan="0"></td>
												            </tr>
												           <?php $urut++; ?>
			                        		<?php endforeach ?>
			                        	</tbody>
			                        </table>
			                        <div style="position: relative;">
				                        <div style="position: absolute; top: -10px; left: 50%; transform: translateX(-50%); background-color: white; padding: 0 10px; z-index: 1;">
				                            <span>End of hutang <?= $anggota->nama_anggota ?></span>
				                        </div>
				                        <hr style="z-index: 0; position: relative;">
					                    </div>
                           	<?php else: ?>
                           		<div class="alert alert-success text-center">Tidak ada tanggungan kas.</div>
                           	<?php endif ?>
                           </div>
                           <div class="tab-pane fade show" id="tabungan<?= $anggota->id_anggota ?>" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                           	<?php if (count($anggota->tabungan) > 0): ?>
                           	<table class="table table-borderless text-nowrap align-middle mb-0">
			                        	<tbody>
			                        		<?php $urut = 1 ?>
			                        		<?php foreach ($anggota->tabungan as $tabungan): ?>
			                        			<tr class="bg-light">
												              <td class="rounded-start bg-transparent">
												                <div class="d-flex align-items-center gap-3">
												                  <div>
												                    <h6 class="mb-0"><?= $urut ?>.</h6>
												                  </div>
												                </div>
												              </td>
												              <td class="bg-transparent"><?= $tabungan->id_tabungan ?></td>
												              <td class="bg-transparent"><?= $tabungan->waktu ?></td>
												              <td class="bg-transparent">Rp<strong><?= $tabungan->nominal ?></strong></td>
												              <td class="bg-transparent text-end">
												              	<span class="badge bg-<?php if ($tabungan->keterangan === 'masuk'){echo "success";}else{echo "danger";} ?>"><?= $tabungan->keterangan ?></span>
												              </td>
												            </tr>
												            <tr>
												            	<td colspan="0"></td>
												            </tr>
												           <?php $urut++; ?>
			                        		<?php endforeach ?>
			                        	</tbody>
			                        </table>
				                    <div style="position: relative;">
				                        <div style="position: absolute; top: -10px; left: 50%; transform: translateX(-50%); background-color: white; padding: 0 10px; z-index: 1;">
				                            <span>End of tabungan <?= $anggota->nama_anggota ?></span>
				                        </div>
				                        <hr style="z-index: 0; position: relative;">
				                    </div>
			                      <?php else: ?>
                           		<div class="alert alert-warning text-center">Belum ada catatan tabungan.</div>
                           	<?php endif ?>
                           </div>
                         </div>
                      </div>
                    </div>
                  </div>
	              </td>
	            </tr>
	        <?php $no++; ?>
	        <?php endforeach ?>
	          </tbody>
	        </table>
	        <?php foreach ($data_anggota as $anggota): ?>
	        <?php endforeach ?>
	   </div>
  </div>
</div>
<?php foreach ($data_anggota as $anggota): ?>
  <!-- Modal -->
	<div class="modal fade" id="hapus<?= $anggota->id_anggota ?>" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	      	<div class="row text-center mb-3">
		      	<i class="ti ti-trash" style="font-size: 10em;"></i>
	      	</div>
	      	<div class="row text-center">
					<p class="mb-0">Yakin akan menghapus anggota:</p>
					<h5><?= $anggota->nama_anggota ?></h5>
	      	</div>
	      </div>
	      <div class="modal-footer d-flex justify-content-center">
			    <button type="button" class="btn btn-danger hapusAnggota" data-id="<?= $anggota->id_anggota ?>"><i class="ti ti-trash"></i>Hapus</button>
	      </div>
	    </div>
	  </div>
	</div>
<?php endforeach ?>
<?php foreach ($data_anggota as $anggota): ?>
	<?php foreach ($anggota->hutang as $hutang): ?>
			<!-- Modal -->
			<div class="modal fade modalBayar" id="hutang<?= $hutang->id_hutang ?>" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
			      			<h5><?= $anggota->nama_anggota ?></h5>
			      		</div>
			      		<div class="col-lg-6">
			      			<span>Periode :</span>
			      			<h5><?= $hutang->periode ?></h5>
			      		</div>
			      	</div>      	
			      	<div class="bg-danger rounded d-flex justify-content-between p-3 text-white">
			      		<span>Nominal :</span>
			      		<h3 class="text-white">Rp <?= $hutang->nominal ?></h3>
			      	</div>
			      </div>
			      <div class="modal-footer d-flex justify-content-between">
			      		<span>Tabungan : <strong><?= $anggota->saldo ?></strong></span>
				      	<form id="formBayarTanggungan" method="POST">
				      		<input type="hidden" name="id_periode" value="<?= $hutang->id_periode ?>">
			      			<input type="hidden" name="id_hutang"  value="<?= $hutang->id_hutang ?>">
			      			<input type="hidden" name="id_anggota" value="<?= $anggota->id_anggota ?>">
			      			<input type="hidden" name="nominal" value="<?= $hutang->nominal ?>">
				      		<input type="hidden" name="saldo" value="<?= $anggota->saldo ?>">
				      		<div class="d-flex justify-content-end align-items-center">
				      		</div>
				      	</form>
				      	<div>
				      		<button type="button" class="btn btn-success simpanTransaksiViaTabungan text-center" id="simpanTransaksiViaTabungan"><i class="ti ti-database"></i>Via Tabungan</button>
							    <button type="button" class="btn btn-primary simpanTransaksi text-center" id="simpanTransaksi"><i class="ti ti-cash"></i>Bayar Tunai</button>
				      	</div>
			      	</div>
			      </div>
			    </div>
			  </div>
			</div>
	<?php endforeach ?>
<?php endforeach ?>
<?php else: ?>
	<div class="card" data-aos="zoom-out" data-aos-delay="100">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div data-aos="zoom-out" data-aos-delay="200">
              <h4 class="card-title fw-semibold">Data Anggota</h4>
              <p class="card-subtitle">Menampilkan data seluruh anggota.</p>
            </div>
            <button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#modalTambahAnggota" data-aos="zoom-out" data-aos-delay="300"><i class="ti ti-plus"></i>Tambah Anggota</button>
          </div>
    	    <div class="alert alert-warning d-flex justify-content-center mt-3" data-aos="zoom-out" data-aos-delay="350">
    	      <p class="mb-0">Belum ada anggota.</p>
    	    </div>
        </div>
	</div>
<?php endif ?>
<!-- Modal -->
<div class="modal fade" id="modalTambahAnggota" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      	<h5>Tambah Anggota</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<form id="formTambahAnggota">
	      	<div class="input-group mb-2">
            <span class="input-group-text"><i class="ti ti-user"></i></span>
            <div class="form-floating">
               <input type="text" class="form-control" id="floatingNamaAnggota" placeholder="Nama Anggota" name="nama_anggota" required>
               <label for="floatingNamaAnggota">Nama Anggota</label>
            </div>
	        </div>
	        <div class="alert alert-danger" id="alertInputBelumLengkap" style="display:none;">
	        	Lengkapi kolom terlebih dahulu!
	        </div>
      	</form>
      </div>
      <div class="modal-footer">
		    <button type="button" class="btn btn-warning" id="tambahAnggota"><i class="ti ti-plus"></i>Tambahkan</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalBerhasilBayar" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div class="row text-center mb-3">
	      	<i class="ti ti-check" style="font-size: 10em;"></i>
      	</div>
      	<div class="row text-center">
				<p class="mb-0">Berhasil melakukan pembayaran.</p>
      	</div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
		    <button type="button" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">Konfirmasi</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalBerhasilTambah" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div class="row text-center mb-3">
	      	<i class="ti ti-check" style="font-size: 10em;"></i>
      	</div>
      	<div class="row text-center">
				<p class="mb-0">Berhasil menambahkan anggota.</p>
      	</div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
		    <button type="button" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">Konfirmasi</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalBerhasilHapus" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div class="row text-center mb-3">
	      	<i class="ti ti-check" style="font-size: 10em;"></i>
      	</div>
      	<div class="row text-center">
				<p class="mb-0">Berhasil menghapus anggota.</p>
      	</div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
		    <button type="button" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">Konfirmasi</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalBerhasilEdit"	 data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div class="row text-center mb-3">
	      	<i class="ti ti-check" style="font-size: 10em;"></i>
      	</div>
      	<div class="row text-center">
				<p class="mb-0">Berhasil melakukan perubahan.</p>
      	</div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
		    <button type="button" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">Konfirmasi</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
		// Edit anggota
	  $(document).on('click', '.editAnggota', function(event){
	      event.preventDefault();
	      var id_anggota = $(this).data('id');
	      var form = $('#formEditAnggota' + id_anggota);

	      $.ajax({
	          url: '<?= site_url('ajax/edit_anggota') ?>',
	          type: 'POST',
	          data: form.serialize(),
	          dataType: 'json'
	      })
	      .done(function(respon){
	          if (respon.status == 'success') {
	              $('#modalBerhasilEdit').modal('show');
	              $('#dataAnggota').load('<?= site_url('ajax/get_anggota') ?>');
	          } else {
	              alert('Gagal menyimpan perubahan: ' + respon.message);
	          }
	      })
	      .fail(function(jqXHR, textStatus, errorThrown){
	          alert('Gagal menyimpan perubahan: ' + textStatus);
	      });
	  });
		$(document).on('click', '.simpanTransaksi', function(event){
	    event.preventDefault();
			var modal = $(this).closest('.modal'); // Mendapatkan elemen modal terdekat

	    // Ambil data dari form
	    var formBayar = $('#formBayarTanggungan').serialize();

	    $.ajax({
	        url: '<?= site_url('ajax/bayar_tanggungan') ?>',
	        type: 'POST',
	        data: formBayar,
	        dataType: 'json'
	    })
	    .done(function(respon){
	    	modal.modal('hide');
	      $('#modalBerhasilBayar').modal('show');
	      $('#dataAnggota').load('<?= site_url('ajax/get_anggota') ?>');
	    })
	    .fail(function(jqXHR, textStatus, errorThrown){
	      modal.modal('hide');
	      $('#modalBerhasilBayar').modal('show');
	      $('#dataAnggota').load('<?= site_url('ajax/get_anggota') ?>');
	    });
		});

		$(document).on('click', '.simpanTransaksiViaTabungan', function(event){
	    event.preventDefault();
			var modal = $(this).closest('.modal'); // Mendapatkan elemen modal terdekat

	    // Ambil data dari form
	    var formBayar = $('#formBayarTanggungan').serialize();

	    $.ajax({
	        url: '<?= site_url('ajax/bayar_tanggungan_via_tabungan') ?>',
	        type: 'POST',
	        data: formBayar,
	        dataType: 'json'
	    })
	    .done(function(respon){
	    	modal.modal('hide');
	      $('#modalBerhasilBayar').modal('show');
	      $('#dataAnggota').load('<?= site_url('ajax/get_anggota') ?>');
	    })
	    .fail(function(jqXHR, textStatus, errorThrown){
	      modal.modal('hide');
	      $('#modalBerhasilBayar').modal('show');
	      $('#dataAnggota').load('<?= site_url('ajax/get_anggota') ?>');
	    });
		});

		$(document).on('click', '.hapusAnggota', function(event){
	    event.preventDefault();
			var id_anggota = $(this).data('id');
			var modal = $(this).closest('.modal');

			$.ajax({
				url: '<?= site_url('ajax/hapus_anggota') ?>',
				type: 'POST',
				data: { id_anggota: id_anggota },
				dataType: 'json'
			})
			.done(function(respon){
	    	modal.modal('hide');
				$('#modalBerhasilHapus').modal('show');
	      $('#dataAnggota').load('<?= site_url('ajax/get_anggota') ?>');
			})
			.fail(function(jqXHR, textStatus, errorThrown){
				console.log('Respon error:', jqXHR.responseText); // Tambahkan ini untuk melihat respon error yang diterima
	    	alert('Gagal menghapus: ' + errorThrown + '  ' + textStatus);
			})
		});

		//submit by klik tombol
		$('#tambahAnggota').click(function(event){
			event.preventDefault();
			var namaanggota = $('#floatingNamaAnggota').val();
			if (!namaanggota) {
				$('#alertInputBelumLengkap').show();
				return;
			}

			$.ajax({
				url: '<?= site_url('ajax/tambah_anggota') ?>',
	      type: 'POST',
	      dataType: 'json',
	      data: {
	          'formTambahAnggota':$('#formTambahAnggota').serialize()
	      }
			})
			.done(function(respon){
				$('#modalTambahAnggota').modal('hide');
	      $('#modalBerhasilTambah').modal('show');
	      $('#dataAnggota').load('<?= site_url('ajax/get_anggota') ?>');
			})
			.fail(function(jqXHR, textStatus, errorThrown){
				console.log('Respon error:', jqXHR.responseText); // Tambahkan ini untuk melihat respon error yang diterima
	    	alert('Gagal menambah: ' + errorThrown + '  ' + textStatus);
			})
		});

		//submit by enter
	  $('#floatingNamaAnggota').keypress(function(event){
	    if(event.which === 13) { // Kode 13 adalah kode untuk tombol Enter
	      event.preventDefault();
	      var namaanggota = $('#floatingNamaAnggota').val();
	      if (!namaanggota) {
	        $('#alertInputBelumLengkap').show();
	        return;
	      }

	      $.ajax({
	        url: '<?= site_url('ajax/tambah_anggota') ?>',
	        type: 'POST',
	        dataType: 'json',
	        data: {
	          'formTambahAnggota': $('#formTambahAnggota').serialize()
	        }
	      })
	      .done(function(respon){
	        $('#modalTambahAnggota').modal('hide');
	        $('#modalBerhasilTambah').modal('show');
	        $('#dataAnggota').load('<?= site_url('ajax/get_anggota') ?>');
	      })
	      .fail(function(jqXHR, textStatus, errorThrown){
	        console.log('Respon error:', jqXHR.responseText);
	        alert('Gagal menambah: ' + errorThrown + '  ' + textStatus);
	      });
	    }
	  });
</script>