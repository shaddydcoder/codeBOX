<?php
  setcookie("phpmailapp[host]", "", time()+1800, "/PHPMailApp/", "www.kaddoura.com/group1/jjmemail.htm",0);
  setcookie("phpmailapp[pass]", "", time()+1800, "/PHPMailApp/", "www.kaddoura.com/group1/jjmemail.htm",0);
  setcookie("phpmailapp[un]", "", time()+1800, "/PHPMailApp/", "www.kaddoura.com/group1/jjmemail.htm",0);
  setcookie("phpmailapp[port]", "", time()+1800, "/PHPMailApp/", "www.kaddoura.com/group1/jjmemail.htm",0);
?>

<?php $pagetext = "Your Mailbox"; ?>
<?php include("inc/header.inc"); ?>
<?php include("inc/menu.inc"); ?>
<?php include("inc/class.POP3.php"); ?>
<?

        print("You Are logged out");

?>

<?php include("inc/footer.inc"); ?>