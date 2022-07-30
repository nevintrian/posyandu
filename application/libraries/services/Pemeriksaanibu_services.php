<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pemeriksaanibu_services
{


    function __construct()
    {
    }

    public function __get($var)
    {
        return get_instance()->$var;
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

    public function get_table_config($_page, $start_number = 1)
    {
        $select_imunisasiibu = $this->select_imunisasiibu();
        $select_penyuluhanibu = $this->select_penyuluhanibu();
        $table["header"] = array(
            'ibuhamil_name' => 'Nama',
            'ibuhamil_tgl_lahir' => 'Tgl Lahir',
            'ibuhamil_jk_id' => 'Jenis Kelamin',
            'ibuhamil_alamat' => 'Alamat',
            'ibuhamil_no_hp' => 'No.HP',
            'imunisasiibu_name' => 'Imunisasi',
            'penyuluhanibu_name' => 'Penyuluhan',
            'darah' => 'Tensi',
            'bb' => 'BB',
            'jantung' => 'Detak jantung janin',
            'suhu' => 'Suhu badan',
        );
        $table["number"] = $start_number;
        $table["action"] = array(
            array(
                "name" => 'Edit',
                "type" => "modal_form",
                "modal_id" => "edit_",
                "url" => site_url($_page . "edit/"),
                "button_color" => "primary",
                "param" => "id",
                "form_data" => array(
                    "id" => array(
                        'type' => 'hidden',
                        'label' => "id",
                    ),
                    "ibuhamil_name" => array(
                        'type' => 'text',
                        'label' => "Nama Ibu Hamil",
                    ),
                    "ibuhamil_tgl_lahir" => array(
                        'type' => 'date',
                        'label' => 'Tgl Lahir',
                    ),
                    "ibuhamil_jk_id" => array(
                        'type' => 'text',
                        'label' => "Jenis Kelamin",
                    ),
                    "ibuhamil_alamat" => array(
                        'type' => 'text',
                        'label' => 'Alamat',
                    ),
                    "ibuhamil_no_hp" => array(
                        'type' => 'text',
                        'label' => 'No. HP',
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
                    "imunisasiibu_id" => array(
                        'type' => 'select',
                        'label' => 'Jenis Penyuluhan',
                        'options' => $select_imunisasiibu,
                    ),
                    "penyuluhanibu_id" => array(
                        'type' => 'select',
                        'label' => 'Jenis Penyuluhan',
                        'options' => $select_penyuluhanibu,
                    ),


                ),
                "title" => "Group",
            ),
            array(
                "name" => 'Hapus',
                "type" => "modal_delete",
                "modal_id" => "delete_",
                "url" => site_url($_page . "delete/"),
                "button_color" => "danger",
                "param" => "id",
                "form_data" => array(
                    "id" => array(
                        'type' => 'hidden',
                        'label' => "id",
                    ),
                ),
                "title" => "Group",
            ),
        );
        return $table;
    }
    public function get_table_group_config($_page, $start_number = 1)
    {
        $table["header"] = array(
            'name' => 'Jenis Imunisasi',
        );
        $table["number"] = $start_number;
        $table["action"] = array(
            array(
                "name" => 'Edit',
                "type" => "modal_form",
                "modal_id" => "edit_",
                "url" => site_url($_page . "edit/"),
                "button_color" => "primary",
                "param" => "id",
                "form_data" => array(
                    "id" => array(
                        'type' => 'hidden',
                        'label' => "id",
                    ),
                    "name" => array(
                        'type' => 'text',
                        'label' => "Jenis Imunisasi",
                    ),
                ),
                "title" => "Group",
            ),
            array(
                "name" => 'Hapus',
                "type" => "modal_delete",
                "modal_id" => "delete_",
                "url" => site_url($_page . "delete/"),
                "button_color" => "danger",
                "param" => "id",
                "form_data" => array(
                    "id" => array(
                        'type' => 'hidden',
                        'label' => "id",
                    ),
                ),
                "title" => "Group",
            ),
        );
        return $table;

        $table["header"] = array(
            'name' => 'Jenis Penyuluhan',
        );
        $table["number"] = $start_number;
        $table["action"] = array(
            array(
                "name" => 'Edit',
                "type" => "modal_form",
                "modal_id" => "edit_",
                "url" => site_url($_page . "edit/"),
                "button_color" => "primary",
                "param" => "id",
                "form_data" => array(
                    "id" => array(
                        'type' => 'hidden',
                        'label' => "id",
                    ),
                    "name" => array(
                        'type' => 'text',
                        'label' => "Jenis Penyuluhan",
                    ),
                ),
                "title" => "Group",
            ),
            array(
                "name" => 'Hapus',
                "type" => "modal_delete",
                "modal_id" => "delete_",
                "url" => site_url($_page . "delete/"),
                "button_color" => "danger",
                "param" => "id",
                "form_data" => array(
                    "id" => array(
                        'type' => 'hidden',
                        'label' => "id",
                    ),
                ),
                "title" => "Group",
            ),
        );
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
                'field' => 'ibuhamil_name',
                'label' => 'Nama Ibu Hamil',
                'rules' =>  'trim|required',
            ),
            array(
                'field' => 'ibuhamil_tgl_lahir',
                'label' => 'Tgl Lahir',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'ibuhamil_jk_id',
                'label' => 'Jenis Kelamin',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'ibuhamil_alamat',
                'label' => 'Alamat',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'ibuhamil_no_hp',
                'label' => 'No. HP',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'imunisasiibu_id',
                'label' => 'Jenis Imunisasi',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'penyuluhanibu_id',
                'label' => 'Jenis Penyuluhan',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'darah',
                'label' => 'Tekanan darah',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'bb',
                'label' => 'BB',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'jantung',
                'label' => 'Detak jantung janin',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'suhu',
                'label' => 'Suhu badan',
                'rules' => 'trim|required',
            ),

        );

        return $config;
    }
    public function get_form_data($page)
    {
        $select_imunisasiibu = $this->select_imunisasiibu();
        $select_penyuluhanibu = $this->select_penyuluhanibu();
        $form_data = array(
            "name" => "Tambah Pemeriksaan",
            "modal_id" => "add_group_",
            "button_color" => "primary",
            "url" => site_url($page . "add/"),
            "form_data" => array(
                "ibuhamil_name" => array(
                    'type' => 'text',
                    'label' => "Nama Ibu Hamil",
                ),
                "ibuhamil_tgl_lahir" => array(
                    'type' => 'date',
                    'label' => 'Tgl Lahir',
                ),
                "ibuhamil_jk_id" => array(
                    'type' => 'text',
                    'label' => "Jenis Kelamin",
                ),
                "ibuhamil_alamat" => array(
                    'type' => 'text',
                    'label' => 'Alamat',
                ),
                "ibuhamil_no_hp" => array(
                    'type' => 'text',
                    'label' => 'No. HP',
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
            ),
            'data' => NULL
        );
        return $form_data;
    }
}
