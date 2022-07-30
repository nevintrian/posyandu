<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Jeniskegiatan_services
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
            'name' => 'Nama Kegiatan',
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
                        'type' => 'textarea',
                        'label' => "Nama Kegiatan",
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
                "data_name" => "name",
            ),
        );
        return $table;
    }
    public function validation_config()
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
}
