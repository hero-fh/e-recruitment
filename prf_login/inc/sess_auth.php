<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $link = "https";
else
    $link = "http";
$link .= "://";
$link .= $_SERVER['HTTP_HOST'];
$link .= $_SERVER['REQUEST_URI'];
if (!isset($_SESSION['userdata']) && !strpos($link, 'login.php')) {
    redirect('prf_login/login.php');
}
if (isset($_SESSION['userdata']) && strpos($link, 'login.php')) {
    redirect('prf_login/index.php');
}
$module = array('', 'admin', '', 'exit', 'prf', 'prf_author');
if (isset($_SESSION['userdata']) && (strpos($link, 'index.php') || strpos($link, 'prf_login/')) && $_SESSION['userdata']['login_type'] !=  99) {
    // echo "<script>location.replace('" . base_url . $module[$_SESSION['userdata']['login_type']] . "');</script>";
    echo "<script>location.replace('" . base_url . $module[$_SESSION['userdata']['login_type']] . "');</script>";
    exit;
}
