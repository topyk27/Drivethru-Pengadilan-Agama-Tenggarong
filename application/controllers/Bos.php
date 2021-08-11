<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Bos extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_bos");
		$this->load->model("M_pengambilan");
		$this->load->model("M_setting");
		$this->load->library('form_validation');
		$this->load->library('session');
		$row = $this->M_setting->ttd();
		if(isset($row))
		{
			$data_pa = array(
				'drivethru_tkn' => $row->token,
				'nama_pa' => $row->nama_pa,
				'nama_pa_pendek' => $row->nama_pa_pendek,
			);
		}
		else
		{
			$data_pa = array(
				'drivethru_tkn' => 'belum',
				'nama_pa' => 'belum',
				'nama_pa_pendek' => 'belum',
			);
		}
		$this->session->set_userdata($data_pa);
	}

	public function cek_jadwal($jadwal)
	{
		$pengambilan = $this->M_pengambilan;
		if($pengambilan->cek_antrian($jadwal) < 10)
		{
			// print_r($pengambilan->cek_antrian($jadwal));
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('cek_jadwal', 'Antrian sudah penuh, silahkan pilih hari yang lain.');
			// $this->session->set_flashdata('respon', 0);
			// print_r("nay");
			return FALSE;
		}
	}

	public function cek_ac_dah_diambil()
	{
		$post = $this->input->post();
		$no_perkara = $post['no_perkara'];
		$pihak = $post['pihak'];
		$p = $this->M_pengambilan;
		$pengambilan;
		if(empty($post['pengambilan']))
		{
			$this->form_validation->set_message('cek_ac_dah_diambil', 'Pilih produk yang ingin diambil');
			return false;
		}
		else
		{
			$pengambilan = $post['pengambilan'];
		}
		
		if($pengambilan[0]=="ac")
		{
			
			if($p->cek_udah_ambil_ac($no_perkara,$pihak))
			{
				return true; //berarti belum diambil
			}
			else
			{
				$this->form_validation->set_message('cek_ac_dah_diambil', 'Anda sudah pernah mengambil akta cerai');
				return false;
			}
		}
		else
		{
			return true;
		}

	}

	public function tgl_indo($tanggal) //format dari asal (Y-m-d)
	{
		$bulan = array (
				1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
		$pecahkan = explode('-', $tanggal);
			
			// variabel pecahkan 0 = tanggal
			// variabel pecahkan 1 = bulan
			// variabel pecahkan 2 = tahun
		 
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}

	// public function testpw()
	// {
	// 	$a = '12345';
	// 	echo hash('sha512',$a .config_item('encryption_key'));
	// }

	public function login()
	{
		$bos = $this->M_bos;
		$this->load->model("M_setting");
		$data['ttd'] = $this->M_setting->ttd();
		if(!$bos->isLogin())
		{
			$validation = $this->form_validation;
			$validation->set_rules($bos->rules());
			if($validation->run())
			{
				$respon = $bos->login();
				if($respon == 1)
				{
					// $this->session->set_userdata('login', true);
					redirect('/');
				}
				else
				{
					$this->session->set_flashdata('respon', 'kosong');
				}
			}
			$this->load->view('bos/login',$data);
		}
		else
		{
			redirect('/');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('bos/login');
	}

	public function semua_antrian()
	{
		$bos = $this->M_bos;
		if($bos->isLogin())
		{
			$this->load->view('bos/semua_antrian');
		}
		else
		{
			redirect('bos/login');
		}
	}

	public function data_semua_antrian()
	{
		$data = $this->M_pengambilan->getAll();
		echo json_encode($data);
	}

	public function data_antrian_filter()
	{
		$data = $this->M_pengambilan->getByDate();
		echo json_encode($data);
	}

	public function antrian_hari_ini()
	{
		$bos = $this->M_bos;
		if($bos->isLogin())
		{
			$this->load->view('bos/antrian_hari_ini');
		}
		else
		{
			redirect('bos/login');
		}
	}

	public function data_antrian_hari_ini()
	{
		$data = $this->M_pengambilan->getAllToday();
		echo json_encode($data);
	}

	public function antrian_ubah($id)
	{
		if(!isset($id))
		{
			redirect('bos/semua_antrian');
		}
		else
		{
			$pengambilan = $this->M_pengambilan;
			$validation = $this->form_validation;
			$validation->set_rules($pengambilan->rules());
			if($validation->run())
			{
				$respon = $pengambilan->update($id);
				if($respon == 1)
				{
					$this->session->set_flashdata('success', 'Data berhasil diubah');
				}
				else
				{
					$this->session->set_flashdata('success', 'Data gagal diubah');
				}
				redirect('bos/semua_antrian');
			}
			$data['data_antrian'] = $pengambilan->getById($id);
			if(!$data)
			{
				$this->session->set_flashdata('success', 'Data yang anda cari tidak ada');
				redirect('bos/semua_antrian');
			}
			else
			{
				$this->load->view("bos/antrian_ubah", $data);
				// print_r($data);
			}
		}
	}

	public function antrian_hapus($id)
	{
		if($this->M_pengambilan->delete($id))
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}

}

 ?>