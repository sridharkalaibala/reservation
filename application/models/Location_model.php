<?php
/**
 * Location_model
 *
 *
 * @package    CI
 * @subpackage Model
 * @author     Bala <bala.phpdev@gmail.com>
 */
class Location_model extends CI_Model {

    private $table_name;
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'locations';
    }
    /**
     *
     * get location data in given limit
     *
     * @param integer $limit  number of locations
     * @return mixed
     */
    public function get_locations($limit = 10)
    {
        $query = $this->db->get($this->table_name, $limit);
        return $query->result();
    }
    /**
     *
     * get location data for given location id
     *
     * @param integer $id  location table primary key
     * @return mixed
     */
    public function get_location($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }
}