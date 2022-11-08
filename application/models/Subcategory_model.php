<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class subcategory_model extends CI_Model {

    private $table = "subcategoryrecord";
    public function __construct() {
        parent::__construct();

        // create table if it doesn't exist 
        if (!$this->db->table_exists($this->table) )
        {
            $this->load->dbforge();
            // define table fields
            $fields = array(
                'subcategoryId' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                ),
                'subcategoryName' => array(
                'type' => 'VARCHAR',
                'constraint' => 20
                ),          
            ); 
            $this->dbforge->add_field($fields);
            // define primary key
            $this->dbforge->add_key('subcategoryId', TRUE);
            // create table
            $this->dbforge->create_table($this->table);
        }
    }

    public function getSubCategoryName()
    {
        return $this->db->select('*')->from($this->table)->get()->result();
    }
    
    //category table
    public function subCategoryList()
    {
        $this->db->select('*');
        $query = $this->db->get('subcategoryrecord');
        return $query->result();
    }

    //get product data by id
    public function getSubCategoryById($data)
    {
        return $this->db->select('*')->from($this->table)->where('subcategoryId',$data)->get()->row(); 
    }
    //edit and update product record
    public function updateSubCategory($data = [])
    {
        return $this->db->where('subcategoryId', $data['subcategoryId'])->update($this->table,$data); 
    }

    //delete product record
    public function deleteSubCategory($data)
    {
        return $this->db->where('subcategoryId', $data)->delete('subcategorytable'); 
    }

    public function createsubcategory($data = [])
    {
		return $this->db->insert($this->table, $data);
	}
}