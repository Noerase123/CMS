<?php 
// DATABASE REQUIRED
define("DB_HOST",     "localhost");
define("DB_USER",     "root");
define("DB_PASSWORD", "");
define("DB_NAME",     "database_name");

// SQL Constants
define ("EZSQL_VERSION","1.01");
define("OBJECT","OBJECT",true);
define("ARRAY_A","ARRAY_A",true);
define("ARRAY_N","ARRAY_N",true);

$db = new db(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);


class db {
    
    // DB Constructor - connects to the server and selects a database
    function db($dbuser,$dbpassword,$dbname, $dbhost)
    {
        $this->dbhost = @mysql_connect($dbhost,$dbuser,$dbpassword);

        if (! $this->dbhost)
        {
            $this->print_error("Your database is not defined!");
        }

        $this->select($dbname);
    }

    // Select a DB
    function select($db)
    {
        if (!@mysql_select_db($db,$this->dbhost))
        {
            $this->print_error("Error Selecting your Database!");
        }
    }

    // Print SQL error
    function print_error($str="")
    {
        if (!$str) $str = mysql_error();
    }

    // Basic Query
    function query($query, $output = OBJECT)
    {
        $this->last_result = null;
        $this->col_info = null;

        // Log how the function was called
        $this->db_call = $db->query($query, $output);
        // Perform the query via std mysql_query function..
        $this->result = mysql_query($query,$this->dbhost);

        

        if ($this->result)
        {
            $i=0;
            while($i < @mysql_num_fields($this->result))
            {
                $this->col_info[$i] = @mysql_fetch_field($this->result);
                $i++;
            }

            $i=0;
            while( $row = @mysql_fetch_object($this->result))
            {
                $this->last_result[$i] = $row;
                $i++;
            }

            @mysql_free_result($this->result);

            if ($i)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else 
        {
            if (mysql_error())
            {
                $this->print_error();
            }
        }
    }

    // Get one variable from the DB
    function get_var($query=null, $x=0,$y=0)
    {
        $this->db_call = $db->get_var($query,$x,$y);

        if ($query)
        {
            $this->query($query);
        }

        if ($this->last_result[$y])
        {
            $values = array_values(get_object_vars($this->last_result[$y]));
        }

        return $values[$x] ? $values[$x] : null;
    }

    // Get one row from the DB
    function get_row($query = null, $y=0, $output=OBJECT)
    {
        $this->db_call = $db->get_row($query,$y,$output);

        if ($query)
        {
            $this->query($query);
        }

        if ($output == OBJECT)
        {
            return $this->last_result[$y] ? $this->last_result[$y] : null;
        }
        elseif($output == ARRAY_A)
        {
            return $this->last_result[$y] ? get_object_vars($this->last_result[$y]) : null;
        }
        elseif ($output == ARRAY_N)
        {
            return $this->last_result[$y] ? array_values(get_object_vars($this->last_result[$y])) : null;
        }
        else
        {
            $this->print_eror("$db->get_row(string query, int offset, output type)");
        }
    }

    function get_results($query=null, $output = OBJECT)
    {
        $this->db_call = "$db->get_results($query, $output)";

        if ($query)
        {
            $this->query($query);
        }

        if ($output == OBJECT)
        {
            return $this->last_result;
        }

        elseif ($output == ARRAY_A || $output == ARRAY_N)
        {
            if ($this->last_result)
            {
                $i=0;
                foreach ($this->last_result as $row)
                {
                    $new_array[$i] = get_object_vars($row);

                    if ($output == ARRAY_N)
                    {
                        $new_array[$i] = array_values($new_array[$i]);
                    }
                    $i++;
                }
                return $new_array;
            }
            else
            {
                return null;
            }
        }
    }
    
    // RAW QUERY FUNCTION
    function raw_query($query, $output = OBJECT)
    {
        $this->result = mysql_query($query,$this->db_host) or
        die(mysql_error());

        if (mysql_error())
        {
            $result = $this->print_error();
        }
        else
        {
            if($this->result)
            {
                $result = $this->result;
            }
        }

        return $result;
    }
}



?>