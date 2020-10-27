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
		if($query->num_rows()==1)
		{
			foreach ($query->result() as $row)
			{
				$data = array(
					'id' => $row->id,
					'username' => $row->username,
					'nama' => $row->nama,
					'role' => $row->role,
					'login' => true,
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

	public function isLogin()
	{
		if($this->session->userdata('login'))
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