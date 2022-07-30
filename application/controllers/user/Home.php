<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends User_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'ibuhamil_model',
			'balita_model',
		));
	}
	public function index()
	{
		$this->data["page_title"] = "Beranda";
		$this->data['jml_ibuhamil'] = count($this->ibuhamil_model->ibuhamils()->result());
		$this->data['jml_balita'] = count($this->balita_model->balitas()->result());
		$this->render("admin/dashboard/content");
	}
}
