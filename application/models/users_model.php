<?php

class Users_model extends CI_Model
{
	function Users_model()
	{
		parent::__construct();
		// autoload database, so the lines below is useless
		
		/*
		$config['hostname'] = "localhost";
		$config['username'] = "myusername";
		$config['password'] = "mypassword";
		$config['database'] = "mydatabase";
		$config['dbdriver'] = "mysql";
		$config['dbprefix'] = "";
		$config['pconnect'] = FALSE;
		$config['db_debug'] = TRUE;
		$config['cache_on'] = FALSE;
		$config['cachedir'] = "";
		$config['char_set'] = "utf8";
		$config['dbcollat'] = "utf8_general_ci";
		*/
		//$this->load->database();
	}
	
	
	function check_login($email, $passwod)
	{
		$user_query = $this->db->query(
			"
			SELECT *
			FROM users
			WHERE email='{$email}';
			"
		);
		
		if($user_query->num_rows() > 0)
		{
			return $user_query->row_array();
		}

		return NULL;
	}
	
	function check_signup($email, $password)
	{
		$user_query = $this->db->query(
			"
			SELECT *
			FROM users
			WHERE email='{$email}';
			"
		);

		if($user_query->num_rows() > 0)
		{
			return "this email has been signed up";
		}
		
		$user_query = $this->db->query(
			"
			INSERT INTO users (email, password)
			VALUES ('{$email}', '{$password}');
			"
		);
		
		if($user_query)
		{
			// is this the right way to check insertion success or not??
			
			if(!mkdir("./images/{$email}"))
			{
				// enough??
				return "something wrong on server";
			}
			
			return "";
		}

		return "wrong with database";
	}
	
	function get_user()
	{
	}
}


?>