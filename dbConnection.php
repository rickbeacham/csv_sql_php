<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rick
 * Date: 6/24/13
 * Time: 7:44 PM
 * To change this template use File | Settings | File Templates.
 */
require_once 'config.php';
class dbConnection extends config{

    private $conn;
    public  $db;


    public function __construct()
    {
        parent::__construct();
        $this->getConnection();
    }
    public function getConnection()
    {
        //connect to db
        $this->db   = mysql_connect($this->host, $this->user, $this->password) or DIE ("Unable to connect to Database Server");
        //select a db
        $this->conn = mysql_select_db($this->dbname, $this->db) or DIE ("Could not select database");
    }

    /**
     * @param $sql
     * @return resource
     */
    function  query($sql) {
        $result = mysql_query($sql, $this->db) or DIE ("Invalid query: " . MYSQL_ERROR());
        return $result;
    }

    /**
     * @param $data
     * @param $table
     * @return resource|string
     */
    public function insert($data , $table)
    {
        $columns = implode(", ",array_keys($data));
        $escaped_values = array_map('mysql_real_escape_string', array_values($data));
        $values  = implode("', '", $escaped_values);
        $sql = "INSERT INTO $table ($columns) VALUES ('$values')";
        $result = $this->query($sql);
        if(!$result)return '';
        return $result;
    }

    public function getRow($field, $table)
    {
        $sql = "SELECT * from  $table WHERE ".$field['key']." = '" .$field['value']."'";
        $result = $this->query($sql);

        IF(MYSQL_NUM_ROWS($result) == 0)
            $value = FALSE;
        ELSE
            $value = MYSQL_RESULT($result, 0);
        RETURN $value;
    }

    /**
     * @param $table
     * @param array $option
     * @return resource|string
     */

    /*
    public function selectAll($table, $option = array())
    {
        //$data = array();
        $sql = "SELECT * from  $table" ;
        $results = $this->query($sql);
        while ($row = mysql_fetch_array($results)) {
            $data[] = $row;
        }
        if(!$data)return '';
        return $data;
    }
    */
    public function selectAll($table, $option = array())
    {
        $orderBy = '';
        $limit   = '';
        //$data = array();
        if(isset($option)){
            if(isset($option['orderby']))
                $orderBy = 'ORDER BY '.$option['orderby'];
            if(isset($option['limit']))
                $limit = 'limit '.$option['limit'];
        }
        $sql = "SELECT * from  $table $orderBy $limit" ;
        $results = $this->query($sql);
        while ($row = mysql_fetch_array($results)) {
            $data[] = $row;
        }
        if(!$data)return '';
        return $data;
    }

    public function validate($pattern, $string)
    {
        $match = preg_match($pattern, $string);
        return $match;
    }

}


