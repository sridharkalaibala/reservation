<?php
/**
 * Stands_model
 *
 *
 * @package    CI
 * @subpackage Model
 * @author     Bala <bala.phpdev@gmail.com>
 */
class Stands_model extends CI_Model {

    private $table_name;
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'stands';
    }
    /**
     *
     * get all stands details for given location id
     *
     * @param integer $location_id  primary key of location table
     * @return mixed
     */
    public function get_stands($location_id)
    {
        $this->db->where('location_id', $location_id);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }
    /**
     *
     * update booking status in stands table
     *
     * @param integer $id  primary key of stand model
     * @param integer $company_id  primary key of compnay model
     * @return boolean
     */
    public function updateStatus($id,$company_id)
    {
        $data = ['booking_status'=>'Booked','booked_by'=>$company_id];
        $this->db->where('id',$id);
        $this->db->update($this->table_name,$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}