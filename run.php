<?php

require_once 'role.php';
require_once 'weapon.php';
require_once 'woodenSword.php';
require_once 'magicSword.php';
require_once 'monster.php';

$wooden = new WoodenSword;
$magic = new MagicSword;
$role = new Role("yobo",$wooden);
$monsterBoss = new Monster("boss",100,3);
$role->weapon->attackTarget($monsterBoss);
$role->weapon = $magic;
$role->weapon->attackTarget($monsterBoss);
