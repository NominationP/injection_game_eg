<?php 

class Monster{

    public $name,$hp,$level;

    public  function __construct($name,$hp,$level){
        $this->name = $name;
        $this->hp = $hp;
        $this->level = $level;
    }

    /**
     * magic methods 
     * need use ?
     * @param  [type] $property [description]
     * @return [type]           [description]
     */
    public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function notify($damage){
        
        $this->hp -= $damage;
        
        if($this->hp <= 0){
            print_r($this->name." is dead !!!\n");
        }else{
            print_r($this->name." least PH: $this->hp \n");
        }

    }





}

