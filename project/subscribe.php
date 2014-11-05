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
            <div class="ui-widget">
            <div id="searchbardiv"> Search : <input type="text" id="searchbar" name="searchbar" >
                <div id="sortbar">Sort :
                    <input type="button" id="price" value="Price">
                    <input type="button" id="alphabetically" value="Alphabetically">
                    
                 </div>
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
     echo "<div class=\"topicbox\" id=\"" .$row['topicname'] . "\">" . $row['topicname'] . "<br><span id=\"pricespan\">" . $row['price'] . "</span><br><span id=\"" . $row['topicid'] . ":" . $row['topicname'] . "\"><button class=\"addtocartbutton\"  name=\"" . $row['topicid'] . ":" . $row['topicname'] . "\" id=\"" . $row['topicid'] . ":" . $row['topicname'] . "\">Add to Cart</button></span></div>";
    
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
    </div>
            <div id="footer">
                <?php include("common/footer.php"); ?>
            </div>
    </body>
</html>
