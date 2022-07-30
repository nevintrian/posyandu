<?php
defined('BASEPATH') or exit('No direct script access allowed');
class balita extends Bidan_Controller
{
    private $services = null;
    private $name = null;
    private $parent_page = 'bidan';
    private $current_page = 'bidan/balita/';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('services/Pasienbalita_services');
        $this->services = new Pasienbalita_services;
        $this->load->model(array(
            'jk_model',
            'balita_model',
            'pemeriksaanbalita_model',
            'imunisasibalita_model',
            'penyuluhanbalita_model',
        ));
    }
    public function index()
    {
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) -  1) : 0;
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

        $alert = $this->session->flashdata('alert');
        $this->data["key"] = $this->input->get('key', FALSE);
        $this->data["alert"] = (isset($alert)) ? $alert : NULL;
        $this->data["current_page"] = $this->current_page;
        $this->data["block_header"] = "Pemeriksaan Balita";
        $this->data["header"] = "Pemeriksaan Balita";
        $this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
        $this->render("templates/contents/plain_content");
    }

    public function detail($balita_id)
    {
        $page = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
        //pagination parameter
        $pagination['base_url'] = base_url($this->current_page) . '/detail/' . $balita_id;
        $pagination['total_records'] = count($this->pemeriksaanbalita_model->pemeriksaanbalitas(0, NULL, $balita_id)->result());
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page * $pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
        //set pagination
        if ($pagination['total_records'] > 0) $this->data['pagination_links'] = $this->setPagination($pagination);
        #################################################################3
        $table = $this->services->get_table_pemeriksaan_config($this->current_page, $balita_id);
        $table["rows"] = $this->pemeriksaanbalita_model->pemeriksaanbalitas($pagination['start_record'], $pagination['limit_per_page'], $balita_id)->result();
        $table = $this->load->view('templates/tables/plain_table', $table, true);
        $this->data["contents"] = $table;

        $form_data = $this->services->get_form_data_pemeriksaan($balita_id);

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
        $this->data["block_header"] = "Data balita";
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

            $data['balita_id'] = $this->input->post('balita_id');
            $data['date'] = $this->input->post('date');
            $data['tb'] = $this->input->post('tb');
            $data['bb'] = $this->input->post('bb');
            $data['suhu'] = $this->input->post('suhu');
            $data['imunisasibalita_id'] = $this->input->post('imunisasibalita_id');
            $data['penyuluhanbalita_id'] = $this->input->post('penyuluhanbalita_id');

            if ($this->pemeriksaanbalita_model->create($data)) {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->pemeriksaanbalita_model->messages()));
            } else {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->pemeriksaanbalita_model->errors()));
            }
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->pemeriksaanbalita_model->errors() ? $this->pemeriksaanbalita_model->errors() : $this->session->flashdata('message')));
            if (validation_errors() || $this->pemeriksaanbalita_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));
        }
        if ($this->input->post('balita_id')) {
            $path = 'detail/' . $data['balita_id'];
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
            $data['balita_id'] = $this->input->post('balita_id');
            $data['date'] = $this->input->post('date');
            $data['tb'] = $this->input->post('tb');
            $data['bb'] = $this->input->post('bb');
            $data['suhu'] = $this->input->post('suhu');
            $data['imunisasibalita_id'] = $this->input->post('imunisasibalita_id');
            $data['penyuluhanbalita_id'] = $this->input->post('penyuluhanbalita_id');
            $data_param['id'] = $this->input->post('id');

            if ($this->pemeriksaanbalita_model->update($data, $data_param)) {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->pemeriksaanbalita_model->messages()));
            } else {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->pemeriksaanbalita_model->errors()));
            }
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->pemeriksaanbalita_model->errors() : $this->session->flashdata('message')));
            if (validation_errors() || $this->pemeriksaanbalita_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));
        }

        if ($this->input->post('balita_id')) {
            $path = 'detail/' . $data['balita_id'];
        }
        redirect(site_url($this->current_page) . $path);
    }

    public function delete()
    {
        if (!($_POST)) redirect(site_url($this->current_page));

        $data_param['id']     = $this->input->post('id');
        if ($this->pemeriksaanbalita_model->delete($data_param)) {
            $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->pemeriksaanbalita_model->messages()));
        } else {
            $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->pemeriksaanbalita_model->errors()));
        }
        redirect(site_url($this->current_page) . 'detail/' . $data_param['id']);
    }

    public function export($balita_id)
    {
        $this->load->library('pdfgenerator');

        $balita = $this->balita_model->balita($balita_id)->row();
        $pemeriksaan = $this->pemeriksaanbalita_model->pemeriksaanbalitas(0, NULL, $balita_id)->result();

        $this->data['title_pdf'] = 'Pemeriksaan Balita ' . $balita->name;
        $this->data['balita'] = $balita;
        $this->data['pemeriksaans'] = $pemeriksaan;

        $file_pdf = 'pemeriksaan_balita_' . $balita->name;
        $paper = 'A4';
        $orientation = 'landscape';

        $html = $this->load->view('export/exportbalita.php', $this->data, true);

        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
