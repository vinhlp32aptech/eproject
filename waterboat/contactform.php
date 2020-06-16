<?php

if(isset($_POST['submit'])){
    $name = $_POST['full name'];
    $email = $_POST['email'];
    $number = $_POST['phone'];
    $message = $_POST['message'];

    $mailTo = "nguyentuanquang03042001@gmail.com";
    $header = "you:".$email;
    $txt = "you have received am e-mail from".$name.".\n\n".$message;



    $retval = mail ($to,$subject,$message,$header);

    if( $retval == true ) {
        echo "Message sent successfully...";
    }else {
        echo "Message could not be sent...";
    }
}