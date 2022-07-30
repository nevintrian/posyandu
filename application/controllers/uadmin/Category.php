<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Category extends Uadmin_Controller
{
	private $services = null;
	private $name = null;
	private $parent_page = 'uadmin';
	private $current_page = 'uadmin/category/';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('services/Category_services');
		$this->services = new Category_services;
		$this->load->model(array(
			'category_model',
			'Group_model',
		));
		$this->data["menu_list_id"] = "category_index";
	}

	public function index()
	{
		$table = $this->services->get_table_config($this->current_page);
		$table["rows"] = $this->category_model->categories()->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data["contents"] = $table;

		##################################################################################################################################
		$add_menu = $this->services->form_data($this->current_page);
		$add_menu = $this->load->view('templates/actions/modal_form', $add_menu, true);

		$this->data["header_button"] =  $add_menu;
		// echo return;
		##################################################################################################################################
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Kategori ";
		$this->data["header"] = "Kategori ";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render("templates/contents/plain_content");
	}

	public function add()
	{
		if (!($_POST)) redirect(site_url($this->current_page));

		$this->form_validation->set_rules("name", "name", "trim|required");

		if ($this->form_validation->run() === TRUE) {
			$data['name'] = $this->input->post('name');


			if ($this->category_model->create($data)) {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->category_model->messages()));
			} else {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->category_model->errors()));
			}
		} else {
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->category_model->errors() : $this->session->flashdata('message')));
			if (validation_errors() || $this->category_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));
		}

		redirect(site_url($this->current_page));
	}

	public function edit()
	{
		if (!($_POST)) redirect(site_url($this->current_page));

		$this->form_validation->set_rules("name", "name", "trim|required");
		if ($this->form_validation->run() === TRUE) {
			$data['name'] = $this->input->post('name');

			$data_param['id'] = $this->input->post('id');

			if ($this->category_model->update($data, $data_param)) {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->category_model->messages()));
			} else {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->category_model->errors()));
			}
		} else {
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->category_model->errors() : $this->session->flashdata('message')));
			if (validation_errors() || $this->category_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));
		}

		redirect(site_url($this->current_page));
	}

	public function delete()
	{
		if (!($_POST)) redirect(site_url($this->current_page));

		$data_param['id'] 	= $this->input->post('id');
		if ($this->category_model->delete($data_param)) {
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->category_model->messages()));
		} else {
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->category_model->errors()));
		}
		redirect(site_url($this->current_page));
	}
}
