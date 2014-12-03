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
        <link rel="stylesheet" href="css/common.css?time=<?php echo time(); ?>">
         <link rel="stylesheet" type="text/css" href="css/slider.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/common.js?time=<?php echo time(); ?>"></script>
<script src="js/slider.js?time=<?php echo time(); ?>"></script>
        <title></title>
    </head>
    <body>
        <div id="header">
        <?php include("common/header.php"); ?>
        </div>
        <div id="body">
                
        
<?php if(empty($_SESSION['user']))
{
?>
            <div id="searchbardiv"> Search : <input type="text" id="searchbar" name="searchbar" >
                <div id="sortbar" class="sortbar">Sort :
                    <input type="button" id="price" value="Price">
                    <input type="button" id="alphabetically" value="Alphabetically">
                    
                 </div>
                </div>
            <div id="listoftopicsdiv">
        <div id="listoftopics">
            

<?php
$databaseadapter = new Databaseadapter();
$result = $databaseadapter->getTopics();
$topiclist="";
//if(!empty($_SESSION['user']))
//{
foreach($result as $row) {
    echo "<div class=\"topicbox\" id=\"" .$row['topicname'] . "\"><span id=\"span".$row['topicname']."\">" . ucfirst($row['topicname']) . " : $<span id=\"pricespan\">" . $row['price'] . "</span></span><br><span id=\"". $row['topicname'] ."button". "\"><button class=\"addtocartbutton\"  name=\"" . $row['topicid'] . ":" . $row['topicname'] . "\" id=\"" . $row['topicid'] . ":" . $row['topicname'] . "\">Add to Cart</button></span></div>";
    
    $topiclist=$topiclist.",".$row['topicname'];
}
$_SESSION['listoftopics']=$topiclist;
//}
//else
//{
//foreach($result as $row) {
//    echo "<tr><td>" . $row['topicname'] . "</td><td>" . $row['price'] . "</td><td><span id=\"" . $row['topicid'] . ":" . $row['topicname'] . "\"><button class=\"addtocartbuttonnormal\"  name=\"" . $row['topicid'] . ":" . $row['topicname'] . "\" id=\"" . $row['topicid'] . ":" . $row['topicname'] . "\">Add to Cart</button></span></td></tr>";
//    
//}
?>
            
        </div>
            </div>
<?php }
else
{
   $databaseadapter = new Databaseadapter();
if(!empty($_SESSION['user']))
{

$checkSubscription = $databaseadapter->checkSubscription($_SESSION['user']);
$topiclist="";
foreach ($checkSubscription as $key => $value) {
    
    $topiclist=$topiclist.",".$value[0];
}

}

?>
            <?php
            //echo ltrim($topiclist,",");
            
            ?>
     <div id="topiclist">
         <?php 
         if(!empty($topiclist))
         {
         echo ltrim($topiclist,",");
         }
         ?>
     </div>
            <div id="sliderdiv">
                <h4 id='newtitleheader'></h4>
<div id="newscontainer"></div>
<div id="buttonbar">
<a class="button" href="#" id="prev" onclick="prev(); return false;" >Prev</a> 
<a class="button" href="#" id="next" onclick="next(); return false;" >Next</a> 
</div>
</div>
<?php }?>    </div>
            <div id="footer">
                <?php include("common/footer.php"); ?>
            </div>
    </body>
</html>
