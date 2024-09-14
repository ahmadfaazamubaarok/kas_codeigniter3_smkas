<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		if ($this->input->method() === 'post') {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$bendahara = $this->kas_model->login($username, $password);

			if ($bendahara) {
				$periode = $this->kas_model->get_periode_aktif();
				$this->session->set_userdata('id_bendahara',$bendahara->id_bendahara);
				$this->session->set_userdata('username',$bendahara->username);
				$this->session->set_userdata('ruang',$bendahara->ruang);
				$this->session->set_userdata('periode',$periode);
				$this->session->set_flashdata('welcome','welcome');
				redirect('page');
			}else{
				$this->session->set_flashdata('salah','salah');
				redirect('auth');
			}
		}
		$this->load->view('login');
	}

	public function ubah_password(){
		$password_lama = $this->input->post('password_lama', TRUE);
		$password_baru = $this->input->post('password_baru', TRUE);
		$konfirmasi_password_baru = $this->input->post('konfirmasi_password_baru', TRUE);

		$benar = $this->kas_model->cek_password($password_lama);
		if ($benar) {
			if ($password_baru === $konfirmasi_password_baru) {
				$password_baru_hash = password_hash($password_baru, PASSWORD_BCRYPT);
				$bendahara = [
					'id_bendahara' 	=> $this->session->userdata('id_bendahara'),
					'password'		=> $password_baru_hash
				];
				$this->kas_model->update_bendahara($bendahara);
				redirect('auth');
			} else {
				redirect('auth');
			}
		}
	}
	public function ubah_username(){
		$username = $this->input->post('username');
		$bendahara = [
			'id_bendahara' 	=> $this->session->userdata('id_bendahara'),
			'username'		=> $username
		];
		$this->kas_model->update_bendahara($bendahara);
		redirect('auth');
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('auth');
	}
}
