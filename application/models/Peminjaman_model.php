<?php

class Peminjaman_Model extends MY_Model {
  public function __construct()
  {
    parent::__construct();

    $this->data['table_name']	= 'peminjaman';
		$this->data['primary_key']	= 'no_pinjam';
  }

  public function get_peminjaman()
  {
    $this->db->select('*')->from('peminjaman');
    $this->db->join('siswa', 'peminjaman.kd_siswa = siswa.kd_siswa', 'left');
    $query = $this->db->get();
    return $query;
  }

  public function create_peminjaman($databuku, $data_transaksi)
  {
    $this->db->insert('peminjaman_detil', $databuku);
    $this->insert($data_transaksi);
    return true;
  }

  public function get_book_by_category($kd_kategori)
  {
    $this->db->where('kd_kategori', $kd_kategori);
    $result = $this->db->get('buku')->result();
    return $result;
  }

  public function delete_peminjaman($id)
  {
    return $this->delete($id);
  }

  public function update_peminjaman($id)
  {
    $data = [
      'nm_peminjaman'   => $this->input->post('nm_peminjaman')
    ];
    $query = $this->db->where('kd_peminjaman', $id);
    return $this->db->update('peminjaman', $data);
  }

  public function tmp_pinjam($data) {
    return $this->db->insert('tmp_pinjam', $data);
  }

  public function get_tmp_peminjaman()
  {
    $this->db->select('*')->from('buku');
    $this->db->join('tmp_pinjam', 'tmp_pinjam.kd_buku = buku.kd_buku');
    return $query = $this->db->get();
  }

  public function delete_tmp_peminjaman($id)
  {
    return $this->db->delete('tmp_pinjam', array('kd_buku' => $id));
  }
}