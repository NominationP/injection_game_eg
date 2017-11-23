<?php


require_once 'monster.php';

class Weapon{

    public $name,$damage,$crit;

    public  function __construct($name,$damage,$crit){

        $this->name = $name;
        $this->damage = $damage;
        $this->crit = $crit;
        
    }


    public function attack($monster_arr,Weapon $weapon){

        foreach ($monster_arr as $key => $value) {
            print_r($value->name." occur !!!!!\n");
            $this->attack_action($value,$weapon);
        }
    }


    public function attack_action(Monster $obj,Weapon $weapon){


        /** stom */
        $tmp_damage = $weapon->damage;
        if(rand(0,1) && $weapon->crit>0){
            
            print_r("occur crit"."\n");
            $tmp_damage = $tmp_damage*2;
        }else{
            $tmp_damage = $tmp_damage;
        }
        $obj->hp-=$tmp_damage;



        print_r($weapon->name." attack ".$tmp_damage."\n");
        if($obj->hp <= 0){
            print_r($obj->name." is Dead !"."\n");
            return;
        }else{
            print_r($obj->name." remaind ".$obj->hp."\n");
        }

        $this->attack_action($obj,$weapon);
    }
}