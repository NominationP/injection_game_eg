

# PHP 依赖注入 类 写个例子研究一下

[依赖注入那些事儿](https://www.cnblogs.com/leoo2sk/archive/2009/06/17/1504693.html)


## v1.0
- class : monter,weapon,role
```
木剑 attack 20
boss remaind 80
occur crit
木剑 attack 40
boss remaind 40
occur crit
木剑 attack 40
boss is Dead !
```

- plan : 
> monster array -[x]
> 
> attack in weapon class->function attack by recursive

## v2.0

```
<?php

require_once 'role.php';
require_once 'weapon.php';
require_once 'woodenSword.php';
require_once 'magicSword.php';
require_once 'monster.php';

$wooden = new WoodenSword;
$magic = new MagicSword;
$role = new Role("yibo",$wooden);
$monsterBoss = new Monster("boss",100,3);
$role->weapon->attackTarget($monsterBoss);
$role->weapon = $magic;
$role->weapon->attackTarget($monsterBoss);

```

- Tip：OCP原则，即开放关闭原则，指设计应该对扩展开放，对修改关闭。
- Tip：策略模式，英文名Strategy Pattern，指定义算法族，分别封装起来，让他们之间可以相互替换，此模式使得算法的变化独立于客户。

- hp change && die ... something is duty for monster class rather than weapon 
- add attackTarget.php and each weapon class, but this not goods readable rather than v1.0
- no to study deep in this . Go on to v3.0

