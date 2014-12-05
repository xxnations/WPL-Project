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
        <script src="js/register_validation.js?time=<?php echo time(); ?>"></script>
        <title></title>
    </head>
    <body>
        <div id="header">
        <?php include("common/header.php"); ?>
        </div>
        <?php
        if (!empty($_POST)) {
            //var_dump($_POST);
            $email = "";
            $password = "";
            $repassword = "";
            $firstname = "";
            $lastname = "";
            $error = false;
            $errormsg = "";
            if (filter_var($_POST['emailid'], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST['emailid'];
                $databaseadapter = new Databaseadapter();
                $emailexists = $databaseadapter->checkIfEmailExists($email);
                if ($emailexists) {
                    $error = true;
                    $errormsg = $errormsg . "Email Already Exists.<br>";
                }
            } else {
                $error = true;
                $errormsg = $errormsg . "Invalid Email Address.<br>";
            }
            if (empty($_POST['password'])) {
                $error = true;
                $errormsg = $errormsg . "Password cannot be Empty.<br>";
            }

            if (!(filter_var($_POST['password'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/['\"]/"))))) {
                $password = $_POST['password'];
            } else {
                $error = true;
                $errormsg = $errormsg . "Error in password.<br>";
            }
            if (empty($_POST['repassword'])) {
                $error = true;
                $errormsg = $errormsg . "Retyped Password cannot be Empty.<br>";
            }
            if (!(filter_var($_POST['repassword'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/['\"]/"))))) {
                $repassword = $_POST['repassword'];
            } else {
                $error = true;
                $errormsg = $errormsg . "Error in Retyped password.<br>";
            }
            if ((filter_var($_POST['firstname'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/[a-zA-Z]/"))))) {
                $firstname = $_POST['firstname'];
            } else {
                $error = true;
                $errormsg = $errormsg . "Error in Firstname.<br>";
            }
            if ((filter_var($_POST['lastname'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/[a-zA-Z]/"))))) {
                $lastname = $_POST['lastname'];
            } else {
                $error = true;
                $errormsg = $errormsg . "Error in Lastname.<br>";
            }
            if (!empty($_POST['gender'])) {

                $gender = $_POST['gender'];
            } else {
                $error = true;
                $errormsg = $errormsg . "Select a gender.<br>";
            }
            if ($password !== $repassword) {
                $error = true;
                $errormsg = $errormsg . "Password and Retyped Password do not match.<br>";
            }

            if (!$error) {
                //Store the data and redirect to login page
                //if error leave it as it is
                $databaseadapter = new Databaseadapter();
                $saveUser = $databaseadapter->saveUser($firstname, $lastname, $email, $password, $gender);

                if ($saveUser) {
                    /* Redirect browser */
                    header("Location: login.php");

                    /* Make sure that code below does not get executed when we redirect. */
                    exit;
                }
            }
            ?>
            <div id="body">
                <div id="center">
                    <form action="" method="POST" id="registrationform">
                        <table id="registertable">
                            <tr>
                                <td>First Name </td><td><input type="text" maxlength="20" name="firstname" id="firstname" value="<?php echo $_POST['firstname'] ?>"/></td>
                            </tr>
                            <tr>
                                <td>Last Name </td><td><input type="text" maxlength="20" name="lastname" id="lastname" value="<?php echo $_POST['lastname'] ?>"/></td>
                            </tr>
                            <tr>
                                <td>Email </td><td><input type="email" maxlength="20" name="emailid" id="emailid" value="<?php echo $_POST['emailid'] ?>"/></td>
                            </tr>
                            <tr>
                                <td>Password </td><td><input type="password" maxlength="20" name="password" id="password"/></td>
                            </tr>
                            <tr>
                                <td>Retype Password </td><td><input type="password" maxlength="20" name="repassword" id="repassword"/></td>
                            </tr>
                            <?php if ($_POST['gender'] === "m") {
                                ?>
                                <tr>
                                    <td>Gender </td><td><span><input type="radio" name="gender" id="Male" value="m" checked="checked">Male</span></td>
                                </tr>
                                <tr>
                                    <td> </td><td><span><input type="radio" name="gender" id="Female" value="f" >Female</span></td>

                                </tr>
                                <?php
                            } else {
                                ?>
                                <tr>
                                    <td>Gender </td><td><span><input type="radio" name="gender" id="m" value="Male">Male</span></td>
                                </tr>
                                <tr>
                                    <td> </td><td><span><input type="radio" name="gender" id="f" value="Female" checked="checked">Female</span></td>

                                </tr>
    <?php } ?>
                            <tr align="right">
                                <td colspan="2" ><input type="submit" value="register" id='registerbutton' name='registerbutton'/></td>
                            </tr>
                        </table>
                    </form>
                    <div id="errordiv">
    <?php echo ($errormsg); ?>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>

            <div id="body">
                <div id="center">
                    <form action="" method="POST" id="registrationform">
                        <table id="registertable">
                            <tr>
                                <td>First Name </td><td><input type="text" maxlength="20" name="firstname" id="firstname" required/></td>
                            </tr>
                            <tr>
                                <td>Last Name </td><td><input type="text" maxlength="20" name="lastname" id="lastname" required/></td>
                            </tr>
                            <tr>
                                <td>Email </td><td><input type="email" maxlength="20" name="emailid" id="emailid" required/></td>
                            </tr>
                            <tr>
                                <td>Password </td><td><input type="password" maxlength="20" name="password" id="password" required/></td>
                            </tr>
                            <tr>
                                <td>Retype Password </td><td><input type="password" maxlength="20" name="repassword" id="repassword" required/></td>
                            </tr>
                            <tr>
                                <td>Gender </td><td><span><input type="radio" name="gender" id="Male" value="m">Male</span></td>
                            </tr>
                            <tr>
                                <td> </td><td><span><input type="radio" name="gender" id="Female" value="f" checked="checked">Female</span></td>

                            </tr>
                            <tr align="right">
                                <td colspan="2" ><input type="submit" value="register" id='registerbutton' name='registerbutton'/></td>
                            </tr>
                        </table>
                    </form>
                    <div id="errordiv">
                    </div>
                </div>
            </div>
            <?php } ?>
        <div id="footer">
<?php include("common/footer.php"); ?>
        </div>
    </body>
</html>
