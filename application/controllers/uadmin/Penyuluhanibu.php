<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Penyuluhanibu extends Uadmin_Controller
{
    private $services = null;
    private $name = null;
    private $parent_page = 'uadmin';
    private $current_page = 'uadmin/penyuluhanibu/';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('services/penyuluhanibu_services');
        $this->services = new penyuluhanibu_services;
        $this->load->model(array(
            'penyuluhanibu_model',
        ));
    }
    public function index()
    {
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) -  1) : 0;
        // echo $page; return;
        //pagination parameter
        $pagination['base_url'] = base_url($this->current_page) . '/index';
        $pagination['total_records'] = $this->penyuluhanibu_model->record_count();
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page * $pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
        //set pagination
        if ($pagination['total_records'] > 0) $this->data['pagination_links'] = $this->setPagination($pagination);
        #################################################################3
        $table = $this->services->get_table_config($this->current_page);
        $table["rows"] = $this->penyuluhanibu_model->penyuluhanibus($pagination['start_record'], $pagination['limit_per_page'])->result();
        $table = $this->load->view('templates/tables/plain_table', $table, true);
        $this->data["contents"] = $table;
        $add_menu = array(
            "name" => "Tambah Jenis Penyuluhan",
            "modal_id" => "add_penyuluhanibu_",
            "button_color" => "primary",
            "url" => site_url($this->current_page . "add/"),
            "form_data" => array(
                "name" => array(
                    'type' => 'textarea',
                    'label' => "Nama Kegiatan",
                    'value' => "-",
                ),
            ),
            'data' => NULL
        );

        $add_menu = $this->load->view('templates/actions/modal_form', $add_menu, true);

        $this->data["header_button"] =  $add_menu;
        // return;
        #################################################################3
        $alert = $this->session->flashdata('alert');
        $this->data["key"] = $this->input->get('key', FALSE);
        $this->data["alert"] = (isset($alert)) ? $alert : NULL;
        $this->data["current_page"] = $this->current_page;
        $this->data["block_header"] = "SETTING";
        $this->data["header"] = "Group";
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

            if ($this->penyuluhanibu_model->create($data)) {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->penyuluhanibu_model->messages()));
            } else {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->penyuluhanibu_model->errors()));
            }
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->penyuluhanibu_model->errors() : $this->session->flashdata('message')));
            if (validation_errors() || $this->penyuluhanibu_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));
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

            $data_param['id'] = $this->input->post('id');

            if ($this->penyuluhanibu_model->update($data, $data_param)) {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->penyuluhanibu_model->messages()));
            } else {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->penyuluhanibu_model->errors()));
            }
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->penyuluhanibu_model->errors() : $this->session->flashdata('message')));
            if (validation_errors() || $this->penyuluhanibu_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));
        }

        redirect(site_url($this->current_page));
    }

    public function delete()
    {
        if (!($_POST)) redirect(site_url($this->current_page));

        $data_param['id']     = $this->input->post('id');
        if ($this->penyuluhanibu_model->delete($data_param)) {
            $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->penyuluhanibu_model->messages()));
        } else {
            $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->penyuluhanibu_model->errors()));
        }
        redirect(site_url($this->current_page));
    }
}
