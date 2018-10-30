<?php
    if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
    class Dashboard extends CI_Controller {
    
        public function index(){
            $data['title'] = 'Dashboard';
            $data['breadcrumb'] = array('Dashboard' => base_url());

            $this->template->display('dashboard/index', $data);
        }
    }
