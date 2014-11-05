       
<?php if(!empty($_SESSION['user']))
{
?>
<div id="headerdiv">
            <table id="headertable">
                <tr>
                    <td><h3> <b><a href="index.php">{Article Subscription}</a></b></h3> </td>
                    <td><h3> <b><a href="logout.php">Log out</a></b></h3> </td>
                    <td><h3> <b><a href="myaccount.php">My Account</a></b></h3> </td>
                    
                </tr>
            </table>
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
        </div>
<?php
}
else
{
    ?>
<div id="headerdiv">
            <table id="headertable">
                <tr>
                    <td><h3> <b><a href="index.php">{Article Subscription}</a></b></h3> </td>
                    <td><h3> <b><a href="register.php">Register</a></b></h3> </td>
                    <td><h3> <b><a href="login.php">login</a></b></h3> </td>
                </tr>
            </table>
            <div id="shoppingcartdiv">
            <?php
            if (empty($_SESSION['cart'])) {
                $cartitems["size"]=0;
                $_SESSION['cart'] = $cartitems;
                echo "<a href=viewcart.php>";
                echo "Cart Items = 0";
                echo "</a>";
            } else {
                echo "<a href=viewcart.php>";
                echo "Cart Items = ".(sizeof($_SESSION['cart'])-1);
                echo "</a>";
            }
            ?>
        </div>
        </div>
<?php
}
?>