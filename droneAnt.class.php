<?php
include_once('ant.class.php');
class droneAnt extends ant{
    
    public $hitpoints = 75;
    public $img = "droneAnt.png";
     public $perhit = 18;
    
    public function getHitpoints(){
        return $this->hitpoints;
    }
    
    public function setHitpoints($points){
        $this->hitpoints = $points;
    }
    
    public function tookHit(){
        $hp = $this->hitpoints - $this->perhit;
        if($hp < 0 ){
            $this->hitpoints = 0;
            return;
        }
        
        $this->hitpoints = $hp;
    }
    
     public function getImage(){
        return $this->imgPath.$this->img;
    }
    
}