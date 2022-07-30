<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends Public_Controller
{

	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		// TODO : tampilkan landing page bagi user yang belum daftar
		redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
		// $this->render("landing_page");
	}
}
