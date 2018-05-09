<?php
session_start();
if($_POST){
    $_SESSION['username'] = $_POST['username'];
}else{
    session_destroy();
}
header("location:".$_SERVER['HTTP_REFERER']);