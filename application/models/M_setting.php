<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class M_setting extends CI_Model
{
	
	private $table = "setting";
	public $ketua;
	public $ketua_nip;
	public $panitera;
	public $panitera_nip;

	public function logo_rules()
	{
		return [
			['field' => 'logo',
			'label' => 'logo',
			'rules' => 'callback_validate_image'
			]
		];
	}

	public function blacklist_rules()
	{
		return [
			[
				'field' => 'jenis_perkara',
				'label' => 'jenis_perkara',
				'rules' => 'required'
			],
			[
				'field' => 'no_urut',
				'label' => 'no_urut',
				'rules' => 'required'
			],
			[
				'field' => 'no_perkara_tahun',
				'label' => 'no_perkara_tahun',
				'rules' => 'required'
			],
			[
				'field' => 'no_perkara',
				'label' => 'no_perkara',
				'rules' => 'required'
			],
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
				'field' => 'alasan',
				'label' => 'alasan',
				'rules' => 'required',
				'errors' => [
					'required' => 'Mohon diisi alasannya dan jangan mengada-ada',
				],
			]
		];
	}

	public function blacklist_ubah_rules()
	{
		return [
			[
				'field' => 'alasan',
				'label' => 'alasan',
				'rules' => 'required',
				'errors' => [
					'required' => 'Mohon diisi alasannya dan jangan mengada-ada',
				],
			]
		];
	}

	public function libur_rules()
	{
		return [
			[
				'field' => 'tanggal',
				'label' => 'tanggal',
				'rules' => 'required'				
			],
			[
				'field' => 'libur',
				'label' => 'libur',
				'rules' => 'required',
				'errors' => [
					'required' => 'Mohon diisi hari libur apa dan jangan mengada-ada',
				],
			]
		];
	}

	public function getAll()
	{
		$this->db->from($this->table);
		return $this->db->get()->row();
	}

	public function list_hakim()
	{
		// $db_sipp = $this->load->database('sipp', TRUE);
		$statement = "SELECT nama_gelar, nip FROM hakim_pn WHERE aktif='Y' ORDER BY nama_gelar ASC";
		// $query = $db_sipp->query($statement);
		$query = $this->db->query($statement);
		return $query->result();
	}

	public function list_panitera()
	{
		// $db_sipp = $this->load->database('sipp', TRUE);
		$statement = "SELECT nama_gelar, nip FROM panitera_pn WHERE aktif='Y' ORDER BY nama_gelar ASC";
		// $query = $db_sipp->query($statement);
		$query = $this->db->query($statement);
		return $query->result();
	}

	public function ketua_save()
	{
		$post = $this->input->post();
		$split = explode("#", $post['ketua']);
		$nama_gelar = $split[0];
		$nip = $split[1];
		$ketua_sebagai = $post['ketua_sebagai'];
		$statement = "UPDATE setting SET ketua_sebagai='$ketua_sebagai', ketua='$nama_gelar', ketua_nip='$nip' ";
		$this->db->query($statement);
		$data['respon'] = $this->db->affected_rows();
		$data['nama'] = $nama_gelar;
		return $data;
	}

	public function panitera_save()
	{
		$post = $this->input->post();
		$split = explode("#", $post['panitera']);
		$nama_gelar = $split[0];
		$nip = $split[1];
		$panitera_sebagai = $post['panitera_sebagai'];
		$statement = "UPDATE setting SET panitera_sebagai='$panitera_sebagai', panitera='$nama_gelar', panitera_nip='$nip' ";
		$this->db->query($statement);
		$data['respon'] = $this->db->affected_rows();
		$data['nama'] = $nama_gelar;
		return $data;
	}

	public function ttd()
	{
		$statement = "SELECT * FROM setting LIMIT 1";
		$query = $this->db->query($statement);
		return $query->row();
	}

	public function savetoken()
	{
		$post = $this->input->post();
		$token = $post['token'];
		$nama_pa = $post['nama_pa'];
		$nama_pa_pendek = $post['nama_pa_pendek'];
		$this->db->truncate("setting");
		$statement = "INSERT INTO setting (token, nama_pa, nama_pa_pendek) VALUES ('$token', '$nama_pa', '$nama_pa_pendek') ";
		$this->db->query($statement);
		return $this->db->affected_rows();
	}

	public function logo_upload()
	{
		// $post = $this->input->post();
		if(!empty($_FILES['logo']['name']))
		{
			return $this->_uploadImage();
		}
	}

	public function _uploadImage()
	{
		$config['upload_path'] = './asset/img/';
		$config['allowed_types'] = 'png';
		$config['file_name'] = 'logo';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		if($this->upload->do_upload('logo'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function get_blacklist()
	{
		$statement = "SELECT * FROM blacklist ORDER BY diperbarui DESC";
		$query = $this->db->query($statement);
		return $query->result();
	}

	public function get_blacklistById($id)
	{
		return $this->db->get_where("blacklist", ["id" => $id])->row();
	}

	public function blacklist_tambah()
	{
		$post = $this->input->post();
		$this->db->where('no_perkara',$post['no_perkara']);
		$this->db->where('pihak',$post['pihak']);
		$query = $this->db->get('blacklist');
		$count_row = $query->num_rows();
		if($count_row > 0)
		{
			return 0;
		}
		else
		{
			$data = array(
				'no_perkara' => $post['no_perkara'],
				'nama' => $post['nama'],
				'pihak' => $post['pihak'],
				'alasan' => $post['alasan'],
			);
			$this->db->insert("blacklist",$data);
			return $this->db->affected_rows();
		}
	}

	public function blacklist_ubah($id)
	{
		$post = $this->input->post();
		$alasan = $post['alasan'];
		$this->db->set('alasan',$alasan);
		$this->db->where('id',$id);
		$this->db->update('blacklist');
		return $this->db->affected_rows();
	}

	public function blacklist_hapus($id)
	{
		$this->db->delete('blacklist', ["id" => $id]);
		return $this->db->affected_rows();
	}

	public function get_libur()
	{
		$statement = "SELECT * FROM libur ORDER BY tanggal DESC";
		$query = $this->db->query($statement);
		return $query->result();
	}

	public function get_liburById($id)
	{
		return $this->db->get_where("libur", ["id" => $id])->row();
	}

	public function libur_tambah()
	{
		$post = $this->input->post();
		$tanggal = $post['tanggal'];
		$nama = $post['libur'];
		$this->db->where('tanggal',$tanggal);		
		$query = $this->db->get('libur');
		$count_row = $query->num_rows();
		if($count_row > 0)
		{
			return 0;
		}
		else
		{
			$data = array(
				'tanggal' => $tanggal,
				'nama' => $nama,				
			);
			$this->db->insert("libur",$data);
			return $this->db->affected_rows();
		}
	}

	public function libur_ubah($id)
	{
		$post = $this->input->post();
		$tanggal = $post['tanggal'];
		$nama = $post['libur'];
		$this->db->set('tanggal',$tanggal);
		$this->db->set('nama',$nama);
		$this->db->where('id',$id);
		$this->db->update('libur');
		return $this->db->affected_rows();
	}

	public function libur_hapus($id)
	{
		$this->db->delete('libur', ["id" => $id]);
		return $this->db->affected_rows();
	}
	
}
 ?>