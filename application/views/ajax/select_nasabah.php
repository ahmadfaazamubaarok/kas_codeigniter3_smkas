<form id="formPilihNasabah">
	<div class="input-group">
		<select name="id_anggota" class="form-control" placeholder="Pilih anggota" required id="pilihIdNasabah">
			<option value="">Pilih Anggota</option>
			<?php foreach ($list_anggota as $anggota): ?>
				<option value="<?= $anggota->id_anggota ?>"><?= $anggota->nama_anggota ?></option>
			<?php endforeach ?>
		</select>
	  	<button class="btn btn-primary" id="cariAnggota">
	  		<i class="ti ti-search"></i>
	  	</button>
	</div>
	<div class="alert alert-warning alert-dismissible fade show" role="alert" id="alertBelumPilihAnggota" style="display:none;">
		Pilih anggota yang hendak membayar terlebih dahulu!
	</div>
</form>
<script type="text/javascript">
	$('#formPilihNasabah').submit(function(event){
			event.preventDefault();//cegah form submit default

			// Validasi input nominal menggunakan JavaScript
		    var idAnggota = $('#pilihIdNasabah').val();
		    if (!idAnggota) {
		    	$('#alertBelumPilihAnggota').show();
		        return; // Hentikan proses jika input tidak valid
		    }

			$.ajax({
				url:'<?= site_url('ajax/cari_nasabah') ?>',
				type:'POST',
				dataType:'json',
				data: {
					'formPilihNasabah':$('#formPilihNasabah').serialize()
				},
			})
			.done(function(respon){
		    	$('#infoNasabah').show();
				$('#namaNasabah').text(respon.nama_anggota);
				$('#saldoNasabah').text('Rp ' + respon.saldo);
				$('#saldoNasabahModalMasuk').text('Rp ' + respon.saldo);
				$('#inputHiddenIdNasabahMasuk').val(respon.id_anggota);
				$('#saldoNasabahModalKeluar').text('Rp ' + respon.saldo);
				$('#inputHiddenIdNasabahKeluar').val(respon.id_anggota);
			})
			.fail(function(respon){
				alert(respon.pesan);
			});
		});
</script>