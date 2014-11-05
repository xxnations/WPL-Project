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
        $clause = implode(',', array_fill(0, count($topiclist), '?'));
        $query="select * from topic where topicid in (".$clause.")";
       
        $conn=$this->getDatabaseConnection();
        $preparestatement = $conn->prepare($query);
        $i=1;
        foreach ($topiclist as $value) {
            $preparestatement->bindValue($i, $value);
            $i++;
        }
        $preparestatement->execute();
        $result=$preparestatement->fetchAll();
        $preparestatement->closeCursor();
        $this->closeConnection($conn);
        return $result;
        }
 catch (Exception $ex)
 {
     
     echo $ex->getMessage();
     
 }
        
    }
    
    public function checkUser($emailid,$password)
    {
        try
        {
        $query="select userid,emailid,firstname from user where emailid=? and password=?";
       
        $conn=$this->getDatabaseConnection();
        $preparestatement = $conn->prepare($query);
        $preparestatement->bindValue(1,$emailid);
        $preparestatement->bindValue(2, $password);
        $preparestatement->execute();
        $result=$preparestatement->fetchAll();
        $preparestatement->closeCursor();
        $this->closeConnection($conn);
        return $result;
        
        }
 catch (Exception $ex)
 {
     echo $ex->getMessage();
 }
    }
    
    public function getUserById($userid)
    {
        try
        {
        $query="select * from user where userid=?";
       
        $conn=$this->getDatabaseConnection();
        $preparestatement = $conn->prepare($query);
        $preparestatement->bindValue(1,$userid);
        $preparestatement->execute();
        $result=$preparestatement->fetchAll();
        $preparestatement->closeCursor();
        $this->closeConnection($conn);
        return $result;
        
        }
 catch (Exception $ex)
 {
     echo $ex->getMessage();
 }
 
    }
    
    public function checkIfEmailExists($emailid)
    {
        try
        {
        $query="select * from user where emailid=?";
       
        $conn=$this->getDatabaseConnection();
        $preparestatement = $conn->prepare($query);
        $preparestatement->bindValue(1,$emailid);
        $preparestatement->execute();
        $result=$preparestatement->rowCount();
        $preparestatement->closeCursor();
        $this->closeConnection($conn);
        if($result>0)
        {
            return true;
        }
 else {
     return false;
 }      
        }
 catch (Exception $ex)
 {
     echo $ex->getMessage();
 }
    }
    
     public function saveUser($firstname,$lastname,$email,$password,$gender)
     {
         try
        {
        $query="insert into user values(null,?,?,?,?,?)";
        
        $conn=$this->getDatabaseConnection();
        $preparestatement = $conn->prepare($query);
        $preparestatement->bindValue(1,$email);
        $preparestatement->bindValue(2,$password);
        $preparestatement->bindValue(3,$firstname);
        $preparestatement->bindValue(4,$lastname);
        $preparestatement->bindValue(5,$gender);
        $execute = $preparestatement->execute();
        $result=$preparestatement->rowCount();
        var_dump($execute);
        $preparestatement->closeCursor();
        $this->closeConnection($conn);
        if($result>0)
        {
            return true;
        }
 else {
     return false;
 }      
        }
 catch (Exception $ex)
 {
     echo $ex->getMessage();
 }
 
     }
 public function updateUser($userid,$firstname,$lastname,$email,$password,$gender)
     {
         try
        {
        $query="update user set emailid=?,password=?,firstname=?,lastname=?,gender=? where userid=?";
        
        $conn=$this->getDatabaseConnection();
        $preparestatement = $conn->prepare($query);
        $preparestatement->bindValue(1,$email);
        $preparestatement->bindValue(2,$password);
        $preparestatement->bindValue(3,$firstname);
        $preparestatement->bindValue(4,$lastname);
        $preparestatement->bindValue(5,$gender);
        $preparestatement->bindValue(6,$userid);
        $preparestatement->execute();
        $result=$preparestatement->rowCount();
        var_dump($result);
        $preparestatement->closeCursor();
        $this->closeConnection($conn);
        if($result>0)
        {
            return true;
        }
 else {
     return false;
 }      
        }
 catch (Exception $ex)
 {
     echo $ex->getMessage();
 }
         
     }
     
     public function storePayment()
     {
         
         
          try
        {
        $query="insert into subscription values(null,?,null,?,?)";
        
        $conn=$this->getDatabaseConnection();
        $preparestatement = $conn->prepare($query);
        $preparestatement->bindValue(1,$_SESSION['user']);
        $preparestatement->bindValue(2,"demo");
        $preparestatement->bindValue(3,$_SESSION['totalprice']);
        $preparestatement->execute();
        $subscribtionid=$conn->lastInsertId();
        $result=$preparestatement->rowCount();
        $preparestatement->closeCursor();
        $this->closeConnection($conn);
        if($result>0)
        {
            $query="insert into topic_subscription values(null,?,".$subscribtionid.")";
            
            $conn=$this->getDatabaseConnection();
            $preparestatement = $conn->prepare($query);
            
            foreach ($_SESSION['cart'] as $key => $value) {
             if($key==="size")  
             {
                 continue;
             }
             $preparestatement->bindValue(1,$key);
             $preparestatement->execute();
             if(!($preparestatement->rowCount()>0))
             {
                 return false;
             }
             
         }
                $_SESSION['cart']=null;
                $cartitems["size"]=0;
                $_SESSION['cart'] = $cartitems;
         return true;
        }
 else {
     return false;
 }      
        }
 catch (Exception $ex)
 {
     echo $ex->getMessage();
 }
         
     }
     
     public function checkSubscription($userid)
     {
          try
        {
        $query="select distinct topicname from subscription s 
join topic_subscription ts on s.subscriptionid=ts.subscriptionid 
join topic t on t.topicid=ts.topicid                                
where s.`timestamp`>NOW() - INTERVAL 30 DAY 
and userid=?";
        
        $conn=$this->getDatabaseConnection();
        $preparestatement = $conn->prepare($query);
        $preparestatement->bindValue(1,$userid);
        $preparestatement->execute();
        $result=$preparestatement->fetchAll();
        $preparestatement->closeCursor();
        $this->closeConnection($conn);
        return $result;
        }
 catch (Exception $ex)
 {
     echo $ex->getMessage();
 }
     }
     
     
     public function getSubscritionHistory($userid)
     {
          try
        {
        $query="select * from topic_subscription ts join subscription s on s.subscriptionid=ts.subscriptionid join topic t on t.topicid=ts.topicid
where s.userid=? order by s.timestamp desc";
        
        $conn=$this->getDatabaseConnection();
        $preparestatement = $conn->prepare($query);
        $preparestatement->bindValue(1,$userid);
        $preparestatement->execute();
        $result=$preparestatement->fetchAll();
        $preparestatement->closeCursor();
        $this->closeConnection($conn);
        return $result;
        }
 catch (Exception $ex)
 {
     echo $ex->getMessage();
 }
     }
     
      
}
