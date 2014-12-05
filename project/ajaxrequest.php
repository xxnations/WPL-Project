<?php

session_start();
include('Databaseadapter.php');

if ($_GET['v'] == "email") {

    if (empty($_POST['emailid'])) {
        $emailid = $_GET['emailid'];
    } else {
        $emailid = $_POST['emailid'];
    }

    $databaseadapter = new Databaseadapter();
    $EmailExists = $databaseadapter->checkIfEmailExists($emailid);

    if ($EmailExists) {
        //echo "email exist ".$EmailExists;
        if (empty($_SESSION['emailid'])) {
            echo "t";
        } else {
            if ($emailid == $_SESSION['emailid']) {
                echo "f";
            } else {
                echo "t";
            }
        }
    } else {
        //echo "email doesnot exist ".$EmailExists;
        if (empty($_SESSION['emailid'])) {
            echo "f";
        } else {
            if ($emailid == $_SESSION['emailid']) {
                echo "t";
            } else {
                echo "f";
            }
        }
    }
} else if ($_GET['v'] == "listoftopics") {
    echo $_SESSION['listoftopics'];
}
?>