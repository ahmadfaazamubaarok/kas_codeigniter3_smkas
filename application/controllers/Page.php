<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller{

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_bendahara')){
			redirect('auth');
		}
	}

	//START PAGES

	public function index(){
		$data['total_saldo'] = $this->kas_model->get_saldo();
		$data['total_anggota'] = count($this->kas_model->get_anggota());
		$data['total_periode'] = count($this->kas_model->get_periode());
		$data['total_hutang'] = count($this->kas_model->get_hutang());

		$data['total_pemasukan'] = 0;
		$data['total_pengeluaran'] = 0;
		$total_pemasukan = $this->kas_model->get_pemasukan_by_periode_aktif();
		$total_pengeluaran = $this->kas_model->get_pengeluaran_by_periode_aktif();
		$data['total_pemasukan'] += $total_pemasukan[0]->nominal;
		$data['total_pengeluaran'] += $total_pengeluaran[0]->nominal;
		// var_dump($total_pemasukan[0]->nominal);
		// die();

		$jumlah_anggota_lunas = count($this->kas_model->get_anggota_lunas());
		$jumlah_anggota_belum_lunas = count($this->kas_model->get_anggota_belum_lunas());

		$data['persentase_anggota_lunas'] = ($jumlah_anggota_lunas > 0) ? ($jumlah_anggota_lunas / $data['total_anggota']) * 100 : 0;
		$data['persentase_anggota_belum_lunas'] = ($jumlah_anggota_belum_lunas > 0) ? ($jumlah_anggota_belum_lunas / $data['total_anggota']) * 100 : 0;
		$this->load->view('dashboard',$data);
	}

	public function transaksi(){
		$this->load->view('transaksi');
	}
	
	public function anggota(){
		$this->load->view('anggota');
	}

	public function periode(){
		$this->load->view('periode');
	}
	//END PAGES
	public function open_pengeluaran(){
		$this->session->set_flashdata('open_pengeluaran','open');
		redirect('page/transaksi');
	}
}