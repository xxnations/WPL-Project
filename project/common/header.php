       
<?php if(!empty($_SESSION['user']))
{
?>
<div id="headerdiv">
    <div id="headeroptionsmain" class="headeroptionsmain">
       <div id="headerimage"> <img src="../project/images/logo1.png" alt="The Article Subscription"> 
       </div>
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
        <div id="optionsbar">
            <table id="headertable">
                <tr>
                    
                        <td> <span id="articlesubscribtion" class="headeroptions"><a href="index.php">Home</a></span></td>
                        <td> <span id="logout" class="headeroptions"><a href="logout.php">Log out</a></span></td>
                        <td> <span id="myaccount" class="headeroptions"><a href="myaccount.php">My Account</a></span></td>
                        <td> <span id="subscribe" class="headeroptions"><a href="subscribe.php">Subscribe</a></span></td>
                   
                </tr>
            </table>
        </div>
         </div>
            
        </div>
<?php
}
else
{
    ?>
<div id="headerdiv">
    <div id="headeroptionsmain" class="headeroptionsmain">
        <div id="headerimage"> <img src="../project/images/logo1.png" alt="The Article Subscription"> 
         
        </div>
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
        <div id="optionsbar">
            <table id="headertable">
                <tr>
                    
                        <td> <span id="articlesubscribtion" class="headeroptions"><a href="index.php">Home</a></span></td>
                        <td> <span id="register" class="headeroptions"><a href="register.php">Register</a></span></td>
                        <td> <span id="login" class="headeroptions"><a href="login.php">Login</a></span></td>
                        <td> <span id="forgotpassword" class="headeroptions"><a href="forgotpassword.php"> Forgot Password </a></span></td>
                    
                </tr>
            </table>
        </div>
        </div>
            
        </div>
<?php
}
?>
