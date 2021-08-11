<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Laporan extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_bos");
		$this->load->model("M_pengambilan");
		$this->load->model("M_setting");
		if(!$this->M_bos->isLogin())
		{
			redirect('login');
		}
	}

	public function nama_bulan($bulan)
	{
		$bln;
		switch ($bulan) {
			
			case 1 :
				$bln = 'Januari';
				break;
			
			case 2 :
				$bln = 'Februari';
				break;
			
			case 3 :
				$bln = 'Maret';
				break;
			
			case 4 :
				$bln = 'April';
				break;
			
			case 5 :
				$bln = 'Mei';
				break;
			
			case 6 :
				$bln = 'Juni';
				break;
			
			case 7 :
				$bln = 'Juli';
				break;
			
			case 8 :
				$bln = 'Agustus';
				break;
			
			case 9 :
				$bln = 'September';
				break;
			case 10:
				$bln = 'Oktober';
				break;
			case 11:
				$bln = 'November';
				break;
			case 12:
				$bln = 'Desember';
				break;
			default :
				$bln = 'Bodoh';
				break;
		}
		return $bln;
	}

	public function pengambilan()
	{
		
		$this->load->view('laporan/pengambilan');
	}

	public function data_laporan_pengambilan()
	{
		$data = $this->M_pengambilan->getAll();
		echo json_encode($data);
	}

	public function cetak_laporan_pengambilan($bulan,$tahun)
	{
		$data['laporan'] = $this->M_pengambilan->cetak_laporan_pengambilan($bulan,$tahun);
		$bln = $this->nama_bulan($bulan);
		$data['bulan'] = $bln;
		$data['tahun'] = $tahun;
		$data['now'] = date('d')." ".$this->nama_bulan(date('n'))." ".date('Y');
		$data['ttd'] = $this->M_setting->ttd();
		$this->load->view('laporan/pengambilan_cetak',$data);
	}

	public function data_laporan_filter()
	{
		$data = $this->M_pengambilan->laporan_pengambilan_getByDate();
		echo json_encode($data);
	}
}
 ?>