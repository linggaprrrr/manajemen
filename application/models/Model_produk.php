<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_produk extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	//get pengrimian by pelangggan
	public function get_pengiriman_by_pelanggan($id_pelanggan) {
		$this->db->select('no_pengiriman, produk.kode, sales.nama, pengiriman.alamat, pengiriman.berat, pengiriman.harga, pelanggan_id');
		$this->db->from('pelanggan');
		$this->db->join('pengiriman', 'pengiriman.pelanggan_id = pelanggan.id');
		$this->db->join('produk', 'produk.id = pengiriman.produk_id');
		$this->db->join('sales', 'sales.id = pengiriman.sales_id');
		$this->db->where('pelanggan_id', $id_pelanggan);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_produk_bykode($kode) {
		$this->db->from('produk');
		$this->db->where('kode', $kode);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_sales_bynama($nama) {
		$this->db->from('sales');
		$this->db->where('nama', $nama);
		$query = $this->db->get();
		return $query->result();
	}

	public function search_produk($keyword) {
		$query = $this->db->query("SELECT * FROM produk WHERE kode LIKE '%$keyword%' OR nama LIKE '%$keyword%'");
    return $query->result();
	}

	public function search_sales($keyword) {
		$query = $this->db->query("SELECT * FROM sales WHERE nama LIKE '%$keyword%'");
    return $query->result();
	}

	public function count() {
		return $this->db->get('produk')->num_rows();
	}

	public function insert($data = array()) {

		return $this->db->insert('produk', $data);
	}

	public function insertPengiriman($data = array()) {

		return $this->db->insert('pengiriman', $data);
	}

	public function update($data = array(), $id) {
		$this->db->where('id', $id);
		return $this->db->update('produk', $data);
	} 

	public function get($id) {
		return $this->db->where('id', $id)->get('produk')->row();
	}    
 

	public function delete($id) {
		$this->db->where('id', $id); 
		return $this->db->delete('produk');
	} 

	public function insertHargaPengiriman($data = array()) { 
		return $this->db->insert('pengiriman', $data);
	}
	public function deleteHargaPengiriman($id) {
		$this->db->where('id', $id);
		return $this->db->delete('pengiriman');
	}
	
	public function show($limit = 0, $offset = 0) {
		if($limit != 0) {
			$query = $this->db->limit($limit, $offset)->get('produk');
		} else {
			$query = $this->db->get('produk');
		}
		return $query->result();
	} 

	public function getNama($id) {
		return $this->db->where('id', $id)->get('produk')->row()->nama;
	}
  

	public function deletePengiriman($id) {
		$this->db->where('id', $id);
		return $this->db->delete('pengiriman');
	}
	

	public function countListHargaByPelangganID($pelanggan_id) {
		$this->db->where('pelanggan_id', $pelanggan_id);
		return $this->db->get('pengiriman')->num_rows();
	}

	public function getProdukByPelangganID($pelanggan_id){ 
		$this->db->select('produk.*, pengiriman.harga as harga_pelanggan');
		$this->db->join('produk', 'produk.id = pengiriman.produk_id');
		$this->db->where('pelanggan_id', $pelanggan_id);
		return $this->db->get('pengiriman')->result();
	}

	
	public function getPengirimanByPelangganIDandProdukID($pelanggan_id, $produk_id){ 
		$this->db->select('produk.*, pengiriman.harga as harga_pelanggan, pengiriman.id as harga_id');
		$this->db->join('produk', 'produk.id = pengiriman.produk_id');
		$this->db->where('pelanggan_id', $pelanggan_id);
		$this->db->where('produk.id', $produk_id);
		return $this->db->get('pengiriman')->row();
	}

	public function getPengirimanPelangganByPelangganID($pelanggan_id){
		$this->db->select('pengiriman.*');
		return $this->db->get('pengiriman')->result();	
	} 

}