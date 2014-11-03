<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of databaseadapter
 *
 * @author Shaishav
 */
class Databaseadapter {
    //put your code here
    public function getDatabaseConnection()
    {
        //$conn = mysql_connect('starchproducts.net:3306\\shaishav_asdb', 'shaishav_root', 'rootroot');
        $conn = new PDO('mysql:host=cpanel.starchproducts.net;dbname=shaishav_asdb', 'shaishav_root', 'rootroot');
if (!$conn) {
    die('Not connected : ' . mysql_error());
}
//mysql_select_db("shaishav_asdb",$conn);
return $conn;
    }
    
    public function closeConnection($conn)
    {
        $conn=null;
    }
    
    public function getTopics()
    {
        $query="select * from topic";
        
        try
        {
        $conn=$this->getDatabaseConnection();
        $result = $conn->query($query);
        $this->closeConnection($conn);
        return $result;
        }
 catch (Exception $ex)
 {
     echo $ex->getMessage();
 }
    }
    
    public function getTopicsById($cartitems)
    {
       $topiclist=Array();
        try
        {
        foreach ($cartitems as $key => $value) {
            if ($key === "size") {
                continue;
            }
            array_push($topiclist, $key);
        }
        $implode = implode(",", $topiclist);
        
        $query="select * from topic where topicid in (".$implode.")";
       
        $conn=$this->getDatabaseConnection();
        $result = $conn->query($query);
        $this->closeConnection($conn);
        return $result;
        }
 catch (Exception $ex)
 {
     echo $ex->getMessage();
 }
        
    }
}
