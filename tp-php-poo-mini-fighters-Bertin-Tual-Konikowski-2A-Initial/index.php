<?php
/**
 * Created by PhpStorm.
 * User: other
 * Date: 07/01/2019
 * Time: 17:41
 */

/* Chargement des classes */
function loadClass($className)
{
    require $className . '.php';
}

spl_autoload_register('loadClass');

$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$req = $db->query('SELECT * FROM players');

$players = $req->fetchAll();

$playersArray = array();

foreach($players as $player)
{
    if($player['type']==='magicien'){
        array_push($playersArray, new Magicien($player['name'], $player['id'], $player['life'], $player['strength']));
    } else if ($player['type']==='soldat'){
        array_push($playersArray, new Soldat($player['name'], $player['id'], $player['life'], $player['strength']));
    } else {
        array_push($playersArray, new Villageois($player['name'], $player['id'], $player['life'], $player['strength']));
    }
}

if(isset($_GET['delPlayer'])){

    $suppressionPerso = new Actions($db);
    $suppressionPerso->supprimer($_GET['delPlayer']);

} else if(isset($_POST['player_name'])&&isset($_POST['player_type'])){

    $ajoutPerso = new Actions($db);
    $ajoutPerso->ajout($_POST['player_name'], $_POST['player_type']);
    exit;

} else if(isset($_POST['player_selected_a'])&&isset($_POST['player_selected_b'])){

    $combatPerso = new Actions($db);
    $combatPerso->combattre($_POST['player_selected_a'], $_POST['player_selected_b']);

} ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>TP PHP POO - Mini-Fighters</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <h1>Fighters mini-jeux</h1>
    <h2>1 - Ajouter un fighter</h2>
    <form action="" method="POST">
        <input type="text" name="player_name"/>
        <select name="player_type">
            <option value="magicien">Magicien</option>
            <option value="soldat">Soldat</option>
            <option value="villageois">Villageois</option>
        </select>
        <input type="submit" value="Ajouter personnage"/>
    </form>
    <h2>2 - Faites combattre vos fighters</h2>
    <form action="" method="POST">
        <select name="player_selected_a">
            <option value="" selected disabled>Selectionnez le joueur n°1</option>
            <?php
            foreach($playersArray as $playerArray){
                echo '<option value="'.$playerArray->getId().'">'.$playerArray->getName().' | '.$playerArray->getType().' | V:'.$playerArray->getLife().' | F:'.$playerArray->getStrength().' | '.'</option>';
            }
            ?>
        </select>
        <select name="player_selected_b">
            <option value="" selected disabled>Selectionnez le joueur n°2</option>
            <?php
            foreach($playersArray as $playerArray){
                echo '<option value="'.$playerArray->getId().'">'.$playerArray->getName().' | '.$playerArray->getType().' | V:'.$playerArray->getLife().' | F:'.$playerArray->getStrength().' | '.'</option>';
            }
            ?>
        </select>
        <input type="submit" value="Fight"/>
    </form>
    <footer>TP PHP POO - Mini-Fighters by Maxime BERTIN, Josselin TUAL & Théodore KONIKOWSKI - 2019</footer>
    <script src="script/animation.js"></script>
</body>
</html>