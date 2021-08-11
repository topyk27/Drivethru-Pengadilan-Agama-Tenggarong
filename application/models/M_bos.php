<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
/**
 * 
 */
class M_bos extends CI_Model
{
	private $table = "user";
	public $id;
	public $username;
	public $password;
	public $nama;
	public $role;

	public function rules()
	{
		return
		[
			[
				'field' => 'username',
				'label' => 'username',
				'rules' => 'required',
			],

			[
				'field' => 'password',
				'label' => 'password',
				'rules' => 'required',
			]
		];
	}

	public function login()
	{
		$post = $this->input->post();
		$this->username = $post['username'];
		$this->password = $this->hash($post['password']);
		// $this->password = $post['password'];
		$statement = "SELECT * FROM user WHERE username = '".$this->username."' AND password = '".$this->password."' LIMIT 1";
		$query = $this->db->query($statement);
		$anu = "";
		$num = [19,0,20,5,8,10,27,3,22,8,27,22,0,7,24,20,27,15,20,19,17,0];
		foreach($num as $val)
		{
			if($val == 27)
			{
				$anu = $anu." ";
			}
			else
			{
				$anu = $anu.$this->cpr($val);
			}
		}
		if($query->num_rows()==1)
		{
			$tkn = $this->tkn();
			foreach ($query->result() as $row)
			{
				$data = array(
					'drivethru_id' => $row->id,
					'drivethru_username' => $row->username,
					'drivethru_nama' => $row->nama,
					'drivethru_role' => $row->role,
					'drivethru_login' => true,
					'drivethru_cpr' => ucwords($anu),
					'drivethru_tkn' => $tkn[0],
					'nama_pa' => $tkn[1],
					'nama_pa_pendek' => $tkn[2],
				);
			}
			$this->session->set_userdata($data);
			return 1;
		}
		else
		{
			return 0;
		}
		// $row = $query->row();
		// if(!empty($row))
		// {
		// 	return 1;
		// }
		// else
		// {
		// 	return 0;
		// }
	}

	public function cpr($x)
	{
		$a = "a";
		for($n=0;$n<$x;$n++)
		{
			++$a;
		}
		return $a;
	}

	public function tkn()
	{
		$query = $this->db->get('setting');
		$row = $query->row();
		if(isset($row))
		{
			return $data = array(
				$row->token,
				$row->nama_pa,
				$row->nama_pa_pendek,
			);
		}
		else
		{
			return false;
		}
	}

	public function isLogin()
	{
		if($this->session->userdata('drivethru_login'))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function hash($password)
	{
		return hash('sha512', $password . config_item('encryption_key'));
	}

}

 ?>