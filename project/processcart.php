<?php

session_start();
if ($_GET['o'] == "a") {
    if (empty($_SESSION['cart'])) {
        $cartitems["size"] = 0;
        $_SESSION['cart'] = $cartitems;
    }
    $cartitems = $_SESSION['cart'];
    foreach ($_POST as $key => $value) {
        $cartitems[$key] = $value;
    }
    $cartitems['size'] = sizeof($cartitems);
    $_SESSION['cart'] = $cartitems;
//session_destroy();
    echo json_encode($_SESSION['cart']);
//echo count($_SESSION);
} else {
    $cartitems = $_SESSION['cart'];
    foreach ($_POST as $key => $value) {
        $cartitems[$key] = $value;
        unset($cartitems[$key]);
    }
    $cartitems['size'] = sizeof($cartitems);
    $_SESSION['cart'] = $cartitems;
//session_destroy();
    echo json_encode($_SESSION['cart']);
}
?>
