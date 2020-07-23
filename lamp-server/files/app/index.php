<?php

   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);

   require 'db-connexion.php';

   function getArticles(PDO $PDO)
   {
      $sql = "SELECT * FROM articles ORDER BY id DESC";
      $result = $PDO->query($sql);
      $articles = $result->fetchAll(PDO::FETCH_ASSOC);
      $result->closeCursor();
      return $articles;
   }
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </head>

<body>
   <nav id="scroll-navbar" class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.php">MyBlog</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Home </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Articles <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>
    <main role="main" class="container">
    <h1 class="mt-5">Articles</h1>
    <hr>
    <h2 class="mt-5 mb-3">Ajouter un nouvel article</h2>
    <form action="validate.php" method="post">
      <div class="form-group">
        <label for="titre">Titre <span style="color: red; font-weight: bold;">*</span></label>
        <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre de votre article" required="required">
      </div>

      <div class="form-group">
        <label for="auteur">Nom de l'auteur <span style="color: red; font-weight: bold;">*</span></label>
        <input type="text" class="form-control" id="auteur" name="auteur" placeholder="Nom de l'auteur" required="required">
      </div>

      <div class="form-group">
        <label for="contenu">Contenu <span style="color: red; font-weight: bold;">*</span></label>
        <textarea class="form-control" id="contenu" name="contenu" rows="5" required="required"></textarea>
      </div>

      <button type="submit" class="btn btn-default">Valider</button>
    </form>

    <br><hr>
    <h2 class="mt-5 mb-5">Liste d'articles</h2>
    <?php
    try {
      $PDO = new PDO(DB_DSN, DB_USER, DB_PASS, $options);

      $articles = getArticles($PDO);
      foreach ($articles as $article) {
        $articleTime = date("d/m/y H:i", strtotime($article["date"]));
        ?>
        <div class="card mt-5">
          <div class="card-header">
            <h2 class="h3"><?= $article["titre"] ?> <small class="text-muted font-italic"></h2>
            <?= $articleTime ?></small>
          </div>
          <div class="card-body">
            <p class="card-text"><?= $article["contenu"] ?></p>
            <footer class="blockquote-footer"><cite title="Source Title"><?= $article["auteur"] ?><cite></footer>
          </div>
        </div>
      <?php
      }
    } catch (PDOException $pe) {
      echo 'ERREUR :', $pe->getMessage();
    }
    ?>

  </main>

  <footer class="page-footer font-small bg-dark mt-5">
    <div class="footer-copyright text-center py-5 text-white">© Copyright:
      <a href="index.php">MyBlog</a>
    </div>
  </footer>
  </body>
</html>
