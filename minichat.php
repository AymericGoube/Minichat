
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Minichat</title>
</head>
<body>
  <form class="" action="minichat_post.php" method="post">
    <input type="text" name="pseudo" value="">
    <input type="text" name="message" value="">
    <input type="submit" name="" value="Envoyer">

    <?php
    echo '</br>';
    try{
      // connexion base de donnée
      $bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8','phpmyadmin','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
    //On vérifie que l'utilisateur a cliqué sur un lien page
    if(isset($_GET['page'])){
    $limit = $_GET['page']*10-10;
}
else{
    $limit= 0;
}

    //Requete permettant de récuperer des données dans la BDD et les afficher ligne par ligne
    $req = $bdd->prepare('SELECT * FROM minichat ORDER BY id DESC LIMIT :lim, 10');
    // on donne une valeur a :lim qui est égale a la variable limit
    $req->bindValue('lim', $limit, PDO::PARAM_INT);
    $req->execute();
      while ($donnees = $req->fetch()){
        echo $donnees['pseudo'] . ' : ' . $donnees['message'] . '</br>';
      }
      ?>

    </form>
    <a href="minichat.php"><button type="button" name="button">Rafraîchir</button></a>

    <?php
    // calcul du nombre d'id contenu dans la table minichat
    $reqNbMsg = $bdd->query('SELECT COUNT(id) as total FROM minichat');
    // on récupere le nombre contenu dans la requete précédente
    $tableNbMsg = $reqNbMsg->fetch();
    // on déclare une variable contenant le nombre de message total
    $NbMessageTotal = $tableNbMsg['total'];
    // afin d'avoir le nbr de page on divise le nombre de message par 10
    $nb_pages = ceil(($NbMessageTotal)/10);
    for ($page = 1 ; $page <= $nb_pages ; $page++)
    {
      echo '<a href="minichat.php?page=' . $page . '"> ' . $page . ' </a>';

    }
    ?>

  </body>
  </html>
