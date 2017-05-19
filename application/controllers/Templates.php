<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Templates
 *
 *
 * @package    CI
 * @subpackage Controller
 * @author     Bala <bala.phpdev@gmail.com>
 */
class Templates extends CI_Controller {
    /**
     *
     * just loads templates for angular js
     *
     * @return none
     */
	public function view($view)
	{
		$this->load->view('templates/'.$view);
	}
}
