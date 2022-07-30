<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesan extends Uadmin_Controller
{
    private $services = null;
    private $name = null;
    private $parent_page = 'uadmin';
    private $current_page = 'uadmin/pesan/';
    private $_user_groups = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url', 'html', 'form');
        $this->data["menu_list_id"] = "pesan_index";
    }
    public function index($id_user = NULL)
    {
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        //pagination parameter
        $pagination['base_url'] = base_url($this->current_page) . '/index';
        $pagination['total_records'] = $this->ion_auth->record_count();
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page * $pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
        //set pagination
        if ($pagination['total_records'] > 0) $this->data['pagination_links'] = $this->setPagination($pagination);

        // $title = "Kirim Pesan Dengan SMS Getaway";

        // $this->load->view('pesan/send', ['title' => $title]);
        $alert = $this->session->flashdata('alert');
        $this->data["key"] = $this->input->get('key', FALSE);
        $this->data["alert"] = (isset($alert)) ? $alert : NULL;
        $this->data["current_page"] = $this->current_page;
        $this->data["block_header"] = "Jadwal Kegiatan";
        $this->data["header"] = "SMS Gateway";
        $this->data["sub_header"] = 'Kirim pesan pengingat kegiatan Posyandu';
        $this->render("templates/contents/plain_content_send");
    }


    public function sendmsg()
    {
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run()) {

            $mobile = $this->input->post('mobile');
            $message = $this->input->post('message');
            $data = $this->input->post();
            unset($data['submit']);

            $userkey = '249e52e2c46a';
            $passkey = '4aa40ccdf016413aed4440ac';
            $telepon = $mobile;
            $url = 'https://console.zenziva.net/reguler/api/sendsms/';
            $curlHandle = curl_init();
            curl_setopt($curlHandle, CURLOPT_URL, $url);
            curl_setopt($curlHandle, CURLOPT_HEADER, 0);
            curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
            curl_setopt($curlHandle, CURLOPT_POST, 1);
            curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
                'userkey' => $userkey,
                'passkey' => $passkey,
                'to' => $telepon,
                'message' => $message
            ));
            $results = json_decode(curl_exec($curlHandle), true);
            $output = curl_close($curlHandle);

?>
            <br>respon ID Mobile : <?php echo $output; ?> pesan sukses di kirim</br>
<?php
            echo "<script>alert('pesan berhasil di kirim');</script>";
            // var_dump($output);
            // die;
            redirect(base_url() . '/uadmin/pesan');
        } else {
            $this->index();
        }
    }
}

/* End of file pesan.php */
/* Location: ./application/controllers/pesan.php */