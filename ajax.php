<?php
session_start();
require_once ('ant.class.php');
require_once ('queenAnt.class.php');
require_once ('workerAnt.class.php');
require_once ('droneAnt.class.php');

if(isset($_GET["type"]) && $_GET["type"] == "queen"){
    
    $ant_queen = unserialize($_SESSION["antQueen"]);
    
    $ant_queen->tookHit();
   
    
    $_SESSION["antQueen"] = serialize($ant_queen);
    
    
}else if(isset($_GET["type"]) && $_GET["type"] == "worker"  ){
    
    $workers = unserialize($_SESSION["antWorkers"]);
    $id = (int)$_GET["id"];
    $workers[$id]->tookHit();
    $_SESSION["antWorkers"] = serialize($workers);
} else if(isset($_GET["type"]) && $_GET["type"] == "drone"){
    
    $drones = unserialize($_SESSION["antDrones"]);
    $id = (int)$_GET["id"];
    $drones[$id]->tookHit();
    $_SESSION["antDrones"] = serialize($drones);
    
    
}