<?php
session_start();
if($_POST){
    $_SESSION['username'] = $_POST['username'];

    //Verif si admin

    if ($stream = fopen('https://whispering-anchorage-52809.herokuapp.com/use/'.$_POST['username'], 'r')) {
        
        $fonction = stream_get_contents($stream, -1, 0);

        fclose($stream);

        $_SESSION['fonction'] = $fonction;
    }
}else{
    session_destroy();
}
header("location:".$_SERVER['HTTP_REFERER']);

