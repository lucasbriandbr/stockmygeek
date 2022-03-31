<?php

    require './bdd.php';

    if (isset($_POST['sub'])) {

        if (
                !empty($_POST['productname']) && 
                !empty($_POST['urlimage']) && 
                !empty($_POST['quantity'])
            )    
        {
            $productname = htmlspecialchars($_POST['productname']);
            $urlimage = htmlspecialchars($_POST['urlimage']);
            $quantity = htmlspecialchars($_POST['quantity']);
    
            $req = $bdd->prepare('INSERT INTO product SET productname = ?, urlimage = ?, quantity = ?');
            $req->execute([$productname, $urlimage, $quantity]);
            $req->closeCursor();

            $message = 'user lucas insert '.$produstname.' into the bdd';
            $date = date('d-m-y h:i:s');
            $recipesStatement2 = $bdd->prepare('INSERT INTO logs SET date = ?, message = ?');
            $recipesStatement2->execute([$date, $message]);
            $req->closeCursor();
    
            header("Location: gestiondestock.php");
        } else {
            echo "Vous n'avez pas rempli tous les champs";
        }
    }

    if (isset($_POST['hagrah'])) {

        $indextodelete = htmlspecialchars($_POST['deleteproduct']);

        $req = $bdd->prepare('DELETE FROM `product` WHERE id = ?');
        $req->execute([$indextodelete]);
        $req->closeCursor();
        $lastindex = $indextodelete;

    }

?>

<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestionnaire de stocks</title>
        <link rel="stylesheet" href="main.css">
    </head>

    <body>

        <header>

            <h1>Gestionnaire de stock</h1>

        </header>

        <div class="produits">
            
            <?php

                require './bdd.php';

                $sqlQuery = 'SELECT * FROM product';
                $recipesStatement = $bdd->prepare($sqlQuery);
                $recipesStatement->execute();
                $recipes = $recipesStatement->fetchAll();

                foreach ($recipes as $recipe) {
            ?>

                <div class="produit">
                    
                    <img src=<?php echo $recipe['urlimage']; ?> alt="blabla" height="200px" width="auto">

                    <p>
                        
                        <?php echo $recipe['productname']; ?> × <?php echo $recipe['quantity']; ?>

                        <div class="formulairedesupressionoumodification">

                            <form method="POST" action="modificationquantity.php">

                                <input style="display:none;" type="number" name="editproduct" value=<?php echo $recipe['id']; ?> required  readonly="readonly">

                                <input type="submit" name="editquantity" value="EDIT" style="background-color: green; color:white;">

                            </form>

                            <form method="POST" action="">

                                <input style="display:none;" type="number" name="deleteproduct" value=<?php echo $recipe['id']; ?> required  readonly="readonly">

                                <input type="submit" name="hagrah" value="DELETE" style="background-color: red; color:white;">

                            </form>

                        </div>
                    
                    </p>
            
                </div>

            <?php
                }
            
            ?>

        </div>

        <header>

            <h1>Add Product</h1>

        </header>

        <div class="loginsection">

            <form method="POST" action="" class="theformulaire">

                <div>

                    <label for="productname">ProductName : </label>

                    <input type="text" id="productname" name="productname" required>

                </div>

                <div>

                    <label for="urlimage">UrlImage : </label>

                    <input type="text" id="urlimage" name="urlimage" required>
                
                </div>

                <div>

                    <label for="quantity">Quantity : </label>

                    <input type="number" id="quantity" name="quantity" required>
                
                </div>

                <input type="submit" name="sub" value="Add Product" id="addproductbutton">

            </form>

        </div>

        <div>

                <center style="padding: 30px; color:white; text-decoration: none;">

                    <p><a href="logs.php">Visualiser les Logs du serveur</a></p>

                </center>

        </div>

    </body>

</html>