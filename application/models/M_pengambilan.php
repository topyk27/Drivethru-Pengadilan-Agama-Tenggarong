<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
/**
 * 
 */
class M_pengambilan extends CI_Model
{
	private $table = "pengambilan";
	public $id;
	public $no_perkara;
	public $pihak;
	public $nama;
	public $ac;
	public $salinan;
	public $no_hp;
	public $no_ac;
	public $jadwal;
	public $antrian;
	public $created_at;
	public $updated_at;

	public function rules()
	{
		return
		[
			[
				'field' => 'no_perkara',
				'label' => 'no_perkara',
				'rules' => 'required',
			],
			// [
			// 	'field' => 'jenis_perkara',
			// 	'label' => 'jenis_perkara',
			// 	'rules' => 'required',
			// ],
			[
				'field' => 'pihak',
				'label' => 'pihak',
				'rules' => 'required',
			],
			[
				'field' => 'nama',
				'label' => 'nama',
				'rules' => 'required',
			],
			[
				'field' => 'no_hp',
				'label' => 'no_hp',
				'rules' => 'numeric|required',
				'errors' => array('numeric' => 'Masukkan hanya angka saja.')
			],
			[
				'field' => 'pengambilan[]',
				'label' => 'pengambilan',
				'rules' => 'required|callback_cek_ac_dah_diambil',
				'errors' => array('required' => 'Pilih produk yang ingin diambil')
			],
			// [
			// 	'field' => 'no_ac',
			// 	'label' => 'no_ac',
			// 	'rules' => 'required',
			// ],
			[
				'field' => 'jadwal',
				'label' => 'jadwal',
				'rules' => 'required|callback_cek_jadwal',
			],
		];
	}

	public function rules_cetak()
	{
		return
		[
			[
				'field' => 'no_perkara',
				'label' => 'no_perkara',
				'rules' => 'required',
			],
			[
				'field' => 'no_hp',
				'label' => 'no_hp',
				'rules' => 'numeric|required',
				'errors' => array('numeric' => 'Masukkan hanya angka saja.')
			]
		];
	}

	public function insert()
	{
		$post = $this->input->post();
		// $this->no_perkara = $post['no_perkara'];
		// $this->jenis_perkara = $post['jenis_perkara'];
		// $this->no_perkara_tahun = $post['no_perkara_tahun'];
		$this->no_perkara = $post['no_perkara'].$post['jenis_perkara'].$post['no_perkara_tahun']."/".$this->session->userdata('nama_pa_pendek');
		$this->pihak = $post['pihak'];
		$this->nama = $post['nama'];
		$this->no_hp = $post['no_hp'];
		$pengambilan = $post['pengambilan'];
		if(sizeof($pengambilan)==2)
		{
			$this->ac = true;
			$this->salinan = true;
		}
		else
		{
			if($pengambilan[0]=="ac")
			{
				$this->ac = true;
				$this->salinan = false;
			}
			else
			{
				$this->ac = false;
				$this->salinan = true;
			}
		}
		
		$this->no_ac = $post['no_ac'];
		$this->jadwal = $post['jadwal'];
		
		$this->antrian = $this->ambil_antrian($this->jadwal);
		$this->created_at = date('Y-m-d H:i:s');
		$this->updated_at = date('Y-m-d H:i:s');
		$this->db->insert($this->table,$this);
		// print_r($this->db->last_query());

		$respon['success'] = $this->db->affected_rows();
		$respon['antrian'] = $this->antrian;
		$respon['jadwal'] = $this->jadwal;
		$respon['no_perkara'] = $this->no_perkara;
		$respon['nama'] = $this->nama;
		$respon['ac'] = $this->ac;
		$respon['salinan'] = $this->salinan;
		return $respon;

	}


	public function cek_antrian($jadwal) //cek jumlah antrian hari itu
	{
		$statement = "SELECT COUNT(id) AS jumlah FROM pengambilan WHERE jadwal = '".$jadwal."'" ;
		$query = $this->db->query($statement);
		// print_r($query->result());
		$row = $query->row();
		// print_r($query->row()->jumlah);
		// print_r("ini row". $row->jumlah);
		return $row->jumlah;
	}

	public function cek_udah_ambil($no_perkara,$pihak,$jadwal)
	{
		$statement = "SELECT * FROM pengambilan WHERE no_perkara='$no_perkara' AND pihak='$pihak' AND jadwal='$jadwal'";
		$query = $this->db->query($statement);
		if($query->num_rows()>0) //berarti ada isinya gak bisa ambil antrian lagi
		{
			return "udah ambil";
		}
		else
		{
			return "belum ambil";
		}
	}

	public function cek_udah_ambil_ac($no_perkara,$pihak)
	{
		if($pihak=="penggugat")
		{
			$statement = "SELECT p.perkara_id, p.nomor_akta_cerai, p.tgl_penyerahan_akta_cerai AS penyerahan, pe.nomor_perkara FROM perkara_akta_cerai p, perkara pe WHERE pe.perkara_id = p.perkara_id AND pe.nomor_perkara = '$no_perkara'";
		}
		else
		{
			$statement = "SELECT p.perkara_id, p.nomor_akta_cerai, p.tgl_penyerahan_akta_cerai_pihak2 AS penyerahan, pe.nomor_perkara FROM perkara_akta_cerai p, perkara pe WHERE pe.perkara_id = p.perkara_id AND pe.nomor_perkara = '$no_perkara'";
		}
		$query = $this->db->query($statement);
		
		$row=$query->row();
		if(is_null($row->penyerahan))
		{
			return true; //berarti belum abmil
		}
		else
		{
			return false;
		}
	}

	public function ambil_antrian($jadwal)
	{
		$statement = "SELECT MAX(antrian) AS antrian FROM pengambilan WHERE jadwal = '".$jadwal."'" ;
		$query = $this->db->query($statement);
		$row = $query->row();
		if(!is_null($row->antrian)) //berarti sudah ada yg ambil
		{
			return $row->antrian+1;
		}
		else //kalo belum ada yg ambil
		{
			return 1;
		}
	}

	public function cetak_jadwal()
	{
		$post = $this->input->post();
		$no_perkara = $post['no_perkara'];
		// $no_perkara = "1262/Pdt.G/2019/PA.Tgr";
		$no_hp = $post['no_hp'];
		// $no_hp = "085250565427";
		$statement = "SELECT * FROM pengambilan WHERE no_perkara ='".$no_perkara."' AND no_hp='".$no_hp."' ORDER BY created_at DESC LIMIT 1";
		$query = $this->db->query($statement);
		// $result = $query->row();
		// print_r($query->row());
		// if(empty($query->row()))
		// {
		// 	print_r("kosong");
		// }
		// else
		// {
		// 	print_r("ada");
		// }
		return $query->row();
	}

	public function getAll()
	{
		$this->db->from($this->table);
		$this->db->order_by('jadwal','desc');
		return $this->db->get()->result();
	}

	public function getAllToday()
	{
		$this->db->from($this->table);
		$this->db->where('jadwal', date("Y-m-d"));
		$this->db->order_by('jadwal','desc');
		return $this->db->get()->result();
	}

	public function getById($id)
	{
		return $this->db->get_where($this->table,["id" => $id])->row();
	}

	public function update($id)
	{
		$post = $this->input->post();
		$this->id = $id;
		$this->no_perkara = $post['no_perkara'];
		$this->pihak = $post['pihak'];
		$this->nama = $post['nama'];
		$pengambilan = $post['pengambilan'];
		
		if(sizeof($pengambilan)==2)
		{
			$this->ac = true;
			$this->salinan = true;
		}
		else
		{
			if($pengambilan[0]=="ac")
			{
				$this->ac = true;
				$this->salinan = false;
			}
			else
			{
				$this->ac = false;
				$this->salinan = true;
			}
		}
		$this->no_hp = $post['no_hp'];
		$this->no_ac = $post['no_ac'];
		$this->jadwal = $post['jadwal'];
		$this->antrian = $post['antrian'];
		$this->db->update($this->table, $this, ['id' => $id]);
		return $this->db->affected_rows();
		// print_r($this->db->last_query());
	}

	public function delete($id)
	{
		return $this->db->delete($this->table, ['id' => $id]);
	}

	public function getStatistik()
	{
		$now = date('Y-m-d');
		$bulan = date('n');
		$tahun = date('Y');
		$statement = "SELECT COUNT(id) as total, DATE_FORMAT(jadwal,'%e') AS tanggal FROM pengambilan WHERE YEAR(jadwal) = $tahun AND MONTH(jadwal) = $bulan GROUP BY jadwal";
		$query = $this->db->query($statement);
		$result = $query->result();
		return $result;
		// $data_statistik = array();
		// foreach ($result as $r) {
		// 	$data_statistik[$r->tanggal] = array(
		// 		"total" => $r->total,
		// 		"tanggal" => $r->tanggal,
		// 	);
		// }
		// return $data_statistik;
	}

	public function getByDate()
	{
		$post = $this->input->post();
		// $tanggal_awal = "2020-10-01";
		$tanggal_awal = $post['tanggal_awal'];
		// $tanggal_akhir = "2020-10-31";
		$tanggal_akhir = $post['tanggal_akhir'];
		$statement = "SELECT * FROM pengambilan WHERE jadwal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY jadwal ASC";
		// print_r($statement);
		$query = $this->db->query($statement);
		return $query->result();
	}

	public function cek_data_perkara()
	{
		$post = $this->input->post();
		$no_perkara = $post['nmr_perkara'];
		$perkara = $post['perkara'];
		// $no_perkara = "900/Pdt.G/2022/PA.Tgr";
		// $perkara = "gugatan";
		// $no_perkara = "502/Pdt.P/2019/PA.Tgr";
		// $perkara = "permohonan";
		if($perkara == "gugatan")
		{
			// fix buat cek ac terbit atau belum tapi yg versi 1
			// $statement = "SELECT p.perkara_id, p.pihak1_text AS p, p.pihak2_text AS t, ac.nomor_akta_cerai FROM perkara AS p, perkara_akta_cerai AS ac WHERE p.perkara_id = ac.perkara_id AND p.nomor_perkara = '$no_perkara' ";
			$statement = "SELECT perkara_id, pihak1_text AS p, pihak2_text AS t, tahapan_terakhir_text AS tahapan FROM perkara where nomor_perkara = '$no_perkara' ";
		}
		else
		{
			$statement = "SELECT perkara_id, pihak1_text AS p, pihak2_text AS t, tahapan_terakhir_text AS tahapan FROM perkara where nomor_perkara = '$no_perkara' ";
		}
		$query = $this->db->query($statement);
		$result = $query->result();
		$row = $query->row();
		if(!empty($result) && $perkara=="gugatan") //perkara terdaftar tapi ac nya udah terbit belum
		{
			$tahapan = $row->tahapan;
			$statement1 = "SELECT p.perkara_id, p.pihak1_text AS p, p.pihak2_text AS t, p.tahapan_terakhir_text AS tahapan, ac.nomor_akta_cerai FROM perkara AS p, perkara_akta_cerai AS ac WHERE p.perkara_id = ac.perkara_id AND p.nomor_perkara = '$no_perkara' ";
			$query1 = $this->db->query($statement1);
			$result1 = $query1->result();
			if(!empty($result1)) //berarti ac nya terbit
			{
				return $result1;
			}
			else if($tahapan!="Putusan" && $tahapan!="Akta Cerai") //perkara terdaftar tapi belum putus
			{
				return "belum putus";
			}
			else //berarti ac nya belum return yg result pertama
			{
				return $result;
			}

		}
		else if(!empty($result) && $perkara!="gugatan")
		{
			return $result;
		}
		else
		{
			return "kosong";
		}
		// if(!empty($result))
		// {
			// ini untuk cek data ac udah terbit atau belum
			// if($perkara == "gugatan")
			// {
			// 	if(isset($row->nomor_akta_cerai))
			// 	{
			// 		return $result;
			// 	}
			// 	else
			// 	{
			// 		return "belum terbit";
			// 	}
			// }
			// else
			// {
			// 	return $result;
			// }
		// 	return $result;
		// }
		// else
		// {
		// 	return "kosong";
		// }
	}

	public function cetak_laporan_pengambilan($bulan,$tahun)
	{
		$statement = "SELECT * FROM pengambilan WHERE MONTH(jadwal)=$bulan AND YEAR(jadwal)=$tahun ORDER BY jadwal ASC ";
		$query = $this->db->query($statement);
		return $query->result();
	}

	public function laporan_pengambilan_getByDate()
	{
		$post = $this->input->post();
		$bulan = $post['bulan'];
		$tahun = $post['tahun'];
		$statement = "SELECT * FROM pengambilan WHERE MONTH(jadwal)=$bulan AND YEAR(jadwal)=$tahun ORDER BY jadwal ASC ";
		$query = $this->db->query($statement);
		return $query->result();
	}

	public function quick_get($no_perkara,$jenis,$tahun,$nama_pa)
	{
		$jenis_perkara = $jenis == 'Pdt.G' ? "gugatan" : "permohonan";
		$no_perkara_full = $no_perkara.'/'.$jenis.'/'.$tahun.'/'.$nama_pa;
		if($jenis_perkara=="gugatan")
		{
			$statement = "SELECT perkara_id, pihak1_text AS p, pihak2_text AS t, tahapan_terakhir_text AS tahapan FROM perkara where nomor_perkara = '$no_perkara_full' ";
		}
		else
		{
			$statement = "SELECT perkara_id, pihak1_text AS p, pihak2_text AS t, tahapan_terakhir_text AS tahapan FROM perkara where nomor_perkara = '$no_perkara_full' ";
		}
		$query = $this->db->query($statement);
		$result = $query->result();
		$row = $query->row();
		if(!empty($result) && $jenis_perkara=="gugatan") //perkara terdaftar tapi ac nya udah terbit belum
		{
			$tahapan = $row->tahapan;
			$statement1 = "SELECT p.perkara_id, p.pihak1_text AS p, p.pihak2_text AS t, p.tahapan_terakhir_text AS tahapan, ac.nomor_akta_cerai FROM perkara AS p, perkara_akta_cerai AS ac WHERE p.perkara_id = ac.perkara_id AND p.nomor_perkara = '$no_perkara_full' ";
			$query1 = $this->db->query($statement1);
			$result1 = $query1->result();
			if(!empty($result1)) //berarti ac nya terbit
			{
				return $result1;
			}
			else if($tahapan!="Putusan" && $tahapan!="Akta Cerai") //perkara terdaftar tapi belum putus
			{
				return "belum putus";
			}
			else //berarti ac nya belum return yg result pertama
			{
				return $result;
			}

		}
		else if(!empty($result) && $jenis_perkara!="gugatan")
		{
			return $result;
		}
		else
		{
			return "kosong";
		}

	}

	public function get_blacklist($no_perkara,$pihak)
	{
		$statement = "SELECT alasan FROM blacklist WHERE no_perkara = '$no_perkara' AND pihak = '$pihak' ";
		$query = $this->db->query($statement);
		$result = $query->result();
		$row = $query->row();
		$respon = [];
		if(!empty($result))
		{
			$respon['alasan'] = $row->alasan;
			$respon['success'] = false;
		}
		else
		{
			$respon['success'] = true;
		}
		return $respon;
	}

	public function get_hari_libur($tanggal_pengambilan)
	{
		$weekend = $this->isWeekend($tanggal_pengambilan);
		if($weekend == "kerja")
		{
			$statement = "SELECT nama FROM libur WHERE tanggal='$tanggal_pengambilan'";
			$query = $this->db->query($statement);
			$result = $query->result();
			$row = $query->row();
			$respon = [];
			if(!empty($result))
			{
				$respon['alasan'] = "Libur " .$row->nama;
				$respon['success'] = false;
			}
			else
			{
				$respon['success'] = true;
			}
			return $respon;
		}
		else
		{
			$respon['alasan'] = "Hari ". $weekend . " libur";
			$respon['success'] = false;
			return $respon;
		}
	}

	public function isWeekend($tanggal)
	{
		$weekend = date('N', strtotime($tanggal));
		if($weekend > 5)
		{
			if($weekend == 6)
			{
				return "Sabtu";
			}
			else
			{
				return "Minggu";
			}
		}
		else
		{
			return "kerja";
		}
	}
}

 ?>