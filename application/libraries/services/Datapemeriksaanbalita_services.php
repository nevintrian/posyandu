<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Datapemeriksaanbalita_services
{


    function __construct()
    {
    }

    public function __get($var)
    {
        return get_instance()->$var;
    }
    public function select_balita()
    {
        $this->load->model('balita_model');
        $balitas = $this->balita_model->balitas()->result();
        $select_balita = [];
        foreach ($balitas as  $balita) {
            $select_balita[$balita->id] = $balita->name;
        }
        return $select_balita;
    }
    public function select_imunisasibalita()
    {
        $this->load->model('imunisasibalita_model');
        $imunisasibalitas = $this->imunisasibalita_model->imunisasibalitas()->result();
        $select_imunisasibalita = [];
        foreach ($imunisasibalitas as  $imunisasibalita) {
            $select_imunisasibalita[$imunisasibalita->id] = $imunisasibalita->name;
        }
        return $select_imunisasibalita;
    }
    public function select_penyuluhanbalita()
    {
        $this->load->model('penyuluhanbalita_model');
        $penyuluhanbalitas = $this->penyuluhanbalita_model->penyuluhanbalitas()->result();
        $select_penyuluhanbalita = [];
        foreach ($penyuluhanbalitas as  $penyuluhanbalita) {
            $select_penyuluhanbalita[$penyuluhanbalita->id] = $penyuluhanbalita->name;
        }
        return $select_penyuluhanbalita;
    }
    public function select_jk()
    {
        $this->load->model('jk_model');
        $jk = $this->jk_model->jk()->result();
        $select_jks = [];
        foreach ($jk as  $jk) {
            $select_jk[$jk->id] = $jk->name;
        }
        return $select_jk;
    }
    public function get_table_config($_page, $start_number = 1)
    {
        $select_jk = $this->select_jk();
        $table["header"] = array(
            'balita_name' => 'Nama Pasien',
            '_date' => 'Tanggal Pemeriksaan',
            'bb' => 'Berat Badan',
            'tb' => 'Tinggi Badan',
            'suhu' => 'Suhu Tubuh',
            'imunisasibalita_name' => 'Jenis Imunisasi',
            'penyuluhanbalita_name' => 'Jenis Penyuluhan',
        );
        $table["number"] = $start_number;
        // $table["action"] = array(
        //     array(
        //         "name" => 'Edit',
        //         "type" => "modal_form",
        //         "modal_id" => "edit_",
        //         "url" => site_url($_page . "edit/"),
        //         "button_color" => "primary",
        //         "param" => "id",
        //         "title" => "Group",
        //         "data_name" => "name",
        //     ),
        //     array(
        //         "name" => 'Hapus',
        //         "type" => "modal_delete",
        //         "modal_id" => "delete_",
        //         "url" => site_url($_page . "delete/"),
        //         "button_color" => "danger",
        //         "param" => "id",
        //         "form_data" => array(
        //             "id" => array(
        //                 'type' => 'hidden',
        //                 'label' => "id",
        //             ),
        //         ),
        //         'data_name' => 'balita_name',
        //         "title" => "Group",
        //     ),
        // );
        return $table;
    }

    public function get_table_pemeriksaan_config($_page, $balita_id = NULL, $start_number = 1)
    {
        // $select_jk = $this->select_jk();
        // $table["header"] = array(
        //     'balita_name' => 'Nama Pasien',
        //     '_date' => 'Tanggal Pemeriksaan',
        //     'bb' => 'Berat Badan',
        //     'tb' => 'Tinggi Badan',
        //     'suhu' => 'Suhu Tubuh',
        //     'imunisasibalita_name' => 'Jenis Imunisasi',
        //     'penyuluhanbalita_name' => 'Jenis Penyuluhan',
        // );
        // $table["number"] = $start_number;
        // $table["action"] = array(
        //     array(
        //         "name" => 'Edit',
        //         "type" => "modal_form",
        //         "modal_id" => "edit_",
        //         "url" => site_url($_page . "edit/"),
        //         "button_color" => "primary",
        //         "param" => "id",
        //         "form_data" => $this->get_form_data_pemeriksaan($balita_id)['form_data'],
        //         "title" => "Group",
        //         "data_name" => "name",
        //     ),
        //     array(
        //         "name" => 'Hapus',
        //         "type" => "modal_delete",
        //         "modal_id" => "delete_",
        //         "url" => site_url($_page . "delete/"),
        //         "button_color" => "danger",
        //         "param" => "id",
        //         "form_data" => array(
        //             "id" => array(
        //                 'type' => 'hidden',
        //                 'label' => "id",
        //             ),
        //         ),
        //         'data_name' => 'balita_name',
        //         "title" => "Group",
        //     ),
        // );
        // return $table;
    }
    public function get_table_group_config($_page, $start_number = 1)
    {
        $table["header"] = array(
            'name' => 'Jenis Kelamin',
        );
        $table["number"] = $start_number;
        // $table["action"] = array(
        //     array(
        //         "name" => 'Tambah Pemeriksaan',
        //         "type" => "link",
        //         "modal_id" => "edit_",
        //         "url" => site_url($_page . "add/"),
        //         "button_color" => "primary",
        //         "param" => "id",

        //     ),
        // array(
        //     "name" => 'Hapus',
        //     "type" => "modal_delete",
        //     "modal_id" => "delete_",
        //     "url" => site_url($_page . "delete/"),
        //     "button_color" => "danger",
        //     "param" => "id",
        //     "form_data" => array(
        //         "id" => array(
        //             'type' => 'hidden',
        //             'label' => "id",
        //         ),
        //     ),
        //     "title" => "Group",
        // ),
        // );
        return $table;
    }
    public function validation_group_config()
    {
        $config = array(
            array(
                'field' => 'name',
                'label' => 'name',
                'rules' =>  'trim|required',
            ),
        );

        return $config;
    }
    public function validation_config()
    {
        $config = array(
            array(
                'field' => 'balita_id',
                'label' => 'balita_id',
                'rules' =>  'trim|required',
            ),
            array(
                'field' => 'penyuluhanbalita_id',
                'label' => 'Penyuluhan',
                'rules' =>  'trim|required',
            ),
            array(
                'field' => 'imunisasibalita_id',
                'label' => 'Jenis Imunisasi',
                'rules' =>  'trim|required',
            ),
            array(
                'field' => 'date',
                'label' => 'Tanggal Pemeriksaan',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'bb',
                'label' => 'Berat Badan',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'tb',
                'label' => 'Tinggi Badan',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'suhu',
                'label' => 'Suhu Tubuh',
                'rules' => 'trim|required',
            ),
        );

        return $config;
    }
    public function validation_pemeriksaan()
    {
        // $config = array(
        //     array(
        //         'field' => 'balita_id',
        //         'label' => 'balita_id',
        //         'rules' =>  'trim|required',
        //     ),
        //     array(
        //         'field' => 'penyuluhanbalita_id',
        //         'label' => 'Penyuluhan',
        //         'rules' =>  'trim|required',
        //     ),
        //     array(
        //         'field' => 'imunisasibalita_id',
        //         'label' => 'Jenis Imunisasi',
        //         'rules' =>  'trim|required',
        //     ),
        //     array(
        //         'field' => 'date',
        //         'label' => 'Tanggal Pemeriksaan',
        //         'rules' => 'trim|required',
        //     ),
        //     array(
        //         'field' => 'bb',
        //         'label' => 'Berat Badan',
        //         'rules' => 'trim|required',
        //     ),
        //     array(
        //         'field' => 'tb',
        //         'label' => 'Tinggi Badan',
        //         'rules' => 'trim|required',
        //     ),
        //     array(
        //         'field' => 'suhu',
        //         'label' => 'Suhu Tubuh',
        //         'rules' => 'trim|required',
        //     ),
        // );

        // return $config;
    }
    public function get_form_data()
    {

        $select_imunisasibalita = $this->select_imunisasibalita();
        $select_penyuluhanbalita = $this->select_penyuluhanbalita();
        $form_data['form_data'] = array(
            "id" => array(
                'type' => 'hidden',
                'label' => "id",
            ),
            "balita_id" => array(
                'type' => 'select',
                'label' => 'Nama Balita',
            ),
            "imunisasibalita_id" => array(
                'type' => 'select',
                'label' => 'Jenis Penyuluhan',
                'options' => $select_imunisasibalita,
            ),
            "penyuluhanbalita_id" => array(
                'type' => 'select',
                'label' => 'Jenis Penyuluhan',
                'options' => $select_penyuluhanbalita,
            ),
            "balita_id" => array(
                'type' => 'hidden',
                'label' => 'balita_id',

            ),
            "date" => array(
                'type' => 'text',
                'label' => "Tanggal",
                'value' => date('Y-m-d'),
            ),
            "bb" => array(
                'type' => 'text',
                'label' => 'Berat Badan',
            ),
            "tb" => array(
                'type' => 'text',
                'label' => 'Tinggi Badan',
            ),
            "suhu" => array(
                'type' => 'text',
                'label' => 'Suhu Badan',
            ),
        );
        return $form_data;
    }
    public function get_form_data_pemeriksaan($balita_id)
    {

        // $select_imunisasibalita = $this->select_imunisasibalita();
        // $select_penyuluhanbalita = $this->select_penyuluhanbalita();
        // $form_data['form_data'] = array(
        //     "id" => array(
        //         'type' => 'hidden',
        //         'label' => "id",
        //     ),
        //     "imunisasibalita_id" => array(
        //         'type' => 'select',
        //         'label' => 'Jenis Penyuluhan',
        //         'options' => $select_imunisasibalita,
        //     ),
        //     "penyuluhanbalita_id" => array(
        //         'type' => 'select',
        //         'label' => 'Jenis Penyuluhan',
        //         'options' => $select_penyuluhanbalita,
        //     ),
        //     "balita_id" => array(
        //         'type' => 'hidden',
        //         'label' => 'balita_id',
        //         'value' => $balita_id,
        //     ),
        //     "date" => array(
        //         'type' => 'text',
        //         'label' => "Tanggal",
        //         'value' => date('Y-m-d'),
        //     ),
        //     "bb" => array(
        //         'type' => 'text',
        //         'label' => 'Berat Badan',
        //     ),
        //     "tb" => array(
        //         'type' => 'text',
        //         'label' => 'Tinggi Badan',
        //     ),
        //     "suhu" => array(
        //         'type' => 'text',
        //         'label' => 'Suhu Badan',
        //     ),
        // );
        // return $form_data;
    }
}
