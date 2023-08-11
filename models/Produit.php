<?php

require_once 'DataBase.php';

/**
 * Description of Produit
 *
 * @author s albrecht
 */
class Produit extends DataBase {

    /**
     * @var type integer
     */
    public $id;

    /**
     * @var type string
     */
    public $nom_produit;

    /**
     * @var type string
     */
    public $quantite;

    /**
     * @var type string
     */
    public $produit_vendu;

    /**
     * Le constructeur de la classe produit
     */
    public function __construct($real_produit = '', $produit_quantite = '', $vendu = '') {
        parent::__construct();
        $this->nom_produit = $real_produit;
        $this->quantite = $produit_quantite;
        $this->produit_vendu = $vendu;
    }

    /**
     * 
     * @return boolean|$this
     */
    public function create() {
        // Le code pour créer un produit
        $query = "INSERT INTO `produit` (`nom_produit`, `quantite`, `produit_vendu`) VALUE (:nom_produit, :quantite, :produit_vendu)"or die('Erreur SQL !' . ' ' );
        $sth = $this->db->prepare($query);
        $sth->bindValue('nom_produit', $this->nom_produit, PDO::PARAM_STR);
        $sth->bindValue('quantite', $this->quantite, PDO::PARAM_STR);
        $sth->bindValue('produit_vendu', $this->produit_vendu, PDO::PARAM_STR);
        if ($sth->execute()) {
            return $this;
        }
        return false;
    }
/**
 * cette methode permet de recuperer tous les produits de la clinique
 * @return type array
 */
    public function getAll() {
        $sql = 'SELECT `id`, `nom_produit`, `quantite`, `produit_vendu` FROM `produit`';
        $usersList = [];
        $sth = $this->db->query($sql);
        if ($sth instanceOf PDOStatement) {
            // Collection des données dans un tableau associatif (FETCH_ASSOC)
            $usersList = $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        return $usersList;
    }
/**
 * cette methode permet de recupérer un produit dans la bdd si il existe
 * @return boolean|$this
 */
    public function getOneById() {
        //Le code sélectionnant un produit
        $sql = 'SELECT `id`, `nom_produit`, `quantite`, `produit_vendu` FROM `produits` WHERE `id` = :id';
        $sth =$this->db->prepare($sql);
        $sth->bindValue(':id', $this->id, PDO::PARAM_INT);
        if($sth->execute()){//hydrate la fonction, lui attribut des nouvelles valeurs
            $produit = $sth->fetch(PDO::FETCH_OBJ);
            if($produit){
            $this->quantite = $produit->quantite;
            $this->nom_produit = $produit->nom_produit;
            $this->produit_vendu = $produit->produit_vendu;
            return $this;
        }
    }
       return false;
    }

    public function delete() {
        //Le code pour supprimer un produit
    }

    public function update() {
        //
    }

}
