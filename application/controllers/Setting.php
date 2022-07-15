<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Setting extends CI_Controller
{
	
	public function __construct()
	{
		parent:: __construct();
		$this->load->model("M_setting");
		$this->load->model("M_bos");
		$this->load->library('form_validation');
	}


	public function awal()
	{
		$this->session->sess_destroy();
		$this->load->view("setting/awal");
	}

	public function savetoken()
	{
		echo $this->M_setting->savetoken();
	}

	public function sistem()
	{
		if(!$this->M_bos->isLogin())
		{
			redirect('login');
		}
		$setting = $this->M_setting;
		$validation = $this->form_validation;
		$validation->set_rules($setting->logo_rules());
		if($validation->run())
		{
			$respon = $setting->logo_upload();
			if($respon)
			{
				redirect('setting/sistem');
			}
		}

		$data['ttd'] = $this->M_setting->getAll();
		$data['hakim'] = $this->M_setting->list_hakim();
		$data['panitera'] = $this->M_setting->list_panitera();
		$this->load->view("setting/sistem",$data);
	}

	public function ketua_save()
	{
		echo json_encode($this->M_setting->ketua_save());

	}

	public function panitera_save()
	{
		echo json_encode($this->M_setting->panitera_save());

	}

	public function blacklist()
	{
		if(!$this->M_bos->isLogin())
		{
			redirect('login');
		}
		$this->load->view("setting/blacklist");
	}

	public function data_blacklist()
	{
		$data = $this->M_setting->get_blacklist();
		echo json_encode($data);
	}

	public function blacklist_ubah($id)
	{
		if(!isset($id))
		{
			redirect('setting/blacklist');
		}
		else
		{
			$setting = $this->M_setting;
			$validation = $this->form_validation;
			$validation->set_rules($setting->blacklist_ubah_rules());
			if($validation->run())
			{
				$respon = $setting->blacklist_ubah($id);
				if($respon == 1)
				{
					$this->session->set_flashdata('success', 'Data berhasil diubah');
				}
				else
				{
					$this->session->set_flashdata('success', 'Data gagal diubah');
				}
				redirect('setting/blacklist');
			}
			$data['data_blacklist'] = $setting->get_blacklistById($id);
			if(!$data['data_blacklist'])
			{
				$this->session->set_flashdata('success', 'Data yang anda cari tidak ada');
				redirect('setting/blacklist');
			}
			else
			{
				$this->load->view('setting/blacklist_ubah',$data);
			}
		}
	}

	public function validate_image()
	{
		$check = TRUE;
		    if ((!isset($_FILES['logo'])) || $_FILES['logo']['size'] == 0) {
		        $this->form_validation->set_message('validate_image', 'Silahkan pilih logo');
		        $check = FALSE;
		    }
		    else if (isset($_FILES['logo']) && $_FILES['logo']['size'] != 0) {
		        $allowedExts = array("png","PNG");
		        $allowedTypes = array(IMAGETYPE_PNG,);
		        $extension = pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);
		        $detectedType = exif_imagetype($_FILES['logo']['tmp_name']);
		        $type = $_FILES['logo']['type'];
		        if (!in_array($detectedType, $allowedTypes)) {
		            $this->form_validation->set_message('validate_image', 'Format logo dalam bentuk png');
		            $check = FALSE;
		        }
		        if(filesize($_FILES['logo']['tmp_name']) > 2000000) {
		            $this->form_validation->set_message('validate_image', 'The Image file size shoud not exceed 20MB!');
		            $check = FALSE;
		        }
		        if(!in_array($extension, $allowedExts)) {
		            $this->form_validation->set_message('validate_image', "Ekstensi {$extension} tidak dapat diunggah, gunakan png.");
		            $check = FALSE;
		        }
		    }
		    return $check;
	}

}

 ?>