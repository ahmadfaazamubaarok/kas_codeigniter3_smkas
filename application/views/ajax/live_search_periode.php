    <div class="card" data-aos="zoom-out" data-aos-delay="50">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div data-aos="zoom-out" data-aos-delay="100">
                    <h4 class="card-title fw-semibold">Data Periode</h4>
                    <p class="card-subtitle">Menampilkan data seluruh periode.</p>
                </div>
                <div class="d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                     <div class="border-end pe-4 border-muted border-opacity-10">
                       <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center"><?= count($data_periode) ?><i class="ti ti-plus fs-5 lh-base text-success"></i>
                       </h3>
                       <p class="mb-0 text-dark">Total Periode</p>
                     </div>
                  </div>
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#tambahPeriode" data-aos="zoom-out" data-aos-delay="300"><i class="ti ti-plus"></i>Tambah Periode</button>
            </div>
            <?php if (count($data_periode) > 0): ?>
            <div class="table-responsive mt-4" data-aos="zoom-out" data-aos-delay="300">
                <table class="table table-borderless text-nowrap align-middle mb-0">
                    <tbody>
                        <?php $urut = 1; ?>
                        <?php foreach ($data_periode as $periode): ?>
                        <tr class="bg-light">
                            <td class="rounded-start bg-transparent">
                                <div class="d-flex align-items-center gap-3">
                                    <div>
                                        <h6 class="mb-0"><?= $urut ?>.</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="bg-transparent"><?= $periode->id_periode ?></td>
                            <td class="bg-transparent"><?= $periode->periode ?></td>
                            <td class="bg-transparent">Rp <strong><?= $periode->nominal ?></strong>,00<i class="ti ti-chevron-up text-danger ms-1 fs-4"></i></td>
                            <td class="text-end rounded-end bg-transparent">
                            	<span class="mx-3 badge bg-<?php if ($periode->status === 'aktif') {echo "success";} else {echo "danger";} ?>" data-aos="flip-left" data-aos-delay="400"><?php if ($periode->status === 'aktif') {echo "Aktif";} else {echo "NonAktif";} ?></span>
                                <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#info<?= $periode->id_periode ?>" aria-expanded="false" aria-controls="collapseTwo" data-aos="zoom-out" data-aos-delay="500">
                                    <i class="ti ti-info-circle"></i>
                                </button>
                                <?php if ($periode->status === 'aktif'): ?>
                                    <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#edit<?= $periode->id_periode ?>" aria-expanded="false" aria-controls="collapseTwo" data-aos="zoom-out" data-aos-delay="600">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                <?php endif ?>
                                <?php if ($periode->status === 'tidak'): ?>
                                    <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $periode->id_periode ?>" data-aos="zoom-out" data-aos-delay="600">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                <?php endif ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div class="accordion-item">
                                    <div id="edit<?= $periode->id_periode ?>" class="accordion-collapse collapse mb-3" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="mb-4">
                                                <span>Edit periode:</span>
                                                <h5><?= $periode->periode ?></h5>
                                            </div>
                                            <form id="formEditPeriode<?= $periode->id_periode ?>" class="formEditPeriode">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="input-group mb-2">
                                                            <span class="input-group-text"><i class="ti ti-key"></i></span>
                                                            <div class="form-floating">
                                                                <input readonly name="id_periode" value="<?= $periode->id_periode ?>" class="form-control">
                                                                <label for="floatingInputGroup1">Kode Periode</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="input-group mb-2">
                                                            <span class="input-group-text"><i class="ti ti-calendar"></i></span>
                                                            <div class="form-floating">
                                                                <input name="periode" value="<?= $periode->periode ?>" class="form-control" id="namaPeriode">
                                                                <label for="namaPeriode">Nama Periode</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="input-group mb-2">
                                                            <span class="input-group-text">Rp</span>
                                                            <div class="form-floating">
                                                                <input name="nominal" value="<?= $periode->nominal ?>" class="form-control" id="nominalPeriode">
                                                                <label for="nominalPeriode">Nominal wajib</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end mt-2">
                                                        <button class="btn btn-success editPeriode" data-id="<?= $periode->id_periode ?>"><i class="ti ti-edit"></i>Simpan perubahan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <?php 
                                       $total_pemasukan = 0;
                                       $total_pengeluaran = 0;
                                     
                                       foreach ($periode->pemasukan as $pemasukan) {
                                       $total_pemasukan += $pemasukan->nominal;
                                       }
                                       foreach ($periode->pengeluaran as $pengeluaran) {
                                       $total_pengeluaran += $pengeluaran->nominal;
                                       }
                                    ?>
                                    <div id="info<?= $periode->id_periode ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                          <div class="row">
                                             <div class="col-lg-6 d-flex align-items-center">
                                                <div class="border-end pe-4 border-muted border-opacity-10">
                                                  <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">Rp <?= $total_pemasukan ?><i class="ti ti-plus fs-5 lh-base text-success"></i>
                                                  </h3>
                                                  <p class="mb-0 text-dark">Total Transaksi Pemasukan</p>
                                                </div>
                                                <div class="ps-4">
                                                  <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">Rp <?= $total_pengeluaran ?><i class="ti ti-minus fs-5 lh-base text-danger"></i>
                                                  </h3>
                                                  <p class="mb-0 text-dark">Total Transaksi Pengeluaran</p>
                                                </div>
                                             </div>
                                             <div class="col-lg-6 d-flex justify-content-end">
                                                <?php if ($periode->status === 'tidak'): ?>
                                                    <form action="<?= site_url('ajax/ekspor_excel') ?>" class="border-end pe-4 border-muted border-opacity-10" method="POST">
                                                        <input type="hidden" name="id_periode" value="<?= $periode->id_periode ?>">
                                                        <input type="hidden" name="total_pemasukan" value="<?= $total_pemasukan ?>">
                                                        <input type="hidden" name="total_pengeluaran" value="<?= $total_pengeluaran ?>">
                                                        <button type="submit" class="btn btn-success"><i class="ti ti-database-export"></i> Ekspor Excel</button>
                                                    </form>
                                                <?php endif ?>
                                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                   <li class="nav-item" role="presentation">
                                                     <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pemasukan<?= $periode->id_periode ?>" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="ti ti-arrow-down"></i> Pemasukan</button>
                                                   </li>
                                                   <li class="nav-item" role="presentation">
                                                     <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pengeluaran<?= $periode->id_periode ?>" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="ti ti-arrow-up"></i> Pengeluaran</button>
                                                   </li>
                                                </ul>
                                             </div>
                                          </div>
                                          <div class="tab-content" id="pills-tabContent">
                                             <div class="tab-pane fade show active" id="pemasukan<?= $periode->id_periode ?>" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                                <?php if (count($periode->pemasukan) > 0): ?>
                                                <div class="table-responsive mt-4">
                                                   <table class="table table-borderless text-nowrap align-middle mb-0">
                                                      <tbody>
                                                      <?php $no = 1; ?>
                                                      <?php foreach ($periode->pemasukan as $pemasukan): ?>
                                                         <tr class="bg-light">
                                                           <td class="rounded-start bg-transparent">
                                                             <div class="d-flex align-items-center gap-3">
                                                               <div>
                                                                 <h6 class="mb-0"><?= $no ?>.</h6>
                                                               </div>
                                                             </div>
                                                           </td>
                                                           <td class="bg-transparent"><?= $pemasukan->id_pemasukan ?></td>
                                                           <td class="bg-transparent">Rp <strong><?= $pemasukan->nominal ?></strong>,00<i class="ti ti-chevron-down text-success ms-1 fs-4"></i></td>
                                                           <td class="bg-transparent"><?= $pemasukan->waktu ?></td>
                                                           <td class="text-end rounded-end bg-transparent">
                                                               <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#info<?= $pemasukan->id_pemasukan ?>" aria-expanded="false" aria-controls="collapseThree">
                                                                 <i class="ti ti-info-circle"></i>
                                                               </button>
                                                           </td>
                                                         </tr>
                                                         <tr>
                                                           <td colspan="6">
                                                             <div class="">
                                                               <div class="accordion-item">
                                                                 <div id="info<?= $pemasukan->id_pemasukan ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                                   <div class="accordion-body">
                                                                     <p><strong>Pembayar: </strong><?= $pemasukan->nama_anggota ?></p>
                                                                     <p><strong>Penerima: </strong><?= $pemasukan->username ?></p>
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
                                                </div>
                                                <?php else: ?>
                                                <div class="alert alert-warning d-flex justify-content-center mt-3">
                                                    <p class="mb-0">Belum ada transaksi <strong>Pemasukan</strong> tercatat.</p>
                                                </div>
                                                <?php endif ?>
                                             </div>

                                             <div class="tab-pane fade show" id="pengeluaran<?= $periode->id_periode ?>" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                                <?php if (count($periode->pengeluaran) > 0): ?>
                                                <div class="table-responsive mt-4">
                                                   <table class="table table-borderless text-nowrap align-middle mb-0">
                                                     <tbody>
                                                      <?php $no = 1; ?>
                                                      <?php foreach ($periode->pengeluaran as $pengeluaran): ?>
                                                         <tr class="bg-light">
                                                           <td class="rounded-start bg-transparent">
                                                             <div class="d-flex align-items-center gap-3">
                                                               <div>
                                                                 <h6 class="mb-0"><?= $no ?>.</h6>
                                                               </div>
                                                             </div>
                                                           </td>
                                                           <td class="bg-transparent"><?= $pengeluaran->id_pengeluaran ?></td>
                                                           <td class="bg-transparent">Rp <strong><?= $pengeluaran->nominal ?></strong>,00<i class="ti ti-chevron-up text-danger ms-1 fs-4"></i></td>
                                                           <td class="bg-transparent"><?= $pengeluaran->waktu ?></td>
                                                           <td class="text-end rounded-end bg-transparent">
                                                               <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#info<?= $pengeluaran->id_pengeluaran ?>" aria-expanded="false" aria-controls="collapseThree">
                                                                 <i class="ti ti-info-circle"></i>
                                                               </button>
                                                           </td>
                                                         </tr>
                                                         <tr>
                                                           <td colspan="6">
                                                             <div class="">
                                                               <div class="accordion-item">
                                                                 <div id="info<?= $pengeluaran->id_pengeluaran ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                                   <div class="accordion-body">
                                                                     <p><strong>Penarik: </strong><?= $pengeluaran->username ?></p>
                                                                     <p><strong>Keperluan: </strong><?= $pengeluaran->keperluan ?></p>
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
                                                </div>
                                                <?php else: ?>
                                                <div class="alert alert-warning d-flex justify-content-center mt-3">
                                                    <p class="mb-0">Belum ada transaksi <strong>Pengeluaran</strong> tercatat.</p>
                                                </div>
                                                <?php endif ?>
                                             </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php $urut++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
    	    <div class="alert alert-warning d-flex justify-content-center mt-3">
    	      <p class="mb-0">Belum ada data periode.</p>
    	    </div>
        <?php endif ?>
        </div>
    </div>
<?php foreach ($data_periode as $periode): ?>
<!-- Modal -->
<div class="modal fade" id="modalHapus<?= $periode->id_periode ?>" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
          <p class="mb-0">Hapus Periode</p>
          <br>
          <h5><?= $periode->periode ?></h5>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
	        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="hapusPeriode" data-id="<?= $periode->id_periode ?>"><i class="ti ti-trash"></i>Hapus periode</button>
      	</form>
      </div>
    </div>
  </div>
</div>
<?php endforeach ?>
<!-- Modal -->
<div class="modal fade" id="tambahPeriode" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Tambah periode</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formTambahPeriode" class="formTambahPeriode">
            <div class="input-group mb-2">
                <span class="input-group-text"><i class="ti ti-calendar"></i></span>
                <div class="form-floating">
                   <input type="text" class="form-control" id="floatingNamaPeriode" placeholder="Nama Periode" name="periodeBaru">
                   <label for="floatingNamaPeriode">Nama Periode</label>
                 </div>
            </div>
            <div class="input-group mb-2">
                <span class="input-group-text">Rp</span>
                <div class="form-floating">
                   <input type="text" class="form-control" id="floatingNominalPeriode" placeholder="Nominal Wajib" name="nominalBaru">
                   <label for="floatingNominalPeriode">Nominal Wajib</label>
                 </div>
            </div>
            <div class="alert alert-danger mt-3" id="alertInputTidakTepat" style="display:none;">Lengkapi kolom input dengan tepat!</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="buttonTambah"><i class="ti ti-plus"></i>Tambah periode</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Berhasil Tambah -->
<div class="modal fade" id="modalBerhasilTambah" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
          <p class="mb-0">Berhasil menambahkan periode</p>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Selesai</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalBerhasilTambah" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
          <p class="mb-0">Berhasil melakukan tambah periode</p>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Selesai</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalBerhasilHapus" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
          <p class="mb-0">Berhasil menghapus periode</p>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Selesai</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        // Edit periode
        $(document).on('click', '.editPeriode', function(event){
            event.preventDefault();
            var id_periode = $(this).data('id');
            var form = $('#formEditPeriode' + id_periode);

            $.ajax({
                url: '<?= site_url('ajax/edit_periode') ?>',
                type: 'POST',
                data: form.serialize(),
                dataType: 'json'
            })
            .done(function(respon){
                if (respon.status == 'success') {
                    $('#modalBerhasiledit').modal('show');
                    $('#dataPeriode').load('<?= site_url('ajax/get_periode') ?>');
                } else {
                    alert('Gagal menyimpan perubahan: ' + respon.message);
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown){
                alert('Gagal menyimpan perubahan: ' + textStatus);
            });
        });

        // Tambah periode
        $('#buttonTambah').click(function(event){
            event.preventDefault();

            var namaPeriode = $('input[name="periodeBaru"]').val();
            var nominal = $('input[name="nominalBaru"]').val();
            if (!namaPeriode || !nominal || nominal <= 0) {
                $('#alertInputTidakTepat').show();
                return; // Hentikan proses jika input tidak valid
            }


            $.ajax({
                url: '<?= site_url('ajax/tambah_periode') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'formTambahPeriode':$('#formTambahPeriode').serialize()
                }
            })
            .done(function(respon){
                if (respon.status == 'success') {
                    $('#tambahPeriode').modal('hide');
                    $('#modalBerhasilTambah').modal('show');
                    $('#dataPeriode').load('<?= site_url('ajax/get_periode') ?>');
                } else {
                    alert('Gagal menambah data: ' + respon.message);
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown){
                alert('Gagal menambah data: ' + textStatus);
            });
        });

        // Hapus periode
        $(document).on('click', '#hapusPeriode', function(event){
            event.preventDefault();
            var id_periode = $(this).data('id');

            $.ajax({
                url: '<?= site_url('ajax/hapus_periode') ?>',
                type: 'POST',
                data: {id_periode: id_periode},
                dataType: 'json'
            })
            .done(function(respon){
                if (respon.status == 'success') {
                    $('#modalHapus').modal('hide');
                    $('#modalBerhasilHapus').modal('show');
                    $('#dataPeriode').load('<?= site_url('ajax/get_periode') ?>');
                } else {
                    alert('Gagal menghapus: ' + respon.message);
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown){
                alert('Gagal menghapus: ' + textStatus);
            });
        });
    });
</script>
