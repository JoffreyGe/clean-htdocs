<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mon Localhost</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>

  <style media="screen">
    h2 {
      padding: 40px 0 15px;
    }

    .project {
      padding-bottom: 15px;
    }
  </style>
  <body>

      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">Localhost</a>
          </div>
        </div>
      </nav>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Localhost</a>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#now">En cours <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#waiting">À venir</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#done">Terminer</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
          </form>
        </div>
      </nav>

      <?php
        $dir_nom = '/Applications/MAMP/htdocs'; // Replace by your htdocs path
        $dir = opendir($dir_nom) or die('Erreur de listage : le répertoire n\'existe pas');
        $file= array();
        $folder= array();
        $done= array();
        $waiting= array();
        $blacklist= array();

        while($element = readdir($dir)) {
        	if($element != '.' && $element != '..') {
            if (!is_dir($dir_nom.'/'.$element)) {$file[] = $element;}
            elseif (strpos($element, 'assets') !== false) {$blacklist[] = $element;}
            elseif (strpos($element, '[termine]') !== false || strpos($element, '[done]') !== false) {$done[] = $element;}
            elseif (strpos($element, '[attente]') !== false || strpos($element, '[waiting]') !== false) {$waiting[] = $element;}
        		else {$folder[] = $element;}
        	}
        }

        closedir($dir);
      ?>
      <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Bienvenue sur localhost !</h1>
          <?= count($folder); ?> <?php if (count($folder) <= 1) {echo " projet est";}else {echo "projets sont";} ?> en cours de développements</p>
          <p><b><?= count($waiting); ?>  <?php if (count($waiting) <= 1) {echo " projet est";}else {echo "projets sont";} ?> en attente</b> - <?= count($done); ?> projets sont terminés</p>
          <p><a class="btn btn-primary btn-lg" href="http://localhost/MAMP/phpmyadmin.php?lang=fr" role="button">Accès à phpMyAdmin</a>&nbsp;
            <a class="btn btn-secondary btn-lg" href="http://localhost/MAMP" role="button">Accès à la page d'accueil</a></p>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-12" id="now">
            <h2>Les projets en cours</h2>
          </div>
          <?php
          if(!empty($folder)) {
            sort($folder); // pour le tri croissant, rsort() pour le tri décroissant
            foreach($folder as $link){ ?>
              <div class="col-4 project">
                <h3><?php echo "$link"; ?></h3>
                <a class="btn btn-outline-success" href="<?php echo $link; ?>" role="button">Accéder</a>
              </div>
            <?php }
          }
          ?>
          <?php if (!empty($waiting)): ?>


            <div class="col-12" id="waiting">
              <h2>Les projets en attente de retour</h2>
            </div>
            <?php
            if(!empty($waiting)) {
              sort($waiting); // pour le tri croissant, rsort() pour le tri décroissant
              foreach($waiting as $link){ ?>
                <div class="col-4 project">
                  <h3>
                    <img src="assets/img/waiting.svg" alt="waiting icon" width="20" height="20">
                    <?php echo str_replace('[attente]', '', $link); ?>
                  </h3>
                  <a class="btn btn-outline-success" href="<?php echo $link; ?>" role="button">Accéder</a>
                </div>
              <?php }
            }
            ?>
          <?php endif; ?>

          <hr>
          <div class="col-12" id="done">
            <h2>Les projets terminés</h2>
          </div>
          <?php
          if(!empty($done)) {
            sort($done); // pour le tri croissant, rsort() pour le tri décroissant
            foreach($done as $link){ ?>
              <div class="col-4 project">
                <h3>
                  <img src="assets/img/done.svg" alt="waiting icon" width="20" height="20">
                  <?php echo str_replace('[termine]', '', $link); ?></h3>
                <a class="btn btn-outline-success" href="<?php echo $link; ?>" role="button">Accéder</a>
              </div>
            <?php }
          }
          ?>
        </div>
        <hr>

      </main>

        <footer class="container">
          <p>© 2017 <a href="https://github.com/JoffreyGe">JoffreyGe</a></p>
        </footer>
      </div> <!-- /container -->


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  </body>
</html>
