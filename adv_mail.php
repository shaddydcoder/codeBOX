
<HTML>
<HEAD><TITLE>E-mailer</TITLE></HEAD>
<BODY background="bricks.jpg">
<?php
//adv_mailer.php

function mailer_header()
{
?>
<p>
<?php
}

function mailer_footer()
{
?>
<p>
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

function mail_form() {
   global $PHP_SELF;
?>
<FORM METHOD="POST" ENCTYPE="MULTIPART/FORM-DATA" ACTION="<?php echo $PHP_SELF ?>">
<INPUT TYPE="HIDDEN" NAME="action" VALUE="send_mail">
<DIV ALIGN="CENTER ">
<TABLE CELLSPACING="2" CELLPADDING="5" WIDTH="79%" BORDER="0">
   <TR>
      <TH ALIGN="right" WIDTH="16%"><font color="#FFFF00">To</font></TH>
      <TD WIDTH="84%" colspan="2"><font color="#FFFF00"><INPUT NAME="mail_to" SIZE="81"></font></TD>
   </TR>
   <TR>
      <TH ALIGN="right" WIDTH="16%"><font color="#FFFF00">Cc</font></TH>
      <TD WIDTH="84%" colspan="2"><font color="#FFFF00"><INPUT NAME="mail_cc" SIZE="81"></font></TD>
   </TR>
   <TR>
      <TH ALIGN="right" WIDTH="16%"><font color="#FFFF00">Bcc</font></TH>
      <TD WIDTH="84%" colspan="2"><font color="#FFFF00"><INPUT NAME="mail_bcc" SIZE="81"></font></TD>
   </TR>
   <TR>
      <TH ALIGN="right" WIDTH="16%"><font color="#FFFF00">From</font></TH>
      <TD WIDTH="84%" colspan="2"><font color="#FFFF00"><INPUT SIZE="81" NAME="mail_from"></font></TD>
   </TR>
   <TR>
      <TH ALIGN="right" WIDTH="16%"><font color="#FFFF00">Reply-to</font></TH>
      <TD WIDTH="84%" colspan="2"><font color="#FFFF00"><INPUT SIZE="81" NAME="mail_reply_to"></font></TD>
   </TR>
   <TR>
      <TH ALIGN="right" WIDTH="16%"><font color="#FFFF00">Attachment</font></TH>
      <TD WIDTH="84%" colspan="2"><font color="#FFFF00"><INPUT TYPE="FILE" NAME="userfile"></font></TD>
   </TR>
   <TR>
      <TH ALIGN="right" WIDTH="16%"><font color="#FFFF00">Type</font></TH>
      <TD WIDTH="23%">
      <font color="#FFFF00">
      <INPUT TYPE="RADIO" VALUE="text" NAME="mail_type" CHECKED>TEXT</font></TD>
      <TD WIDTH="61%">
      <font color="#FFFF00">
      <INPUT TYPE="RADIO" VALUE="html" NAME="mail_type">HTML</font></TD>
   </TR>
   <TR>
      <TH ALIGN="right" WIDTH="16%"><font color="#FFFF00">Encoding</font></TH>
      <TD WIDTH="23%">
      <font color="#FFFF00">
      <INPUT TYPE="RADIO" VALUE="7bit" NAME="mail_encoding" CHECKED>7BIT</font></TD>
      <TD WIDTH="61%">
      <font color="#FFFF00">
      <INPUT TYPE="RADIO" VALUE="8bit" NAME="mail_encoding">8BIT</font></TD>
   </TR>
   <TR>
      <TH ALIGN="right" WIDTH="16%"><font color="#FFFF00">Character Set</font></TH>
      <TD WIDTH="23%">
      <font color="#FFFF00">
      <INPUT TYPE="RADIO" VALUE="us-ascii" NAME="mail_charset" CHECKED>US-ASCII&nbsp;</font></TD>
      <TD WIDTH="61%">
      <font color="#FFFF00"><INPUT TYPE="RADIO" VALUE="euc-kr" NAME="mail_charset">EUC-KR</font></TD>
   </TR>
   <TR>
      <TH ALIGN="right" WIDTH="16%"><font color="#FFFF00">Subject</font></TH>
      <TD WIDTH="84%" colspan="2"><font color="#FFFF00"><INPUT SIZE="81" NAME="mail_subject"></font></TD>
   </TR>
   <TR>
      <TH ALIGN="right" WIDTH="16%" valign="top"><font color="#FFFF00">Body</font></TH>
      <TD WIDTH="84%" colspan="2"><TEXTAREA NAME="mail_body" ROWS="16"
         COLS="62"></TEXTAREA></TD>
   </TR>
   <TR>
      <TH WIDTH="100%" COLSPAN="3" ALIGN="CENTER">
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
   global $userfile, $userfile_type, $userfile_name, $userfile_size;
   global $mail_type, $mail_charset, $mail_encoding;

   $mail_parts["mail_type"] = $mail_type;
   $mail_parts["mail_charset"] = $mail_charset;
   $mail_parts["mail_encoding"] = $mail_encoding;

   $mail_parts["userfile"] = $userfile;
   $mail_parts["userfile_type"] = $userfile_type;
   $mail_parts["userfile_name"] = $userfile_name;
   $mail_parts["userfile_size"] = $userfile_size;


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

   $mail_type = $mail_parts["mail_type"];
   $mail_charset = $mail_parts["mail_charset"];
   $mail_encoding = $mail_parts["mail_encoding"];

   $userfile = $mail_parts["userfile"];
   $userfile_type = $mail_parts["userfile_type"];
   $userfile_name = $mail_parts["userfile_name"];
   $userfile_size = $mail_parts["userfile_size"];

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

   if($userfile_size > 0)
   {
      $mail_boundary = md5(uniqid(time()));
      $mail_headers .= "MIME-Version: 1.0\r\n";
      $mail_headers .= "Content-type: multipart/mixed;
                                      boundary=\"$mail_boundary\"\r\n\r\n";
      $mail_headers .= "This is a multi-part message in MIME format.\r\n\r\n";

      $fp = fopen($userfile, "r");
      $file = fread($fp, filesize($userfile));
      $file = chunk_split(base64_encode($file));

      $new_mail_body = "--$mail_boundary\r\n";
      $new_mail_body .= "Content-type:text/plain;charset=$mail_charset\r\n";
      $new_mail_body .= "Content-transfer-encoding:$mail_encoding\r\n\r\n";
      $new_mail_body .= "$mail_body\r\n";
      $new_mail_body .= "--$mail_boundary\r\n";
      if(!empty($userfile_type)) $mime_type = $userfile_type;
      else $mime_type = "application/octet-stream";

      $new_mail_body .= "Content-type:$mime_type;name=$userfile_name\r\n";
      $new_mail_body .= "Content-transfer-encoding:base64\r\n\r\n";
      $new_mail_body .= $file . "\r\n\r\n";
      $new_mail_body .= "--$mail_boundary--";
      $mail_body = $new_mail_body;
   }
   else if($mail_type == 'html')
   {
      $mail_headers .= "Content-type: text/html; charset=$mail_charset\r\n";
      $mail_headers .= "Content-transfer-encoding:$mail_encoding\r\n\r\n";
   }
   else
   {
      $mail_headers .= "Content-type: text/plain; charset=$mail_charset\r\n";
      $mail_headers .= "Content-transfer-encoding:$mail_encoding\r\n\r\n";
   }

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
</BODY>
</HTML>