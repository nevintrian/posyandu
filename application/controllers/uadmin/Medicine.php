
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Medicine extends Uadmin_Controller
{
    private $services = null;
    private $name = null;
    private $parent_page = 'uadmin';
    private $current_page = 'uadmin/medicine/';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('services/Medicine_services');
        $this->services = new Medicine_services;
        $this->load->model(array(
            'group_model',
            'medicine_model',
        ));
    }
    public function index()
    {
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) -  1) : 0;
        // echo $page; return;
        //pagination parameter
        $pagination['base_url'] = base_url($this->current_page) . '/index';
        $pagination['total_records'] = $this->medicine_model->record_count();
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page * $pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
        //set pagination
        if ($pagination['total_records'] > 0) $this->data['pagination_links'] = $this->setPagination($pagination);
        #################################################################3
        $table = $this->services->get_table_config($this->current_page);
        $table["rows"] = $this->medicine_model->medicines($pagination['start_record'], $pagination['limit_per_page'])->result();
        // var_dump($table["rows"]);
        // die;
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
        $this->data["block_header"] = "Obat";
        $this->data["header"] = "Daftar Obat";
        $this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
        $this->render("templates/contents/plain_content");
    }


    public function add()
    {
        if (!($_POST)) redirect(site_url($this->current_page));

        // echo var_dump( $data );return;
        $this->form_validation->set_rules($this->services->validation_config());
        if ($this->form_validation->run() === TRUE) {
            $data['code'] = $this->input->post('code');
            $data['name'] = $this->input->post('name');
            $data['category_id'] = $this->input->post('category_id');
            $data['date'] = $this->input->post('date');
            $data['expired'] = $this->input->post('expired');
            $data['timestamp'] = $this->input->post('timestamp');
            $data['stock'] = $this->input->post('stock');

            if ($this->medicine_model->create($data)) {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->medicine_model->messages()));
            } else {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->medicine_model->errors()));
            }
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->medicine_model->errors() : $this->session->flashdata('message')));
            if (validation_errors() || $this->medicine_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));
        }

        redirect(site_url($this->current_page));
    }

    public function edit()
    {
        if (!($_POST)) redirect(site_url($this->current_page));

        // echo var_dump( $data );return;
        $this->form_validation->set_rules($this->services->validation_config());
        if ($this->form_validation->run() === TRUE) {
            $data['code'] = $this->input->post('code');
            $data['name'] = $this->input->post('name');
            $data['category_id'] = $this->input->post('category_id');
            $data['date'] = $this->input->post('date');
            $data['expired'] = $this->input->post('expired');
            $data['stock'] = $this->input->post('stock');

            $data_param['id'] = $this->input->post('id');

            if ($this->medicine_model->update($data, $data_param)) {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->medicine_model->messages()));
            } else {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->medicine_model->errors()));
            }
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->medicine_model->errors() : $this->session->flashdata('message')));
            if (validation_errors() || $this->medicine_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));
        }

        redirect(site_url($this->current_page));
    }

    public function delete()
    {
        if (!($_POST)) redirect(site_url($this->current_page));

        $data_param['id']     = $this->input->post('id');
        if ($this->medicine_model->delete($data_param)) {
            $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->medicine_model->messages()));
        } else {
            $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->medicine_model->errors()));
        }
        redirect(site_url($this->current_page));
    }
}
