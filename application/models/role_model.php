<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class role_model extends CI_Model {

	private $table = "rolerecord";
	public function __construct() {
        parent::__construct();

        // create table if it doesn't exist 
        if (!$this->db->table_exists($this->table) )
        {
            $this->load->dbforge();
            // define table fields
            $fields = array(
                'roleId' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                ),
                'roleName' => array(
                'type' => 'VARCHAR',
                'constraint' => 50
                ),    
            ); 
            $this->dbforge->add_field($fields);
            // define primary key
            $this->dbforge->add_key('roleId', TRUE);
            // create table
            $this->dbforge->create_table($this->table);
        }
    }

    //role table
    public function roleList()
    {
        $this->db->select('*');
        $query = $this->db->get('rolerecord');
        return $query->result();
    }
    public function getRoleName()
    {
        return $this->db->select('*')->from($this->table)->get()->result();
    }

    //get product data by id
    public function getRoleById($data)
    {
        return $this->db->select('*')->from($this->table)->where('roleId',$data)->get()->row(); 
    }

    //delete product record
    public function deleteRole($data)
    {
        return $this->db->where('roleId', $data)->delete('rolerecord'); 
    }

    public function updateRoleRecord($data = [])
    {
        return $this->db->where('roleId', $data['roleId'])->update($this->table,$data);
    }

    public function createrole($data = [])
    {
		return $this->db->insert($this->table, $data);
	}
      
}