<?php

namespace Models;

use Core\DB;

/**
 * Classe Model
 * classe usada para adicionar métodos a todos os Models
 */
class Model extends DB
{

	protected $conn;
	protected $table;

	public function __construct($table = "")
	{
		$this->init($table);
	}

	/**
	 * method create
	 * responsável por criar o registro na base de dados
	 * @param $data, $debug
	 * @return mysqli output, sql query or boolean
	 */
	public function create($data = [], $debug = false)
	{
		if(empty($this->table)) { return false; }
		$count = count($data);
		if($count > 0) {
			$columns = "";
			$values = "";
			$i = 0;
			foreach($data as $k => $v) {
				$columns .= $k;
				$values .= '"'.$this->filter($v).'"';
				if($i < ($count - 1)) {
					$columns .= ", ";
					$values .= ", ";
				}
				$i++;
			}
			$query = sprintf("INSERT INTO %s (%s) VALUES (%s)", $this->table, $columns, $values);
			return $this->return($query, $debug);
		} else {
			return false;
		}
	}

	/**
	 * method read
	 * responsável por pegar os registros na base de dados
	 * @param $data, $where, $debug
	 * @return mysqli output or sql query
	 */
	public function read($columns = [], $where = "", $debug = false)
	{
		if(empty($this->table)) { return false; }
		$count = count($columns);
		if($count > 0) {
			$col = "";
			$i = 0;
			foreach($columns as $v) {
				$col .= $v;
				if($i < ($count - 1)) {
					$col .= ", ";
				}
				$i++;
			}
		} else {
			$col = "*";
		}
		$query = sprintf("SELECT %s FROM %s", $col, $this->table);
		$query .= ( empty($where) ? "" : " WHERE ".$where );
		return $this->return($query, $debug);
	}

	/**
	 * method update
	 * responsável por atualizar o registro na base de dados
	 * @param $data, $where, $debug
	 * @return mysqli output, sql query or boolean
	 */
	public function update($data = [], $where = "", $debug = false)
	{
		if(empty($this->table)) { return false; }
		$count = count($data);
		if($count > 0) {
			$a = "";
			$i = 0;
			foreach($data as $k => $v) {
				$a .= $k.' = "'.$this->filter($v).'"';
				if($i < ($count - 1)) {
					$a .= ", ";
				}
				$i++;
			}
			$query = sprintf("UPDATE %s SET %s", $this->table, $a);
			$query .= ( empty($where) ? "" : " WHERE ".$where );
			return $this->return($query, $debug);
		} else {
			return false;
		}
	}

	/**
	 * method delete
	 * responsável por deletar o registro na base de dados
	 * @param $where, $debug
	 * @return sql query or boolean
	 */
	public function delete($where = "", $debug = false)
	{
		if(empty($this->table)) { return false; }
		if(empty($where)) { return false; }
		$query = sprintf("DELETE FROM %s WHERE %s", $this->table, $where);
		return $this->return($query, $debug);
	}

	public function init($table = "")
	{
		$this->setConn();
		if(!empty($table)) {
			$this->setTable($table);
		}
	}

	public function setConn()
	{
		$this->conn = parent::$connection;
		return $this;
	}

	public function setTable($table)
	{
		$this->table = $table;
		return $this;
	}

	protected function filter($str)
	{
		return ( get_magic_quotes_gpc() ? $str : addslashes($str) );
	}

	protected function return($query, $debug = false)
	{
		if($debug) {
			return $query;
		} else {
			return $this->conn->query($query);
		}
	}

}
