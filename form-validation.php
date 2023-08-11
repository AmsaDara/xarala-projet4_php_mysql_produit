<?php
$isSubmitted = false;
// $regexName = "/^[A-Za-zéÉ][A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+((-| )[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+)?$/";
// $regexDate = "/^((?:19|20)[0-9]{2})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
// $regexTel = "/^0[67](\.[0-9]{2}){4}$/";
$nom_produit = $quantite = $produit_vendu ='';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isSubmitted = true;
     //verif champ nom
     $nom_produit = trim(htmlspecialchars($_POST['nom_produit']));
     //verif champ quantite
     $quantite = trim(htmlspecialchars($_POST['quantite']));
    
     //verif champ produit vendu
    $produit_vendu = trim(htmlspecialchars($_POST['produit_vendu']));
    
}