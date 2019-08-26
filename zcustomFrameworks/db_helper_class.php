<?php 
// DATABASE REQUIRED
define("DB_HOST",     "localhost");
define("DB_USER",     "root");
define("DB_PASSWORD", "");
define("DB_NAME",     "database_name");

$sql_helper = new SQLHelper(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);

class SQLHelper extends db
{
    function cget_row($table_name="", $where="")
    {
        if ($where != "")
        {
            $where = 'WHERE'.$where;
        }
        else 
        {
            $where='';
        }
        $sql = "SELECT * FROM $table_name ". $where;
        $row = $this->get_row($sql);
        return $row;
    }

    function insert_id($sql)
    {
        mysql_query($sql);
        $id = mysql_insert_id();
        return $id;
    }

    // insert all OBJECT / basic insert function
    function insert_all($table_name="", $values=array())
    {
        $fields = "";
        $data_values = "";
        $ctr = 0;
        foreach($values as $key=> $value)
        {
            if ($ctr == 0)
            {
                if ($value == "now")
                {
                    $fields      .= "`$key`";
                    $data_values .= "NOW()";
                }
                else
                {
                    $fields      .= "`$key`";
                    $data_values .= "'$value'";
                }
            }
            else
            {
                if ($value == "now")
                {
                    $fields .= ",`$key`";
                    $data_values .= ",NOW()";
                }
                else
                {
                    $fields      .= ",`$key`";
                    $data_values .= ",'$value'";
                }
            }
            $ctr++;
        }
        $sql = "INSERT INTO `$table_name` ($fields) VALUES ($data_values)";
        
        return $this->insert_id($sql);
    }

    // update function / update all OBJECT
    function update_all($table_name="", $id="", $id_value, $values=array())
    {
        $data_values = "";
        $ctr = 0;

        foreach ($values as $key=> $value)
        {
            if ($ctr == 0)
            {
                if ($value == "now")
                {
                    $data_values .= "`$key` = NOW() ";          
                }
                else
                {
                    $data_values .= "`$key` = '$value'";
                }
            }
            else
            {
                if ($value == "now")
                {
                    $data_values .= ",`$key` = NOW() ";          
                }
                else
                {
                    $data_values .= ",`$key` = '$value'";
                }
            }
            $ctr++;
        }
        $sql = "UPDATE `$table_name` SET $data_values WHERE `$id` = $id_value";
        
        $this->query($sql);
        return mysql_affected_rows();
    }

    // DELETE SQL FUNCTION
    function delete($table_name="", $id="", $id_value)
    {
        $sql = "DELETE FROM $table_name WHERE `$id` = $id_value";
        $this->query($sql);

        echo $sql;

        return mysqli_affected_rows();
    }

    // WHERE LIKE SQL FUNCTION
    function where_like($fields=array(), $value="")
    {
        $where = "WHERE (";
        $ctr = 0;
        
        foreach($fields as $field)
        {
            $where .= "$field LIKE '%$value%'";
            $ctr++;
            if ($ctr < count($fields))
            {
                $where .= " OR";
            }
        }
        return $where . ") ";

        // sample 
        // $firstname = "firstname";
        // $lastname = "lastname";
        // $surname = "Caasi"
        // $fnc = "WHERE ($firstname OR $lastname LIKE '%$surname%'";
    }

    // COUNT THE ROWS AFFECTED
    function sql_count($sql)
    {
        $result = 0;
        $rs = mysql_query($sql);

        if (mysql_num_rows($rs) > 0)
        {
            $result = mysql_fetch_array($rs);
            $result = $result[0];
        }

        return $result;
    }
}


?>