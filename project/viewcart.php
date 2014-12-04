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
        <link rel="stylesheet" href="css/register.css?time=<?php echo time(); ?>">
        <script src="js/jquery.min.js"></script>
        <script src="js/common.js?time=<?php echo time(); ?>"></script>
        
        <title></title>
    </head>
    <body>
        <div id="header">
        <?php include("common/header.php"); ?>
        </div>
        <div id="body">
            <div id="center">
<?php 
$databaseadapter = new Databaseadapter();
if(!empty($_SESSION['user']))
{

$checkSubscription = $databaseadapter->checkSubscription($_SESSION['user']);
$cartitems=$_SESSION['cart'];
$change=false;

$removed="";
foreach ($checkSubscription as $key => $value) {
    //echo "---".$key." ".$value[0]."<br>";
    foreach ($cartitems as $ikey => $ivalue) {
        if($ikey==="size")
        {
            continue;
        }
      //  echo $ikey." ".$ivalue." , ";
        if($value[0]===$ivalue)
        {
            $removed=$removed.", ".ucfirst($ivalue);
            unset($cartitems[$ikey]);
            $change=true;
            break;
        }
    }
}
if($change)
{
    unset($_SESSION['cart']);
    $cartitems['size']=  count($cartitems);
    $_SESSION['cart']=$cartitems;
    $removed= ltrim ($removed, ',');
    unset($_SESSION['removed']);
    $_SESSION['removed']=$removed;
     header("Location: viewcart.php");
    $_SESSION['showmessage']=true;
 
/* Make sure that code below does not get executed when we redirect. */
exit;
}

}
?>
            
            <form action="checkout.php" method="POST">
<!--        <table id="listoftopicsincart" cellpadding="5">
            <tr><th></th><th>Topic</th><th>Price</th><th></th></tr>
            <tr><td></td><td></td><td></td></tr>-->

<?php
try
{
$cartitems=$_SESSION['cart'];
$price=0;

if(count($cartitems)>1)
{

$result = $databaseadapter->getTopicsById($cartitems);
$i=0;
echo "<table id=\"listoftopicsincart\" cellpadding=\"5\">
            <tr><th></th><th>Topic</th><th>Price</th><th></th></tr>
            <tr><td></td><td></td><td></td></tr>";
foreach ($result as $row) {
    echo "<tr><td>".++$i.".     </td><td>" . ucfirst($row['topicname']) . "</td><td>$" . $row['price'] . "</td><td><span id=\"" . $row['topicid'] . ":" . $row['topicname'] . "\"><button class=\"removefromcartbutton\"  name=\"" . $row['topicid'] . ":" . $row['topicname'] . "\" id=\"" . $row['topicid'] . ":" . $row['topicname'] . "\">Remove</button></span></td></tr>";
    $price=$price+$row['price'];
}

$_SESSION['totalprice']=$price;
}
else
{
    ?><h3>No items in Cart</h3>
        <?php
}
}
 catch (Exception $ex)
 {
     echo $ex->getMessage();
 }
?>
        </table>
                 <?php if(!empty($_SESSION['user']))
        {
                     if(count($cartitems)>1){
            echo "<br><button id=\"checkoutbutton\">CheckOut</button>";
                     }
        }
        else
        {
            echo "<a href=\"login.php\">Log in</a> or <a href=\"register\">Register</a> to Subscribe";
        }
?>
                <div id="messagediv">
                    <?php
                    if(!empty($_SESSION['removed']))
                    {
                         if(!empty($_SESSION['showmessage']))
                    {
                        if($_SESSION['showmessage'])
                        {
                        echo "<br>Following items are removed from your cart as you have already subscribed to them:<br><br><span id=\"existingitems\"> ".$_SESSION['removed']."</span>"
                                . "<br><br>Check <a href=\"myaccount.php\"> your account</a> for more details.";
                        $_SESSION['showmessage']=false;
                        }
                    }
                    }
                    ?>
                </div>
                <div id="paymentdiv">
                    <span><br>Total Amount to Pay : $<?php echo $price; ?></span>
                    <span> <button id="paybutton">Pay</button></span>
                </div>
            </form>
        </div>
        </div>
                    <div id="footer">
                <?php include("common/footer.php"); ?>
            </div>
            
    </body>
</html>
