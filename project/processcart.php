<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(empty($_SESSION['cart']))
{
    $_SESSION['cart']="";
}

$cartitems=$_SESSION['cart'];

$cartitems="1:success";
echo $_POST['id'];
echo json_encode($cartitems);

?>
