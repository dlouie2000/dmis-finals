<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    private $table = "categoryrecord";
    public function __construct() {
        parent::__construct();

        // create table if it doesn't exist 
        if (!$this->db->table_exists($this->table) )
        {
            $this->load->dbforge();
            // define table fields
            $fields = array(
                'categoryID' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                ),
                'categoryName' => array(
                'type' => 'VARCHAR',
                'constraint' => 20
                ),          
            ); 
            $this->dbforge->add_field($fields);
            // define primary key
            $this->dbforge->add_key('categoryID', TRUE);
            // create table
            $this->dbforge->create_table($this->table);
        }
    }

    public function getCategoryName()
    {
        return $this->db->select('*')->from($this->table)->get()->result();
    }  
    
    //category table
    public function categoryList()
    {
        $this->db->select('*');
        $query = $this->db->get('categoryrecord');
        return $query->result();
    }

    //get product data by id
    public function getCategoriesById($data)
    {
        return $this->db->select('*')->from($this->table)->where('categoryID',$data)->get()->row(); 
    }

    //edit and update product record
    public function updateCategories($data = [])
    {
        return $this->db->where('categoryID', $data['categoryID'])->update($this->table,$data); 
    }

    //delete product record
    public function deleteCategories($data)
    {
        return $this->db->where('categoryID', $data)->delete('categoryrecord'); 
    }

    public function createcategory($data = [])
    {
		return $this->db->insert($this->table, $data);
	}
      

}