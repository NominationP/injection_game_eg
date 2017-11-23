<?php

require_once('attackTarget.php');

class MagicSword implements AttackTarget{
              
    public function attackTarget(monster $monster){

        
        $monster->notify(30);
    }

}