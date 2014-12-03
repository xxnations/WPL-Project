<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php session_start();
include('Databaseadapter.php');

?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/register.css?time=<?php echo time(); ?>">
        <link rel="stylesheet" href="css/common.css?time=<?php echo time(); ?>">
         <script src="js/jquery.min.js"></script>
        <script src="js/common.js?time=<?php echo time(); ?>"></script>
        <title></title>
    </head>
    <body>
        <div id="header">
        <?php include("common/header.php"); ?>
        </div>
        <?php
        if (!empty($_POST)) {

            $email = "";
            $password = "";
            $error=false;
            $errormsg="";
            if (filter_var($_POST['emailid'], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST['emailid'];
            }
            else
            {
                $error=true;
                $errormsg=$errormsg."Invalid Email";
            }

            
            if (strlen($email) > 3) {
                //Check here in database if userexist
                $databaseadapter = new Databaseadapter();
                $result = $databaseadapter->getPassword($email);
                
                if ($result) {
                    require("smtp.php");
        require("sasl.php");
        $from = 'articlesubscriptionwpl@gmail.com';
        $to = 'articlesubscriptionwpl@gmail.com';
        //$to=$email
        $smtp=new smtp_class;
        $smtp->host_name="smtp.gmail.com";
        $smtp->host_port='465';
        $smtp->user='articlesubscriptionwpl@gmail.com';
        $smtp->password='pathikshaishav';
        $smtp->ssl=1;
        $smtp->debug=0;       //0 here in production
        $smtp->html_debug=1; //same
        
        $sendMessage = $smtp->SendMessage($from,array($to),array(
        "From: $from",
        "To: $to",
        "Subject: Password Recovery",
        "Date: ".strftime("%a, %d %b %Y %H:%M:%S %Z")),
        "Hello $email,\n\nYour credentials are as follow.\n\n"
                . "Email : $email\n"
                . "Password ".$result[0]['password']
                . "\n\nBye.\n");

    if($sendMessage)
    {
                    /* Redirect browser */
            
                    echo "Send Email Success";
                    $_SESSION['message']="An Email has been send successfully with Login Information";
                    header("Location: login.php");

                    /* Make sure that code below does not get executed when we redirect. */
                    exit;
                    
                }
                }    
    }        
            ?>
            <div id="body">
                Error in the credentials
                <form action="" method="POST" id="loginform">
                    <table id="logintable">
                        <tr>
                            <td>Email </td><td><input type="email" maxlength="20" name="emailid" id="emailid" value="<?php echo $_POST['emailid'];?>"/></td>
                        </tr>
                        <tr align="right">
                            <td colspan="2" ><input type="submit" value="Log In" id='loginbutton' name='loginbutton'/></td>
                        </tr>
                    </table>
                </form>
                <div id="errordiv">
                </div>
            </div>
<?php
} else {
    ?>

    <?php
    if (!empty($_SESSION['user'])) {
        //Redirect as already Logged In
    } else {
        ?>
                <div id="body">
                    <form action="" method="POST" id="loginform">
                        <table id="logintable">
                            <tr>
                                <td>Email </td><td><input type="email" maxlength="20" name="emailid" id="emailid" required/></td>
                            </tr>
                            
                            <tr align="right">
                                <td colspan="2" ><input type="submit" value="Log In" id='loginbutton' name='loginbutton'/></td>
                            </tr>
                        </table>
                    </form>

                    <div id="errordiv">
                    </div>
                </div>
    <?php }
}?>

            <div id="footer">
    <?php include("common/footer.php");
?>
        </div>
    </body>
</html>
