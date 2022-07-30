<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ibuhamil extends Bidan_Controller
{
    private $services = null;
    private $name = null;
    private $parent_page = 'bidan';
    private $current_page = 'bidan/ibuhamil/';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('services/Pasienibu_services');
        $this->services = new Pasienibu_services;
        $this->load->model(array(
            'jk_model',
            'ibuhamil_model',
            'pemeriksaanibu_model',
            'imunisasiibu_model',
            'penyuluhanibu_model',
        ));
    }
    public function index()
    {
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) -  1) : 0;
        //pagination parameter
        $pagination['base_url'] = base_url($this->current_page) . '/index';
        $pagination['total_records'] = $this->ibuhamil_model->record_count();
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page * $pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
        //set pagination
        if ($pagination['total_records'] > 0) $this->data['pagination_links'] = $this->setPagination($pagination);
        #################################################################3
        $table = $this->services->get_table_config($this->current_page);
        $table["rows"] = $this->ibuhamil_model->ibuhamils($pagination['start_record'], $pagination['limit_per_page'])->result();
        $table = $this->load->view('templates/tables/plain_table', $table, true);
        $this->data["contents"] = $table;

        $alert = $this->session->flashdata('alert');
        $this->data["key"] = $this->input->get('key', FALSE);
        $this->data["alert"] = (isset($alert)) ? $alert : NULL;
        $this->data["current_page"] = $this->current_page;
        $this->data["block_header"] = "Pemeriksaan Ibu Hamil";
        $this->data["header"] = "Pemeriksaan Ibu Hamil";
        $this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
        $this->render("templates/contents/plain_content");
    }

    public function detail($ibuhamil_id)
    {
        $page = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
        //pagination parameter
        $pagination['base_url'] = base_url($this->current_page) . '/detail/' . $ibuhamil_id;
        $pagination['total_records'] = count($this->pemeriksaanibu_model->pemeriksaanibus(0, NULL, $ibuhamil_id)->result());
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page * $pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
        //set pagination
        if ($pagination['total_records'] > 0) $this->data['pagination_links'] = $this->setPagination($pagination);
        #################################################################3
        $table = $this->services->get_table_pemeriksaan_config($this->current_page, $ibuhamil_id);
        $table["rows"] = $this->pemeriksaanibu_model->pemeriksaanibus($pagination['start_record'], $pagination['limit_per_page'], $ibuhamil_id)->result();
        $table = $this->load->view('templates/tables/plain_table', $table, true);
        $this->data["contents"] = $table;

        $form_data = $this->services->get_form_data_pemeriksaan($ibuhamil_id);

        $add_menu = array(
            "name" => "Tambah Pemeriksaan",
            "modal_id" => "add_pemeriksaan_",
            "button_color" => "primary",
            "url" => site_url($this->current_page . "add/"),
            "form_data" => $form_data['form_data'],
            'data' => NULL
        );

        $add_menu = $this->load->view('templates/actions/modal_form', $add_menu, true);

        $this->data["header_button"] =  $add_menu;

        $alert = $this->session->flashdata('alert');
        $this->data["key"] = $this->input->get('key', FALSE);
        $this->data["alert"] = (isset($alert)) ? $alert : NULL;
        $this->data["current_page"] = $this->current_page;
        $this->data["block_header"] = "Data Ibu Hamil";
        $this->data["header"] = "Group";
        $this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
        $this->render("templates/contents/plain_content");
    }


    public function add()
    {
        $path = '';
        if (!($_POST)) redirect(site_url($this->current_page));

        // echo var_dump( $data );return;
        $this->form_validation->set_rules($this->services->validation_pemeriksaan());


        if ($this->form_validation->run() === TRUE) {

            $data['ibuhamil_id'] = $this->input->post('ibuhamil_id');
            $data['date'] = $this->input->post('date');
            $data['darah'] = $this->input->post('darah');
            $data['bb'] = $this->input->post('bb');
            $data['jantung'] = $this->input->post('jantung');
            $data['suhu'] = $this->input->post('suhu');
            $data['imunisasiibu_id'] = $this->input->post('imunisasiibu_id');
            $data['penyuluhanibu_id'] = $this->input->post('penyuluhanibu_id');

            if ($this->pemeriksaanibu_model->create($data)) {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->pemeriksaanibu_model->messages()));
            } else {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->pemeriksaanibu_model->errors()));
            }
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->pemeriksaanibu_model->errors() ? $this->pemeriksaanibu_model->errors() : $this->session->flashdata('message')));
            if (validation_errors() || $this->pemeriksaanibu_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));
        }
        if ($this->input->post('ibuhamil_id')) {
            $path = 'detail/' . $data['ibuhamil_id'];
        }

        redirect(site_url($this->current_page) . $path);
    }

    public function edit()
    {
        $path = '';
        if (!($_POST)) redirect(site_url($this->current_page));

        // echo var_dump( $data );return;
        $this->form_validation->set_rules($this->services->validation_pemeriksaan());
        if ($this->form_validation->run() === TRUE) {
            $data['ibuhamil_id'] = $this->input->post('ibuhamil_id');
            $data['date'] = $this->input->post('date');
            $data['darah'] = $this->input->post('darah');
            $data['bb'] = $this->input->post('bb');
            $data['jantung'] = $this->input->post('jantung');
            $data['suhu'] = $this->input->post('suhu');
            $data['imunisasiibu_id'] = $this->input->post('imunisasiibu_id');
            $data['penyuluhanibu_id'] = $this->input->post('penyuluhanibu_id');
            $data_param['id'] = $this->input->post('id');

            if ($this->pemeriksaanibu_model->update($data, $data_param)) {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->pemeriksaanibu_model->messages()));
            } else {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->pemeriksaanibu_model->errors()));
            }
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->pemeriksaanibu_model->errors() : $this->session->flashdata('message')));
            if (validation_errors() || $this->pemeriksaanibu_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));
        }

        if ($this->input->post('ibuhamil_id')) {
            $path = 'detail/' . $data['ibuhamil_id'];
        }
        redirect(site_url($this->current_page) . $path);
    }

    public function delete()
    {
        if (!($_POST)) redirect(site_url($this->current_page));

        $data_param['id']     = $this->input->post('id');
        if ($this->pemeriksaanibu_model->delete($data_param)) {
            $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->pemeriksaanibu_model->messages()));
        } else {
            $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->pemeriksaanibu_model->errors()));
        }
        redirect(site_url($this->current_page) . 'detail/' . $data_param['id']);
    }

    public function export($ibuhamil_id)
    {
        $this->load->library('pdfgenerator');

        $ibuhamil = $this->ibuhamil_model->ibuhamil($ibuhamil_id)->row();
        $pemeriksaan = $this->pemeriksaanibu_model->pemeriksaanibus(0, NULL, $ibuhamil_id)->result();

        $this->data['title_pdf'] = 'Pemeriksaan Ibu ' . $ibuhamil->name;
        $this->data['ibuhamil'] = $ibuhamil;
        $this->data['pemeriksaans'] = $pemeriksaan;

        $file_pdf = 'pemeriksaan_ibu_'  . $ibuhamil->name;
        $paper = 'A4';
        $orientation = 'potrait';

        $html = $this->load->view('export/exportibu.php', $this->data, true);

        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
