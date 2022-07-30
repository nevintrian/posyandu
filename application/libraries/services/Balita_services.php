<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Balita_services
{


    function __construct()
    {
    }

    public function __get($var)
    {
        return get_instance()->$var;
    }
    public function select_jk()
    {
        $this->load->model('jk_model');
        $jks = $this->jk_model->jks()->result();
        $select_jk = [];
        foreach ($jks as  $jk) {
            $select_jk[$jk->id] = $jk->name;
        }
        return $select_jk;
    }
    public function get_table_config($_page, $start_number = 1)
    {
        $select_jk = $this->select_jk();
        $table["header"] = array(
            'name' => 'Nama Pasien',
            'tgl_lahir' => 'Tanggal Lahir',
            'jk_name' => 'Jenis Kelamin',
            'nama_ortu' => 'Nama Orang Tua',
            'alamat' => 'Alamat',
            'no_hp' => 'No. HP',
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
                        'label' => "Nama Pasien",
                    ),
                    "tgl_lahir" => array(
                        'type' => 'date',
                        'label' => 'Tanggal Lahir',
                    ),
                    "jk_id" => array(
                        'type' => 'select',
                        'label' => "Jenis Kelamin",
                        'options' => $select_jk
                    ),
                    "nama_ortu" => array(
                        'type' => 'text',
                        'label' => 'Nama Orang Tua',
                    ),
                    "alamat" => array(
                        'type' => 'text',
                        'label' => 'Alamat',
                    ),
                    "no_hp" => array(
                        'type' => 'text',
                        'label' => 'No. HP',
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
            'name' => 'Jenis Kelamin',
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
                        'label' => "Jenis Kelamin",
                    ),
                ),
                "title" => "Group",
            ),
            array(
                "name" => 'X',
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
                'field' => 'name',
                'label' => 'name',
                'rules' =>  'trim|required',
            ),
            array(
                'field' => 'tgl_lahir',
                'label' => 'Tanggal Lahir',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'jk_id',
                'label' => 'Jenis Kelamin',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'nama_ortu',
                'label' => 'Nama Orang Tua',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'no_hp',
                'label' => 'No. HP',
                'rules' => 'trim|required',
            ),
        );

        return $config;
    }
    public function get_form_data($page)
    {
        $select_jk = $this->select_jk();
        $form_data = array(
            "name" => "Tambah Pasien",
            "modal_id" => "add_group_",
            "button_color" => "primary",
            "url" => site_url($page . "add/"),
            "form_data" => array(
                "name" => array(
                    'type' => 'text',
                    'label' => "Nama Pasien",
                ),
                "tgl_lahir" => array(
                    'type' => 'date',
                    'label' => 'Tanggal Lahir',
                ),
                "jk_id" => array(
                    'type' => 'select',
                    'label' => "Jenis Kelamin",
                    'options' => $select_jk
                ),
                "nama_ortu" => array(
                    'type' => 'text',
                    'label' => 'Nama Orang Tua',
                ),
                "alamat" => array(
                    'type' => 'text',
                    'label' => 'Alamat',
                ),
                "no_hp" => array(
                    'type' => 'text',
                    'label' => 'No. HP',
                ),
            ),
            'data' => NULL
        );
        return $form_data;
    }
}
