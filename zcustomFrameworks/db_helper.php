<?php 
class Helper
{
    function init_grid($grid_id="")
    {
        $grid = ' <table id="'.strtolower($grid_id).'" style="display:none"></table>';
    }

    function button_val($mode, $button_name)
    {
        switch ($mode)
        {
            case 'add':
                return "Create". $button_name;
                break;
            case 'edit':
                return "Update". $button_name;
                break;
            case 'delete':
                return "Delete". $button_name;
                break;
            case 'import':
                return "Import". $button_name;
                break;
            case 'export':
                return "Export". $button_name;
                break;
            default:
                return 0;
            
        }
    }

    function operation_msg($action="", $result="",$record="")
    {
        $result_msg = "";
        $is_successful = true;

        if ($result != false)
        {
            $is_successful = false;
        }

        switch($action)
        {
            case 'add':
                $result_msg = $record. "successfully SAVED!";
                
                if ($is_successful != true)
                {
                    if ($result == '')
                    {
                        $result_msg = "System Function ERROR";
                    }
                    else
                    {
                        $result_msg = "ADDING ". $record . "failed!";
                    }
                }
                break;
            case 'edit':
                $result_msg = $record. "successfully UPDATED!";
                
                if ($is_successful != true)
                {
                    if ($result == '')
                    {
                        $result_msg = "You successfully haven't changed any record";
                    }
                    else
                    {
                        $result_msg = "UPDATING ". $record . "failed!";
                    }
                }
                break;
            case 'delete':
                $result_msg = $record. "successfully DELETED!";
                
                if ($is_successful != true)
                {
                    if ($result == '')
                    {
                        $result_msg = "delete query FAILED!";
                    }
                    else
                    {
                        $result_msg = "DELETING ". $record . "failed!";
                    }
                }
                break;
            case 'import':
                $result_msg = $record. "successfully SAVED!";
                
                if ($is_successful != true)
                {
                    if ($result == 'mismatch')
                    {
                        $result_msg = "IMPORT FAILED!";
                    }
                    else
                    {
                        $result_msg = "IMPORTING ". $record . "failed!";
                    }
                }
                break;
            default:
                $result_msg = "";
        }
        return $result_msg;
    }

    function is_editable($mode)
    {
        switch ($mode)
        {
            case 'view':
                return false;
                break;
            case 'add':
                return true;
                break;
            case 'edit':
                return true;
                break;
            case 'delete':
                return false;
                break;
            default:
                return false;
        }
    }

    function pre_print_r($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    function get_photo_size($file, $postfix="")
    {
        $dot = strrpos($file, '-');
        $ext = substr($file, $dot);
        $basename = preg_replace('#\.[^.]*$#', '', $file);
        $filename = $basename.$postfix.$ext;

        return $filename;
    }

    function readable_date ($var, $format="M d, Y")
    {
        return date($format, strtotime($var));
    }

    function readable_datetime($var, $format= "M d,Y, h:i A")
    {
        return date($format, strtotime($var));
    }

    function sort_order_validator($tablename,$mode,$id,$column,$extra_query="")
    {
        if($extra_query!="")
        {
            $extra_query = " AND ".$extra_query;
        }
        if($mode == 'add' || $mode == 'ADD')
        {
            $maxcontents = 0;
            $sql = '';
            $sql = mysql_query("SELECT * FROM $tablename WHERE $column > 0 $extra_query");
            unset($row);
            while($row = mysql_fetch_array($sql))
            {
                $contents[] = $row['sort_order'];
            }

            if (mysql_num_rows($sql) > 0)
            {
                $maxcontents = max($contents);
            }

            $sort_order = $maxcontents + 1;
            else
            {
                $sql = mysql_query("SELECT * FROM $tablename WHERE ".$column."= '".$id."' $extra_query");
                $row = mysql_fetch_array($sql);
                $sort_order = $row['sort_order'];
            }

            return $sort_order;
        }
    }

    function delete_file($dir="", $tablename,$ref_id, $id,$column,$extra_query)
    {
        $result = false;
        
        if($id > 0)
        {
            $sql = mysql_query("SELECT * FROM $tablename WHERE $ref_id = '$id' $extra_query");
            
            if (mysql_num_rows($sql) > 0 )
            {
                $record = mysql_fetch_array($sql);

                if($record[$column] != "" || $record[$column] != NULL)
                {
                    $file_path = $dir.$record[$column];
                    if( file_exists($file_path))
                    {
                        @unlink($file_path);
                        @unlink($this->get_photo_size($file_path, '_s'));
                    }
                    $result = true;
                }
            }
        }
        return $result;
    }

    function varkeydump()
    {
        $length = 12;
        $characters = date("mdYgisu", time())."ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$characters .= strtolower("ABCDEFGHIJKLMNOPQRSTUVWXYZ");
		$key = '';
		    
		for ($p = 0; $p < $length; $p++) {	
			$key .= $characters[mt_rand(0, strlen($characters))];	
		}
		return $key;
    }
}
?>