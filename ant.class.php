<?php

abstract class ant{
    
    public $hitpoints = 0;
    public $imgPath = "assets/img/";
    
    abstract protected function getHitpoints();
    abstract protected function setHitpoints($points);
    abstract protected function getImage();
    
    
    
}