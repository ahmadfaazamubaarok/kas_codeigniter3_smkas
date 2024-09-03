<form id="formPilihAnggota">
	<div class="input-group">
		<select name="id_anggota" class="form-control" placeholder="Pilih anggota" required id="pilihIdAnggota">
			<option value="">Pilih Anggota</option>
			<?php foreach ($list_anggota as $anggota): ?>
				<option value="<?= $anggota->id_anggota ?>"><?= $anggota->nama_anggota ?></option>
			<?php endforeach ?>
		</select>
	  	<button class="btn btn-primary" id="cariAnggota">
	  		<i class="ti ti-search"></i>
	  	</button>
	</div>
	<span class="fs-1"><i class="ti ti-info-circle"></i> Hanya menampilkan list anggota yang memiliki tanggungan pada : <strong><?= $this->session->userdata('periode')->periode ?></strong></span>
	<div class="alert alert-warning alert-dismissible fade show" role="alert" id="alertBelumPilihAnggota" style="display:none;">
		Pilih anggota yang hendak membayar terlebih dahulu!
	</div>
</form>
<script type="text/javascript">
	$('#cariAnggota').click(function(event){
			event.preventDefault();//cegah form submit default

			// Validasi input nominal menggunakan JavaScript
		    var idAnggota = $('#pilihIdAnggota').val();
		    if (!idAnggota) {
		    	$('#alertBelumPilihAnggota').show();
		        return; // Hentikan proses jika input tidak valid
		    }

			$.ajax({
				url:'<?= site_url('ajax/pilih_pembayar') ?>',
				type:'POST',
				dataType:'json',
				data: {
					'formPilihAnggota':$('#formPilihAnggota').serialize()
				},
			})
			.done(function(respon){
				$('#alertBelumPilihAnggota').hide();
				$('#alertBerhasilTransaksi').hide();
				$('#infoAnggota').show();
				$('#namaAnggota').text(respon.nama_anggota);
				$('#bayarAnggota').text(respon.nama_anggota);
				$('#periode').text(respon.periode);
				$('#bayarPeriode').text(respon.periode);
				$('#nominal').text('Rp ' + respon.nominal);
				$('#bayarNominal').text('Rp ' + respon.nominal);
				$('#inputHiddenIdAnggota').val(respon.id_anggota);
				$('#inputHiddenIdPeriode').val(respon.id_periode);
				$('#inputHiddenNominal').val(respon.nominal);
			})
			.fail(function(respon){
				alert(respon.pesan);
			});
		});
</script>