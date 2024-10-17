<?php

namespace Model;

defined('ROOTPATH') OR defined('SERVERPATH') OR exit("Access denied!");

Trait Database
{
	private function connect()
	{
		$string = "mysql:hostname=" . DBHOST . ";dbname=" . DBNAME;
		$con = new \PDO($string, DBUSER, DBPASS);
		$con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		return $con;
	}

	public function query($query, $data = [])
	{
		$con = $this->connect();
		$stm = $con->prepare($query);
		$check = $stm->execute($data);
		if($check)
		{
			$result = $stm->fetchAll(\PDO::FETCH_OBJ);
			if(is_array($result) && count($result) > 0)
			{
				return $result;
			}
		}
		return $check;
	}

	public function get_row($query, $data = [])
	{
		$con = $this->connect();
		$stm = $con->prepare($query);
		$check = $stm->execute($data);
		if($check)
		{
			$result = $stm->fetchAll(\PDO::FETCH_OBJ);
			if(is_array($result) && count($result) > 0)
			{
				return $result[0];
			}
		}
		return false;
	}
}