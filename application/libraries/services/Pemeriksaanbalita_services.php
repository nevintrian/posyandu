<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pemeriksaanbalita_services
{


    function __construct()
    {
    }

    public function __get($var)
    {
        return get_instance()->$var;
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

    public function get_table_config($_page, $start_number = 1)
    {
        $select_imunisasibalita = $this->select_imunisasibalita();
        $select_penyuluhanbalita = $this->select_penyuluhanbalita();
        $table["header"] = array(
            'balita_name' => 'Nama',
            'balita_tgl_lahir' => 'Tgl Lahir',
            'balita_jk_id' => 'Jenis Kelamin',
            'balita_alamat' => 'Alamat',
            'balita_no_hp' => 'No.HP',
            'imunisasibalita_name' => 'Jenis Imunisasi',
            'penyuluhanbalita_name' => 'Jenis Penyuluhan',
            'bb' => 'BB',
            'tb' => 'TB',
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
                    "balita_name" => array(
                        'type' => 'text',
                        'label' => "Nama balita ",
                    ),
                    "balita_tgl_lahir" => array(
                        'type' => 'date',
                        'label' => 'Tgl Lahir',
                    ),
                    "balita_jk_id" => array(
                        'type' => 'text',
                        'label' => "Jenis Kelamin",
                    ),
                    "balita_alamat" => array(
                        'type' => 'text',
                        'label' => 'Alamat',
                    ),
                    "balita_no_hp" => array(
                        'type' => 'text',
                        'label' => 'No. HP',
                    ),
                    "bb" => array(
                        'type' => 'text',
                        'label' => 'BB',
                    ),
                    "tb" => array(
                        'type' => 'text',
                        'label' => 'TB',
                    ),
                    "suhu" => array(
                        'type' => 'text',
                        'label' => 'Suhu Badan',
                    ),
                    "penyuluhanbalita_id" => array(
                        'type' => 'select',
                        'label' => 'Jenis Penyuluhan',
                        'options' => $select_penyuluhanbalita,
                    ),
                    "imunisasibalita_id" => array(
                        'type' => 'select',
                        'label' => 'Jenis Penyuluhan',
                        'options' => $select_imunisasibalita,
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
                'field' => 'balita_name',
                'label' => 'Nama balita ',
                'rules' =>  'trim|required',
            ),
            array(
                'field' => 'balita_tgl_lahir',
                'label' => 'Tgl Lahir',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'balita_jk_id',
                'label' => 'Jenis Kelamin',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'balita_alamat',
                'label' => 'Alamat',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'balita_no_hp',
                'label' => 'No. HP',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'bb',
                'label' => 'BB',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'tb',
                'label' => 'TB',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'suhu',
                'label' => 'Suhu badan',
                'rules' => 'trim|required',
            ), array(
                'field' => 'imunisasibalita_id',
                'label' => 'Jenis Imunisasi',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'penyuluhanbalita_id',
                'label' => 'Jenis Penyuluhan',
                'rules' => 'trim|required',
            ),

        );

        return $config;
    }
    public function get_form_data($page)
    {
        $select_imunisasibalita = $this->select_imunisasibalita();
        $select_penyuluhanbalita = $this->select_penyuluhanbalita();
        $form_data = array(
            "name" => "Tambah Pemeriksaan",
            "modal_id" => "add_group_",
            "button_color" => "primary",
            "url" => site_url($page . "add/"),
            "form_data" => array(
                "balita_name" => array(
                    'type' => 'text',
                    'label' => "Nama balita ",
                ),
                "balita_tgl_lahir" => array(
                    'type' => 'date',
                    'label' => 'Tgl Lahir',
                ),
                "balita_jk_id" => array(
                    'type' => 'text',
                    'label' => "Jenis Kelamin",
                ),
                "balita_alamat" => array(
                    'type' => 'text',
                    'label' => 'Alamat',
                ),
                "balita_no_hp" => array(
                    'type' => 'text',
                    'label' => 'No. HP',
                ),
                "bb" => array(
                    'type' => 'text',
                    'label' => 'BB',
                ),
                "tb" => array(
                    'type' => 'text',
                    'label' => 'TB',
                ),
                "suhu" => array(
                    'type' => 'text',
                    'label' => 'Suhu Badan',
                ),
                "penyuluhanbalita_id" => array(
                    'type' => 'select',
                    'label' => 'Jenis Penyuluhan',
                    'options' => $select_penyuluhanbalita,
                ),
                "imunisasibalita_id" => array(
                    'type' => 'select',
                    'label' => 'Jenis Penyuluhan',
                    'options' => $select_imunisasibalita,
                ),

            ),
            'data' => NULL
        );
        return $form_data;
    }
}
