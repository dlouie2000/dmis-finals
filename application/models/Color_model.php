<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class color_model extends CI_Model {

    private $table = "colorrecord";
    public function __construct() {
        parent::__construct();

        // create table if it doesn't exist 
        if (!$this->db->table_exists($this->table) )
        {
            $this->load->dbforge();
            // define table fields
            $fields = array(
                'colorId' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                ),
                'colorName' => array(
                'type' => 'VARCHAR',
                'constraint' => 20
                ),          
            ); 
            $this->dbforge->add_field($fields);
            // define primary key
            $this->dbforge->add_key('colorId', TRUE);
            // create table
            $this->dbforge->create_table($this->table);
        }
    }

    public function getColorName()
    {
        return $this->db->select('*')->from($this->table)->get()->result();
    }
    
    //category table
    public function colorList()
    {
        $this->db->select('*');
        $query = $this->db->get('colorrecord');
        return $query->result();
    }

    //get product data by id
    public function getColorById($data)
    {
        return $this->db->select('*')->from($this->table)->where('colorId',$data)->get()->row(); 
    }
    //edit and update product record
    public function updateColor($data = [])
    {
        return $this->db->where('colorId', $data['colorId'])->update($this->table,$data); 
    }

    //delete product record
    public function deleteColor($data)
    {
        return $this->db->where('colorId', $data)->delete('colorrecord'); 
    }

    public function createcolor($data = [])
    {
		return $this->db->insert($this->table, $data);
	}
}