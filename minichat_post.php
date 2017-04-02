<?php
$pseudo = htmlspecialchars($_POST['pseudo']);
$message = htmlspecialchars($_POST['message']);
try{
  $bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8','phpmyadmin','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}
$req = $bdd->prepare('INSERT INTO minichat(pseudo,message) VALUES(:pseudo, :message)');
$req->execute(array(
  'pseudo' => $pseudo,
  'message' => $message
));
header('Location: minichat.php');
 ?>
