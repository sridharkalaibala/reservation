<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Api
 *
 *
 * @package    CI
 * @subpackage Controller
 * @author     Bala <bala.phpdev@gmail.com>
 */

class Api extends CI_Controller {
    public function __construct()
    {
        header("Content-Type: application/json;charset=utf-8");
        parent::__construct();
    }

    /**
     *
     * display all locations in json format
     *
     * @param integer $limit  number of locations
     * @return none
     */
    public function locations($limit  = 10)
    {
        $this->load->model('location_model');
        $locations = $this->location_model->get_locations($limit);
        echo json_encode($locations);
    }
    /**
     *
     * retrieves only one location in json format
     *
     * @param integer $id  location table primary key id
     * @return none
     */
    public function location($id)
    {
        $this->load->model('location_model');
        $locations = $this->location_model->get_location($id);
        echo json_encode($locations);
    }
    /**
     *
     * display all stands based on given location id
     *
     * @param integer $locationid  location table primary key id
     * @return none
     */
    public function stands($locationid  = 1)
    {
        $this->load->model('stands_model');
        $stands = $this->stands_model->get_stands($locationid);
        echo json_encode($stands);
    }
    /**
     *
     * display company details in json format for given id
     *
     * @param integer $id  company table primary key id
     * @return none
     */
    public function company($id)
    {
        $this->load->model('company_model');
        $locations = $this->company_model->get_company($id);
        echo json_encode($locations);
    }
    /**
     *
     * display all company details in json format
     *
     * @return none
     */
    public function companies()
    {
        $this->load->model('company_model');
        $locations = $this->company_model->get_companies();
        echo json_encode($locations);
    }
    /**
     *
     * send email for given input to email and report message
     *
     * @return none
     */
    public function send_email()
    {
        // Known Security Issue sending emails without authorizing user
        try {
        $_POST = !isset($_POST['admin']) ? json_decode(file_get_contents('php://input'), true) : $_POST;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('report', 'Report', 'trim|required');
        $this->form_validation->set_rules('admin', 'Admin', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE)
        {
            throw new Exception(validation_errors());
        }
        $to = $this->input->post('admin',true);
        $message = $this->input->post('report',true);
        $config = Array(
            'protocol' => $this->config->item('protocol'),
            'smtp_host' => $this->config->item('smtp_host'),
            'smtp_port' => $this->config->item('smtp_port'),
            'smtp_user' => $this->config->item('smtp_user'),
            'smtp_pass' => $this->config->item('smtp_pass'),
            'mailtype'  => $this->config->item('mailtype'),
            'charset'   => $this->config->item('charset')
        );
        $this->load->library('email', $config);
        $this->email->from($config['smtp_user']);
        $this->email->to($to);
        $this->email->subject('User report');
        $this->email->message($message);
        $this->email->set_newline("\r\n");
        $result = $this->email->send();
        if($result)
        {
            echo json_encode(array('status'=>'success','message'=>''));
        } else {
            throw new Exception('problem in sending email');
        }
        } catch (Exception $e) {
            echo json_encode(array('status'=>'failure','message'=>$e->getMessage()));
        }

    }
    /**
     *
     * create company row for given input
     *
     * @return none
     */
    public function create_company()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('admin', 'Admin', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $company_data = [
                            'admin'=>$this->input->post('admin', TRUE),
                            'phone'=>$this->input->post('phone', TRUE),
                            'email'=>$this->input->post('email', TRUE)
                        ];
        try {
            if ($this->form_validation->run() == FALSE)
            {
                throw new Exception(validation_errors());
            }
            $config['encrypt_name'] = TRUE;
            $config['upload_path']          = './app/img/logos/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 10000; // 10 MB
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ( ! $this->upload->do_upload('logo'))
            {
                throw new Exception($this->upload->display_errors());
            }
            $upload_data = $this->upload->data();
            $company_data['logo'] = $upload_data['file_name'];
            $config = [];
            $config['encrypt_name']         = TRUE;
            $config['upload_path']          = './app/downloads/';
            $config['allowed_types']        = 'zip';
            $config['max_size']             = 100000; // 100 MB
            $this->upload->initialize($config);
            if ( ! $this->upload->do_upload('marketing_documents'))
            {
                throw new Exception($this->upload->display_errors());
            }

            $upload_data = $this->upload->data();
            $company_data['marketing_documents'] = $upload_data['file_name'];
            $this->load->model('company_model');
            $company_id = $this->company_model->insert($company_data);
            if(!is_numeric($company_id) || $company_id < 1)
            {
                throw new Exception('Error in creating company');
            }
            $id = $this->input->post('stand_id', TRUE);
            $this->load->model('stands_model');
            if($this->stands_model->updateStatus($id,$company_id) === true) {
                echo json_encode(array('status'=>'success','message'=>''));
            }else {
                throw new Exception('Error in booking');
            }

        }catch(Exception $e) {
            echo json_encode(array('status'=>'error','message'=>$e->getMessage()));
        }
    }


}
