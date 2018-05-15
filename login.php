<?php
session_start();
require('./folder.php');
require("./scripts/fonctions.php");

if($_POST){

    //Check si POST venant de l'étape simple login ou la suivante verif mot de passe admin

    if(isset($_SESSION['fonction'])){ //Etape verif password

        //Infos à POST

        $dataTab = array('username'=> $_POST['username'] ,'password'=> $_POST['password']);
        $data = json_encode($dataTab);

        //POST: http://php.net/manual/en/function.stream-context-create.php
        $context_options = array (
                'http' => array (
                    'method' => 'POST',
                    'header'=> "Content-type: application/json; charset=utf-8\r\n"
                        . "Content-Length: " . strlen($data) . "\r\n",
                    'content' => $data
                    )
                );

        $context = stream_context_create($context_options);
        $fp = fopen('https://whispering-anchorage-52809.herokuapp.com/verify', 'r', false, $context);

        $result = stream_get_contents($fp, -1, 0);

        fclose($fp);

        //Verif resultat

        if($result === "true"){   //Password OK
            $_SESSION['checked'] = "true";
            header("location: " . $racine);
        }else{
            echo showMeTheLoginPage();
        }

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

    if($_SERVER['HTTP_REFERER'] === $racine."?page=gestionCartes" OR $_SERVER['HTTP_REFERER'] === $racine."?page=gestionUsers"){
        header("location: " . $racine);
    }else{
        header("location: ".$_SERVER['HTTP_REFERER']);
    }
    
}