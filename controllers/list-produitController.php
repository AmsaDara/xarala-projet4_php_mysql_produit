<?php
require_once '../models/Produit.php';
$produit = new Produit();
$usersList = $produit->getAll();
require_once '../views/list-produit.php';