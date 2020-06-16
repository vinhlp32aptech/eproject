<?php
// Mật khẩu là dammio
$password = 'dammio';

echo 'Mật khẩu <b>' . $password . '</b> được mã hóa thành: <br/><br/>';
echo 'MD5: <b>' . md5($password) . '</b><br/>'; // mật khẩu đã được mã hóa bằng md5
echo 'SHA1: <b>' . sha1($password) . '</b>'; // mật khẩu đã được mã hóa bằng sha1
?>

