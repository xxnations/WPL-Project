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
        <script src="js/jquery.min.js"></script>
        <script src="js/common.js?time=<?php echo time(); ?>"></script>
        <title></title>
    </head>
    <body>
        <div id="shoppingcartdiv">
            <?php
            if (empty($_SESSION['cart'])) {
                $cartitems["size"]=0;
                $_SESSION['cart'] = $cartitems;
            } else {
                echo "Cart Items = ".(sizeof($_SESSION['cart'])-1);
            }
            ?>
        </div>
        <table id="listoftopics">
            <tr><th>Topic Name</th><th>Price</th><th>Add to Cart</th><th>Select</th></tr>

<?php
$databaseadapter = new Databaseadapter();
$result = $databaseadapter->getTopics();
while ($row = mysql_fetch_array($result)) {
    echo "<tr><td>" . $row['topicname'] . "</td><td>" . $row['price'] . "</td><td><button class=\"addtocartbutton\"  name=" . $row['topicid'] . ":" . $row['topicname'] . ">Add to Cart</button></td><td><input type=\"checkbox\" name=" . $row['topicid'] . ":" . $row['topicname'] . "></tr>";
}
?>
        </table>
    </body>
</html>