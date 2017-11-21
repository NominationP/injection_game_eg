<?php

require_once 'weapon.php';

class Role{
    public $name,$weapon;

    function __construct($name,Weapon $weapon){
        $this->name = $name;
        $this->weapon = $weapon;
    }


}