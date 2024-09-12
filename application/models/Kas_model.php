<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kas_model extends CI_Model {
	//---------------------------------------------------------------------------------------------------------------------------
	//START CRUD tb_bendahara
	public function login($username, $password){
		$bendahara = $this->db->get_where('tb_bendahara', ['username' => $username])->row();
		if ($bendahara) {
			if (password_verify($password, $bendahara->password)) {
				return $bendahara;
			} else {
				return FALSE;
			}
		}
	}

	public function cek_password_dan_id_bendahara($password, $id_bendahara){
		$bendahara = $this->db->get_where('tb_bendahara', ['id_bendahara' => $id_bendahara])->row();
		if (password_verify($password, $bendahara->password)) {
			return $bendahara;
		} else {
			return FALSE;
		}
	}
	public function cek_password($password){
		$bendahara = $this->db->get_where('tb_bendahara', ['id_bendahara' => $this->session->userdata('id_bendahara')])->row();
		if (password_verify($password, $bendahara->password)) {
			return $bendahara;
		} else {
			return FALSE;
		}
	}
	public function update_bendahara($bendahara){
		return $this->db->where('id_bendahara', $bendahara['id_bendahara'])->update('tb_bendahara', $bendahara);
	}
	//END CRUD tb_bendahara
	//---------------------------------------------------------------------------------------------------------------------------
	//START CRUD tb_anggota
	public function get_anggota(){
		$this->db->order_by('nama_anggota', 'ASC');
		return $this->db->get('tb_anggota')->result();
	}
	public function get_anggota_by_id($id_anggota){
		return $this->db->get_where('tb_anggota', ['id_anggota' => $id_anggota])->row();
	}
	public function hapus_anggota($id_anggota){
		return $this->db->delete('tb_anggota', ['id_anggota' => $id_anggota]);
	}
	public function tambah_anggota($anggota){
		return $this->db->insert('tb_anggota', $anggota);
	}
	public function get_anggota_by_hutang_periode_aktif(){
		$this->db->select('*');
		$this->db->from('tb_hutang');
		$this->db->join('tb_anggota', 'tb_hutang.anggota = tb_anggota.id_anggota', 'left');
		$this->db->join('tb_periode', 'tb_hutang.periode = tb_periode.id_periode', 'left');
		$this->db->where('status', 'aktif');
		$this->db->order_by('id_anggota', 'DESC');
		return $this->db->get()->result();
	}
	public function update_anggota($id_anggota, $data){
	    return $this->db->where('id_anggota', $id_anggota)->update('tb_anggota', $data);
	}
	public function get_anggota_lunas(){
	    $this->db->select('*');
	    $this->db->from('tb_anggota');
	    $this->db->join('tb_hutang', 'tb_anggota.id_anggota = tb_hutang.anggota', 'left');
	    $this->db->where('tb_hutang.anggota IS NULL');
	    return $this->db->get()->result();
	}
	public function get_anggota_belum_lunas(){
		$this->db->select('*');
	    $this->db->from('tb_anggota');
	    $this->db->join('tb_hutang', 'tb_anggota.id_anggota = tb_hutang.anggota', 'inner');
	    return $this->db->get()->result();
	}
	public function get_anggota_by_keyword($keyword) {
        $this->db->like('nama_anggota', $keyword);
        $this->db->or_like('id_anggota', $keyword);
        $query = $this->db->get('tb_anggota');
        return $query->result();
    }
    public function get_total_saldo_tabungan(){
	    $this->db->select_sum('saldo');
	    $query = $this->db->get('tb_anggota'); // Simpan hasil query dalam variabel
	    if ($query->num_rows() > 0) {
	        return $query->row()->saldo; // Ambil nilai saldo dari hasil query
	    } else {
	        return 0; // Jika tidak ada hasil, kembalikan 0
	    }
	}
	//END CRUD tb_anggota
	//---------------------------------------------------------------------------------------------------------------------------
	//START CRUD tb_pemasukan
	public function insert_pemasukan($pemasukan){
		return $this->db->insert('tb_pemasukan', $pemasukan);
	}
	public function get_pemasukan_by_periode($id_periode) {
        $this->db->select('*');
        $this->db->from('tb_pemasukan');
        $this->db->join('tb_bendahara', 'tb_pemasukan.bendahara = tb_bendahara.id_bendahara', 'left');
        $this->db->join('tb_anggota', 'tb_pemasukan.anggota = tb_anggota.id_anggota', 'left');
		$this->db->order_by('id_pemasukan', 'DESC');
        $this->db->where('periode', $id_periode); // Filter berdasarkan periode
        return $this->db->get()->result();
    }
     // Method untuk mendapatkan total pemasukan berdasarkan id_periode
    public function total_pemasukan_by_periode($id_periode) {
        $this->db->select_sum('nominal'); // Menghitung jumlah total dari kolom nominal
        $this->db->where('periode', $id_periode); // Menambahkan kondisi periode
        $query = $this->db->get('tb_pemasukan'); // Mengambil data dari tabel pemasukan
        $result = $query->row(); // Mengambil hasil query sebagai objek

        return $result ? $result->nominal : 0; // Mengembalikan hasil nominal, jika tidak ada data kembalikan 0
    }
    public function hapus_pemasukan_by_periode($id_periode){
		return $this->db->delete('tb_pemasukan', ['periode' => $id_periode]);
	}
	public function get_pemasukan_by_periode_aktif(){
	    $this->db->select_sum('tb_pemasukan.nominal');
	    $this->db->from('tb_pemasukan');
	    $this->db->join('tb_periode', 'tb_pemasukan.periode = tb_periode.id_periode', 'left');
	    $this->db->where('tb_periode.status', 'aktif');
	    return $this->db->get()->result();
	}
	//END CRUD tb_pemasukan
	//---------------------------------------------------------------------------------------------------------------------------
	//START CRUD tb_saldo
	public function get_saldo(){
		return $this->db->get_where('tb_saldo', ['id_saldo' => 1])->row();
	}

	public function tambah_saldo($nominal){
	    $this->db->set('nominal', "nominal + $nominal", FALSE);
	    return $this->db->update('tb_saldo');
	}

	public function kurangi_saldo($nominal){
	    $this->db->set('nominal', "nominal - $nominal", FALSE);
	    return $this->db->update('tb_saldo');
	}
	//END CRUD tb_saldo
	//---------------------------------------------------------------------------------------------------------------------------
	//START CRUD tb_pengeluaran
	public function insert_pengeluaran($pengeluaran){
		return $this->db->insert('tb_pengeluaran', $pengeluaran);
	}
	public function get_pengeluaran_by_periode($id_periode) {
        $this->db->select('*');
        $this->db->from('tb_pengeluaran');
        $this->db->join('tb_bendahara', 'tb_pengeluaran.bendahara = tb_bendahara.id_bendahara', 'left');
        $this->db->where('periode', $id_periode); // Filter berdasarkan periode
		$this->db->order_by('id_pengeluaran', 'DESC');
        return $this->db->get()->result();
    }
    // Method untuk mendapatkan total pengeluaran berdasarkan id_periode
    public function total_pengeluaran_by_periode($id_periode) {
        $this->db->select_sum('nominal'); // Menghitung jumlah total dari kolom nominal
        $this->db->where('periode', $id_periode); // Menambahkan kondisi periode
        $query = $this->db->get('tb_pengeluaran'); // Mengambil data dari tabel pengeluaran
        $result = $query->row(); // Mengambil hasil query sebagai objek

        return $result ? $result->nominal : 0; // Mengembalikan hasil nominal, jika tidak ada data kembalikan 0
    }
    public function hapus_pengeluaran_by_periode($id_periode){
		return $this->db->delete('tb_pengeluaran', ['periode' => $id_periode]);
	}
	public function get_pengeluaran_by_periode_aktif(){
	    $this->db->select_sum('tb_pengeluaran.nominal');
	    $this->db->from('tb_pengeluaran');
	    $this->db->join('tb_periode', 'tb_pengeluaran.periode = tb_periode.id_periode', 'left');
	    $this->db->where('tb_periode.status', 'aktif');
	    return $this->db->get()->result();
	}
	//END CRUD tb_saldo
	//---------------------------------------------------------------------------------------------------------------------------
	//START CRUD tb_periode
	public function get_periode(){
		$this->db->order_by('id_periode', 'DESC');
		return $this->db->get('tb_periode')->result();
	}
	public function get_periode_by_id($id_periode){
		return $this->db->get_where('tb_periode', ['id_periode' => $id_periode])->row();
	}
	public function get_periode_aktif(){
		return $this->db->get_where('tb_periode', ['status' => 'aktif'])->row();
	}
	public function update_periode($id_periode, $data){
	    return $this->db->where('id_periode', $id_periode)->update('tb_periode', $data);
	}
	public function non_aktif_semua_periode(){
	    return $this->db->where('status', 'aktif')->update('tb_periode', ['status' => 'nonaktif']);
	}
	public function insert_periode($periode){
	    return $this->db->insert('tb_periode', $periode);
	}
	public function hapus_periode($id_periode){
		return $this->db->delete('tb_periode', ['id_periode' => $id_periode]);
	}
	public function get_periode_aktif_by_id($id_periode){
		return $this->db->get_where('tb_periode', ['status' => 'aktif', 'id_periode' => $id_periode])->row();
	}
	public function get_periode_by_keyword($keyword) {
        $this->db->like('periode', $keyword);
        $this->db->or_like('nominal', $keyword);
        $this->db->or_like('status', $keyword);
        $this->db->or_like('id_periode', $keyword);
        $query = $this->db->get('tb_periode');
        return $query->result();
    }
	//END CRUD tb_periode
	//---------------------------------------------------------------------------------------------------------------------------
	//START CRUD tb_hutang
	public function insert_hutang($hutang){
		return $this->db->insert('tb_hutang',$hutang);
	}
	public function get_hutang_by_anggota($id_anggota){
		$this->db->select('*');
		$this->db->from('tb_hutang');
		$this->db->join('tb_periode','tb_hutang.periode = tb_periode.id_periode');
		$this->db->where(['anggota' => $id_anggota]);
		$this->db->order_by('id_hutang', 'DESC');
		return $this->db->get()->result();
	}
	public function hapus_hutang($id_hutang){
		return $this->db->delete('tb_hutang', ['id_hutang' => $id_hutang]);
	}
	public function get_hutang_by_id_anggota_id_periode($id_periode, $id_anggota){
		return $this->db->get_where('tb_hutang', ['periode' => $id_periode, 'anggota' => $id_anggota])->row();
	}
	public function hapus_hutang_by_periode($id_periode){
		return $this->db->delete('tb_hutang', ['periode' => $id_periode]);
	}
	public function hapus_hutang_by_anggota($id_anggota){
		return $this->db->delete('tb_hutang', ['anggota' => $id_anggota]);
	}
	public function get_hutang(){
		return $this->db->get('tb_hutang')->result();
	}
	//END CRUD tb_hutang
	//---------------------------------------------------------------------------------------------------------------------------
	//START CRUD tb_tabungan
	public function insert_tabungan($tabungan){
		return $this->db->insert('tb_tabungan', $tabungan);
	}
	public function get_tabungan_by_anggota($id_anggota){
		return $this->db->get_where('tb_tabungan', ['anggota' => $id_anggota])->result();
	}
}
