<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model("M_setting");
		$data['ttd'] = $this->M_setting->ttd();
		$row = $data['ttd'];
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
		$this->load->view('welcome', $data);
	}

	public function bantuan()
	{
		$this->load->view('bantuan');
	}
}
