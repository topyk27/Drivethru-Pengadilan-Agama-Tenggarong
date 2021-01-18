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
		$this->load->library('form_validation');
		$this->load->library('session');
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
			$this->load->view('bos/login');
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