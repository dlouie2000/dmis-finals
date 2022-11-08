<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class size_model extends CI_Model {

    private $table = "sizerecord";
    public function __construct() {
        parent::__construct();

        // create table if it doesn't exist 
        if (!$this->db->table_exists($this->table) )
        {
            $this->load->dbforge();
            // define table fields
            $fields = array(
                'sizeId' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                ),
                'sizeName' => array(
                'type' => 'VARCHAR',
                'constraint' => 20
                ),          
            ); 
            $this->dbforge->add_field($fields);
            // define primary key
            $this->dbforge->add_key('sizeId', TRUE);
            // create table
            $this->dbforge->create_table($this->table);
        }
    }

    public function getSizeName()
    {
        return $this->db->select('*')->from($this->table)->get()->result();
    }
    
    //category table
    public function sizeList()
    {
        $this->db->select('*');
        $query = $this->db->get('sizerecord');
        return $query->result();
    }

    //get product data by id
    public function getSizeById($data)
    {
        return $this->db->select('*')->from($this->table)->where('sizeId',$data)->get()->row(); 
    }
    //edit and update product record
    public function updateSize($data = [])
    {
        return $this->db->where('sizeId', $data['sizeId'])->update($this->table,$data); 
    }

    //delete product record
    public function deleteSize($data)
    {
        return $this->db->where('sizeId', $data)->delete('sizerecord'); 
    }

    public function deleteColor($data)
    {
        return $this->db->where('colorId', $data)->delete('colorrecord'); 
    }

    public function createsize($data = [])
    {
		return $this->db->insert($this->table, $data);
	}
}