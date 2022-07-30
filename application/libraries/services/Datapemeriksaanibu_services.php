<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Datapemeriksaanibu_services
{


    function __construct()
    {
    }

    public function __get($var)
    {
        return get_instance()->$var;
    }
    public function select_ibuhamil()
    {
        $this->load->model('ibuhamil_model');
        $ibuhamils = $this->ibuhamil_model->ibuhamils()->result();
        $select_ibuhamil = [];
        foreach ($ibuhamils as  $ibuhamil) {
            $select_ibuhamil[$ibuhamil->id] = $ibuhamil->name;
        }
        return $select_ibuhamil;
    }
    public function select_imunisasiibu()
    {
        $this->load->model('imunisasiibu_model');
        $imunisasiibus = $this->imunisasiibu_model->imunisasiibus()->result();
        $select_imunisasiibu = [];
        foreach ($imunisasiibus as  $imunisasiibu) {
            $select_imunisasiibu[$imunisasiibu->id] = $imunisasiibu->name;
        }
        return $select_imunisasiibu;
    }
    public function select_penyuluhanibu()
    {
        $this->load->model('penyuluhanibu_model');
        $penyuluhanibus = $this->penyuluhanibu_model->penyuluhanibus()->result();
        $select_penyuluhanibu = [];
        foreach ($penyuluhanibus as  $penyuluhanibu) {
            $select_penyuluhanibu[$penyuluhanibu->id] = $penyuluhanibu->name;
        }
        return $select_penyuluhanibu;
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
            'ibuhamil_name' => 'Nama Pasien',
            '_date' => 'Tanggal Pemeriksaan',
            'darah' => 'Tekanan darah',
            'bb' => 'Berat Badan',
            'suhu' => 'Suhu Tubuh',
            'jantung' => 'Detak Jantung janin',
            'imunisasiibu_name' => 'Jenis Imunisasi',
            'penyuluhanibu_name' => 'Jenis Penyuluhan',
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
        //         'data_name' => 'ibuhamil_name',
        //         "title" => "Group",
        //     ),
        // );
        return $table;
    }

    public function get_table_pemeriksaan_config($_page, $ibuhamil_id = NULL, $start_number = 1)
    {
        // $select_jk = $this->select_jk();
        // $table["header"] = array(
        //     'ibuhamil_name' => 'Nama Pasien',
        //     '_date' => 'Tanggal Pemeriksaan',
        //     'bb' => 'Berat Badan',
        //     'tb' => 'Tinggi Badan',
        //     'suhu' => 'Suhu Tubuh',
        //     'imunisasiibuhamil_name' => 'Jenis Imunisasi',
        //     'penyuluhanibuhamil_name' => 'Jenis Penyuluhan',
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
        //         "form_data" => $this->get_form_data_pemeriksaan($ibuhamil_id)['form_data'],
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
        //         'data_name' => 'ibuhamil_name',
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
                'field' => 'ibuhamil_id',
                'label' => 'ibuhamil_id',
                'rules' =>  'trim|required',
            ),
            array(
                'field' => 'date',
                'label' => 'Tanggal Pemeriksaan',
                'rules' =>  'trim|required',
            ),
            array(
                'field' => 'penyuluhanibu_id',
                'label' => 'Penyuluhan',
                'rules' =>  'trim|required',
            ),
            array(
                'field' => 'imunisasiibu_id',
                'label' => 'Jenis Imunisasi',
                'rules' =>  'trim|required',
            ),

            array(
                'field' => 'darah',
                'label' => 'Darah',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'bb',
                'label' => 'Berat Badan',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'jantung',
                'label' => 'Jantung',
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
        //         'field' => 'ibuhamil_id',
        //         'label' => 'ibuhamil_id',
        //         'rules' =>  'trim|required',
        //     ),
        //     array(
        //         'field' => 'penyuluhanibuhamil_id',
        //         'label' => 'Penyuluhan',
        //         'rules' =>  'trim|required',
        //     ),
        //     array(
        //         'field' => 'imunisasiibuhamil_id',
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

        $select_imunisasiibu = $this->select_imunisasiibu();
        $select_penyuluhanibu = $this->select_penyuluhanibu();
        $form_data['form_data'] = array(
            "id" => array(
                'type' => 'hidden',
                'label' => "id",
            ),
            "ibuhamil_id" => array(
                'type' => 'hidden',
                'label' => 'ibuhamil_id',
            ),
            "penyuluhanibu_id" => array(
                'type' => 'select',
                'label' => 'Jenis Penyuluhan',
                'options' => $select_penyuluhanibu,
            ),
            "imunisasiibu_id" => array(
                'type' => 'select',
                'label' => 'Jenis Penyuluhan',
                'options' => $select_imunisasiibu,
            ),
            "date" => array(
                'type' => 'text',
                'label' => 'Tanggal Pemeriksaan',
                'value' => date('Y-m-d'),
            ),

            "darah" => array(
                'type' => 'text',
                'label' => 'Tekanan Darah',
            ),
            "bb" => array(
                'type' => 'text',
                'label' => 'BB',
            ),
            "jantung" => array(
                'type' => 'text',
                'label' => 'Detak Jantung Janin',
            ),
            "suhu" => array(
                'type' => 'text',
                'label' => 'Suhu Badan',
            ),
        );
        return $form_data;
    }
    public function get_form_data_pemeriksaan($ibuhamil_id)
    {

        // $select_imunisasiibuhamil = $this->select_imunisasiibuhamil();
        // $select_penyuluhanibuhamil = $this->select_penyuluhanibuhamil();
        // $form_data['form_data'] = array(
        //     "id" => array(
        //         'type' => 'hidden',
        //         'label' => "id",
        //     ),
        //     "imunisasiibuhamil_id" => array(
        //         'type' => 'select',
        //         'label' => 'Jenis Penyuluhan',
        //         'options' => $select_imunisasiibuhamil,
        //     ),
        //     "penyuluhanibuhamil_id" => array(
        //         'type' => 'select',
        //         'label' => 'Jenis Penyuluhan',
        //         'options' => $select_penyuluhanibuhamil,
        //     ),
        //     "ibuhamil_id" => array(
        //         'type' => 'hidden',
        //         'label' => 'ibuhamil_id',
        //         'value' => $ibuhamil_id,
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
