<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
include('Databaseadapter.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/register.css?time=<?php echo time(); ?>">
        <link rel="stylesheet" href="css/common.css?time=<?php echo time(); ?>">
        <title></title>
    </head>
    <body>
       
        <div id="header">
        <?php include("common/header.php"); ?>
        </div>
         <?php if(empty($_SESSION['user']))
        {
            
        }
 else {
     $databaseadapter = new Databaseadapter();
            $subscritionHistory = $databaseadapter->getSubscritionHistory($_SESSION['user']);
            
            ?>
        <div id="body">
             <?php if(!empty($subscritionHistory)){ ?>
            <div id="subscriptionhistorydiv" align="center" >
<table id="subscriptionhistorytable" cellpadding="30" border="1">
    <tr>
        <th> ID</th>
        <th> Topic Name </th>
        <th> Valid Upto</th>
    </tr>
    

 <?php
//            $databaseadapter = new Databaseadapter();
//            $subscritionHistory = $databaseadapter->getSubscritionHistory($_SESSION['user']);
            //var_dump($subscritionHistory);
         
            foreach ($subscritionHistory as $key => $value) {
                 //echo "<br>".$key." --- ".$value['subscriptionid']."---".$value['topicname']."----".date('M j Y g:i A', strtotime($value['timestamp'].'+ 30 days'));
                 echo "<tr><td>".$value['subscriptionid']."</td><td>".strtoupper($value['topicname'])."</td><td>".date('M j Y g:i A', strtotime($value['timestamp'].'+ 30 days'))."</td></tr>";
            }
            ?>
</table>
            </div>
             </div>
           <?php }else{
               echo "No subscription history";
           }} ?>
            <div id="footer">
                <?php
       include("common/footer.php"); ?>
            </div>
    </body>
</html>
