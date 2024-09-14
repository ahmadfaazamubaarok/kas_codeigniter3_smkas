<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller{

	public function get_pembayar(){
		$data['list_anggota'] = $this->kas_model->get_anggota_by_hutang_periode_aktif();
		$this->load->view('ajax/select_pembayar',$data);
	}

	public function pilih_pembayar(){
		$formPilihAnggota = $this->input->post('formPilihAnggota');

		parse_str($formPilihAnggota, $data);
		$id_anggota = $data['id_anggota'];
		$pembayar = $this->kas_model->get_anggota_by_id($id_anggota);
		$periode = $this->kas_model->get_periode_aktif();

		if ($pembayar) {
			$info = [
				'hasil'			=> TRUE,
				'pesan'			=> 'Menampilkan data pembayar.',
				'id_anggota'	=> $pembayar->id_anggota,
				'id_periode'	=> $periode->id_periode,
				'nama_anggota'	=> $pembayar->nama_anggota,
				'periode' 		=> $periode->periode,
				'nominal'		=> number_format($periode->nominal),
				'saldo'			=> number_format($pembayar->saldo)
			];
		} else {
			$info = [
				'hasil' => FALSE,
				'pesan' => 'Gagal menampilkan data pembayar.'
			];
		}

		echo json_encode($info);
	}

	public function simpan_pemasukan(){
		$id_anggota = $this->input->post('id_anggota');
		$id_periode = $this->input->post('id_periode');
		$nominal = $this->input->post('nominal');
		
		$pemasukan = [
			'id_pemasukan'  => 'KM'.date('ymdhis'),
			'anggota' 		=> $id_anggota,
			'bendahara' 	=> $this->session->userdata('id_bendahara'),
			'nominal'		=> $nominal,
			'waktu'			=> date('Y-m-d'),
			'periode'		=> $id_periode,
			'metode'		=> 'tunai'
		];

		$hutang = $this->kas_model->get_hutang_by_id_anggota_id_periode($id_periode, $id_anggota);
		$hapus_hutang = $this->kas_model->hapus_hutang($hutang->id_hutang);
		$inserted = $this->kas_model->insert_pemasukan($pemasukan);
		$updated_saldo = $this->kas_model->tambah_saldo($nominal);
		
		if ($inserted && $updated_saldo && $hapus_hutang) {
			$info = [
				'hasil' => TRUE,
				'pesan' => 'Berhasil melakukan transaksi.'
			];
		} else {
			$info = [
				'hasil' => FALSE,
				'pesan' => 'Gagal melakukan transaksi.'
			];
		}

		echo json_encode($info);
	}

	public function simpan_pemasukan_via_tabungan(){
		$id_anggota = $this->input->post('id_anggota');
		$id_periode = $this->input->post('id_periode');
		$nominal = $this->input->post('nominal');
		$saldo = $this->input->post('saldo');
		if ($nominal > $saldo) {//jika saldo kurang
			echo json_encode(['success' => false]);
		} else {
			$pemasukan = [
				'id_pemasukan'  => 'KM'.date('ymdhis'),
				'anggota' 		=> $id_anggota,
				'bendahara' 	=> $this->session->userdata('id_bendahara'),
				'nominal'		=> $nominal,
				'waktu'			=> date('Y-m-d'),
				'periode'		=> $id_periode,
				'metode'		=> 'tabungan'
			];

			$saldo_baru = $saldo - $nominal;

			$tabungan = [
				'id_tabungan' 	=> 'TB'.date('ymdhis'),
				'anggota'		=> $id_anggota,
				'waktu'			=> date('Y-m-d'),
				'nominal'		=> $nominal,
				'keterangan'	=> 'keluar',
				'saldo'			=> $saldo_baru
			];

			$data = [
				'saldo'			=> $saldo_baru
			];

			$inserted_tabungan 	= $this->kas_model->insert_tabungan($tabungan);
			$updated_anggota 	= $this->kas_model->update_anggota($id_anggota, $data);
			$hutang 			= $this->kas_model->get_hutang_by_id_anggota_id_periode($id_periode, $id_anggota);
			$hapus_hutang 		= $this->kas_model->hapus_hutang($hutang->id_hutang);
			$inserted 			= $this->kas_model->insert_pemasukan($pemasukan);
			$updated_saldo 		= $this->kas_model->tambah_saldo($nominal);
			
			if ($inserted && $updated_saldo && $hapus_hutang && $updated_anggota && $inserted_tabungan) {
				$info = [
					'hasil' => TRUE,
					'pesan' => 'Berhasil melakukan transaksi.'
				];
			} else {
				$info = [
					'hasil' => FALSE,
					'pesan' => 'Gagal melakukan transaksi.'
				];
			}

			echo json_encode($info);
		}

	}

	public function simpan_penarikan() {
	    $password = $this->input->post('password');
	    $nominal = $this->input->post('nominal');
	    $keperluan = $this->input->post('keperluan');

	    // $password = 'admin';
	    // $nominal = '50';
	    // $keperluan = 'debugging';
	    $id_bendahara = $this->session->userdata('id_bendahara');
	    $periode = $this->kas_model->get_periode_aktif();

	    $bendahara = $this->kas_model->cek_password_dan_id_bendahara($password, $id_bendahara);

	    if ($bendahara) {
	        $saldo = $this->kas_model->get_saldo();

	        if ($nominal > $saldo->nominal) {
	            $info = [
	                'hasil' => FALSE,
	                'pesan' => 'Gagal melakukan penarikan karena nominal lebih besar dari saldo yang ada.',
	                'nominal' => $nominal,
	                'saldo' => number_format($saldo->nominal)
	            ];
	        } else {
	            $kurangi_saldo = $this->kas_model->kurangi_saldo($nominal);
                $pengeluaran = [
                	'id_pengeluaran'=> 'KK'.date('ymdhis'),
                	'bendahara' 	=> $id_bendahara,
                	'nominal'		=> $nominal,
                	'keperluan'		=> $keperluan,
                	'waktu'			=> date('Y-m-d'),
					'periode'		=> $periode->id_periode
                ];
                $simpan_pengeluaran = $this->kas_model->insert_pengeluaran($pengeluaran);

	            if ($kurangi_saldo && $simpan_pengeluaran) {
	                // Mendapatkan saldo baru setelah penarikan
	                $saldo_baru = $this->kas_model->get_saldo();

	                $info = [
	                    'hasil'		=> TRUE,
	                    'pesan'		=> 'Berhasil melakukan penarikan saldo.',
	                    'nominal' 	=> $nominal,
	                    'saldo' 	=> number_format($saldo_baru->nominal)
	                ];
	            } else {
	                $info = [
	                    'hasil' => FALSE,
	                    'pesan' => 'Gagal melakukan penarikan.',
	                    'nominal' => $nominal,
	                    'saldo' => number_format($saldo->nominal)
	                ];
	            }
	        }
	    } else {
	        $info = [
	            'hasil' => FALSE,
	            'pesan' => 'Gagal melakukan penarikan.',
	            'nominal' => $nominal,
	            'saldo' => number_format($saldo->nominal)
	        ];
	    }

	    echo json_encode($info);
	}

	public function get_saldo(){
		$data['saldo'] = $this->kas_model->get_saldo();
		$this->load->view('ajax/saldo',$data);
	}

	public function cari_periode(){
		$id_periode = $this->input->post('id_periode');
	    if($id_periode) {
            $data['data_periode'] = $this->kas_model->get_pemasukan_by_periode($id_periode);
            $data['data_pemasukan'] = $this->kas_model->get_pemasukan_by_periode($id_periode);
            $data['data_pengeluaran'] = $this->kas_model->get_pengeluaran_by_periode($id_periode);

            $data['total_pemasukan'] = $this->kas_model->total_pemasukan_by_periode($id_periode);
            $data['total_pengeluaran'] = $this->kas_model->total_pengeluaran_by_periode($id_periode);

            $this->load->view('ajax/data_laporan', $data);
        } else {
            echo "Tidak ada periode yang dipilih.";
        }
	}

	public function get_periode(){
		$data['data_periode'] = $this->kas_model->get_periode();
		foreach ($data['data_periode'] as $periode) {
			$periode->pemasukan = $this->kas_model->get_pemasukan_by_periode($periode->id_periode);
			$periode->pengeluaran = $this->kas_model->get_pengeluaran_by_periode($periode->id_periode);
		}
		// var_dump($data['data_periode']);
		// die();
		$this->load->view('ajax/data_periode',$data);
	}

	public function edit_periode(){
	    $id_periode = $this->input->post('id_periode');
	    $data = [
	        'periode' => $this->input->post('periode'),
	        'nominal' => $this->input->post('nominal')
	    ];

	    $this->kas_model->update_periode($id_periode, $data);
	    $this->session->set_userdata('periode',$this->kas_model->get_periode_aktif());
	    echo json_encode(['status' => 'success', 'periode' => $data]);
	}

	public function tambah_periode(){
		$formTambahPeriode = $this->input->post('formTambahPeriode');
		parse_str($formTambahPeriode,$data);
		$nama_periode = $data['periodeBaru'];
	    $nominal = $data['nominalBaru'];
	    // $nama_periode = 'Pertama';
	    // $nominal = 1000;

	    $periode_sebelumnya = $this->kas_model->get_periode();
	    if ($periode_sebelumnya) {
		    // Non-aktifkan semua periode yang aktif
		    $nonaktifkansemua = $this->kas_model->non_aktif_semua_periode();
		    if ($nonaktifkansemua) {
		        $periode = [
		            'id_periode' => 'PR'.date('ymdhis'),
		            'periode'    => $nama_periode,
		            'nominal'    => $nominal,
		            'status'     => 'aktif'
		        ];
		    	$inserted_periode = $this->kas_model->insert_periode($periode);
	
		    	$anggota = $this->kas_model->get_anggota();
		        foreach ($anggota as $a) {
		        	$hutang = [
						'id_hutang' => 'HT'.uniqid(),
						'anggota'	=> $a->id_anggota,
						'periode'	=> $periode['id_periode'],
						'nominal'	=> $nominal	
		        	];
		        	$inserted_hutang = $this->kas_model->insert_hutang($hutang);
		        }
		    }
	    } else {
	    	$periode = [
	            'id_periode' => 'PR'.date('ymdhis'),
	            'periode'    => $nama_periode,
	            'nominal'    => $nominal,
	            'status'     => 'aktif'
	        ];
	    	$inserted_periode = $this->kas_model->insert_periode($periode);

	    	$anggota = $this->kas_model->get_anggota();
	        foreach ($anggota as $a) {
	        	$hutang = [
					'id_hutang' => 'HT'.uniqid(),
					'anggota'	=> $a->id_anggota,
					'periode'	=> $periode['id_periode'],
					'nominal'	=> $nominal	
	        	];
	        	$inserted_hutang = $this->kas_model->insert_hutang($hutang);
	        }
	    }
		$periode = $this->kas_model->get_periode_aktif();
		$this->session->set_userdata('periode',$periode);
        // echo json_encode(['status' => 'success']);
        $response = ['status' => 'success'];
		log_message('debug', 'Response: ' . json_encode($response));
		echo json_encode($response);
	}

	public function hapus_periode(){
		$id_periode = $this->input->post('id_periode');
		$deleted = $this->kas_model->hapus_periode($id_periode);
		$deleted = $this->kas_model->hapus_hutang_by_periode($id_periode);
		$deleted = $this->kas_model->hapus_pemasukan_by_periode($id_periode);
		$deleted = $this->kas_model->hapus_pengeluaran_by_periode($id_periode);
		if ($deleted) {
		    echo json_encode(['status' => 'success']);
		}
	}

	public function get_anggota(){
		$data['data_anggota'] = $this->kas_model->get_anggota();
		foreach ($data['data_anggota'] as $anggota) {
			$id_anggota = $anggota->id_anggota;
			$anggota->hutang = $this->kas_model->get_hutang_by_anggota($id_anggota);
			$anggota->tabungan = $this->kas_model->get_tabungan_by_anggota($id_anggota);
		}
		// var_dump($data['data_anggota']);
		// die();
		$this->load->view('ajax/data_anggota',$data);
	}

	public function bayar_tanggungan(){
	    // Ambil data dari POST
	    $id_hutang  = $this->input->post('id_hutang');
	    $id_periode = $this->input->post('id_periode');
	    $id_anggota = $this->input->post('id_anggota');
	    $nominal    = $this->input->post('nominal');

	    // Cek periode aktif
	    $tepat_waktu = $this->kas_model->get_periode_aktif_by_id($id_periode);
	    if ($tepat_waktu) {
	        $status = 'tepat waktu';
	    } else {
	        $status = 'terlambat';
	    }

	    // Buat data pemasukan
	    $pemasukan = [
	        'id_pemasukan'  => 'KM'.date('ymdhis'),
	        'anggota'       => $id_anggota,
	        'bendahara'     => $this->session->userdata('id_bendahara'),
	        'nominal'       => $nominal,
	        'waktu'         => date('Y-m-d'),
	        'periode'       => $id_periode,
	        'status'        => $status
	    ];

	    // Lakukan insert, update, dan delete
	    $inserted_pemasukan = $this->kas_model->insert_pemasukan($pemasukan);
	    $updated_saldo      = $this->kas_model->tambah_saldo($nominal);
	    $deleted_hutang     = $this->kas_model->hapus_hutang($id_hutang);

	    // Pastikan semua operasi berhasil
	    if ($inserted_pemasukan && $updated_saldo && $deleted_hutang) {
	        echo json_encode(['status' => 'success']);
	    } else {
	        echo json_encode(['status' => 'error', 'message' => 'Gagal memproses pembayaran.']);
	    }
	}

	public function bayar_tanggungan_via_tabungan(){
	    // Ambil data dari POST
	    $id_hutang  = $this->input->post('id_hutang');
	    $id_periode = $this->input->post('id_periode');
	    $id_anggota = $this->input->post('id_anggota');
	    $nominal    = $this->input->post('nominal');
	    $saldo 		= $this->input->post('saldo');

	    if ($nominal > $saldo) {//jika saldo kurang
			echo json_encode(['success' => false]);
		} else {
		    // Cek periode aktif
		    $tepat_waktu = $this->kas_model->get_periode_aktif_by_id($id_periode);
		    if ($tepat_waktu) {
		        $status = 'tepat waktu';
		    } else {
		        $status = 'terlambat';
		    }

		    // Buat data pemasukan
		    $pemasukan = [
		        'id_pemasukan'  => 'KM'.date('ymdhis'),
		        'anggota'       => $id_anggota,
		        'bendahara'     => $this->session->userdata('id_bendahara'),
		        'nominal'       => $nominal,
		        'waktu'         => date('Y-m-d'),
		        'periode'       => $id_periode,
		        'status'        => $status,
		        'metode'		=> 'tabungan'
		    ];

		    $saldo_baru = $saldo - $nominal;

			$tabungan = [
				'id_tabungan' 	=> 'TB'.date('ymdhis'),
				'anggota'		=> $id_anggota,
				'waktu'			=> date('Y-m-d'),
				'nominal'		=> $nominal,
				'keterangan'	=> 'keluar',
				'saldo'			=> $saldo_baru
			];

			$data = [
				'saldo'			=> $saldo_baru
			];
			
		    // Lakukan insert, update, dan delete
		    $inserted_tabungan 	= $this->kas_model->insert_tabungan($tabungan);
			$updated_anggota 	= $this->kas_model->update_anggota($id_anggota, $data);
			$hutang 			= $this->kas_model->get_hutang_by_id_anggota_id_periode($id_periode, $id_anggota);
			$hapus_hutang 		= $this->kas_model->hapus_hutang($hutang->id_hutang);
			$inserted 			= $this->kas_model->insert_pemasukan($pemasukan);
			$updated_saldo 		= $this->kas_model->tambah_saldo($nominal);

		    // Pastikan semua operasi berhasil
		    if ($inserted && $updated_saldo && $hapus_hutang && $updated_anggota && $inserted_tabungan) {
		        echo json_encode(['status' => 'success']);
		    } else {
		        echo json_encode(['status' => 'error', 'message' => 'Gagal memproses pembayaran.']);
		    }
		}
	}

	public function hapus_anggota(){
		$id_anggota = $this->input->post('id_anggota');
		// $id_anggota = 1;
		$this->kas_model->hapus_anggota($id_anggota);
		$this->kas_model->hapus_hutang_by_anggota($id_anggota);
		// var_dump($deleted_anggota);
		// die();
		echo json_encode(['status' => 'success']);
	}

	public function tambah_anggota(){
		$formTambahAnggota = $this->input->post('formTambahAnggota');
		parse_str($formTambahAnggota,$data);
		$nama_anggota = $data['nama_anggota'];

		$id_anggota = 'AG' . date('ymdhis');

		$anggota = [
			'id_anggota'	=> $id_anggota,
			'nama_anggota'	=> $nama_anggota
		];
		$this->kas_model->tambah_anggota($anggota);

		$periode_aktif = $this->kas_model->get_periode_aktif();
		$hutang = [
			'id_hutang' => 'HT'.uniqid(),
			'anggota'	=> $id_anggota,
			'periode'	=> $periode_aktif->id_periode,
			'nominal'	=> $periode_aktif->nominal	
    	];
    	$this->kas_model->insert_hutang($hutang);
    	$this->session->set_flashdata('user_baru',$id_anggota);

		echo json_encode(['status' => 'success']);
	}

	public function edit_anggota(){
	    $id_periode = $this->input->post('id_anggota');
	    $data = [
	        'nama_anggota' => $this->input->post('nama_anggota')
	    ];

	    $this->kas_model->update_anggota($id_periode, $data);
	    echo json_encode(['status' => 'success', 'anggota' => $data]);
	}

	public function ekspor_excel()
	{
		$id_periode = $this->input->post('id_periode');
		$total_pemasukan = $this->input->post('total_pemasukan');
		$total_pengeluaran = $this->input->post('total_pengeluaran');

		$periode = $this->kas_model->get_periode_by_id($id_periode);
		$data_pemasukan = $this->kas_model->get_pemasukan_by_periode($id_periode);
		$data_pengeluaran = $this->kas_model->get_pengeluaran_by_periode($id_periode);

		// $waktu_awal = $this->input->post('waktu_awal');
		// $waktu_akhir = $this->input->post('waktu_akhir');

		// $laporan_transaksi = $this->transaksi_model->get_by_time_join_user($waktu_awal, $waktu_akhir);

		require(APPPATH. 'phpexcel/Classes/PHPExcel.php');
		require(APPPATH. 'phpexcel/Classes/PHPExcel/Writer/Excel2007.php');

		$object = new PHPExcel();

		$object->getProperties()->setCreator($this->session->userdata('username'));
		$object->getProperties()->setLastModifiedBy($this->session->userdata('username'));
		$object->getProperties()->setTitle("Data Transaksi ".$periode->periode);

		$object->setActiveSheetIndex(0);

		$object->getActiveSheet()->setCellValue('A1', 'Data Pemasukan');
		$object->getActiveSheet()->setCellValue('A2', 'No');
		$object->getActiveSheet()->setCellValue('B2', 'Kode Transaksi');
		$object->getActiveSheet()->setCellValue('C2', 'Anggota');
		$object->getActiveSheet()->setCellValue('D2', 'Bendahara');
		$object->getActiveSheet()->setCellValue('E2', 'Nominal');
		$object->getActiveSheet()->setCellValue('F2', 'Waktu');
		$object->getActiveSheet()->setCellValue('G2', 'Status');
		$object->getActiveSheet()->setCellValue('H2', 'Metode');

		$object->getActiveSheet()->setCellValue('I1', 'Data Pengeluaran');
		$object->getActiveSheet()->setCellValue('I2', 'No');
		$object->getActiveSheet()->setCellValue('J2', 'Kode Transaksi');
		$object->getActiveSheet()->setCellValue('K2', 'Bendahara');
		$object->getActiveSheet()->setCellValue('L2', 'Nominal');
		$object->getActiveSheet()->setCellValue('M2', 'Waktu');
		$object->getActiveSheet()->setCellValue('N2', 'Keperluan');

		$object->getActiveSheet()->setCellValue('B1', 'Total pemasukan : '.$total_pemasukan);
		$object->getActiveSheet()->setCellValue('J1', 'Total pengeluaran : '.$total_pengeluaran);

		$baris = 3;
		$no = 1;

		foreach ($data_pemasukan as $pemasukan) {
			$object->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$object->getActiveSheet()->setCellValue('B' . $baris, $pemasukan->id_pemasukan);
			$object->getActiveSheet()->setCellValue('C' . $baris, $pemasukan->nama_anggota);
			$object->getActiveSheet()->setCellValue('D' . $baris, $pemasukan->username);
			$object->getActiveSheet()->setCellValue('E' . $baris, $pemasukan->nominal);
			$object->getActiveSheet()->setCellValue('F' . $baris, $pemasukan->waktu);
			$object->getActiveSheet()->setCellValue('G' . $baris, $pemasukan->status);
			$object->getActiveSheet()->setCellValue('H' . $baris, $pemasukan->metode);

			$baris++;
		}

		$baris = 3;
		$no = 1;

		foreach ($data_pengeluaran as $pengeluaran) {
			$object->getActiveSheet()->setCellValue('I' . $baris, $no++);
			$object->getActiveSheet()->setCellValue('J' . $baris, $pengeluaran->id_pengeluaran);
			$object->getActiveSheet()->setCellValue('K' . $baris, $pengeluaran->username);
			$object->getActiveSheet()->setCellValue('L' . $baris, $pengeluaran->nominal);
			$object->getActiveSheet()->setCellValue('M' . $baris, $pengeluaran->waktu);
			$object->getActiveSheet()->setCellValue('N' . $baris, $pengeluaran->keperluan);

			$baris++;
		}

		$filename = "Data Transaksi ".$periode->periode .'.xlsx';
		$object->getActiveSheet()->setTitle("Data Transaksi");

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheethtml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		$writer = PHPExcel_IOFactory::createwriter($object, 'Excel2007');
		$writer->save('php://output');

		exit;
	}

	public function live_search_anggota() {
	    $keyword = $this->input->get('keyword');  // Menggunakan $this->input->get untuk input yang aman

	    // Panggil fungsi dari model
	    $data['data_anggota'] = $this->kas_model->get_anggota_by_keyword($keyword);
		foreach ($data['data_anggota'] as $anggota) {
			$id_anggota = $anggota->id_anggota;
			$anggota->hutang = $this->kas_model->get_hutang_by_anggota($id_anggota);
		}
	    // Load view dengan data yang didapat dari model
	    $this->load->view('ajax/live_search_anggota', $data);
	}

	public function live_search_periode() {
	    $keyword = $this->input->get('keyword');  // Menggunakan $this->input->get untuk input yang aman

	    // Panggil fungsi dari model
	    $data['data_periode'] = $this->kas_model->get_periode_by_keyword($keyword);
		foreach ($data['data_periode'] as $periode) {
			$periode->pemasukan = $this->kas_model->get_pemasukan_by_periode($periode->id_periode);
			$periode->pengeluaran = $this->kas_model->get_pengeluaran_by_periode($periode->id_periode);
		}
	    // Load view dengan data yang didapat dari model
	    $this->load->view('ajax/live_search_periode', $data);
	}

	public function pilih_nasabah(){
		$data['list_anggota'] = $this->kas_model->get_anggota();
		$this->load->view('ajax/select_nasabah',$data);
	}

	public function cari_nasabah(){
		$formPilihAnggota = $this->input->post('formPilihNasabah');

		parse_str($formPilihAnggota, $data);
		$id_anggota = $data['id_anggota'];
		$pembayar = $this->kas_model->get_anggota_by_id($id_anggota);

		if ($pembayar) {
			$info = [
				'hasil'			=> TRUE,
				'pesan'			=> 'Menampilkan data pembayar.',
				'id_anggota'	=> $pembayar->id_anggota,
				'nama_anggota'	=> $pembayar->nama_anggota,
				'saldo'			=> number_format($pembayar->saldo)
			];
		} else {
			$info = [
				'hasil' => FALSE,
				'pesan' => 'Gagal menampilkan data pembayar.'
			];
		}

		echo json_encode($info);
	}

	public function tabungan_masuk(){
		$id_anggota = $this->input->post('id_anggota');
		$nominal = $this->input->post('nominal');
		// $id_anggota = 'AG240831043629';
		// $nominal = 1000;

		$anggota = $this->kas_model->get_anggota_by_id($id_anggota);
		$saldo = $anggota->saldo;
		$saldo_baru = $saldo + $nominal;

		$tabungan = [
			'id_tabungan' 	=> 'TB'.date('ymdhis'),
			'anggota'		=> $id_anggota,
			'waktu'			=> date('Y-m-d'),
			'nominal'		=> $nominal,
			'keterangan'	=> 'masuk',
			'saldo'			=> $saldo_baru
		];

		$data = [
			'saldo'			=> $saldo_baru
		];

		$this->kas_model->insert_tabungan($tabungan);
		$this->kas_model->update_anggota($id_anggota, $data);

		echo json_encode(['success' => true]);
	}

	public function tabungan_keluar(){
		$id_anggota = $this->input->post('id_anggota');
		$nominal = $this->input->post('nominal');
		// $id_anggota = 'AG240831043629';
		// $nominal = 1000;

		$anggota = $this->kas_model->get_anggota_by_id($id_anggota);
		$saldo = $anggota->saldo;
		if ($nominal > $saldo) {//jika saldo kurang
			echo json_encode(['success' => false]);
		} else {
			$saldo_baru = $saldo - $nominal;

			$tabungan = [
				'id_tabungan' 	=> 'TB'.date('ymdhis'),
				'anggota'		=> $id_anggota,
				'waktu'			=> date('Y-m-d'),
				'nominal'		=> $nominal,
				'keterangan'	=> 'keluar',
				'saldo'			=> $saldo_baru
			];

			$data = [
				'saldo'			=> $saldo_baru
			];

			$this->kas_model->insert_tabungan($tabungan);
			$this->kas_model->update_anggota($id_anggota, $data);

			echo json_encode(['success' => true]);
		}
	}
}