<?php

require_once 'role.php';
require_once 'weapon.php';
require_once 'woodenSword.php';
require_once 'magicSword.php';
require_once 'monster.php';

// $weapon = new Weapon("木剑",20,20);
// $role = new Role("yibo",$weapon);
// $monsterBoss = new Monster("boss",100,3);
// $monsterA = new Monster("monsterA",50,1);
// $monster = [$monsterA,$monsterBoss];
// $role->weapon->attack($monster,$weapon);

// $role = new Role("yibo",$weapon);

$wooden = new WoodenSword;
$magic = new MagicSword;
$role = new Role("yobo",$wooden);
$monsterBoss = new Monster("boss",100,3);
$role->weapon->attackTarget($monsterBoss);
$role->weapon = $magic;
$role->weapon->attackTarget($monsterBoss);
