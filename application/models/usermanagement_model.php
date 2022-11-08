<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class usermanagement_model extends CI_Model {

	private $table = "usersrecord";
	public function __construct() {
        parent::__construct();

        // create table if it doesn't exist 
        if (!$this->db->table_exists($this->table) )
        {
            $this->load->dbforge();
            // define table fields
            $fields = array(
                'userId' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                ),
                'userName' => array(
                'type' => 'VARCHAR',
                'constraint' => 50
                ),
                'userRole' => array(
                'type' => 'VARCHAR',
                'constraint' =>50,
                ),
                'userEmail' => array(
                'type' => 'VARCHAR',
                'constraint' => 50
                ),
                'userPassword' => array(
                'type' => 'VARCHAR',
                'constraint' => 50
                ),
                'userDatetime' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                ),    
            ); 
            $this->dbforge->add_field($fields);
            // define primary key
            $this->dbforge->add_key('userId', TRUE);
            // create table
            $this->dbforge->create_table($this->table);
        }
    }

    //user table
    public function userList()
    {
        $this->db->select('*');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function checkEmailUnique($data)
    {
        return $this->db->select('*')->from($this->table)->where('userEmail',$data)->get()->row();
    }


    public function getUserDataById($data)
    {
        return $this->db->select('*')->from($this->table)->where('userId',$data)->get()->row();
    }

    //delete user
    public function deleteUser($data)
    {
        return $this->db->where('userId', $data)->delete($this->table);
    }

    public function updateUserRecord($data = [])
    {
        return $this->db->where('userId', $data['userId'])->update($this->table,$data);
    }

    public function createuser($data = [])
    {
		return $this->db->insert($this->table, $data);
	}   
}