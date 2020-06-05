<?php
class ErrorPHP
{
    public static function showmessage($message)
    {
        echo "<script>alert(\"$message\");</script>";
    }
}