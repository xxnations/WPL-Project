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
        $conn = mysql_connect('starchproducts.net:3306\\shaishav_asdb', 'shaishav_root', 'rootroot');
if (!$conn) {
    die('Not connected : ' . mysql_error());
}
mysql_select_db("shaishav_asdb",$conn);
return $conn;
    }
    
    public function closeConnection($conn)
    {
        mysql_close($conn);
    }
    
    public function getTopics()
    {
        $query="select * from topic";
        
        $conn=$this->getDatabaseConnection();
        $result=mysql_query($query,$conn);
        return $result;
    }
    
}
