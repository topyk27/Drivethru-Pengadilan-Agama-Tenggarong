<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Pengambilan extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_pengambilan");
		$this->load->library('form_validation');
		$this->load->library('session');
	}


	public function cek_jadwal($jadwal)
	{
		$no_perkara = $this->input->post('no_perkara');
		$pihak = $this->input->post('pihak');
		$pengambilan = $this->M_pengambilan;
		$hari_ini = new DateTime(date("Y-m-d"));
		$hari_ini->modify('+1 day');
		$besok = $hari_ini->getTimestamp();

		// if(strtotime($jadwal) > time()+86400) //fix kalo lebih dari 24 jam berarti boleh ambil
		if(strtotime($jadwal) >= $besok ) // test kalo lebih dari 24 jam berarti boleh ambil
		{
			if($pengambilan->cek_udah_ambil($no_perkara,$pihak,$jadwal)) //cek udah ambil antrian hari itu apa belum
			{
				if($pengambilan->cek_antrian($jadwal) < 10) //kalo antrian kurang dari 10 berarti boleh ambil
				{
					return TRUE;
				}
				else
				{
					$this->form_validation->set_message('cek_jadwal', 'Antrian sudah penuh, silahkan pilih hari yang lain.');
					return FALSE;
				}
			}
			else
			{
				$this->form_validation->set_message('cek_jadwal', 'Anda sudah mengambil antrian pada hari itu. Silahkan pilih menu cetak antrian.');
				return FALSE;
			}
		}
		else
		{
			$this->form_validation->set_message('cek_jadwal', 'Pengambilan antrian tidak bisa dilakukan apabila kurang dari 1 hari. Silahkan pilih besok lusa.');
			// $this->session->set_flashdata('respon', 0);
			// print_r("nay");
			return FALSE;
		}
	}

	public function cek_ac_dah_diambil()
	{
		$post = $this->input->post();
		$no_perkara = $post['no_perkara'].$post['jenis_perkara'].$post['no_perkara_tahun']."/PA.Tgr";
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
		// $no_perkara = '695/Pdt.G/2020/PA.Tgr';
		// $pihak = "penggugat";
		// $pengambilan = ["ac","salinan"];
		// print_r($pengambilan);
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

	public function statistik()
	{
		$data = $this->M_pengambilan->getStatistik();
		echo json_encode($data);
	}

	public function index()
	{
		$pengambilan = $this->M_pengambilan;
		$validation = $this->form_validation;
		$validation->set_rules($pengambilan->rules());
		if($validation->run())
		{
			$respon = $pengambilan->insert();
			if($respon['success'] == 1)
			{
				// print_r("yay");
				// redirect('pengambilan');
				// return 1;
				// $this->session->set_flashdata('respon', 1);
				// $this->session->set_flashdata('antrian',$respon->antrian);
				// $this->session->set_flashdata('no_perkara',$respon->no_perkara);
				// $this->session->set_flashdata('nama',$respon->nama);
				// $jadwal = $this->tgl_indo($respon->jadwal);
				// $this->session->set_flashdata('jadwal',$jadwal);
				$this->session->set_flashdata('respon', 1);
				$this->session->set_flashdata('antrian', $respon['antrian']);
				$this->session->set_flashdata('no_perkara', $respon['no_perkara']);
				$this->session->set_flashdata('nama', $respon['nama']);
				$this->session->set_flashdata('ac', $respon['ac']);
				$this->session->set_flashdata('salinan', $respon['salinan']);
				$this->session->set_flashdata('jadwal', $this->tgl_indo($respon['jadwal']));
			}
			else
			{
				// $this->session->set_flashdata('respon', 0);
				$this->session->set_flashdata('respon', 0);
				// return 0;
			}
		}
		$this->load->view("pengambilan");
	}

	// public function tambah()
	// {
	// 	$pengambilan = $this->M_pengambilan;
	// 	$pengambilan->cek_antrian("2020-09-23");
	// }

	public function cetak()
	{
		$pengambilan = $this->M_pengambilan;
		$validation = $this->form_validation;
		$validation->set_rules($pengambilan->rules_cetak());
		if($validation->run())
		{
			$respon = $pengambilan->cetak_jadwal();
			if(!empty($respon))
			{
				$this->session->set_flashdata('antrian',$respon->antrian);
				$this->session->set_flashdata('no_perkara',$respon->no_perkara);
				$this->session->set_flashdata('nama',$respon->nama);
				$jadwal = $this->tgl_indo($respon->jadwal);
				$this->session->set_flashdata('jadwal',$jadwal);
				$this->session->set_flashdata('ac',$respon->ac);
				$this->session->set_flashdata('salinan',$respon->salinan);
				redirect('pengambilan/cetak_antrian');
			}
			else
			{
				$this->session->set_flashdata('respon', 'kosong');
			}
			// if($respon == 1)
			// {
			// 	// print_r("yay");
			// 	// redirect('pengambilan');
			// 	// return 1;
			// 	// $this->session->set_flashdata('respon', 1);
			// 	$this->session->set_flashdata('respon', 1);
			// }
			// else
			// {
			// 	// $this->session->set_flashdata('respon', 0);
			// 	$this->session->set_flashdata('respon', 0);
			// 	// return 0;
			// }
		}
		$this->load->view("cetak");
	}

	public function cetak_antrian()
	{
		$this->load->view("cetak_antrian");
	}

	public function cek_data_perkara()
	{
		$data_perkara = $this->M_pengambilan->cek_data_perkara();
		echo json_encode($data_perkara);
	}

}

 ?>