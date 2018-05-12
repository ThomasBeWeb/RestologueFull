<?php
session_start();

require("./scripts/fonctions.php");

if($_POST){

    //Check si POST venant de l'étape simple login ou la suivante verif mot de passe admin

    if(isset($_SESSION['fonction'])){ //Etape verif password
/*
$url = $file_name;
$fields = array(
            '__VIEWSTATE'=>urlencode($state),
            '__EVENTVALIDATION'=>urlencode($valid),
            'btnSubmit'=>urlencode('Submit')
        );

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
$fields_string = rtrim($fields_string,'&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

//execute post
$result = curl_exec($ch);
print $result;
*/
        echo $_POST['username']."+".$_POST['password'];

    }else{ //Check Login
        $_SESSION['username'] = $_POST['username'];

    //Verif si admin

    if ($stream = fopen('https://whispering-anchorage-52809.herokuapp.com/use/'.$_POST['username'], 'r')) {
        
        $fonction = stream_get_contents($stream, -1, 0);

        fclose($stream);
        
        $_SESSION['fonction'] = $fonction;

        if($fonction === "admin"){  //Si admin affichage de la page login

            echo showMeTheLoginPage();

        }else{
            header("location: ".$_SERVER['HTTP_REFERER']);
        }
    }
    }
    
}else{
    session_destroy();
    header("location: ".$_SERVER['HTTP_REFERER']);
}