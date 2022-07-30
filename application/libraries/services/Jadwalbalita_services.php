<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Jadwalbalita_services
{


    function __construct()
    {
    }

    public function __get($var)
    {
        return get_instance()->$var;
    }
    public function select_jeniskegiatan()
    {
        $this->load->model('jeniskegiatan_model');
        $jeniskegiatans = $this->jeniskegiatan_model->jeniskegiatans()->result();
        $select_jeniskegiatan = [];
        foreach ($jeniskegiatans as  $jeniskegiatan) {
            $select_jeniskegiatan[$jeniskegiatan->id] = $jeniskegiatan->name;
        }
        return $select_jeniskegiatan;
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

    public function select_posyandu()
    {
        $this->load->model('posyandu_model');
        $posyandus = $this->posyandu_model->posyandus()->result();
        $select_posyandu = [];
        foreach ($posyandus as  $posyandu) {
            $select_posyandu[$posyandu->id] = $posyandu->nama;
        }
        return $select_posyandu;
    }
    public function get_table_config($_page, $start_number = 1)
    {
        $select_jeniskegiatan = $this->select_jeniskegiatan();
        $select_imunisasibalita = $this->select_imunisasibalita();
        $select_penyuluhanbalita = $this->select_penyuluhanbalita();
        $select_posyandu = $this->select_posyandu();
        $table["header"] = array(
            'jeniskegiatan_name' => 'Jenis Kegiatan',
            'jadwal' => 'Jadwal Kegiatan',
            'imunisasibalita_name' => 'Jenis Imunisasi',
            'penyuluhanbalita_name' => 'Jenis penyuluhan',
            'posyandu_name' => 'Posyandu',
        );
        $table["number"] = $start_number;
        $table["action"] = array(
            array(
                "name" => "Kirim Pesan",
                "type" => "link",
                "url" => site_url($_page . "pesan/"),
                "button_color" => "success",
                "param" => "id",
            ),
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
                    "jeniskegiatan_id" => array(
                        'type' => 'select',
                        'label' => "Jenis Kegiatan",
                        'options' => $select_jeniskegiatan,
                    ),
                    "jadwal" => array(
                        'type' => 'date',
                        'label' => 'Jadwal Kegiatan',
                    ),
                    "imunisasibalita_id" => array(
                        'type' => 'select',
                        'label' => "Jenis Imunisasi",
                        'options' => $select_imunisasibalita,
                    ),
                    "penyuluhanbalita_id" => array(
                        'type' => 'select',
                        'label' => 'Jenis Penyuluhan',
                        'options' => $select_penyuluhanbalita,
                    ),
                    "posyandu_id" => array(
                        'type' => 'select',
                        'label' => 'Posyandu',
                        'options' => $select_posyandu,
                    ),
                ),
                "data_name" => "jeniskegiatan_name",
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
            'name' => 'Jenis Kegiatan',
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
                        'label' => "Jenis Kegiatan",
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
        $table["header"] = array(
            'name' => 'Posyandu',
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
                        'label' => "Posyandu",
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
            array(
                'field' => 'nama',
                'label' => 'nama',
                'rules' =>  'trim|required',
            ),
        );

        return $config;
    }
    public function validation_config()
    {
        $config = array(
            array(
                'field' => 'jeniskegiatan_id',
                'label' => 'Jenis Kegiatan',
                'rules' =>  'trim|required',
            ),
            array(
                'field' => 'jadwal',
                'label' => 'Jadwal Kegiatan',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'imunisasibalita_id',
                'label' => 'Jenis Imunisasi',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'penyuluhanbalita_id',
                'label' => 'Jenis Penyuluhan',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'posyandu_id',
                'label' => 'Posyandu',
                'rules' => 'trim|required',
            ),

        );

        return $config;
    }
    public function get_form_data($page)
    {
        $select_jeniskegiatan = $this->select_jeniskegiatan();
        $select_imunisasibalita = $this->select_imunisasibalita();
        $select_penyuluhanbalita = $this->select_penyuluhanbalita();
        $select_posyandu = $this->select_posyandu();
        $form_data = array(
            "name" => "Tambah Kegiatan",
            "modal_id" => "add_group_",
            "button_color" => "primary",
            "url" => site_url($page . "add/"),
            "form_data" => array(
                "jeniskegiatan_id" => array(
                    'type' => 'select',
                    'label' => "Jenis Kegiatan",
                    'options' => $select_jeniskegiatan,
                ),
                "jadwal" => array(
                    'type' => 'date',
                    'label' => 'Jadwal Kegiatan',
                ),
                "imunisasibalita_id" => array(
                    'type' => 'select',
                    'label' => "Jenis Imunisasi",
                    'options' => $select_imunisasibalita,
                ),
                "penyuluhanbalita_id" => array(
                    'type' => 'select',
                    'label' => 'Jenis Penyuluhan',
                    'options' => $select_penyuluhanbalita,
                ),
                "posyandu_id" => array(
                    'type' => 'select',
                    'label' => 'Posyandu',
                    'options' => $select_posyandu,
                ),
            ),
            'data' => NULL
        );
        return $form_data;
    }
}
