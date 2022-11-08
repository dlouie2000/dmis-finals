<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reqproduct_model extends CI_Model {

	private $table = "reqproductrecord";
	public function __construct() {
        parent::__construct();

        // create table if it doesn't exist 
        if (!$this->db->table_exists($this->table) )
        {
            $this->load->dbforge();
            // define table fields
            $fields = array(
                'reqproductId' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                ),
                'productId' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                ),
                'reqproductQuantity' => array(
                'type' => 'INT',
                'constraint' => 20,
                ),  
                'reqDateTime' => array(
                'type' => 'DATETIME',
                //'constraint' => 100,
                ),
                'reqproductStatus' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                ),
                'approveDateTime' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                ),            
            ); 
            $this->dbforge->add_field($fields);
            // define primary key
            $this->dbforge->add_key('reqproductId', TRUE);
            // create table
            $this->dbforge->create_table($this->table);
        }
    }

    public function reqproductList()
    {
        return $this->db->select('*')
        ->from('reqproductrecord')
        ->join('productrecord', 'reqproductrecord.productId = productrecord.productId', 'left')
        ->join('categorytable', 'productrecord.productCategory = categorytable.categoryId', 'left')
        ->get()->result();
    }

    public function getProductDataById($data)
    {
        return $this->db->select('*')->from($this->table)->where('productId',$data)->get()->row();
    }

    public function topRequestedProducts()
    {
       $query = $this->db->query("SELECT sum(reqproductrecord.reqproductQuantity) as count, productrecord.productId, productrecord.productName FROM reqproductrecord LEFT JOIN productrecord ON reqproductrecord.productId = productrecord.productId group by productrecord.productId order by count DESC limit 5;"); 
       return $query->result();
    }
    public function topRequestedCategories()
    {
        $query = $this->db->query("SELECT sum(reqproductrecord.reqproductQuantity) as count, productrecord.productCategory FROM reqproductrecord LEFT JOIN productrecord ON reqproductrecord.productId = productrecord.productId group by productrecord.productCategory order by count DESC limit 5;");
        return $query->result();
    }
    
    public function joinReqProductTable()
    {
        $this->db->select('*');
        $this->db->from('productrecord');
        $this->db->join('reqproductrecord', 'productId = reqproductrecord.productId ');
        return $query->result();

    }

    //function that only shows pending requests in the admin approval products table
    public function reqproductListAdminView()
    {
        $this->db->select('*')->where('reqproductStatus', 'Pending');
        $query = $this->db->get('reqproductrecord');
        return $query->result();
    }

    //reject product
    public function rejectReqproductRecord($data = [])
    {
        $reqproductss = $this->db->select('*')->from($this->table)->where('reqproductId', $data['reqproductId'])->get()->row();
        return $this->db->where('reqproductId', $data['reqproductId'])->update($this->table,$data);
    }
    
    //approve and update product quantity
    public function updateReqproductRecord($data = [])
    {
        $reqproductss = $this->db->select('*')->from($this->table)->where('reqproductId', $data['reqproductId'])->get()->row();
        $productInfo = $this->db->select('*')->from('productrecord')->where('productId', $reqproductss->productId)->get()->row();

        if($productInfo->productQuantity >= $reqproductss->reqproductQuantity){
            $query = $this->db->query('update productrecord set productQuantity = (productQuantity - '.$reqproductss->reqproductQuantity.') where productId = "'.$reqproductss->productId.'"');
            return $this->db->where('reqproductId', $data['reqproductId'])->update($this->table, $data);
        }
        else {
            return 'stockError';
        }
    }
    
    public function createrequest($data = [])
    {
		return $this->db->insert($this->table, $data);
	}

}