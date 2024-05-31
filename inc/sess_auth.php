<?php
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $link = "https";
else
    $link = "http";
$link .= "://";
$link .= $_SERVER['HTTP_HOST'];
$link .= $_SERVER['REQUEST_URI'];
// if (!isset($_SESSION['userdata']) && !strpos($link, '?p=send_email')) {
//     redirect('?p=send_email');
// }
if (!isset($_SESSION['userdata']) && !strpos($link, '?p=registration')) {
    redirect('?p=registration');
}

if (isset($_SESSION['userdata']) && strpos($link, 'login.php')) {
    redirect('index.php');
}
if (isset($_SESSION['userdata']) && strpos($link, '?p=registration')) {
    redirect('?p=exams');
}
