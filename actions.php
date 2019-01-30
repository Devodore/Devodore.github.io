<?php
/**
 * Created by PhpStorm.
 * User: other
 * Date: 18/01/2019
 * Time: 11:50
 */

class Actions
{
	protected $db;
	
	public function __construct($dbb){
			$this->db = $dbb;
	}
	
    public function ajout($playerName, $playerType)
    {
        $character = new Character();
        

        if(isset($playerName)&&isset($playerType)){

            switch($playerType){
                case 'magicien':
                    $newPlayer = new Magicien($playerName);
                    break;
        
                case 'soldat':
                    $newPlayer = new Soldat($playerName);
                    break;
        
                case 'villageois':
                    $newPlayer = new Villageois($playerName);
                    break;
            }
			$dba = $this->db;
            $req = $dba->prepare('INSERT INTO players (name, type, strength, life) VALUES(:name, :type, :strength, :life)');
            $req->execute(array(
                'name' => $newPlayer->getName(),
                'type' => $newPlayer->getType(),
                'strength' => $newPlayer->getStrength(),
                'life' => $newPlayer->getLife(),
            ));
        
            header('location: index.php');
        }
    }

    public function supprimer($id)
    {

		$dba = $this->db;
        $req = $dba->prepare('DELETE FROM players WHERE id=:id');
        $req->execute(array(
            'id' => $id,
        ));
        header('location: index.php');
    }

    public function combattre($player_a, $player_b)
    {
        $dba = $this->db;

        if(isset($player_a)&&isset($player_b)){
            $req = $dba->prepare('SELECT * FROM players WHERE id=:id_player_a OR id=:id_player_b');
            $req->execute(array(
                'id_player_a' => $player_a,
                'id_player_b' => $player_b,
            ));
            $selectedPlayers = $req->fetchAll();
            $selectedPlayersArray = array();
            if(sizeof($selectedPlayers)===2){
                foreach($selectedPlayers as $player)
                {
                    if($player['type']==='magicien'){
                        array_push($selectedPlayersArray, new Magicien($player['name'], $player['id'], $player['life'], $player['strength']));
                    } else if ($player['type']==='soldat'){
                        array_push($selectedPlayersArray, new Soldat($player['name'], $player['id'], $player['life'], $player['strength']));
                    } else {
                        array_push($selectedPlayersArray, new Villageois($player['name'], $player['id'], $player['life'], $player['strength']));
                    }
                }
                $selectedPlayersArray[0]->damage($selectedPlayersArray[1]->getStrength());
                $selectedPlayersArray[1]->damage($selectedPlayersArray[0]->getStrength());
        
                for($j=0;$j<=1;$j++){
                    $req = $dba->prepare('UPDATE players SET life = :life WHERE id = :id');
                    $req->execute(array(
                        'life' => $selectedPlayersArray[$j]->getLife(),
                        'id' => $selectedPlayersArray[$j]->getId(),
                    ));
                }
                $fightIsPossible = true;
                /* echo $selectedPlayersArray[1]->getName().' a encore '.$selectedPlayersArray[1]->getLife().'</br>'; */
                echo '<div class="countDown">3</div>';
                echo '<div class="playerSpawn" id="playerSpawn1"><img src="img/castle.png" alt="Tour de chateau"/></div>';
                echo '<div class="playerSpawn" id="playerSpawn2"><img src="img/castle.png" alt="Tour de chateau"/></div>';
                echo '<div class="container">';
                for($k=0;$k<2;$k++){
                    switch($selectedPlayersArray[$k]->getType()) {
                        case 'soldat' :
                            echo '<div id="character'. $k .'" class="characters"><h2><span>'.$selectedPlayersArray[$k]->getLife().'</span> <i class="material-icons">favorite</i></h2><a href="?delPlayer='.$selectedPlayersArray[$k]->getId().'"><img src="img/suppression.png"/><span>Cliquez pour supprimer le joueur.</span></a><img src="img/soldat.png" alt="Miniature soldat"/></div>';
                            break;
                        case 'villageois' :
                            echo '<div id="character'. $k .'" class="characters"><h2><span>'.$selectedPlayersArray[$k]->getLife().'</span> <i class="material-icons">favorite</i></h2><a href="?delPlayer='.$selectedPlayersArray[$k]->getId().'"><img src="img/suppression.png"/><span>Cliquez pour supprimer le joueur.</span></a><img src="img/villageois.png" alt="Miniature villageois"/></div>';
                            break;
                        case 'magicien' :
                            echo '<div id="character'. $k .'" class="characters"><h2><span>'.$selectedPlayersArray[$k]->getLife().'</span> <i class="material-icons">favorite</i></h2><a href="?delPlayer='.$selectedPlayersArray[$k]->getId().'"><img src="img/suppression.png"/><span>Cliquez pour supprimer le joueur.</span></a><img src="img/magicien.png" alt="Miniature magicien"/></div>';
                            break;
                    }
                }
                echo '</div>';
            } else {
                echo 'Vous ne pouvez pas faire combattre deux même joueur.';
            }
        }
    }
}
?>