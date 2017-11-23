<?php

require_once 'weapon.php';
require_once 'attackTarget.php';

class Role{
    public $name,$weapon;

    function __construct($name,AttackTarget $weapon){
        $this->name = $name;
        $this->weapon = $weapon;
    }


}