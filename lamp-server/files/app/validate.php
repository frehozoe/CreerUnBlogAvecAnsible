<?php
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);

   require 'db-connexion.php';


   function Valider(PDO $PDO){
      if(!isset($_POST["titre"]) || empty($_POST["titre"])) {
          echo '<p style="color: red; font-weight: bold;">Veuillez ajouter un titre à votre article.</p>';
      }
      elseif(!isset($_POST["auteur"]) || empty($_POST["auteur"])) {
          echo '<p style="color: red; font-weight: bold;">Veuillez ajouter le nom de l\'auteur.</p>';
      }
      elseif(!isset($_POST["contenu"]) || empty($_POST["contenu"])) {
          echo '<p style="color: red; font-weight: bold;">Veuillez écrire le contenu de votre article.</p>';
      }
      else{
        $request = $PDO->prepare("INSERT INTO articles (titre, auteur, contenu) VALUES (:titre, :auteur, :contenu)");
        $request->bindValue(":titre", $_POST["titre"]);
        $request->bindValue(":auteur", $_POST["auteur"]);
        $request->bindValue(":contenu", $_POST["contenu"]);
        $request->execute();
        header('Location: index.php');
      }

      echo '<p><a href="index.php">Home</a></p>';
   }

   $PDO = new PDO(DB_DSN, DB_USER, DB_PASS, $options);
   Valider($PDO);
?>

