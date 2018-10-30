<?php
    class Template {

        protected $_ci;

        function __construct() {
            $this->_ci = &get_instance();
        }

        function display($template, $data = NULL) {
            $data['_sidebar']       = $this->_ci->load->view('templates/sidebar', $data, TRUE);
            $data['_content']       = $this->_ci->load->view($template, $data, TRUE);
            $data['_base']          = $this->_ci->load->view('templates/template.php', $data);
        }

    }
?>
