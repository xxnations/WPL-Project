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
        <?php
        if(!$_SESSION['user'])
        {
            /* Redirect browser */
header("Location: index.php");
 
/* Make sure that code below does not get executed when we redirect. */
exit;
        }
        ?>
        <div id="header">
        <?php include("common/header.php"); ?>
        </div>
        <?php
       if(!empty($_POST))
       {
            $email = "";
            $password = "";
            $repassword="";
            $firstname="";
            $lastname="";
            $error=false;
            $errormsg="";
            if (filter_var($_POST['emailid'], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST['emailid'];
            }
            else
            {
                $error=true;
                $errormsg=$errormsg."Invalid Email Address.<br>";
            }
            if(empty($_POST['password']))
                {
                    $errormsg=$errormsg."Password cannot be Empty.<br>";
                }
                
            if (!(filter_var($_POST['password'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/['\"]/"))))) {
                $password = $_POST['password'];
                
            }
            else
            {
                $error=true;
                $errormsg=$errormsg."Error in password.<br>";
                
            }
            if(empty($_POST['repassword']))
                {
                    $errormsg=$errormsg."Retyped Password cannot be Empty.<br>";
                }
            if (!(filter_var($_POST['repassword'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/['\"]/"))))) {
                $repassword = $_POST['repassword'];
            }
            else
            {
                $error=true;
                $errormsg=$errormsg."Error in Retyped password.<br>";
                
            }
            if ((filter_var($_POST['firstname'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/[a-zA-Z]/"))))) {
                $firstname = $_POST['firstname'];
            }
            else
            {
                $error=true;
                $errormsg=$errormsg."Error in Firstname.<br>";
            }
            if ((filter_var($_POST['lastname'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/[a-zA-Z]/"))))) {
                $lastname = $_POST['lastname'];
            }
            else
            {
                $error=true;
                $errormsg=$errormsg."Error in Lastname.<br>";
            }
            if (!empty($_POST['gender'])) {
                $gender = $_POST['gender'];
            }
            else
            {
                $error=true;
                $errormsg=$errormsg."Select a gender.<br>";
            }
            if($password!==$repassword)
            {
                $error=true;
                $errormsg=$errormsg."Password and Retyped Password do not match.<br>";
            }
            
             if(!$error)
            {
                //Store the data and redirect to login page
                //if error leave it as it is
                $databaseadapter = new Databaseadapter();
                $updateUser = $databaseadapter->updateUser($_SESSION['user'],$firstname,$lastname,$email,$password,$gender);
                
                if($updateUser)
        {
            /* Redirect browser */
                    $_SESSION['emailid']=$email;
header("Location: myaccount.php");
 
/* Make sure that code below does not get executed when we redirect. */
exit;
        }
            }
           
            ?>
        <div id="body">
            <form action="" method="POST" id="registrationform">
            <table id="registertable">
                <tr>
                    <td>First Name </td><td><input type="text" maxlength="20" name="firstname" id="firstname" value="<?php echo $_POST['firstname']?>"/></td>
                </tr>
                <tr>
                    <td>Last Name </td><td><input type="text" maxlength="20" name="lastname" id="lastname" value="<?php echo $_POST['lastname']?>"/></td>
                </tr>
                <tr>
                    <td>Email </td><td><input type="email" maxlength="20" name="emailid" id="emailid" value="<?php echo $_POST['emailid']?>"/></td>
                </tr>
                <tr>
                    <td>Password </td><td><input type="password" maxlength="20" name="password" id="password" value="<?php echo $_POST['password']?>"/></td>
                </tr>
                <tr>
                    <td>Retype Password </td><td><input type="password" maxlength="20" name="repassword" id="repassword" value="<?php echo $_POST['repassword']?>"/></td>
                 </tr>
                 <?php if($_POST['gender']==="m")
                 {?>
                <tr>   
                    <td>Gender </td><td><input type="radio" name="gender" id="Male" value="m" checked="checked">Male</td>
                </tr>
                <tr>
                    <td> </td><td><input type="radio" name="gender" id="Female" value="f" >Female</td>
                    
                </tr>
                 <?php }
                 else
                 {
                     
?>
                <tr>   
                    <td>Gender </td><td><input type="radio" name="gender" id="m" value="Male">Male</td>
                </tr>
                <tr>
                    <td> </td><td><input type="radio" name="gender" id="f" value="Female" checked="checked">Female</td>
                    
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
                <?php
            
       }
       else
       {
           $databaseadapter = new Databaseadapter();
           $result1 = $databaseadapter->getUserById($_SESSION['user']);
           $result=$result1[0];
          
        ?>
        
        <div id="body">
            <form action="" method="POST" id="registrationform">
            <table id="registertable">
                <tr>
                    <td>First Name </td><td><input type="text" maxlength="20" name="firstname" id="firstname" value="<?php echo $result['firstname']; ?>"/></td>
                </tr>
                <tr>
                    <td>Last Name </td><td><input type="text" maxlength="20" name="lastname" id="lastname" value="<?php echo $result['lastname']; ?>"/></td>
                </tr>
                <tr>
                    <td>Email </td><td><input type="email" maxlength="20" name="emailid" id="emailid" value="<?php echo $result['emailid']; ?>"/></td>
                </tr>
                <tr>
                    <td>Password </td><td><input type="password" maxlength="20" name="password" id="password" value="<?php echo $result['password']; ?>"/></td>
                </tr>
                <tr>
                    <td>Retype Password </td><td><input type="password" maxlength="20" name="repassword" id="repassword" value="<?php echo $result['password']; ?>"/></td>
                 </tr>
                 <?php if($result['gender']==="f")
                 {?>
                <tr>   
                    <td>Gender </td><td><input type="radio" name="gender" id="Male" value="m">Male</td>
                </tr>
                <tr>
                    <td> </td><td><input type="radio" name="gender" id="Female" value="f" checked="checked">Female</td>
                    
                </tr>
                 <?php }
                 else
                 {?>
                <tr>   
                    <td>Gender </td><td><input type="radio" name="gender" id="Male" value="m" checked="checked">Male</td>
                </tr>
                <tr>
                    <td> </td><td><input type="radio" name="gender" id="Female" value="f" >Female</td>
                    
                </tr>
                 <?php } ?>
                <tr align="right">
                    <td colspan="2" ><input type="submit" value="register" id='registerbutton' name='registerbutton'/></td>
                </tr>
            </table>
        </form>
            <div id="errordiv">
            </div>
             </div>
       <?php } ?>
            <div id="footer">
                <?php
       include("common/footer.php"); ?>
            </div>
    </body>
</html>
