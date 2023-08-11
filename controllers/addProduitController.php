<?php
require_once '../models/Produit.php';
include '../form-validation.php';
if ($isSubmitted && count($errors) == 0) {
    $produit = new Produit($nom_produit, $quantite, $produit_vendu);
    if($produit->create()){
        echo '<script>alert("produit créé")</script>';
    }
}
require_once '../views/addProduit.php';