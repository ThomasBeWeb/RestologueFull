<?php
session_start();
require('./folder.php');

include "./template/header.php";
include "./template/navigation.php";

//Affichage content en fonction du GET

if($_GET){
    include "./contents/".$_GET['page'].".php";
}else{
    include "./template/default.html";  //Page Home
}
include "./template/footer.php";
?>		