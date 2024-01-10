<?php

if (!ini_get("register_globals")) {
    import_request_variables('GPC');
}

include ("config.php");

if(!defined("SQL_LAYER"))
{

define("SQL_LAYER","mysql");

class sql_db
{
    var $db_connect_id;
    var $query_result;
    var $row = array();
    var $rowset = array();
    var $num_queries = 0;
    function sql_db($sqlserver, $sqluser, $sqlpassword, $database, $persistency = true)
    {
        $this->persistency = $persistency;
        $this->user = $sqluser;
        $this->password = $sqlpassword;
        $this->server = $sqlserver;
        $this->dbname = $database;
        if($this->persistency)
        {
            $this->db_connect_id = @mysql_pconnect($this->server, $this->user, $this->password);
        }
        else
        {
            $this->db_connect_id = @mysql_connect($this->server, $this->user, $this->password);
        }
        if($this->db_connect_id)
        {
            if($database != "")
            {
                $this->dbname = $database;
                $dbselect = @mysql_select_db($this->dbname);
                if(!$dbselect)
                {
                    @mysql_close($this->db_connect_id);
                    $this->db_connect_id = $dbselect;
                }
            }
            return $this->db_connect_id;
        }
        else
        {
            return false;
        }
    }
    function sql_query($query = "", $transaction = FALSE)
    {
        // Remove any pre-existing queries
        unset($this->query_result);
        if($query != "")
                {
            $this->query_result = @mysql_query($query, $this->db_connect_id);
        }
        if($this->query_result)
        {
            unset($this->row[$this->query_result]);
            unset($this->rowset[$this->query_result]);
            return $this->query_result;
        }
        else
        {
            return ( $transaction == END_TRANSACTION ) ? true : false;
        }
    }
    function sql_numrows($query_id = 0)
    {
        if(!$query_id)
        {
            $query_id = $this->query_result;
        }
        if($query_id)
        {
            $result = @mysql_num_rows($query_id);
            return $result;
        }
        else
        {
            return false;
        }
    }
    function sql_fetchrow($query_id = 0)
    {
        if(!$query_id)
        {
            $query_id = $this->query_result;
        }
        if($query_id)
        {
            $this->row[$query_id] = @mysql_fetch_array($query_id);
            return $this->row[$query_id];
        }
        else
        {
            return false;
        }
    }
}
}

$db = new sql_db($dbhost, $dbuname, $dbpass, $dbname, false);
if(!$db->db_connect_id) {
    die("problem with mysql");
}

$row = $db->sql_fetchrow($result);

$datetime = new DateTime();

?>