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
        <script src="js/common.js?time=<?php echo time(); ?>"></script>
<script src="js/slider.js"></script>
        <title></title>
    </head>
    <body>
        <div id="header">
        <?php include("common/header.php"); ?>
        </div>
        <div id="body">
        <div id="shoppingcartdiv">
            <?php
            if (empty($_SESSION['cart'])) {
                $cartitems["size"]=0;
                $_SESSION['cart'] = $cartitems;
            } else {
                echo "<a href=viewcart.php>";
                echo "Cart Items = ".(sizeof($_SESSION['cart'])-1);
                echo "</a>";
            }
            ?>
        </div>
<?php if(empty($_SESSION['user']))
{
?>
        <table id="listoftopics">
            <tr><th>Topic Name</th><th>Price</th><th>Add to Cart</th></tr>

<?php
$databaseadapter = new Databaseadapter();
$result = $databaseadapter->getTopics();
//if(!empty($_SESSION['user']))
//{
foreach($result as $row) {
    echo "<tr><td>" . $row['topicname'] . "</td><td>" . $row['price'] . "</td><td><span id=\"" . $row['topicid'] . ":" . $row['topicname'] . "\"><button class=\"addtocartbutton\"  name=\"" . $row['topicid'] . ":" . $row['topicname'] . "\" id=\"" . $row['topicid'] . ":" . $row['topicname'] . "\">Add to Cart</button></span></td></tr>";
     
}
//}
//else
//{
//foreach($result as $row) {
//    echo "<tr><td>" . $row['topicname'] . "</td><td>" . $row['price'] . "</td><td><span id=\"" . $row['topicid'] . ":" . $row['topicname'] . "\"><button class=\"addtocartbuttonnormal\"  name=\"" . $row['topicid'] . ":" . $row['topicname'] . "\" id=\"" . $row['topicid'] . ":" . $row['topicname'] . "\">Add to Cart</button></span></td></tr>";
//    
//}
?>
            
        </table>
<?php }
else
{
    

?>
            <div id="sliderdiv">
<div id="newscontainer"></div>
<a class="button" href="#" id="prev" onclick="prev(); return false;" >Prev</a> 
<a class="button" href="#" id="right" onclick="next(); return false;" >Next</a> 
 
</div>
<?php }?>    </div>
            <div id="footer">
                <?php include("common/footer.php"); ?>
            </div>
    </body>
</html>
