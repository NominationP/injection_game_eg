<?php

require_once 'role.php';
require_once 'weapon.php';
require_once 'monster.php';

$weapon = new Weapon("木剑",20,20);
$role = new Role("yibo",$weapon);
$monster = new Monster("boss",100,3);
print_r($monster);
$role->weapon->attack($monster,$weapon);
// $role = new Role("yibo",$weapon);

