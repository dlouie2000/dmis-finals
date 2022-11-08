<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_model extends CI_Model {

    private $table = "brandrecord";
    public function __construct() {
        parent::__construct();

        // create table if it doesn't exist 
        if (!$this->db->table_exists($this->table) )
        {
            $this->load->dbforge();
            // define table fields
            $fields = array(
                'brandId' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                ),
                'brandName' => array(
                'type' => 'VARCHAR',
                'constraint' => 20
                ),          
            ); 
            $this->dbforge->add_field($fields);
            // define primary key
            $this->dbforge->add_key('brandId', TRUE);
            // create table
            $this->dbforge->create_table($this->table);
        }
    }

    public function getBrandName()
    {
        return $this->db->select('*')->from($this->table)->get()->result();
    }
    
    //category table
    public function brandList()
    {
        $this->db->select('*');
        $query = $this->db->get('brandrecord');
        return $query->result();
    }

    //get product data by id
    public function getBrandsById($data)
    {
        return $this->db->select('*')->from($this->table)->where('brandId',$data)->get()->row(); 
    }
    //edit and update product record
    public function updateBrands($data = [])
    {
        return $this->db->where('brandId', $data['brandId'])->update($this->table,$data); 
    }

    //delete product record
    public function deleteBrands($data)
    {
        return $this->db->where('brandId', $data)->delete('brandrecord'); 
    }

    public function createbrand($data = [])
    {
		return $this->db->insert($this->table, $data);
	}
      

}