<?php
/**
 * Company_model
 *
 *
 * @package    CI
 * @subpackage Model
 * @author     Bala <bala.phpdev@gmail.com>
 */
class Company_model extends CI_Model {

    private $table_name;
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'company';
    }
    /**
     *
     * Get all rows from company table
     *
     * @return mixed
     */
    public function get_companies()
    {
        $query = $this->db->get($this->table_name);
        return $query->result();
    }
    /**
     *
     * get company row details for given id
     *
     * @param integer $company_id  company table primary key
     * @return mixed
     */
    public function get_company($company_id)
    {
        $this->db->where('id', $company_id);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }
    /**
     *
     * insert company details for given array of data
     *
     * @param array $data company fields
     * @return mixed
     */
    public function insert($data)
    {
        $this->db->insert($this->table_name,$data);
        return $this->db->insert_id();
    }
}