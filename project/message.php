<?php session_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/register.css?time=<?php echo time(); ?>">
        <link rel="stylesheet" href="css/common.css?time=<?php echo time(); ?>">
        <title></title>
    </head>
    <body>
        <div id="header">
            <?php include("common/header.php"); ?>
        </div>
        <div id="body">
            <h2>
                <?php
                if (!empty($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    header("refresh:5;url=index.php");
                } else {
                    echo "Demo";
                    header("refresh:5;url=index.php");
                }
                ?>
            </h2>
        </div>
        <div id="footer">
<?php include("common/footer.php"); ?>
        </div>
    </body>


</html>
