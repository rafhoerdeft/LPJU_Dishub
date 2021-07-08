<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class MasterData extends CI_Model {

	// Select * from table
	public function getData($table){
		return $this->db->GET($table);
	}

	// Select field from table
	public function getSelectData($select,$table){
		return $this->db->SELECT($select)
						->GET($table);
	}

	// Select * from table where = ?
	public function getDataWhere($table,$where){
		return $this->db->SELECT('*')
						->WHERE($where)
						->GET($table);
	}

	// Select field from table where = ?
	public function getWhereData($select,$table,$where){
		return $this->db->SELECT($select)
						->WHERE($where)
						->GET($table);
	}

	// Select field from table where = ? limit =?
	public function getWhereDataLimit($select,$table,$where,$limit){
		return $this->db->SELECT($select)
						->WHERE($where)
						->LIMIT($limit)
						->GET($table);
	}

	// Select field from table '%like%'
	public function getWhereDataLike($select,$table,$field,$keyword){
		return $this->db->SELECT($select)
						->LIKE($field, $keyword)
						->GET($table);
	}

	// public function getWhereBetweenData{}
	// public function notin

	// Select field from table order by
	public function getSelectDataOrder($select,$table,$by,$order){
		return $this->db->SELECT($select)
						->order_by($by, $order)
						->GET($table);
	}

	// Select field from table group by
	public function getSelectDataGroup($select,$table,$group){
		return $this->db->SELECT($select)
						->group_by($group)
						->GET($table);
	}

	// Select field from table where = ? order by
	public function getWhereDataOrder($select,$table,$where,$by,$order){
		return $this->db->SELECT($select)
						->WHERE($where)
						->order_by($by,$order)
						->GET($table);
	}

	// Select field from table where group by
	public function getWhereDataGroup($select,$table,$where,$group){
		return $this->db->SELECT($select)
						->WHERE($where)
						->group_by($group)
						->GET($table);
	}

	// Select field from table where group by limit
	public function getWhereDataGroupLimit($select,$table,$where,$group,$limit){
		return $this->db->SELECT($select)
						->WHERE($where)
						->LIMIT($limit)
						->group_by($group)
						->GET($table);
	}

	// Select field from table where = ? order by '?' limit
	public function getWhereDataLimitOrder($select,$table,$where,$limit,$by,$order){
		return $this->db->SELECT($select)
						->WHERE($where)
						->LIMIT($limit)
						->order_by($by, $order)
						->GET($table);
	}

	// Select field from table group, order by
	public function getSelectDataGroupOrder($select,$table,$group,$by,$order){
		return $this->db->SELECT($select)
						->group_by($group)
						->order_by($by,$order)
						->GET($table);
	}

	public function getWhereDataGroupOrder($select,$table,$where,$group,$by,$order){
		return $this->db->SELECT($select)
						->WHERE($where)
						->group_by($group)
						->order_by($by,$order)
						->GET($table);
	}

	// Select field from table group, order by limit
	public function getSelectDataLimitGroupOrder($select,$table,$limit,$group,$by,$order){
		return $this->db->SELECT($select)
						->LIMIT($limit)
						->group_by($group)
						->order_by($by,$order)
						->GET($table);
	}

	// Select field from table where = ? group, order by limit
	public function getWhereDataLimitGroupOrder($select,$table,$where,$limit,$group,$by,$order){
		return $this->db->SELECT($select)
						->WHERE($where)
						->LIMIT($limit)
						->group_by($group)
						->order_by($by,$order)
						->GET($table);
	}

	public function getWhereDataLimitIndexOrder($select='',$table='',$where='',$index=0,$limit='',$by='',$order=''){
		if ($where != '') {
			$data = $this->db->SELECT($select)
						 ->WHERE($where)
						 ->LIMIT($limit, $index)
						 ->order_by($by, $order)
						 ->GET($table);
		}else{
			$data = $this->db->SELECT($select)
						 ->LIMIT($limit, $index)
						 ->order_by($by, $order)
						 ->GET($table);
		}
		return $data;
	}

	// insert into table values(field)
	public function inputData($data,$table){
		return $this->db->insert($table,$data);
	}

	// replace field from table
	public function replaceData($data,$table){
		return $this->db->replace($table,$data);
	}

	// update table set = ? val = ? where = ?
	public function editData($where,$data,$table){
		$this->db->where($where);
			return $this->db->update($table,$data);
	}

	// delete table where = ?
	public function deleteData($where,$table){
		$this->db->where($where);
			return $this->db->delete($table);
	}	

	public function idUserBaru(){
		return $this->db->query('select id_user from user order by id_user desc limit 1');
	}

	public function laporanBulanan($start,$end){
		return $this->db->query("SELECT detail_pemesanan.kd_alat, nm_alat, sum(jml_alt) as jumlah, sum(total_hrg) as pendapatan FROM detail_pemesanan,alat where detail_pemesanan.kd_alat=alat.kd_alat and (tgl_sewa BETWEEN '$start' and '$end') GROUP by kd_alat");
	}

	public function showGrafikBar(){
		return $this->db->query("SELECT detail_pemesanan.kd_alat, nm_alat, sum(jml_alt) as jumlah, sum(total_hrg) as pendapatan FROM validasi_pemesanan, pemesanan, detail_pemesanan, alat where validasi_pemesanan.id_pms = pemesanan.id_pms and pemesanan.id_pms=detail_pemesanan.id_pms and detail_pemesanan.kd_alat=alat.kd_alat and month(tgl_sewa) = month(now()) and year(tgl_sewa) = year(now()) GROUP by kd_alat");
	}

	public function showGrafikBarBasedInput($bulan,$tahun){
		return $this->db->query("SELECT detail_pemesanan.kd_alat, nm_alat, sum(jml_alt) as jumlah, sum(total_hrg) as pendapatan FROM validasi_pemesanan, pemesanan, detail_pemesanan,alat where validasi_pemesanan.id_pms = pemesanan.id_pms and pemesanan.id_pms=detail_pemesanan.id_pms and detail_pemesanan.kd_alat=alat.kd_alat and month(tgl_sewa) = '$bulan' and year(tgl_sewa) = '$tahun' GROUP by kd_alat");
	}
}