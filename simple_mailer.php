<?php
//simple_mailer.php

function mailer_header()
{
?>
<HTML>
<HEAD><TITLE>E-mailer</TITLE></HEAD>
<BODY>
<?php
}

function mailer_footer()
{
?>
</BODY>
</HTML>
<?php
}

function error_message($msg)
{
   mailer_header();
   echo "<SCRIPT>alert(\"Error: $msg\");history.go(-1)</SCRIPT>";
   mailer_footer();
   exit;
}

function user_message($msg)
{
   mailer_header();
   echo "<SCRIPT>alert(\"$msg\");history.go(-1)</SCRIPT>";
   mailer_footer();
   exit;
}

function mail_form()
{
   global $PHP_SELF;
?>
<FORM METHOD="POST" ENCTYPE="MULTIPART/FORM-DATA"
      ACTION="<?php echo $PHP_SELF ?>">
<INPUT TYPE="hidden" NAME="action" VALUE="send_mail">
<DIV ALIGN="CENTER ">
<TABLE CELLSPACING="2" CELLPADDING="5" WIDTH="90%" BORDER="1">
   <TR>
      <TH ALIGN="CENTER" WIDTH="30%">To</TH>
      <TD WIDTH="70%"><INPUT NAME="mail_to" SIZE="20"></TD>
   </TR>
   <TR>
      <TH ALIGN="CENTER" WIDTH="30%">Cc</TH>
      <TD WIDTH="70%"><INPUT NAME="mail_cc" SIZE="20"></TD>
   </TR>
   <TR>
      <TH ALIGN="CENTER" WIDTH="30%">Bcc</TH>
      <TD WIDTH="70%"><INPUT NAME="mail_bcc" SIZE="20"></TD>
   </TR>
   <TR>
      <TH ALIGN="CENTER" WIDTH="30%">From</TH>
      <TD WIDTH="70%"><INPUT SIZE="20" NAME="mail_from"></TD>
   </TR>
   <TR>
      <TH ALIGN="CENTER" WIDTH="30%">Reply-To</TH>
      <TD WIDTH="70%"><INPUT SIZE="20" NAME="mail_reply_to"></TD>
   </TR>
   <TR>
      <TH ALIGN="CENTER" WIDTH="30%">Subject</TH>
      <TD WIDTH="70%"><INPUT SIZE="40" NAME="mail_subject"></TD>
   </TR>
   <TR>
      <TH ALIGN="CENTER" WIDTH="30%">Body</TH>
      <TD WIDTH="70%"><TEXTAREA NAME="mail_body" ROWS="16"
         COLS="70"></TEXTAREA></TD>
   </TR>
   <TR>
      <TH WIDTH="100%" COLSPAN="2" ALIGN="CENTER">
         <INPUT TYPE="SUBMIT" VALUE="Send" NAME="SUBMIT">
         <INPUT TYPE="RESET" VALUE="Reset" NAME="RESET">
      </TH>
   </TR>
</TABLE>
</DIV>
</FORM>
<?php
}

function send_mail()
{
   global $mail_to, $mail_cc, $mail_bcc, $mail_from, $mail_reply_to;
   global $mail_body, $mail_subject;

   $mail_parts["mail_to"] = $mail_to;
   $mail_parts["mail_from"] = $mail_from;
   $mail_parts["mail_reply_to"] = $mail_reply_to;
   $mail_parts["mail_cc"] = $mail_cc;
   $mail_parts["mail_bcc"] = $mail_bcc;
   $mail_parts["mail_subject"] = trim($mail_subject);
   $mail_parts["mail_body"] = $mail_body;

   if(my_mail($mail_parts))
      user_message("Successfully sent an e-mail titled '$mail_subject'.");

   else error_message("An unknown error occurred while attempting to
                                 send an e-mail titled '$mail_subject'.");
}

function my_mail($mail_parts)
{
   $mail_to = $mail_parts["mail_to"];
   $mail_from = $mail_parts["mail_from"];
   $mail_reply_to = $mail_parts["mail_reply_to"];
   $mail_cc = $mail_parts["mail_cc"];
   $mail_bcc = $mail_parts["mail_bcc"];
   $mail_subject = $mail_parts["mail_subject"];
   $mail_body = $mail_parts["mail_body"];

   if(empty($mail_to)) error_message("Empty to field!");
   if(empty($mail_subject)) error_message("Empty subject!");
   if(empty($mail_body)) error_message("Empty body! ");

   $mail_to = str_replace(";", ",", $mail_to);

   $mail_headers = '';

   if(!empty($mail_from)) $mail_headers .= "From: $mail_from\n";
   if(!empty($mail_reply_to)) $mail_headers .= "Reply-to: $mail_reply_to\n";
   if(!empty($mail_cc))
            $mail_headers .= "Cc: " . str_replace(";", ",", $mail_cc) . "\n";
   if(!empty($mail_bcc))
            $mail_headers .= "Bcc: " . str_replace(";", ",", $mail_bcc) . "\n";

   $mail_subject = stripslashes($mail_subject);
   $mail_body = stripslashes($mail_body);

   return mail($mail_to,$mail_subject,$mail_body,$mail_headers);
}

switch ($action)
{
   case "send_mail":
      mailer_header();
      send_mail();
      mailer_footer();
      break;
   case "mail_form":
      mailer_header();
      mail_form();
      mailer_footer();
      break;
   default:
      mailer_header();
      mail_form();
      mailer_footer();
      break;
}
?>