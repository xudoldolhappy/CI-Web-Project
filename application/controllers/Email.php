<?php
/**
 * Created by PhpStorm.
 * User: ruh19
 * Date: 7/9/2018
 * Time: 6:05 AM
 */
class Email extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('email');
    }
    public function index() {
        $this->load->helper('form');
        $this->load->view('contact_email_form');
    }
    public function send_mail() {
        $this->load->library('email');
//        $this->load->library('encrypt');
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_timeout' => 7,
            'smtp_user' => 'hmc198918@gmail.com',
            'smtp_pass' => '!hk2015129!',
            'mailtype'  => 'html',
            'newline' => '\r\n',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $htmlContent = '<h1>Sending email via SMTP server</h1>';
        $htmlContent .= '<p>This email has sent via SMTP server from CodeIgniter application.</p>';

        $this->email->to('hmc198918@outlook.com');
        $this->email->from('ruh1991912@outlook.com','MyWebsite');
        $this->email->subject('How to send email via SMTP server in CodeIgniter');
        $this->email->message($htmlContent);

        $this->email->send();


    }
}