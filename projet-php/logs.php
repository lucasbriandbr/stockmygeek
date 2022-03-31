<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Logs du serveur</title>
        <link rel="stylesheet" href="main.css">

    </head>

    <body>

        <header>

            <h1>Logs du serveur : </h1>

        </header>

        <div>

            
            
            <?php

                require './bdd.php';

                $sqlQuery = 'SELECT * FROM logs';
                $recipesStatement = $bdd->prepare($sqlQuery);
                $recipesStatement->execute();
                $recipes = $recipesStatement->fetchAll();

                foreach ($recipes as $recipe) {
            ?>

                <div>

                    <p><?php echo $recipe['date']; ?> , "<?php echo $recipe['message']; ?>"</p><br>

                </div>

            <?php
                }
            
            ?>

            <a href="gestiondestock.php">Retour à la page des Stocks</a>

        </div>
        
    </body>

</html>