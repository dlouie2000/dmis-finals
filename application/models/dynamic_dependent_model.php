<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dynamic_dependent_model extends CI_Model {

    private $table = "categorytable";
	public function __construct() {
		parent::__construct();
		// create table if it doesn't exist 
		if (!$this->db->table_exists($this->table))
		{
			$this->db->query("	CREATE TABLE `categorytable` (
				`categoryId` varchar(50) NOT NULL,
				`categoryNamee` varchar(50) NOT NULL
			  )");
		}
		if (!$this->db->table_exists($this->table))
		{
		$this->db->query("	INSERT INTO `categorytable`(`categoryId`, `categoryNamee`) VALUES
		('DDLSCTGRY-1', 'Tops'),
        ('DDLSCTGRY-2', 'Bottoms'), 
        ('DDLSCTGRY-3', 'Dress'),
        ('DDLSCTGRY-4', 'Accesories'),
        ('DDLSCTGRY-5', 'Hats'),
		('DDLSCTGRY-6', 'Shoes'); ");
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
        $query = $this->db->get('categorytable');
        return $query->result();
    }

    //get product data by id
    public function getCategoriesById($data)
    {
        return $this->db->select('*')->from($this->table)->where('categoryId',$data)->get()->row(); 
    }

    public function fetch_category()
    {
     $this->db->order_by("categoryId", "ASC");
     $query = $this->db->get("categorytable");
     return $query->result();
    }
   

}