<?php

/** Handles Mysql connection and queries **/
class MySQL
{
	private $db_user;
	private $db_pass;
	private $db_server;
	private $db_name;
        private $db_mysqli;
	
	function __construct($server,$user,$pass,$dbName)
	{
		$this->db_server = $server;
		$this->db_user = $user;
		$this->db_pass = $pass;
		$this->db_name = $dbName;
		$this->db_mysqli = new mysqli($this->db_server,$this->db_user,$this->db_pass,$this->db_name) or die($this->db_mysqli->error);
                $this->db_mysqli->set_charset("UTF8");
	}
        /**Clean user input**/
        function clean($input)
        {
            if(is_array($input))
            {
                $returnArray = array();
                foreach($input as $var)
                {
                    $returnArray[] = $this->db_mysqli->real_escape_string($var);
                }
                return $returnArray;
            }
            else
            {
                return $this->db_mysqli->real_escape_string($input);
            }
        }
	
        /** Query DB **/
    	function query($query)
    	{
                $result =  $this->db_mysqli->query($query)or die ($this->db_mysqli->error);
                return $result;
    		
    	}
        /**Returns a prepared Satement**/
        function getPreparedQuery($query)
        {
            $preparedStatement = $this->db_mysqli->prepare($query);
            
            return $preparedStatement;
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