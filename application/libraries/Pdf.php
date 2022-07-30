<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
class Pdf extends DOMPDF
{
    public function __get($var)
    {
        return get_instance()->$var;
    }
    public function load_view($view, $data = array())
    {
        $html = $this->load->view($view, $data, TRUE);

        $this->load_html($html);
    }
}
