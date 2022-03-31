<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modification des quantités</title>
        <link rel="stylesheet" href="main.css">

    </head>

    <body>

        <header>

            <h1>Modifier les quantités de : </h1>

        </header>

        <div class="editquantitybro">
    
            <?php

                require './bdd.php';

                if (isset($_POST['editquantity'])) {
                    $indexproduct = $_POST['editproduct'];

                    $sqlQuery = 'SELECT * FROM product WHERE id = '.$indexproduct;
                    $recipesStatement = $bdd->prepare($sqlQuery);
                    $recipesStatement->execute();
                    $recipes = $recipesStatement->fetchAll();
                    

                    foreach ($recipes as $recipe) {
                        ?>
                    
                        <img src=<?php echo $recipe['urlimage']; ?> alt="blabla" height="500px" width="auto">
                        
                        <p style="color: white;">

                            <?php echo $recipe['productname']; ?> × <?php echo $recipe['quantity']; ?>
                        
                        </p>

                        <form method="POST" action="">

                            <input type="number" name="newquantity" required>

                            <input style="display: none;" type="number" name="editproduct" value=<?php echo $recipe['id']; ?> required  readonly="readonly">

                            <input type="submit" name="editquantitybro" value="UPDATE">

                        </form>

                        <?php
                    }
                }

                if (isset($_POST['editquantitybro'])) {
            
                    if (
                            !empty($_POST['newquantity'])
                        )    
                    {
                        $indexproduct2 = $_POST['editproduct'];
                        $productnewquantity = htmlspecialchars($_POST['newquantity']);
                    
                        $req = $bdd->prepare('UPDATE `product` SET `quantity` = '.$productnewquantity.' WHERE id = '.$indexproduct2);
                        $req->execute();
                        $req->closeCursor();
                    
                        header("Location: gestiondestock.php");

                    } else {
                        echo "Vous n'avez pas rempli tous les champs";
                    }
                }

            ?>
        
        </div>
        
    </body>

</html>