<?php

namespace Model;

defined('ROOTPATH') OR exit("Access denied!");

Trait Model
{
	use Database;

	public $limit = 10;
	public $offset = 0;
	public $order_column = 'id';
	public $order_type = 'desc';
	public $errors = [];

	public function where($data = [], $data_not = [])
	{
		$data = $this->sanitizeColumns($data);

		if(empty($data) && empty($data_not))
		{
			$query = "select * from " . $this->table;
		}
		else{
			$query = "select * from " . $this->table . " where ";
			foreach ($data as $key => $value) {
				$query .= $key . " = :" . $key . " && ";
			}
			foreach ($data_not as $key => $value) {
				$query .= $key . " != :" . $key . " && ";
			}
			$query = trim($query, " && ");
		}
		$query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
		$data = array_merge($data, $data_not);
		return $this->query($query, $data);
	}

	public function first($data = [], $data_not = [])
	{
		$data = $this->sanitizeColumns($data);
		if(empty($data) && empty($data_not))
		{
			$query = "select * from " . $this->table;
		}
		else{
			$query = "select * from " . $this->table . " where ";
			foreach ($data as $key => $value) {
				$query .= $key . " = :" . $key . " && ";
			}
			foreach ($data_not as $key => $value) {
				$query .= $key . " != :" . $key . " && ";
			}
			$query = trim($query, " && ");
		}
		$data = array_merge($data, $data_not);
		return $this->get_row($query, $data);
	}

	public function insert($data)
	{
		$data = $this->sanitizeColumns($data);
		if(empty($data))
			return false;

		$query = "insert into " . $this->table . " (";
		foreach ($data as $key => $value) {
			$query .= $key . ", ";
		}
		$query = trim($query, ", ");
		$query .= ") values (";
		foreach ($data as $key => $value) {
			$query .= ":" . $key . ", ";
		}
		$query = trim($query, ", ");
		$query .= ")";
		return $this->query($query, $data);
	}

	public function update($id, $data, $id_column = 'id')
	{
		$data = $this->sanitizeColumns($data);
		if($id == null || empty($data))
			return false;

		$id_column_cond = $id_column . 'condition';

		$query = "update " . $this->table . " set ";
		foreach ($data as $key => $value) {
			$query .= $key . " = :" . $key . ", ";
		}
		$query = trim($query, ", ");
		$query .= " where " . $id_column . " = :" . $id_column_cond;
		$data[$id_column_cond] = $id;
		$this->query($query, $data);
	}

	public function delete($id, $id_column = 'id')
	{
		if($id == null)
			return false;

		$query = "delete from " . $this->table . " where " . $id_column . " = :" . $id_column;
		$this->query($query, [$id_column => $id]);
	}

	private function sanitizeColumns($data = [])
	{
		if(!empty($this->allowedColumns))
		{
			foreach ($data as $key => $value) {
				if(!in_array($key, $this->allowedColumns))
				{
					unset($data[$key]);
				}
			}
		}
		return $data;
	}
}