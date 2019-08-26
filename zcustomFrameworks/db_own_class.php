<?php

$host = "localhost";
$username = "root";
$password = "";
$db_name = "db_name";

define("DB_HOST", $host);
define("DB_USER", $username);
define("DB_PW", $password);
define("DB_NAME", $db_name);

$db = new Helper(DB_HOST, DB_USER, DB_PW, DB_NAME);

class Helper
{
    function Helper($db_host, $db_user, $db_password, $datebase_name)
    {
        $this->dbh = @mysql_connect($db_host,$db_user,$db_password);

        $this->select_db($database_name);
    }
    
    function select_db($database_name)
    {
        $this->db_select = @mysql_select_db($this->dbh, $database_name);
        
        if (!$this->db_select)
        {
            $this->mysql_error();
        }
        
        return $this->db_select;
    }
}
?>