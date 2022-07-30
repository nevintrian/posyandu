<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Posyandu_services
{
    function __construct()
    {
    }

    public function __get($var)
    {
        return get_instance()->$var;
    }

    public function get_table_config($_page, $start_number = 1)
    {
        $table["header"] = array(
            'nama' => 'Nama Posyandu',
            'alamat' => 'Alamat',
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
                    "nama" => array(
                        'type' => 'text',
                        'label' => "Nama Posyandu",
                    ),
                    "alamat" => array(
                        'type' => 'textarea',
                        'label' => "Alamat",
                    ),
                ),
                "title" => "group",
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
                "data_name" => "nama",
            ),
        );
        return $table;
    }
    public function validation_config()
    {
        $config = array(

            array(
                'field' => 'nama',
                'label' => 'nama',
                'rules' =>  'trim|required',
            ),
        );

        return $config;
    }
}
