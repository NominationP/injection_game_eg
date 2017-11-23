<?php

require_once('attackTarget.php');

class WoodenSword implements AttackTarget{
              
    public function attackTarget(monster $monster){

        $monster->notify(20);
    }

}