<?php


$headers  = 'MIME-Version: 1.0' . "\r\n"
.'Content-type: text/html; charset=utf-8' . "\r\n"
.'From: ' . $visitor_email . "\r\n";
  
if(mail("saifsunny56@gmail.com", "hello", "telo", "mello")) {
    echo "<p>Thank you for contacting us, sunny. You will get a reply within 24 hours.</p>";
} else {
    echo '<p>We are sorry but the email did not go through.</p>';
}
      ?>