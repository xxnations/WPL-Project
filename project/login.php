<?php
session_start();
include('Databaseadapter.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/register.css?time=<?php echo time(); ?>">
        <link rel="stylesheet" href="css/common.css?time=<?php echo time(); ?>">
        <script src="js/jquery.min.js"></script>
        <script src="js/common.js?time=<?php echo time(); ?>"></script>
        <script src="js/login_validtion.js?time=<?php echo time(); ?>"></script>
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
            $error = false;
            $errormsg = "";
            if (filter_var($_POST['emailid'], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST['emailid'];
            } else {
                $error = true;
                $errormsg = $errormsg . "Invalid Email";
            }

            if (!(filter_var($_POST['password'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/['\"]/"))))) {
                $password = $_POST['password'];
            } else {
                $error = true;
                $errormsg = $errormsg . "Invalid password";
            }
            if (strlen($email) > 3 && strlen($password) > 0) {
                //Check here in database if userexist
                $databaseadapter = new Databaseadapter();
                $result = $databaseadapter->checkUser($email, $password);
                if (!empty($result)) {
                    foreach ($result as $row) {
                        var_dump($row);
                        $_SESSION['username'] = ucfirst($row['firstname']);
                        $_SESSION['user'] = $row['userid'];
                        $_SESSION['emailid'] = $row['emailid'];
                        if ($_SESSION['user']) {
                            /* Redirect browser */
                            header("Location: index.php");

                            /* Make sure that code below does not get executed when we redirect. */
                            exit;
                        }
                    }
                }
            }
            ?>
            <div id="body">
                <div id="center">

                    <form action="" method="POST" id="loginform">
                        <table id="logintable">
                            <tr>
                                <td>Email </td><td><input type="email" maxlength="20" name="emailid" id="emailid" value="<?php echo $_POST['emailid']; ?>"/></td>
                            </tr>
                            <tr>
                                <td>Password </td><td><input type="password" maxlength="20" name="password" id="password" /></td>
                            </tr>
                            <tr align="right">
                                <td colspan="2" ><input type="submit" value="Log In" id='loginbutton' name='loginbutton'/></td>
                            </tr>
                        </table>
                    </form>
                    <div id="messagediv">
    <?php
    if (!empty($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
                    </div>
                    <div id="errordiv">
                        Email Id/Password is not valid
                    </div>
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
                    <div id="center">
                        <form action="" method="POST" id="loginform">
                            <table id="logintable">
                                <tr>
                                    <td>Email Id</td><td><input type="email" maxlength="20" name="emailid" id="emailid" required/></td>
                                </tr>
                                <tr>
                                    <td>Password </td><td><input type="password" maxlength="20" name="password" id="password" required/></td>
                                </tr>
                                <tr align="right">
                                    <td colspan="2" ><input type="submit" value="Log In" id='loginbutton' name='loginbutton'/></td>
                                </tr>
                            </table>
                        </form>
                        <div id="messagediv">
        <?php
        if (!empty($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>
                        </div>
                        <div id="errordiv">

                        </div>
                    </div>
                </div>
                        <?php }
                    }
                    ?>

        <div id="footer">
<?php include("common/footer.php");
?>
        </div>
    </body>
</html>
