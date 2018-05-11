<?php
session_start();
if($_POST){
    $_SESSION['username'] = $_POST['username'];

    //Verif si admin

    if ($stream = fopen('https://whispering-anchorage-52809.herokuapp.com/use/'.$_POST['username'], 'r')) {
        
        $fonction = stream_get_contents($stream, -1, 0);

        fclose($stream);
        
        $_SESSION['fonction'] = $fonction;

        if($fonction === "admin"){  //Si admin affichage de la page login

        ?>
<!DOCTYPE html>
<html>

<head>
    <title>Le restologue</title>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="./favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row main">
            <div class="main-login main-center">

                <div class="form-group">
                    <label for="username" class="cols-sm-2 control-label">Username</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-users fa" aria-hidden="true"></i>
                            </span>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter your Username" value="administrateur"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="cols-sm-2 control-label">Password</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-lock fa-lg" aria-hidden="true"></i>
                            </span>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" value=""/>
                    </div>
                </div>
            </div>

            <div class="form-group ">
                <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Login</button>
            </div>
    </div>
</div>
</div>
</body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js "></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js "></script>
        <link href="./css/styleConnexion.css " rel="stylesheet ">
</html>
    <?php
        }else{
            header("location: ".$_SERVER['HTTP_REFERER']);
        }
    }
}else{
    session_destroy();
    header("location: ".$_SERVER['HTTP_REFERER']);
}