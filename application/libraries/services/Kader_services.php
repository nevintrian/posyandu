<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kader_services
{
	// user var
	protected $id;
	protected $identity;
	protected $first_name;
	protected $last_name;
	protected $phone;
	protected $address;
	protected $email;
	protected $posyandu_id;

	function __construct()
	{
		$this->id		      = '';
		$this->identity		= '';
		$this->first_name	= "";
		$this->last_name	= "";
		$this->phone		  = "";
		$this->address		= "";
		$this->email		  = "";
		$this->posyandu_id		= '';
	}

	public function __get($var)
	{
		return get_instance()->$var;
	}
	public function get_photo_upload_config($name = "_")
	{
		$filename = "USER_" . $name . "_" . time();
		$upload_path = 'uploads/users_photo/';

		$config['upload_path'] = './' . $upload_path;
		$config['image_path'] = base_url() . $upload_path;
		$config['allowed_types'] = "gif|jpg|png|jpeg";
		$config['overwrite'] = "true";
		$config['max_size'] = "2048";
		$config['file_name'] = '' . $filename;

		return $config;
	}

	public function get_table_config($_page, $start_number = 1)
	{
		// sesuaikan nama tabel header yang akan d tampilkan dengan nama atribut dari tabel yang ada dalam database
		$table["header"] = array(
			'username' => 'Username',
			'group_name' => 'Group',
			'user_fullname' => 'Nama Lengkap',
			'phone' => 'No Telepon',
			'address' => 'Alamat',
			'email' => 'Email',
		);
		$table["number"] = $start_number;
		$table["action"] = array(
			array(
				"name" => "Detail",
				"type" => "link",
				"url" => site_url($_page . "detail/"),
				"button_color" => "primary",
				"param" => "id",
			),
			array(
				"name" => "Edit",
				"type" => "link",
				"url" => site_url($_page . "edit/"),
				"button_color" => "primary",
				"param" => "id",
			),
			array(
				"name" => 'Hapus',
				"type" => "modal_delete",
				"modal_id" => "delete_category_",
				"url" => site_url($_page . "delete/"),
				"button_color" => "danger",
				"param" => "id",
				"form_data" => array(
					"id" => array(
						'type' => 'hidden',
						'label' => "id",
					),
					"posyandu_id" => array(
						'type' => 'hidden',
						'label' => "posyandu_id",
					),
				),
				"title" => "User",
				"data_name" => "user_fullname",
			),
		);
		return $table;
	}

	/**
	 * get_form_data
	 *
	 * @return array
	 * @author madukubah
	 **/
	public function get_form_data_readonly($user_id = -1)
	{
		if ($user_id != -1) {
			$user 				= $this->ion_auth_model->user($user_id)->row();
			$this->identity		= $user->username;
			$this->first_name	= $user->first_name;
			$this->last_name	= $user->last_name;
			$this->phone		= $user->phone;
			$this->id			= $user->user_id;
			$this->email		= $user->email;
			$this->posyandu_id		= $user->posyandu_id;
			$this->address		= $user->address;
		}

		$groups = $this->ion_auth_model->posyandu()->result();
		$group_select = array();
		foreach ($groups as $group) {
			// if( $group->id == 1 ) continue;
			$group_select[$group->id] = $group->name;
		}

		$_data["form_data"] = array(
			"id" => array(
				'type' => 'hidden',
				'label' => "ID",
				'value' => $this->form_validation->set_value('id', $this->id),
			),
			"first_name" => array(
				'type' => 'text',
				'label' => "Nama Depan",
				'value' => $this->form_validation->set_value('first_name', $this->first_name),
			),
			"last_name" => array(
				'type' => 'text',
				'label' => "Nama Belakang",
				'value' => $this->form_validation->set_value('last_name', $this->last_name),
			),
			"email" => array(
				'type' => 'text',
				'label' => "Email",
				'value' => $this->form_validation->set_value('email', $this->email),
			),
			"address" => array(
				'type' => 'text',
				'label' => "Alamat",
				'value' => $this->form_validation->set_value('address', $this->address),
			),
			"phone" => array(
				'type' => 'number',
				'label' => "Nomor Telepon",
				'value' => $this->form_validation->set_value('phone', $this->phone),
			),
			"posyandu_id" => array(
				'type' => 'text',
				'label' => "Posyandu",
				'value' => $group_select[$this->posyandu_id],
			),
		);
		return $_data;
	}
}
