<?php

require_once 'role.php';
require_once 'weapon.php';
require_once 'monster.php';

$weapon = new Weapon("木剑",20,20);
$role = new Role("yibo",$weapon);
$monsterBoss = new Monster("boss",100,3);
$monsterA = new Monster("monsterA",50,1);
$monster = [$monsterA,$monsterBoss];
$role->weapon->attack($monster,$weapon);

// $role = new Role("yibo",$weapon);

