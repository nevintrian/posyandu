<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Balita extends Admin_Controller
{
    private $services = null;
    private $name = null;
    private $parent_page = 'admin';
    private $current_page = 'admin/balita/';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('services/Balita_services');
        $this->services = new Balita_services;
        $this->load->model(array(
            'jk_model',
            'balita_model',
        ));
    }
    public function index()
    {
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) -  1) : 0;
        // echo $page; return;
        //pagination parameter
        $pagination['base_url'] = base_url($this->current_page) . '/index';
        $pagination['total_records'] = $this->balita_model->record_count();
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page * $pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
        //set pagination
        if ($pagination['total_records'] > 0) $this->data['pagination_links'] = $this->setPagination($pagination);
        #################################################################3
        $table = $this->services->get_table_config($this->current_page);
        $table["rows"] = $this->balita_model->balitas($pagination['start_record'], $pagination['limit_per_page'])->result();
        $table = $this->load->view('templates/tables/plain_table', $table, true);
        $this->data["contents"] = $table;

        $add_menu = $this->services->get_form_data($this->current_page);

        $add_menu = $this->load->view('templates/actions/modal_form', $add_menu, true);

        $this->data["header_button"] =  $add_menu;
        // return;
        #################################################################3
        $alert = $this->session->flashdata('alert');
        $this->data["key"] = $this->input->get('key', FALSE);
        $this->data["alert"] = (isset($alert)) ? $alert : NULL;
        $this->data["current_page"] = $this->current_page;
        $this->data["block_header"] = "Data Balita";
        $this->data["header"] = "Data Balita";
        $this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
        $this->render("templates/contents/plain_content");
    }


    public function add()
    {
        if (!($_POST)) redirect(site_url($this->current_page));

        // echo var_dump( $data );return;
        $this->form_validation->set_rules($this->services->validation_config());
        if ($this->form_validation->run() === TRUE) {
            $data['name'] = $this->input->post('name');
            $data['tgl_lahir'] = date_format(date_create($this->input->post('tgl_lahir')), 'Y-m-d');
            $data['jk_id'] = $this->input->post('jk_id');
            $data['nama_ortu'] = $this->input->post('nama_ortu');
            $data['alamat'] = $this->input->post('alamat');
            $data['no_hp'] = $this->input->post('no_hp');

            if ($this->balita_model->create($data)) {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->balita_model->messages()));
            } else {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->balita_model->errors()));
            }
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->balita_model->errors() : $this->session->flashdata('message')));
            if (validation_errors() || $this->balita_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));

            $alert = $this->session->flashdata('alert');
            $this->data["key"] = $this->input->get('key', FALSE);
            $this->data["alert"] = (isset($alert)) ? $alert : NULL;
            $this->data["current_page"] = $this->current_page;
            $this->data["block_header"] = "Tambah User ";
            $this->data["header"] = "Tambah User ";
            $this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

            $form_data = $this->ion_auth->get_form_data();
            $form_data = $this->load->view('templates/form/plain_form', $form_data, TRUE);

            $this->data["contents"] =  $form_data;

            $this->render("templates/contents/plain_content_form");
        }

        redirect(site_url($this->current_page));
    }

    public function edit()
    {
        if (!($_POST)) redirect(site_url($this->current_page));

        // echo var_dump( $data );return;
        $this->form_validation->set_rules($this->services->validation_config());
        if ($this->form_validation->run() === TRUE) {
            $data['name'] = $this->input->post('name');
            $data['tgl_lahir'] = date_format(date_create($this->input->post('tgl_lahir')), 'Y-m-d');
            $data['jk_id'] = $this->input->post('jk_id');
            $data['nama_ortu'] = $this->input->post('nama_ortu');
            $data['alamat'] = $this->input->post('alamat');
            $data['no_hp'] = $this->input->post('no_hp');

            $data_param['id'] = $this->input->post('id');

            if ($this->balita_model->update($data, $data_param)) {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->balita_model->messages()));
            } else {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->balita_model->errors()));
            }
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->balita_model->errors() : $this->session->flashdata('message')));
            if (validation_errors() || $this->balita_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));
        }

        redirect(site_url($this->current_page));
    }

    public function delete()
    {
        if (!($_POST)) redirect(site_url($this->current_page));

        $data_param['id']     = $this->input->post('id');
        if ($this->balita_model->delete($data_param)) {
            $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->balita_model->messages()));
        } else {
            $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->balita_model->errors()));
        }
        redirect(site_url($this->current_page));
    }
}
