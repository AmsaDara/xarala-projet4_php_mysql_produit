<?php
include 'form-validation.php';
if ($isSubmitted && count($errors) == 0) {
require 'params.php';
$conn->exec("SET CHARACTER SET utf8");
$query = "INSERT INTO produit (`nom_produit`, `quantite`, `produit_vendu`) 
VALUE (:nom_produit, :quantite, :produit_vendu)"
or die ('Erreur SQL !'.$req.' ');
$sth = $conn->prepare($query);

$sth->bindValue('nom_produit', $nom_produit, PDO::PARAM_STR);
$sth->bindValue('quantite', $quantite, PDO::PARAM_STR);
$sth->bindValue('produit_vendu', $produit_vendu, PDO::PARAM_STR);

$execute = $sth->execute();

header('Location: lists-produit.php?succes');
        exit();
}
include 'views/includes/header.php';
?>



        <div class="col mt-4">
            <form method="post" action="#">
                <div class="mb-3">
                    <label for="nom_produit" class="form-label">Nom Du Produit : </label>
                    <input type="text" class="form-control" id="nom_produit" name="nom_produit" value="<?= $nom_produit ?>" placeholder="Veuillez entrée le nom du produit">
                </div>
                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantité : </label>
                    <input type="number" class="form-control" id="quantite" name="quantite" value="<?= $quantite ?>" placeholder="Veuillez entré un nombre">
                </div>
                <div class="mb-3">
                    <label for="produit_vendu" class="form-label">Déja Vendu :</label>
                    <input type="number" class="form-control" id="produit_vendu" name="produit_vendu" value="<?= $produit_vendu ?>" placeholder="Veuillez entré un nombre">
                </div>
                <button type="submit"  value="Ajout d'un produit" class="btn btn-primary">Enregistré Le Produit</button>
            </form>
        </div>

    </div>
    </div>
    
    <?php include 'views/includes/footer.php'; ?>