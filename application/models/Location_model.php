<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class location_model extends CI_Model {

    private $table = "locationrecord";
    public function __construct() {
        parent::__construct();

        // create table if it doesn't exist 
        if (!$this->db->table_exists($this->table) )
        {
            $this->load->dbforge();
            // define table fields
            $fields = array(
                'locationId' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                ),
                'locationName' => array(
                'type' => 'VARCHAR',
                'constraint' => 20
                ),          
            ); 
            $this->dbforge->add_field($fields);
            // define primary key
            $this->dbforge->add_key('locationId', TRUE);
            // create table
            $this->dbforge->create_table($this->table);
        }
    }

    public function getLocationName()
    {
        return $this->db->select('*')->from($this->table)->get()->result();
    }
    
    //category table
    public function locationList()
    {
        $this->db->select('*');
        $query = $this->db->get('locationrecord');
        return $query->result();
    }

    //get product data by id
    public function getLocationById($data)
    {
        return $this->db->select('*')->from($this->table)->where('locationId',$data)->get()->row(); 
    }
    //edit and update product record
    public function updateLocation($data = [])
    {
        return $this->db->where('locationId', $data['locationId'])->update($this->table,$data); 
    }

    //delete product record
    public function deleteLocation($data)
    {
        return $this->db->where('locationId', $data)->delete('locationrecord'); 
    }

    public function createlocation($data = [])
    {
		return $this->db->insert($this->table, $data);
	}
}