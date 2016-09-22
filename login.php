<?php
  setcookie("phpmailapp[host]", $host, time()+1800, "/PHPMailApp/", "www.kaddoura.com/group1/jjmemail.htm",0);
  setcookie("phpmailapp[pass]", $pass, time()+1800, "/PHPMailApp/", "www.kaddoura.com/group1/jjmemail.htm",0);
  setcookie("phpmailapp[un]", $un, time()+1800, "/PHPMailApp/", "www.kaddoura.com/group1/jjmemail.htm",0);
  setcookie("phpmailapp[port]", $port, time()+1800, "/PHPMailApp/", "www.kaddoura.com/group1/jjmemail.htm",0);
?>

<?php $pagetext = "Your Mailbox"; ?>
<?php include("inc/class.POP3.php"); ?>
<?

  $accnt = new POP3($host, 60);

  if(!$accnt->connect($host, 110) )
  {
    echo "Problem $accnt->ERROR <br>\n";
    exit;
  }

  $Count = $accnt->login($un, $pass);
  if( (!$Count) or ($Count == -1) )
  {
    echo "<H1>Login Failed: $accnt->ERROR</H1>\n";
    exit;
  }

  if ($Count < 1)
  {
    echo "Login OK: No Messages in Inbox<br>\n";
  }
  else {
    echo "Login OK: You have [$Count] messages<br>\n";
  }

?>
<a href="mail.php?com=list">Inbox</a>
<?php include("inc/footer.inc"); ?>