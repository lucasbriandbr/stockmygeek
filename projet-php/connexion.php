<?php
    session_start();
    require "./bdd.php";

    if(isset($_POST["Submit"])) {
        if (!empty($_POST["login"]) and !empty($_POST["passw"])) {

            $login = htmlspecialchars($_POST["login"]);
            $passw = htmlspecialchars($_POST["passw"]);

            $get_user = $bdd->prepare("SELECT * FROM `users` WHERE username = ? and password = ?");
            $get_user->execute(array($login,$passw));

            if ($get_user->rowCount() > 0) {

                $_SESSION ["login"] = $get_user->fetch();

                header("Location: gestiondestock.php");
                echo "connecté";

            }
        } else {
            echo "Les informations sont vides !";
        }
    }

?>

<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion</title>
        <link rel="stylesheet" href="main.css">
    </head>

    <body>

        <header>

            <h1>Page de connection</h1>

        </header>

        <div class="loginsection">

            <form method="POST" action="" class="theformulaire">

                <div>

                    <label for="login">Login : </label>

                    <input type="text" id="login" name="login" required>

                </div>

                <div>

                    <label for="passw">password : </label>

                    <input type="passw" id="passw" name="passw" required>
                
                </div>

                <input type="submit" name="Submit" value="Send" id="boutonenvoi">

            </form>

        </div>

        <footer>



        </footer>
        
    </body>

</html>