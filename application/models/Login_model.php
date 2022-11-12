<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	private $table = "users_tbl";
	public function __construct() {
		parent::__construct();
		// create table if it doesn't exist 
		if (!$this->db->table_exists($this->table) )
		{
			$this->db->query("	CREATE TABLE `users_tbl` (
				`userId` varchar(50) NOT NULL,
				`username` varchar(20) NOT NULL,
				`userEmail` varchar(150) NOT NULL,
				`password` varchar(40) NOT NULL,
				`pin` varchar(40) NOT NULL,
				`level` int(3) NOT NULL,
				`userDatetime` varchar(40) NOT NULL
			  )");
		}
		if (!$this->db->table_exists($this->table))
		{
		$this->db->query("	INSERT INTO `users_tbl` (`userId`, `username`, `userEmail`, `password`, `pin`,  `level`, `userDatetime`) VALUES
		(1, 'admin', 'admin@gmail.com','".md5('@dmind00dles')."' ,'".md5('123456')."' , 1, '".date('Y-m-d')."'),
		(2, 'warehouse', 'warehouse@gmail.com', '".md5('@w@rehoused00dles')."' ,'".md5('123456')."', 2, '".date('Y-m-d')."');");
		}
	}

	// INSERT INTO `users_tbl` (`id`, `username`, `email`, `password`, `level`) VALUES
	// (1, 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
	// (2, 'warehouse', 'warehouse@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2);

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
	
	function check_user($username, $password) {
		$this->db->select('*'); //select all
		$this->db->from('users_tbl'); // table name
		$this->db->where('username', $username); // where username is equal to $username
		$this->db->where('password', md5($password)); // and password is equal to  $password (md5 format)
		// $this->db->where('pin', md5($pin)); // and password is equal to  $password (md5 format)
		$query = $this->db->get(); //get data from DB
		return $query;
	}

}
