<?php session_start();
include('Databaseadapter.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/register.css?time=<?php echo time(); ?>">
        <link rel="stylesheet" href="css/common.css?time=<?php echo time(); ?>">
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/common.js?time=<?php echo time(); ?>"></script>
        <title></title>
    </head>
    <body>

        <div id="header">
        <?php include("common/header.php"); ?>
        </div>
        <?php
        if (empty($_SESSION['user'])) {

        } else {
            ?>
            <div id="body">
                <table id="logintable">
                    <tr>
                        <td><a href="subscriptionhistory.php">Subscription History </a></td>
                    </tr>
                    <tr>
                        <td><a href="editprofile">Edit Profile </a></td>
                    </tr>
                    <tr>
                        <td><span id="topicssubscribedspan"><a href="#topicssubscribedtable">Current Subscription</a></span></td>
                    </tr>
                </table>
                <?php
                if (!empty($_SESSION['topicssubscribed'])) {
                    ?>

                    <div id="topicssubscribedtable">
                        <table id="currentsubscriptionhistorytable" cellpadding="5" border="1">
                            <tr>
                                <th> ID</th>
                                <th> Topic Name </th>
                                <th> Valid Upto</th>
                            </tr>
                            <?php
                            $topicssubscribed = explode(",", $_SESSION['topicssubscribed']);
                            $databaseadapter = new Databaseadapter();
                            $subscritionHistory = $databaseadapter->getSubscritionHistory($_SESSION['user']);
                            //var_dump($subscritionHistory);

                            foreach ($subscritionHistory as $key => $value) {
                                //echo "<br>".$key." --- ".$value['subscriptionid']."---".$value['topicname']."----".date('M j Y g:i A', strtotime($value['timestamp'].'+ 30 days'));
                                if (!in_array($value, $topicssubscribed)) {
                                    echo "<tr><td>" . $value['subscriptionid'] . "</td><td>" . strtoupper($value['topicname']) . "</td><td>" . date('M j Y g:i A', strtotime($value['timestamp'] . '+ 30 days')) . "</td></tr>";
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            <?php
            } else {
                echo "Nothing subscribed currently.";
            }
        }
        ?>
        <div id="footer">
            <?php include("common/footer.php"); ?>
        </div>

    </body>
</html>
