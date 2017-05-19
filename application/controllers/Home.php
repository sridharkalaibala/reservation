<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Home
 *
 *
 * @package    CI
 * @subpackage Controller
 * @author     Bala <bala.phpdev@gmail.com>
 */
class Home extends CI_Controller {
    /**
     *
     * just loads in home page view
     *
     * @return none
     */
	public function index()
	{
		$this->load->view('home');
	}
}
