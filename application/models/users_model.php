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
	
	
	function check_login($email, $password)
	{
		$user_query = $this->db->query(
			"
			SELECT *
			FROM users
			WHERE email='{$email}';
			"
		);
		
		$user=[];
		if($user_query->num_rows() > 0)
		{
			// check password
			$user=$user_query->row_array();
			
			if($user["password"]!=md5($password))
			{
				$user["msg"]="wrong password";
			}
			else if($user["code"]!="")
			{
				$user["msg"]="this account hasn't been validated";
			}
			else
			{
				$user["msg"]="success";
			}
		}
		else 
		{
			$user["msg"]="no user";
		}

		return $user;
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


		$rand_length = 8;
		$alphabets = "abcdefghijklmnopqrstuvwxyz0123456789";
		$length = strlen($alphabets);
		$rand_code = "";
		
		for ($i = 0; $i < $rand_length; $i++)
		{
			$n = rand(0, $length-1);
			$rand_code = $rand_code . $alphabets[$n];
		}
		
		$code_length=10;
		$rand_code=substr(md5($rand_code), 0, $code_length);
		
		$hash_password=md5($password);
		$user_query = $this->db->query(
			"
			INSERT INTO users (email, password, code)
			VALUES ('{$email}', '{$hash_password}', '{$rand_code}');
			"
		);
		
		if($user_query)
		{
			// is this the right way to check insertion success or not??
			$hash_email = md5($email);
			
			if(!mkdir("./images/{$hash_email}"))
			{
				// enough??
				return "something wrong on server";
			}
			
			return "";
		}

		return "wrong with database";
	}
	
	function change_password($user_id, $old_password, $new_password)
	{
		$user = $this->db->query(
			"
			SELECT *
			FROM users
			WHERE id={$user_id};
			"
		)->row_array();
		
		if($user["password"]==md5($old_password))
		{
			$hash_password=md5($new_password);
			$update_query = $this->db->query(
				"
				UPDATE users
				SET password='{$hash_password}'
				WHERE id={$user_id};
				"
			);
		
			$msg="success";
		}
		else 
		{
			$msg="wrong password";
		}
		
		return $msg;
	}
	
	function reset_password($user_email, $rand_password)
	{
		$user=[];
		$user_query = $this->db->query(
			"
			SELECT *
			FROM users
			WHERE email='{$user_email}';
			"
		);
		
		if($user_query->num_rows() > 0)
		{
			$user=$user_query->row_array();
		}
		else
		{
			return "this account doesn't exist";
		}
		
		$hash_password=md5($rand_password);
		$update_query = $this->db->query(
			"
			UPDATE users
			SET password='{$hash_password}'
			WHERE email='{$user_email}';
			"
		);
		
		return "";
	}
	
	function account_validation($code, $user_id)
	{
		$user=[];
		$user_query = $this->db->query(
			"
			SELECT *
			FROM users
			WHERE id={$user_id};
			"
		);
		
		if($user_query->num_rows() > 0)
		{
			$user=$user_query->row_array();
		}
		else
		{
			return "validation failed";
		}
		
		if($code==$user["code"])
		{
			$update_query = $this->db->query(
				"
				UPDATE users
				SET code=''
				WHERE id={$user_id};
				"
			);
		}
		else
		{
			return "validation failed";
		}
		
		return "";
	}
	
	function get_validation_code($user_email)
	{
		$user=[];
		$user_query = $this->db->query(
			"
			SELECT *
			FROM users
			WHERE email='{$user_email}';
			"
		);
		
		
		if($user_query->num_rows() > 0)
		{
			$user=$user_query->row_array();
		}
		else
		{
			return "this account doesn't exist";
		}
		
		return $user["code"];
	}
	
	function get_single_user($user_email)
	{
		$user = $this->db->query(
			"
			SELECT *
			FROM users
			WHERE email='{$user_email}';
			"
		)->row_array();
		
		return $user;
	}
	
	
	
}


?>
