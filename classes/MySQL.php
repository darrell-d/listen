<?php

class MySQL
{
	private $db_user;
	private $db_pass;
	private $db_server;
	private $db_name;
	private $db_table;
	
	private $db_mysqli;
	
	function __construct($server,$user,$pass,$dbName)
	{
		$this->db_server = $server;
		$this->db_user = $user;
		$this->db_pass = $pass;
		$this->db_name = $dbName;
		$this->db_mysqli = new mysqli($this->db_server,$this->db_user,$this->db_pass,$this->db_name) or die($db_mysqli->error);
	}
	
	function query($query)
	{
            $query = $mysqli->prepare($query);
            $query->bind_param('s',$VARIABLE);
            $query->execute();
            $query->bind_result($VARIABLE_LIST_MATCHING_COLUMN_LIST);
            $query->fetch();
            $result =  $this->db_mysqli->query($query)or die ($this->db_mysqli->error);
            return $result;
		
	}
        function prepare($query)
        {
            return $this->db_mysqli->prepare($query);
        }
        function error()
        {
            return $this->db_mysqli->error;
        }
}


?>