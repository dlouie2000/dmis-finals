<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dynamic_dependent_models extends CI_Model {

    private $table = "subcategorytable";
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
                'categoryId' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                ),
                'subcategoryName' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                ),     
            ); 
            $this->dbforge->add_field($fields);
            // define primary key
            $this->dbforge->add_key('subcategoryId', TRUE);
            // create table
            $this->dbforge->create_table($this->table);
        }
    }

    public function subcategoryList()
    {
        return $this->db->select('*')
        ->from('subcategorytable')
        ->join('categorytable', 'subcategorytable.categoryId = categorytable.categoryId', 'left')
        ->get()->result();
    }
    
    public function getSubCategoryName()
    {
        return $this->db->select('*')->from($this->table)->get()->result();
    }

    // public function subcategoryList()
    // {
    //     $this->db->select('*');
    //     $query = $this->db->get('subcategorytable');
    //     return $query->result();
    // }

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

    //
    public function fetch_category()
    {
        $this->db->order_by("categoryId", "ASC");
        $query = $this->db->get("categorytable");
        return $query->result();
    }

    public function fetch_subcategoryy()
    {
        $this->db->order_by("subcategoryId", "ASC");
        $query = $this->db->get("subcategorytable");
        return $query->result();
    }
   
    public function fetch_subcategory($categoryId)
    {
        $this->db->where('categoryId', $categoryId);
        $this->db->order_by('subcategoryName', 'ASC');
        $query = $this->db->get('subcategorytable');
        $output = '<option value="">Select Sub-category</option>';
        foreach($query->result() as $row)
     {
         $output .= '<option value="'.$row->subcategoryId.'">'.$row->subcategoryName.'</option>';
     }
        return $output;
    }

    public function fetch_subcategoryedit($categoryId, $subcategoryId)
    {
        $this->db->where('categoryId', $categoryId);
        $this->db->order_by('subcategoryName', 'ASC');
        $query = $this->db->get('subcategorytable');
        $output = '<option value="">Select Sub-category</option>';
        foreach($query->result() as $row)
     {
         $output .= '<option value="'.$row->subcategoryId.'" '.(($row->subcategoryId == $subcategoryId)? 'selected' : null ).' >'.$row->subcategoryName.'</option>';
        
     }
        return $output;
    }

    
    public function createsubcategory($data = [])
    {
		return $this->db->insert($this->table, $data);
	}
    
    // function fetch_city($state_id)
    // {
    //  $this->db->where('state_id', $state_id);
    //  $this->db->order_by('city_name', 'ASC');
    //  $query = $this->db->get('city');
    //  $output = '<option value="">Select City</option>';
    //  foreach($query->result() as $row)
    //  {
    //   $output .= '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
    //  }
    //  return $output;
    // }
}